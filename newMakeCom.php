<?php 
// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
include($_SERVER['DOCUMENT_ROOT']."/mission6_2/left.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>新規登録 | TECH-BASE掲示板</title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<div class="right">
  <div class="user">
    <p>登録完了しました</p>
    <a href="home.php" class="optional">ホームに戻る</a><br>
  </div>
</div>
</body>
</html>
