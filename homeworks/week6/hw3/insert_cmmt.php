<?php

require_once('conn.php');

$chk_stmt = $conn->prepare("SELECT user_id FROM $certificates_table WHERE certificate = :certificate");
$chk_stmt->bindParam(':certificate', $_COOKIE[certificate]);
$chk_stmt->execute();
$chk_stmt->setFetchMode(PDO::FETCH_ASSOC);
$chk_row = $chk_stmt->fetch();

$stmt = $conn->prepare("INSERT INTO $cmmts_table (user_id, parent_id, content)" .
					" VALUES (:user_id, :parent_id , :content )");
$stmt->bindParam(':user_id', $chk_row['user_id']);
$stmt->bindParam(':parent_id', $_POST['parent_id']);
$stmt->bindParam(':content', $_POST['content']);

if( $stmt->execute() ){

	header("Location: ./index.php");
}


?>