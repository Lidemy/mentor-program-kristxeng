<?php
class User extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('url');
  }

  public function login() {

    $data['title'] = '登入';
    $data['file'] = 'login';

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    //如果沒有輸入值，顯示登入頁
    if( $this->form_validation->run() === FALSE ) {
      $this->load->view('header', $data);
      $this->load->view('login', $data);
      $this->load->view('footer');

    //有輸入值，則驗證登入
    } else {
      $username = $this->input->post( 'username' );
      $password = $this->input->post( 'password' );
      $result = $this->user_model->find_user_by_username( $username );

      if( $result !== 'error') {

        //比對使用者輸入密碼與資料庫內密碼是否相同，比對正確設定 session 並回到首頁
        if( password_verify( $password, $result['password'] ) ){
          $this->session->set_userdata('user_id', $result['user_id']);
          echo 'ok';
        } else {
          echo'error';
        }

      } else {
        echo 'error';
      }
    }
  }

  public function reg() {

    $data['title'] = '註冊';
    $data['file'] = 'reg';

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('nickname', 'Nickname', 'required');

    //如果沒有輸入值，顯示註冊頁
    if( $this->form_validation->run() === FALSE ) {
      $this->load->view('header', $data);
      $this->load->view('reg', $data);
      $this->load->view('footer');

    
    } else { 

      $username = $this->input->post( 'username' );
      $password = $this->input->post( 'password' );
      $nickname = $this->input->post( 'nickname' );


      //確認 username 與 nickname 是否重複
      $chk_result = $this->user_model->chk_user_existed( $username, $nickname );
      
      if( !$chk_result ) {
        $hashed_password = password_hash( $password, PASSWORD_DEFAULT );
        $add_result = $this->user_model->add_user( $username, $hashed_password, $nickname );

        //使用者新增成功，設定 session 並回傳 ok
        if( $add_result ){
          $this->session->set_userdata( 'user_id', $this->db->insert_id() );
          echo 'ok';
        
        } else  echo "error: Can't add user !";
      }

      //帳號或暱稱已重複，回傳 error
      else echo 'error';
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}