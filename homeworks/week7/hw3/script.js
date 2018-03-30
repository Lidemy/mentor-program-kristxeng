/********************/
/*					*/
/*	for index.php	*/
/*					*/
/********************/


$(function(){
	
	$('.container-fluid').on('click', e =>{
		
		//處理子留言框折疊或顯示的toggle
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

							content.outerHTML = `
								<div class="cmmt__content">
									${htmlspecialchars(content.value)}
								</div>`
							e.target.innerText = '編輯';
							e.target.className = 'cmmt__edit';

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

							$(e.target).parent().parent().parent().parent().remove();
						}

					}
				}

				req.open( 'POST', 'delete_cmmt.php', true );
				req.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
				req.send( 'cmmt_id=' + cmmt_id.innerText );

			}


		}

	})

	//登出按鍵處理
	$('.cmmt__logout').on('click', ()=>{

		document.location.href = 'logout.php';
		
	})

	//新增留言的 ajax 處理
	$('.container-fluid').on('click','.cmmt__btn' , function(e){

		e.preventDefault();

		if( $(e.target).prev().prev().val() === '' ){

			alert('請輸入您的留言內容');

		}else{

			$.ajax({
				type: 'POST',
				url: 'insert_cmmt.php',
				data: {
					parent_id: $(e.target).prev().val(),
					content: $(e.target).prev().prev().val()
				},
				success: res =>{

					//console.log(res);

					var resText = JSON.parse(res);
					var nickname = resText.nickname;
					var created_by = resText.created_by;
					var content = $(e.target).prev().prev().val();
					var cmmt_id = resText.cmmt_id;

					//取得主要留言者暱稱，做之後子留言上色的判斷
					var primary_cmmt_nickname = $(e.target).parents('.cmmt-box').children('.cmmt__header').children('.cmmt__nickname').text();


					//console.log("nickname:" + nickname)

					//console.log("primary_cmmt_nickname:" + primary_cmmt_nickname)

					//顯示在主留言
					if( e.target.className === 'cmmt__btn'){

						$('.cmmt-box:first').after(`
							<div class="cmmt-box col-lg-6 col-sm-10 mx-auto mb-2 p-4">
								<!--  顯示主留言 START  -->
								<div class="cmmt__header">
									<div class="cmmt__nickname">${nickname}</div>
									<div>
										<div class="cmmt__time">${created_by}</div>
										<div class="cmmt__edit-delete">
											<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>
										</div>
									</div>
								</div>
								<div class="cmmt__content">${content}</div>
								<div class="cmmt__id">${cmmt_id}</div>

								<!--  顯示子留言串 START  -->
									
								<!--   子留言的撰寫框 START  -->
								<div class="sub-cmmt">  			
									<div class="sub-cmmt__collapse-toggle">回應[+]</div>
										<div>
											<div class="cmmt__nickname">${nickname}</div>
											<textarea class="cmmt__textarea" name="content" placeholder="留言內容" required=""></textarea>
											<input type="hidden" name="parent_id" value="${cmmt_id}">
											<input class="cmmt__btn sub-cmmt__btn" type="submit" value="送 出">
										</div>
									</div>
								</div>
							</div>`
						)

					//顯示在子留言
					}else {

						$(e.target).parent().parent().before(`
							<div class="sub-cmmt col-11">
								<div class="cmmt__header">
									<div class="cmmt__nickname">${nickname}</div>
									<div>	
										<div class="cmmt__time">${created_by}</div>
										<div class="cmmt__edit-delete">
											<span class="cmmt__edit">編輯</span>&nbsp;/&nbsp;<span class="cmmt__delete">刪除</span>									</div>
									</div>
								</div>

								<div class="cmmt__content">${content}</div>
								<div class="cmmt__id">${cmmt_id}</div>
							</div>`
						)

						//如果子留言與主留言暱稱相同，則上色
						if( nickname === primary_cmmt_nickname ){

							$(e.target).parent().parent().prev().addClass('sub-cmmt__main-author');
						}


					}

					//把輸入欄位清空
					$(e.target).prev().prev().val('');
				}
			});
		}


	})

})

function chkRequired( field ){

	if( field.value === '') return false;
	else return true;
}

// javascript 版本的 htmlspecialchars
var htmlspecialchars = function (string, quote_style) {
   string = string.toString();

   string = string.replace(/&/g, '&amp;');
   string = string.replace(/</g, '&lt;');
   string = string.replace(/>/g, '&gt;');

   if (quote_style == 'ENT_QUOTES') {
       string = string.replace(/"/g, '&quot;');
       string = string.replace(/\'/g, '&#039;');
   } else if (quote_style != 'ENT_NOQUOTES') {
       string = string.replace(/"/g, '&quot;');
   }

   return string;
}

