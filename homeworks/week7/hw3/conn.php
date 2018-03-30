<?php

$servername = "localhost";
$username = "mentor_admin";
$password = "mentor_admin123";
$dbname = "mentor_program_db";
$cmmts_table = "kristxeng_comments2";
$users_table = "kristxeng_users";
//$certificates_table = "kristxeng_users_certificate";


//用 PDO 方式改寫

try{

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	//設定錯誤顯示時，會拋出異常
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected Success";
}

catch(PDOException $e){

	echo "Connected Failed: " . $e->getMessage();
}

?>
