<?php 
// データベースに接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$mailadress = $_GET['adress'];
$attention = NULL;

// 空欄がない場合に登録を行おうとする
if(!empty($_POST["newNumber"]) && !empty($_POST["newPass"])) {

  // データの取得
  $sql = "SELECT * FROM mission6_2_premember";
  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  foreach ($results as $row){

    // 認証番号が同じ場合に登録する
    if($row['solveNumber'] == $_POST["newNumber"]) {
      $sql = $pdo -> prepare("INSERT INTO mission6_2_member (mailadress,password,date) VALUES (:mailadress,:password,:date)");
      $sql -> bindParam(':mailadress', $mailadress, PDO::PARAM_STR);
      $sql -> bindParam(':password', $password, PDO::PARAM_STR);
      $sql -> bindParam(':date', $date, PDO::PARAM_STR);
      $password = $_POST["newPass"];
      $date = date("Y/m/d H:i:s");
      $sql -> execute();

      header("Location: newMakeCom.php");
      exit();
    }
  }
  $attention = "認証番号が異なります！";

} else if(isset($_POST["newSend"])){
  $attention = "認証番号またはパスワードが空欄です！";
}
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
    <p>認証コードを送信しました</p>
    <form action="" method="post">
    <input type="text" name="newNumber" autocomplete="off" placeholder="認証番号"><br>
    <input type="text" name="newPass" autocomplete="off" placeholder="パスワード"><br>
    <h5 class="attention"><?php echo $attention ?></h5>
    <button type="submit" class="btn" name="newSend">アカウント作成</a>
    </form>
  </div>
</div>
</body>
</html>
