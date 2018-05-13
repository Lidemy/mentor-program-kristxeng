<?php
Class User_model extends CI_Model {

  public function __construct() {

    $this->load->database();
  }

  //查詢要登入使用者的密碼
  public function find_user_by_username ( $username ) {
    $sql = 'SELECT id, username, password, nickname FROM kristxeng_users WHERE username = ?';
    $query = $this->db->query( $sql, $username);

    if( $query->num_rows() === 1) {

      //取得單行查詢結果
      $row = $query->row_array();
      return array( 'user_id'=> $row['id'], 
                    'password'=> $row['password'] );

    } else {
      return 'error';
    }
  }

  public function find_nickname_by_id ( $user_id ) {
    $sql = 'SELECT nickname FROM kristxeng_users WHERE id = ?';
    $query = $this->db->query( $sql, $user_id);
    $row = $query->row_array();
    return $row['nickname'];
  }

  //查詢使用者帳號或暱稱是否已存在
  public function chk_user_existed ( $username, $nickname ) {
    $sql = 'SELECT username , nickname FROM kristxeng_users WHERE username = ? OR nickname = ?';
    $query = $this->db->query( $sql, [$username, $nickname]);
    //username 或 nickname 已存在回傳 true，沒查到回傳 false
    return $query->num_rows() > 0 ? true : false;
  }

  //新增使用者
  public function add_user ( $username, $password, $nickname ) {
    
    $sql = 'INSERT INTO kristxeng_users (username, password, nickname) VALUES (?, ?, ?)';
    $query = $this->db->query( $sql, [$username, $password, $nickname] );
    if( $query ){
      return $this->db->insert_id();
    }
  }
}