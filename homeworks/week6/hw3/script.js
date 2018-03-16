/********************/
/*					*/
/*	for index.php	*/
/*					*/
/********************/


document.addEventListener('DOMContentLoaded', ()=>{
	
	//處理子留言框折疊或顯示的toggle
	let container = document.querySelector('.container');
	container.addEventListener('click', e =>{
		
		//「回應toggle」處理
		if(e.target.className === 'sub-cmmt__collapse-toggle'){
			if( e.target.innerText ==='回應[+]' ){

				e.target.innerText = '回應[-]';
				e.target.nextElementSibling.style.display = 'block';
				
			}else{

				e.target.innerText = '回應[+]';
				e.target.nextElementSibling.style.display = 'none';
			}	
		}

		//編輯完成按鍵處理
		if(e.target.className === 'cmmt__edited'){
			var content = e.target.parentNode.parentNode.parentNode.nextElementSibling;
			var cmmt_id = content.nextElementSibling;
			
			//必填檢查
			if( chkRequired(content) ){
				let req = new XMLHttpRequest();

				req.onload = () =>{
					if( req.status >= 200 && req.status < 400 ){
						if( req.responseText === 'modified' ){

							window.location.reload();
						}

					}
				}

				req.open( 'POST', 'modify_cmmt.php', true );
				req.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
				req.send( 'cmmt_id=' + cmmt_id.innerText + '&content=' + encodeURIComponent(content.value) );

			}

		}

		//編輯留言按鍵處理
		if(e.target.className === 'cmmt__edit'){
			var content = e.target.parentNode.parentNode.parentNode.nextElementSibling;
			var newTextArea = document.createElement('textarea');
			//顯示留言區塊轉換成textarea
			newTextArea.className = 'cmmt__textarea';
			newTextArea.innerText = content.innerText;
			content.outerHTML = newTextArea.outerHTML;
			e.target.innerText = '完成';
			e.target.className = 'cmmt__edited';

		}

		

		//刪除留言按鍵處理
		if(e.target.className === 'cmmt__delete'){
			var content = e.target.parentNode.parentNode.parentNode.nextElementSibling;
			var cmmt_id = content.nextElementSibling;
			
			//必填檢查
			if( chkRequired(content) ){
				let req = new XMLHttpRequest();

				req.onload = () =>{
					if( req.status >= 200 && req.status < 400 ){
						if( req.responseText === 'deleted' ){

							window.location.reload();
						}

					}
				}

				req.open( 'POST', 'delete_cmmt.php', true );
				req.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
				req.send( 'cmmt_id=' + cmmt_id.innerText );

			}


		}

	})

	document.querySelector('.cmmt__logout').addEventListener('click', ()=>{

		document.location.href = 'logout.php';
		
	})

})

function chkRequired( field ){

	if( field.value === '') return false;
	else return true;
}
