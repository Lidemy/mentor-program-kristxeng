document.addEventListener('DOMContentLoaded', ()=>{

	let container = document.querySelector('.container');

	container.addEventListener('click', e =>{
		console.log(e.target.className)
		if(e.target.className === 'box-collapse'){

			if( e.target.innerText ==='回應▶' ){

				e.target.innerText = '回應▼';
				e.target.nextElementSibling.style.display = 'block';
			
			}else{

				e.target.innerText = '回應▶';
				e.target.nextElementSibling.style.display = 'none';

			}
			

		}

	})
	
})