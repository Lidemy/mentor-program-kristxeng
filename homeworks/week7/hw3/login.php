<!DOCTYPE html>
<html lang="zh-Hant-TW">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>登入</title>
		<meta name="description" content="This is Mentor Program Week7 hw3" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!--  jQuery  -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!--  Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script>
			$(function(){

				document.querySelector('.login__btn').addEventListener('click', ()=>{

					let username = document.querySelector('[name=username]');
					let password = document.querySelector('[name=password]');

					if( chkRequired(username) && chkRequired(password) ){
				
						let req = new XMLHttpRequest();

						req.onload = () =>{
							if( req.status >= 200 && req.status < 400 ){
								console.log(req.responseText);

								if( req.responseText === 'error' ){

									showWarning( '', '帳號/密碼 錯誤！' );
									$(".alert").alert();
								}

								if( req.responseText === 'ok' ){

									showWarning('' , '登入成功' );
									document.location.href = 'index.php';
								}
							}
						}

						req.open( 'POST', 'chk_login.php', true );
						req.setRequestHeader( "Content-type","application/x-www-form-urlencoded" );
						req.send( 'username='+username.value+'&password='+password.value );
						
					}else{

						if( !chkRequired(username) ) showWarning(username, '以上皆為必填項目');
						if( !chkRequired(password) ) showWarning(password, '以上皆為必填項目');
					}
				}) //END of querySelector('.login__btn')



				// document.querySelector('.cmmt-box').addEventListener('click', e =>{
				// 	//如果點擊輸入框，隱藏所有提示
				// 	let username = document.querySelector('[name=username]');
				// 	let password = document.querySelector('[name=password]');

				// 	if( e.target.className === 'login__input'){
						
				// 		document.querySelector('.login__warning-toggle').innerText = '';
				// 		document.querySelector('.login__warning-toggle').style.visibility = 'hidden';
				// 		username.style.borderColor = '#CCCCCC';
				// 		password.style.borderColor = '#CCCCCC';
				// 	}
				// }) //END of querySelector('.cmm-box')
			})

			function chkRequired( field ){

				if( field.value === '') return false;
				else return true;
			}

			function showWarning( field, warningText ){

				$('.login__warning-toggle').text(warningText);
				$('.login__warning-toggle').css('visibility','visible');

			}

		</script>
	</head>
	<body>
		<div class="login-container container-fluid d-flex justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="display-4 mt-5">使用者登入</div>
				<div class="cmmt-box bg-white p-5">

					<div class="login__title">請輸入您的使用者名稱：</div>
					<input class="login__input" name="username" type="text" placeholder="帳號" /><br>

					<div class="login__title">請輸入您的密碼：</div>
					<input class="login__input" name="password" type="password" placeholder="密碼" /><br>

					<div class="login__warning-toggle"></div>
					<input class="cmmt__btn login__btn" type="button" value="Sign In" />

					<div class="login__title login__title--centered"><a href="reg.php">還沒有帳號？ 請按此註冊</a></div>
					
				</div>
			</div>
		</div>

	</body>
</html>