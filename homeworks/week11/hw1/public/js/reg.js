document.addEventListener('DOMContentLoaded', ()=>{
	document.querySelector('.login__btn').addEventListener('click', ()=>{

		let username = document.querySelector('[name=username]');
		let password = document.querySelector('[name=password]');
		let nickname = document.querySelector('[name=nickname]');

		//如果三項必填檢驗都通過才執行XHR
		if( chkRequired(username) && chkRequired(password) && chkRequired(nickname) ){

			let req = new XMLHttpRequest();

			req.onload = () =>{
				if( req.status >= 200 && req.status < 400 ){

					console.log( req.responseText );

					/*
					if( req.responseText === 'u_err') showWarning('','此【帳號】已有人使用！');
					if( req.responseText === 'n_err') showWarning('','此【暱稱】已有人使用！');
					if( req.responseText === 'both_err' || req.responseText === 'n_erru_err' || req.responseText === 'u_errn_err') {
						showWarning('','此【帳號】及【暱稱】已有人使用！');
					}*/

					if( req.responseText === 'error' ) showWarning('', '帳號或暱稱已有人使用！');

					//註冊完成，轉回首頁
					if( req.responseText === 'ok' ) {

						showWarning('', '註冊成功');
						document.location.href = '/';
					}
				}
			}

			req.open('POST', '/reg', true);
			req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			req.send('username='+username.value+'&password='+password.value+'&nickname='+nickname.value );
			
		}else{

			//檢查哪一項未填，並顯示提示
			if( !chkRequired(username) ) showWarning(username, '以上皆為必填項目');
			if( !chkRequired(password) ) showWarning(password, '以上皆為必填項目');
			if( !chkRequired(nickname) ) showWarning(nickname, '以上皆為必填項目');
		}

	}) //END of querySelector('.login__btn')

	document.querySelector('.cmmt-box').addEventListener('click', e =>{
		//如果點擊輸入框，隱藏所有提示
		let username = document.querySelector('[name=username]');
		let password = document.querySelector('[name=password]');
		let nickname = document.querySelector('[name=nickname]');

		if( e.target.className === 'login__input'){
			
			document.querySelector('.login__warning-toggle').innerText = '';
			document.querySelector('.login__warning-toggle').style.visibility = 'hidden';
			username.style.borderColor = '#CCCCCC';
			password.style.borderColor = '#CCCCCC';
			nickname.style.borderColor = '#CCCCCC';
		}
	}) //END of querySelector('.cmm-box')
})


function chkRequired( field ){

	if( field.value === '') return false;
	else return true;
}

function showWarning( field, warningText ){

	document.querySelector('.login__warning-toggle').innerText = warningText;
	document.querySelector('.login__warning-toggle').style.visibility = 'visible';

	//如果有傳第一個參數進來才執行
	if( field !== '' ) field.style.borderColor = '#d64848';
}