<?php
class Comment extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('comment_model');
    $this->load->library('session');
  }

  public function create() {
    $user_id = $_SESSION['user_id'];
    $parent_id = $this->input->post('parent_id');
    $content = $this->input->post('content');
    $result = $this->comment_model->insert_cmmt( $user_id, $parent_id, $content );

    echo ( $result !== 'error' ) ? json_encode($result) : 'error';

  }

  public function modify() {
    $cmmt_id = $this->input->post('cmmt_id');
    $content = $this->input->post('content');
    $user_id = $_SESSION['user_id'];
    $result = $this->comment_model->modify_cmmt( $cmmt_id, $content, $user_id );

    echo  $result;

  }

  public function delete() {
    $cmmt_id = $this->input->post('cmmt_id');
    $user_id = $_SESSION['user_id'];
    $result = $this->comment_model->delete_cmmt( $cmmt_id, $user_id );

    echo $result;
    
  }

}