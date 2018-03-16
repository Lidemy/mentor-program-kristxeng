<?php

require_once('conn.php');

$stmt = $conn->prepare("UPDATE $cmmts_table SET content = :content WHERE id = :cmmt_id");
$stmt->bindParam(':cmmt_id', $_POST['cmmt_id']);
$stmt->bindParam(':content', $_POST['content']);

if( $stmt->execute() ){

	echo 'modified';

}else{

	echo 'error';
}

?>