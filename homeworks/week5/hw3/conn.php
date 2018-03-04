<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$cmmts_table = "";
$users_table = "";


$conn = new mysqli($servername, $username, $password, $dbname);

if( $conn->connect_error ){
	die("Connect Fails: " . $conn->connect_error);
}

?>