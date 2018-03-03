/********************/
/*					*/
/*	for index.php	*/
/*					*/
/********************/


document.addEventListener('DOMContentLoaded', ()=>{
	
	//處理子留言框折疊或顯示的toggle
	let container = document.querySelector('.container');
	container.addEventListener('click', e =>{
		if(e.target.className === 'sub-cmmt__collapse-toggle'){
			if( e.target.innerText ==='回應[+]' ){

				e.target.innerText = '回應[-]';
				e.target.nextElementSibling.style.display = 'block';
				
			}else{

				e.target.innerText = '回應[+]';
				e.target.nextElementSibling.style.display = 'none';
			}	
		}
	})

	document.querySelector('.cmmt-box__logout').addEventListener('click', ()=>{

		
		document.location.href = 'logout.php';
		
	})

})
