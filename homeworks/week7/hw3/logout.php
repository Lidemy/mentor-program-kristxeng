<?php

session_start();


//清除 session
session_unset();
session_destroy();

//跳轉回首頁
header("Location: ./index.php");

?>
