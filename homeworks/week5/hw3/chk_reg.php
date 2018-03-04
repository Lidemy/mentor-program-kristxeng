<?php

require('conn.php');

$chk_sql = "SELECT username, nickname FROM $users_table WHERE username = '" . $_POST['username']."'" .
			"OR nickname = '" . $_POST['nickname'] . "'";

$chk_result = $conn->query( $chk_sql );

if( $chk_result->num_rows === 0 ){

	$reg_sql = "INSERT INTO $users_table (username, password, nickname) VALUES ('" .
				addslashes($_POST['username']) . "','" .  addslashes($_POST['password']) .
				"','" . addslashes($_POST['nickname']) ."')";

	if( $conn->query($reg_sql) === TRUE ){
		setcookie('user_id', $conn->insert_id, time()+3600*24);
		echo 'ok';
	}

}else{

	while( $chk_row = $chk_result->fetch_assoc() ){

		//echo '$chk_row["username"]= ' . $chk_row['username'];
		//echo '$_POST["username"]= ' . $_POST['username'];
		//echo '$chk_row["nickname"]= ' . $chk_row['nickname'];
		//echo '$_POST["nickname"]= ' . $_POST['nickname'];

		//字串做不分大小寫比較
		if( !strcasecmp( $chk_row['username'], $_POST['username'] ) AND !strcasecmp( $chk_row['nickname'], $_POST['nickname'] ) ){
			
			echo 'both_err';
			//重複的帳號暱稱在同一列

		}else if( !strcasecmp( $chk_row['nickname'], $_POST['nickname'] ) ){

			echo 'n_err';

		}else if( !strcasecmp( $chk_row['username'], $_POST['username'] ) ){

			echo 'u_err';
			//重複帳號暱稱若在不同列，會分別回傳n_err和u_err
		}else{

			echo 'error';
			//測試找例外錯誤時使用
		}

	}

}

?>