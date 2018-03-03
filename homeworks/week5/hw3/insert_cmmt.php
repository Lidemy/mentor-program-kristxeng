<?php
	require('conn.php');

	$sql = "INSERT INTO $cmmts_table (user_id, parent_id, content) VALUES ('" . $_COOKIE['user_id'] . 
			"' , '" . $_POST['parent_id'] . "' , '" . addslashes( $_POST['content'] ) . "' )";


	if( $conn->query($sql) === TRUE ){
		header("Location: ./index.php");
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>