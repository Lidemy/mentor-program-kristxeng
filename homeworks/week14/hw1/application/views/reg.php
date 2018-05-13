<div class="login-container container-fluid d-flex justify-content-center">
  <div class="col-lg-5 col-md-7">
    <div class="title mt-5"><?php echo $title ?></div>
    <div class="cmmt-box bg-white p-5">
      <div class="login__warning-toggle"></div>
      <?php echo form_open('users/reg') ?>
        <label class="login__title" for="username">選擇您的使用者名稱：</label>
        <input class="login__input" name="username" type="text" placeholder="帳號" />

        <label class="login__title" for="password">建立密碼：</label>
        <input class="login__input" name="password" type="password" placeholder="密碼" />

        <label class="login__title" for="nickname">選擇您的暱稱：</label>
        <input class="login__input" name="nickname" type="text" placeholder="暱稱" />

        <input class="cmmt__btn login__btn btn btn-primary" type="button" value="Sign Up" />
      </form>

      <div class="login__title login__title--centered text-primary">
        <a href="<?php echo base_url('/user/login/') ?>">已有帳號？ 請按此登入</a>
      </div>
      
    </div>
  </div>
</div>