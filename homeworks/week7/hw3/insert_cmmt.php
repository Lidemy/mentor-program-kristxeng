<?php

session_start();

require_once('conn.php');

$stmt = $conn->prepare("INSERT INTO $cmmts_table (user_id, parent_id, content)" .
					" VALUES (:user_id, :parent_id , :content )");

$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->bindParam(':parent_id', $_POST['parent_id']);
$stmt->bindParam(':content', $_POST['content']);
$stmt->execute();

$cmmt_id = $conn->lastInsertId();

//查詢剛剛新增留言的 nickname、cmmt_id、created_by
$stmt = $conn->prepare("SELECT nickname, created_by FROM $cmmts_table AS c INNER JOIN $users_table AS u ON c.id = :cmmt_id AND user_id = u.id");
$stmt->bindParam(':cmmt_id', $cmmt_id);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetch();

$arr = array( 
	'nickname' => $row['nickname'],
	'cmmt_id' => $cmmt_id,
	'created_by' => $row['created_by'] 
);

echo json_encode($arr);

?>

