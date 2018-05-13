$(function(){
  document.querySelector('.login__btn').addEventListener('click', e =>{
    e.preventDefault();

    let username = document.querySelector('[name=username]');
    let password = document.querySelector('[name=password]');

    if( chkRequired(username) && chkRequired(password) ){
  
      let req = new XMLHttpRequest();

      req.onload = () =>{
        console.log(req.responseText);
        if( req.status >= 200 && req.status < 400 ){

          if( req.responseText === 'error' ){

            showWarning( '', '帳號/密碼 錯誤！' );
          }

          if( req.responseText === 'ok' ){

            showWarning('' , '登入成功' );
            document.location.href = '/ci-cmmt/';
          }
        }
      }

      req.open( 'POST', './', true );
      req.setRequestHeader( "Content-type","application/x-www-form-urlencoded" );
      req.send( 'username='+username.value+'&password='+password.value );
      
    }else{

      if( !chkRequired(username) ) showWarning(username, '以上皆為必填項目');
      if( !chkRequired(password) ) showWarning(password, '以上皆為必填項目');
    }
  }) //END of querySelector('.login__btn')



  document.querySelector('.cmmt-box').addEventListener('click', e =>{
   //如果點擊輸入框，隱藏所有提示
   let username = document.querySelector('[name=username]');
   let password = document.querySelector('[name=password]');

   if( e.target.className === 'login__input'){
      
     document.querySelector('.login__warning-toggle').innerText = '';
     document.querySelector('.login__warning-toggle').style.visibility = 'hidden';
     username.style.borderColor = '#CCCCCC';
     password.style.borderColor = '#CCCCCC';
   }
  }) 
})

function chkRequired( field ){

  if( field.value === '') return false;
  else return true;
}

function showWarning( field, warningText ){

  $('.login__warning-toggle').text(warningText);
  $('.login__warning-toggle').css('visibility','visible');

}