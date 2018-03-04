<?php

require('conn.php');

$sql = "SELECT id, username, password FROM $users_table WHERE username = '" . $_POST['username']."'" .
			"AND password = '" . $_POST['password'] . "'";

$result = $conn->query( $sql );

if( $result->num_rows === 1 ){

	$row = $result->fetch_assoc();
	setcookie('user_id', $row['id'], time()+3600*24);
	echo 'ok';

}else{

	echo 'error';
}

?>