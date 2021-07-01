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

// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

require_once('boardName.php');

// 開いているスレの番号を抽出する
$sum = $_GET['tbname'] . $_GET['sureid'];

// 書き込みを記録するテーブルを作成
$sql = "CREATE TABLE IF NOT EXISTS {$sum} (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    comment TEXT,
    date DateTime
)";
$stmt = $pdo->query($sql);

// データを書き込む
if(isset($_POST["submit"])) {
    $comment = $_POST["comment"];
    // 空欄がない場合にはコメントなどをDBに書き込む
    if(!empty($_POST['name']) && !empty($_POST['comment'])){
        $sql = $pdo -> prepare("INSERT INTO {$sum}(name, comment,date) VALUES (:name, :comment, :date)");
        $sql -> bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $sql -> bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
        $date = date("Y/m/d H:i:s");
        $sql -> execute();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo $_GET['title'] ?></title>
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
    <div class="newSureBoard">
    <h1><?php echo $_GET['title'] ?></h1>
<?php

    // 書き込んだコメントなどを表示する！
    $sql = "SELECT * FROM {$sum}";
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row): 
?>
    <h3 class="inf"><?php echo $row['id'].". " ?></h3>
    <h3 class="inf"><?php echo "名前:" ?></h3>
    <h3 class="inf submitName"><?php echo $row['name']." " ?></h3>
    <h3 class="inf"><?php echo $row['date'] ?></h3><br>
    <p class="comment"><?php echo $row['comment']; ?></p>
    <?php endforeach ?>
    <hr>
    <div class="newCommentMake">
        <h2 class="topTitle">書きこむ</h2>
        <form action="" method="post">
        <h3 class="heading">名前</h3><input type="text" name="name" autocomplete="off" value="名無しさん"><br>
        <h3 class="heading">コメント</h3><textarea type="text" name="comment"></textarea><br>
        <input type="submit" name="submit"　value="書き込む">
        </form>
    </div>
    </div>
</div>
</body>
</html>
