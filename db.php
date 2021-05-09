<?php
    /*DB接続開始*/
    $dsn = 'mysql:dbname=tb221121db;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    /*DB接続完了*/
?>
