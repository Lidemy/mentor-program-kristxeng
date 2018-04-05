<?php

function make_certificate( $user_id, $conn ){

	$stmt = $conn->prepare("SELECT * FROM kristxeng_users_certificate WHERE user_id = :user_id");
	$stmt->bindParam(':user_id', $user_id);
	$stmt->execute();

	//先刪除舊的certificate再創建新的certificate
	if( $stmt->rowCount() ){
		$del_sql = "DELETE FROM kristxeng_users_certificate WHERE user_id = $user_id";
		$conn->exec($del_sql);
	}

	/*
	$ref_str = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$certificate = '';
	$certificate_length = 16;

	//從 $ref_str 隨機輸出 16個字母當作憑證
	for( $i = 0; $i < $certificate_length; $i++ ){

		$certificate .= substr( $ref_str, rand(0, 35), 1 );
	}
	*/

	//改用 uniqid() 隨機生成 certificate
	$certificate = uniqid();
	$stmt = $conn->prepare("INSERT INTO kristxeng_users_certificate (user_id, certificate) VALUES (:user_id, :certificate)");
	$stmt->bindParam(':user_id', $user_id);
	$stmt->bindParam(':certificate', $certificate);
	$stmt->execute();

	return $certificate;
}

?>