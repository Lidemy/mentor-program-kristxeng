<?php

require_once('conn.php');

$stmt = $conn->prepare("DELETE FROM $cmmts_table WHERE id = :cmmt_id OR parent_id = :cmmt_id");
$stmt->bindParam(':cmmt_id', $_POST['cmmt_id']);

if( $stmt->execute() ){

	echo 'deleted';
}else{

	echo 'error';
}


?>