<?php

require_once('conn.php');

$stmt = $conn->prepare("INSERT INTO $cmmts_table (user_id, parent_id, content)" .
					" VALUES (:user_id, :parent_id , :content )");
$stmt->bindParam(':user_id', $_COOKIE['user_id']);
$stmt->bindParam(':parent_id', $_POST['parent_id']);
$stmt->bindParam(':content', $_POST['content']);

if( $stmt->execute() ){

	header("Location: ./index.php");
}

$conn->close();

?>