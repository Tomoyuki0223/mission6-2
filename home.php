<?php
// セッションの開始
session_start();

// ゲストかログイン中かを把握
if(isset($_SESSION['EMAIL'])) {
  $userinf = "{$_SESSION['EMAIL']}さん，ようこそ！";
} else {
  $userinf = "ゲストさん，ようこそ！";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>TECH-BASE掲示板へようこそ！</title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<!-- 左側部分を読み込んで表示する -->
<?php include($_SERVER['DOCUMENT_ROOT']."/mission6_2/left.php"); ?>
<!-- 右側部分を表示する -->
<div class="right">
  <h4><?php echo $userinf ?></h4>
  <h1>TECH-BASE掲示板</h1>
  <div class="howTo">  
    <h2>この掲示板の使用方法は以下の通りです</h2>
    <ul>
      <li>様々なテーマについて自由に語り合える掲示板です</li>
      <li>この掲示板を利用するにはログインが必要です</li>
      <li>一度投稿したら削除はできません</li>
    </ul>
  </div>
</div>
</body>
</html>
