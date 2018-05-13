<div class="login-container container-fluid d-flex justify-content-center">
  <div class="col-lg-5 col-md-7">
    <div class="title mt-5"><?php echo $title ?></div>
    <div class="cmmt-box bg-white p-5">
      <div class="login__warning-toggle"><?php echo $warning_message ?></div>
      <?php echo form_open('user/login') ?>
        <label class="login__title" for="username">請輸入您的使用者名稱：</label>
        <input class="login__input" name="username" type="text" placeholder="帳號" />

        <label class="login__title" for="password">請輸入您的密碼：</label>
        <input class="login__input" name="password" type="password" placeholder="密碼" />

        <input class="cmmt__btn login__btn btn btn-primary" type="submit" name="submit" value="Sign In" />
      </form>

      <div class="login__title login__title--centered text-primary">
        <a href="<?php echo base_url('/user/reg/') ?>">還沒有帳號？ 請按此註冊</a>
      </div>
      
    </div>
  </div>
</div>