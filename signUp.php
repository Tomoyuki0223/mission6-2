<?php 
// セッションの開始
session_start();

// ログイン中ならログイン中画面へ移動
if(isset($_SESSION['EMAIL'])) {
  header("Location: seCom.php");
  exit();
}

$attention = NULL;

// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// 空欄がない場合に登録情報との比較を開始
if(!empty($_POST["loginEmail"]) && !empty($_POST["loginPass"])) {
  $sql = "SELECT * FROM mission6_2_member";
  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  foreach ($results as $row){
    if($row['mailadress'] == $_POST["loginEmail"]) {
      if($row['password'] == $_POST["loginPass"]) {
        $_SESSION['EMAIL'] = $_POST["loginEmail"];
        header("Location: home.php");
        exit();
      }
    }
  }
  $attention = "メールアドレスまたはパスワードが異なります！";
} else if(isset($_POST["loginSend"])) {
  $attention = "メールアドレスまたはパスワードが空欄です！";
}
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
    <p>掲示板にログイン</p>
    <form action="" method="post">
    <input type="email" name="loginEmail" placeholder="メールアドレス"><br>
    <input type="password" name="loginPass" placeholder="パスワード"><br>
    <h5 class="attention"><?php echo $attention ?></h5>
    <button type="submit" name="loginSend">ログイン
    </form>
  </div>
</div>
</body>
</html>
