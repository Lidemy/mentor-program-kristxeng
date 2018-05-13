<?php
class Page extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('comment_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->helper('security');
    $this->load->helper('url');
  }

  public function index( $page = 1 ) {

    $data['title'] = '留言板';
    $data['file'] = 'index';

    //如果已登入，用 session 中的 user_id 找 nickname
    if( isset($_SESSION['user_id']) ){
      //用session 中的 user_id 找 nickname
      $data['current_nickname'] = $this->user_model->find_nickname_by_id( $_SESSION['user_id'] );
    }

    //查詢主要留言總數，並計算總頁數
    $total_pages = (int)ceil( $this->comment_model->count_main_cmmts() / 10 );
    
    //剔除超過範圍的頁碼
    $page = ( (int)$page <= $total_pages AND (int)$page>0) ? (int)$page : 1;
    $data['page'] = $page;
    $data['total_pages'] = $total_pages;

    
    //查詢目前頁面需要的十筆主要留言
    $cmmts = $this->comment_model->show_10cmmts( $page );
    //查詢主要留言下的子留言，並塞進主要留言陣列下的 sub_cmmts 元素
    for( $i=0; $i < count($cmmts); $i++ ) {
      $cmmts[$i]['sub_cmmts'] = $this->comment_model->show_sub_cmmts( $cmmts[$i]['cmmt_id'] );
    }
    $data['cmmts'] = $cmmts;

    $this->load->view('header', $data);
    $this->load->view('index', $data);
    $this->load->view('footer');

  }
}