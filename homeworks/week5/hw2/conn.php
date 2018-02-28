<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$table = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if( $conn->connect_error ){
	die("Connect Fails: " . $conn->connect_error);
}

?>