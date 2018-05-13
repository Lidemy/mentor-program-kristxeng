<?php
Class Comment_model extends CI_Model {

  public function __construct() {

    $this->load->database();
  }

  public function show_10cmmts( $current_page ) {

    $offset = ( $current_page-1 )*10;

    $sql = "SELECT c.id AS cmmt_id, user_id, nickname, created_by, content FROM kristxeng_comments2 AS c INNER JOIN kristxeng_users AS u ON parent_id = 0 AND user_id = u.id ORDER BY created_by DESC LIMIT ?, 10";
    $query = $this->db->query( $sql, $offset );
    return $query->result_array();
  }

  public function show_sub_cmmts( $parent_id ) {

    $sql = "SELECT c.id AS cmmt_id, user_id, nickname, created_by, content FROM kristxeng_comments2 AS c INNER JOIN kristxeng_users AS u WHERE parent_id = ? AND user_id = u.id ORDER BY created_by ASC";
    $query = $this->db->query( $sql, $parent_id );
    return $query->result_array();
  }

  public function count_main_cmmts() {
    $sql = "SELECT COUNT(parent_id) AS datanum FROM kristxeng_comments2 WHERE parent_id = 0";
    $query = $this->db->query( $sql );
    $row = $query->row_array();
    return $row['datanum'];
  }

  public function insert_cmmt( $user_id, $parent_id, $content ) {
    $sql = "INSERT INTO kristxeng_comments2 (user_id, parent_id, content) VALUES (?, ? , ? )";
    $query = $this->db->query( $sql, [$user_id, $parent_id, $content]);
    $cmmt_id = $this->db->insert_id();

    //如果新增成功，用 cmmt_id 回查 created_by
    if( $query ) {
      $sql = "SELECT nickname, created_by FROM kristxeng_comments2 AS c INNER JOIN kristxeng_users AS u ON c.id = ? AND user_id = u.id";
      $query = $this->db->query( $sql, $cmmt_id );
      $row = $query->row_array();

      $row['cmmt_id'] = $cmmt_id;
      return $row;
    } else {
      return 'error';
    }
  }

  public function modify_cmmt( $cmmt_id, $content, $user_id ) {
    $sql = "UPDATE kristxeng_comments2 SET content = ? WHERE id = ? AND user_id = ?";
    $query = $this->db->query( $sql, [$content, $cmmt_id, $user_id] );
    return $query ? 'modified' : 'error';
  }

  public function delete_cmmt( $cmmt_id, $user_id ) {
    $sql = "DELETE FROM kristxeng_comments2 WHERE (id = ? OR parent_id = ?) AND (user_id = ?)";
    $query = $this->db->query( $sql, [$cmmt_id, $cmmt_id, $user_id] );
    return $query ? 'deleted' : 'error';
  }


}