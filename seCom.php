<?php 
// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワ－ド';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

include($_SERVER['DOCUMENT_ROOT']."/mission6_2/left.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ログイン | TECH-BASE掲示板</title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<div class="right">
  <div class="user">
    <p>すでにログイン中です</p>
    <a href="seOut.php" class="optional">ログアウト</a><br>
  </div>
</div>
</body>
</html>
