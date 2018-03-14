<?php

require_once('conn.php');

//密碼 hash 加密處理
$hashed_password = password_hash( $_POST['password'], PASSWORD_DEFAULT );

//使用PDO & Prepared Statement 
$chk_stmt = $conn->prepare("SELECT username , nickname FROM $users_table" .
						" WHERE username=:username OR nickname=:nickname");
//bind parameters & execute
$chk_stmt->bindParam(':username', $_POST['username']);
$chk_stmt->bindParam(':nickname', $_POST['nickname']);
$chk_stmt->execute();
//設定 fetch mode 為 fetch_assoc
$chk_stmt->setFetchMode(PDO::FETCH_ASSOC);

if( $chk_stmt->rowCount() === 0 ){
	$reg_stmt = $conn->prepare("INSERT INTO $users_table (username, password, nickname) ".
								"VALUES (:username, :password, :nickname)");
	$param = [
		':username' => $_POST['username'],
		':password' => $hashed_password,
		':nickname' => $_POST['nickname']
	];

	if( $reg_stmt->execute($param) ){
		setcookie('user_id', $conn->lastInsertId(), time()+3600*24);
		echo 'ok';
	}

}else{

	while( $chk_row = $chk_stmt->fetch() ){

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



/* 原本使用 MySQLi 的方式
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
*/

?>