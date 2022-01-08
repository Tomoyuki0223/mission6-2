<?php
// セッションの開始
session_start();

// すでにログインしている場合には完了ページへ送還
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

// アドレスとパスワードを仮登録するテーブルを作成
$sql = "CREATE TABLE IF NOT EXISTS mission6_2_premember (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mailadress VARCHAR(50),
  solveNumber CHAR(6),
  date DATETIME,
  flag VARCHAR(1)
)";
$stmt = $pdo->query($sql);

// アドレスとパスワードを記録するテーブルを作成
$sql = "CREATE TABLE IF NOT EXISTS mission6_2_member (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mailadress VARCHAR(50),
  password VARCHAR(128),
  date DATETIME
)";
$stmt = $pdo->query($sql);

// メールアドレスが入力されている場合
if(!empty($_POST["newEmail"])) {
  // 同じメールアドレスが登録されていないか確認
  $sql = 'SELECT * FROM mission6_2_member';
  $stmt = $pdo->query($sql);
  $results = $stmt->fetchAll();
  foreach ($results as $row){
    // メールアドレスが同じ場合には警告を出す
    if($row['mailadress'] == $_POST["newEmail"]) {
      $attention = "このメールアドレスはすでに使用されています！";
      goto end;
    }
  }

  // 入力されたアドレスの取得・加工
  $mailadress = htmlspecialchars($_POST["newEmail"], ENT_QUOTES, "UTF-8");

  // メール本文を組み立てていく
  $title = "【TECH-BASE掲示板】メールアドレス認証";
  $ext_header = "From:tb.221121.mail@gmail.com";
  $solvenumber = mt_rand(100000,999999);
  $body =  <<<EOM
  認証番号：{$solvenumber}

  こんにちは．本メールは，TECH-BASEへの会員登録を希望されている方に
  本人確認のため自動送信しています．

  ※メールアドレスの登録をリクエストされていない場合は，本メールを削除してください．
  他の方がメールアドレスを間違って入力したため本メールが送信された可能性があります．

  TECH-BASE掲示板　管理人
  EOM;

  // メール送信の実行
  $rc = mb_send_mail($mailadress, $title, $body, $ext_header);
  if (!$rc) {
    $attention = "メールが送信できませんでした！";
  } else {
    // データを入力
    $sql = $pdo -> prepare("INSERT INTO mission6_2_premember (mailadress,solveNumber,date,flag) VALUES (:mailadress, :solveNumber, :date, :flag)");
    $sql -> bindParam(':mailadress', $mailadress, PDO::PARAM_STR);
    $sql -> bindParam(':solveNumber', $solvenumber, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $sql -> bindParam(':flag', $flag, PDO::PARAM_STR);
    $date = date("Y/m/d H:i:s");
    $flag = 0;
    $sql -> execute();
    header("Location: newMakeMail.php?adress={$mailadress}");
    exit();
  }

} else if(isset($_POST["newSend"])) { // 空でボタンが押された場合は警告
  $attention = "メールアドレスを入力してください！";
}
end:
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
      <p>アカウントを作成</p>
      <form action="" method="post">
      <input type="email" name="newEmail" autocomplete="off" placeholder="メールアドレス"><br>
      <h5 class="attention"><?php echo $attention ?></h5>
      <button type="submit" name="newSend">メール認証
      </form>
    </div>
  </div>
  </body>
</html>
