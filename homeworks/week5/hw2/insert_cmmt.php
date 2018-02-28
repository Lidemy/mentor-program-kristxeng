<?php
	require('conn.php');

	$sql = "INSERT INTO $table (nickname, content, parent_id) VALUES ('" . addslashes( $_POST['nickname'] ) . "' , '" . addslashes( $_POST['content'] ) . "' , '" . $_POST['parent_id'] . "' )";


	if( $conn->query($sql) === TRUE ){
		echo "alert('上傳成功')";
		header("Location: ./index.php");
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>