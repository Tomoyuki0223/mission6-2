<?php
session_start();
if(isset($_SESSION['EMAIL'])) {
  $userinf = "{$_SESSION['EMAIL']}さん，ようこそ！";
} else {
  header("Location: newMake.php");
  exit();
}

require 'db.php';
require_once('boardName.php');

$sql = "CREATE TABLE IF NOT EXISTS {$_GET['tbname']}title"
      ." ("
      . "id INT AUTO_INCREMENT PRIMARY KEY,"
      . "sureName TEXT"
      .");";
$stmt = $pdo->query($sql);

if(isset($_POST["submit"])) {/*送信ボタンが押されたとき*/
  $sureName = $_POST["sureName"];
  if(!empty($sureName)) {
    $sql = $pdo -> prepare("INSERT INTO {$_GET['tbname']}title (sureName) VALUES (:sureName)");
    $sql -> bindParam(':sureName', $sureName, PDO::PARAM_STR);
    $sql -> execute();
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $_GET['name']." | TECH-BASE掲示板" ?></title>
    <link rel="stylesheet" href="stylesheet2.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  </head>
<body>
<header>
  <div class="container">
    <a href="home.php" class="home">TECH-BASE掲示板</a>
    |
    <a href="https://twitter.com/tb_221121" target="_blank"><span class="fa fa-twitter"></span>twitter</a>
    |
    <a href="seOut.php">ログアウト</a>
    <a class="se"><?php echo $userinf ?></a>
  </div>
</header>
<div class="main">
  <div class="title">
    <h1>TECH-BASE掲示板</h1>
  </div>
  <div class="index">
    <h2 class="topTitle"><?php echo $_GET['name'] ?></h2>
    <div class="suleTitle">
<?php 
      $sql = "SELECT * FROM {$_GET['tbname']}title";
      $stmt = $pdo->query($sql);
      $results = $stmt->fetchAll();
      foreach ($results as $row): ?>
        <a href="boardDetails.php?title=<?php echo $row['sureName'] ?>&tbname=<?php echo $_GET['tbname'] ?>">
        <?php echo $row['id']."．".$row['sureName'].'<br>' ?>
        </a>
      <?php endforeach ?>
    </div>
  </div>
  <div class="newSureMake">
    <h2 class="topTitle">新規スレッド作成</h2>
    <form method="post" action="">
      <h3 class="heading">スレッド名</h3>
      <input type="text" name="sureName" autocomplete="off"><br>
      <input type="submit" name="submit" value="作成">
    </form>
  </div>
</div>
</body>
</html>
