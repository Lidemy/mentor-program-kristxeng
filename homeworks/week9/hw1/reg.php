<!DOCTYPE html>
<html lang="zh-Hant-TW">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>註冊會員</title>
		<meta name="description" content="This is Mentor Program Week7 hw3" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!--  jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!--  Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script>
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

								if( req.responseText === 'u_err') showWarning('','此【帳號】已有人使用！');
								if( req.responseText === 'n_err') showWarning('','此【暱稱】已有人使用！');
								if( req.responseText === 'both_err' || req.responseText === 'n_erru_err' || req.responseText === 'u_errn_err') {
									showWarning('','此【帳號】及【暱稱】已有人使用！');
								}

								//註冊完成，轉回首頁
								if( req.responseText === 'ok' ) {

									showWarning('', '註冊成功');
									document.location.href = 'index.php';
								}
							}
						}

						req.open('POST', 'chk_reg.php', true);
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

		</script>
	</head>
	<body>
		<div class="login-container container-fluid d-flex justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="title mt-5">註冊</div>
				<div class="cmmt-box bg-white p-5">
					
					<div class="login__title">選擇您的使用者名稱：</div>
					<input class="login__input" name="username" type="text" placeholder="帳號" />

					<div class="login__title">建立密碼：</div>
					<input class="login__input" name="password" type="password" placeholder="密碼" />

					<div class="login__title">選擇您的暱稱：</div>
					<input class="login__input" name="nickname" type="text" placeholder="暱稱" />

					<div class="login__warning-toggle"></div>
					<input class="cmmt__btn login__btn btn btn-primary" type="button" value="Sign Up" />

					<div class="login__title login__title--centered"><a href="login.php">已有帳號？ 請按此登入</a></div>
					
				</div>
			</div>
		</div>
	</body>
</html>
