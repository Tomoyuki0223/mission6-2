<?php
// セッションの開始
session_start();

// ログイン中でなければアカウント作成へ移動
if(isset($_SESSION['EMAIL'])) {
  $userinf = "{$_SESSION['EMAIL']}さん，ようこそ！";
} else {
  header("Location: newMake.php");
  exit();
}

require_once('boardName.php');

// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// 初めて開いた場合はスレの名前を記録するテーブルを作成
$sql = "CREATE TABLE IF NOT EXISTS {$_GET['tbname']}title (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sureName TEXT
)";

// SQL実行
$stmt = $pdo->query($sql);

// スレを作成しようとした場合を考える
if(isset($_POST["submit"])) {
  $sureName = $_POST["sureName"];
  if(!empty($sureName)) {
    // スレ名の追加
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
  <a href="https://twitter.com/ieso_i" target="_blank"><span class="fa fa-twitter"></span>twitter</a>
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
      // 作成されているスレ一覧を画面に表示する
      $sql = "SELECT * FROM {$_GET['tbname']}title";
      $stmt = $pdo->query($sql);
      $results = $stmt->fetchAll();
      foreach ($results as $row): ?>
        <a href="boardDetails.php?title=<?php echo $row['sureName'] ?>&tbname=<?php echo $_GET['tbname'] ?>&sureid=<?php echo $row['id'] ?>">
        <?php echo $row['id']."．".$row['sureName'].'<br>' ?>
        </a>
      <?php endforeach ?>
    </div>
  </div>
  <!-- 新しいスレを立てる -->
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
