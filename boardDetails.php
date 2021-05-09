<?php
    require 'db.php';
    require_once('boardName.php');
    session_start();
    if(isset($_SESSION['EMAIL'])) {
        $userinf = "{$_SESSION['EMAIL']}さん，ようこそ！";
    } else {
        header("Location: newMake.php");
        exit();
    }
    
    $sql = "SELECT * FROM {$_GET['tbname']}title";
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		if($_GET['title'] == $row['sureName']) {
            $id = $row['id'];
        }
	}

    /*データベース内にテーブルを作成*/
    $sql = "CREATE TABLE IF NOT EXISTS {$_GET['tbname']}{$id}"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"/*自動で登録されていうナンバリング*/
	. "name char(32),"/*名前を入れる。文字列、半角英数で32文字*/
	. "comment TEXT,"/*コメントを入れる。文字列、長めの文章も入る*/
	. "date DateTime"/*投稿日時を入れる。文字列、長めの文章も入る*/
	.");";
	$stmt = $pdo->query($sql);
	/*データベース内にテーブルを作成終了*/

    if(isset($_POST["submit"])) {/*送信ボタンが押されたとき*/
        $name = $_POST["name"];/*入力した名前*/
        $comment = $_POST["comment"];/*変更したいコメント*/ 
        if(!empty($name) && !empty($comment)){/*空欄があったらダメ*/
            /*データを入力（データレコードの挿入）*/
            $sql = $pdo -> prepare("INSERT INTO {$_GET['tbname']}{$id} (name, comment,date) VALUES (:name, :comment, :date)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $date = date("Y/m/d H:i:s");
            $sql -> execute();
            /*データ入力完了*/
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
    <a href="https://twitter.com/tb_221121" target="_blank"><span class="fa fa-twitter"></span>twitter</a>
    |
    <a href="seOut.php">ログアウト</a>
    <a class="se"><?php echo $userinf ?></a>
  </div>
</header>
<div class="main">
    <div class="newSureBoard">
    <h1><?php echo $_GET['title'] ?></h1>
<?php
    /*入力したデータレコードを抽出し、表示する*/
    $sql = "SELECT * FROM {$_GET['tbname']}{$id}";
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
