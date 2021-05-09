<?php 
    include($_SERVER['DOCUMENT_ROOT']."/left.php");
    require 'db.php';
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
