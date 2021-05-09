<?php
  session_start();
  require 'db.php';
  require 'src/Exception.php';
  require 'src/PHPMailer.php';
  require 'src/SMTP.php';
  require 'setting.php';

  if(isset($_SESSION['EMAIL'])) {
    header("Location: seCom.php");
    exit();
  } 

  $attention = NULL;

  /*データベース内にアドレスとパスワードを記録するテーブルを作成*/
  $sql = "CREATE TABLE IF NOT EXISTS mission6_2_premember"
  ." ("
  . "id INT AUTO_INCREMENT PRIMARY KEY,"/*自動で登録されているナンバリング*/
  . "mailadress VARCHAR(50),"/*メールアドレス*/
  . "solveNumber CHAR(6),"/*認証番号(6文字)*/
  . "date DATETIME,"/*日時*/
  . "flag VARCHAR(1)"/*本登録しているかの確認*/
  .");";
  $stmt = $pdo->query($sql);
  /*データベース内にテーブルを作成終了*/

  /*データベース内にアドレスとパスワードを記録するテーブルを作成*/
  $sql = "CREATE TABLE IF NOT EXISTS mission6_2_member"
  ." ("
  . "id INT AUTO_INCREMENT PRIMARY KEY,"/*自動で登録されているナンバリング*/
  . "mailadress VARCHAR(50),"/*メールアドレス*/
  . "password VARCHAR(128),"/*パスワード*/
  . "date DATETIME"/*日時*/
  .");";
  $stmt = $pdo->query($sql);
  /*データベース内にテーブルを作成終了*/

  if(!empty($_POST["newEmail"])) {/*メールアドレスが入力されている場合*/

    /*同じメールアドレスが登録されていないかを確認*/
    $sql = 'SELECT * FROM mission6_2_member';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        if($row['mailadress'] == $_POST["newEmail"]) {/*メールアドレスが同じ場合*/
          $attention = "このメールアドレスはすでに使用されています！";
          goto end;
        }
    }
    /*同じメールアドレスが登録されていないかを確認終了*/

    $mailadress = $_POST["newEmail"];
    $solvenumber = mt_rand(100000,999999);
    
    // PHPMailerのインスタンス生成
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $mail->Port = SMTP_PORT; // 接続するTCPポート
    
    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mail->addAddress($mailadress); //受信者（送信先）を追加する
    $mail->Subject = MAIL_SUBJECT; // メールタイトル
    $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = 'あなたの認証番号は「'.$solvenumber.'」です．';
    
    $mail->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mail->send()) {
      $attention = "メールが送信できませんでした！";
    } else {
      /*データを入力（データレコードの挿入）*/
      $sql = $pdo -> prepare("INSERT INTO mission6_2_premember (mailadress,solveNumber,date,flag) VALUES (:mailadress, :solveNumber, :date, :flag)");
      $sql -> bindParam(':mailadress', $mailadress, PDO::PARAM_STR);
      $sql -> bindParam(':solveNumber', $solvenumber, PDO::PARAM_STR);
      $sql -> bindParam(':date', $date, PDO::PARAM_STR);
      $sql -> bindParam(':flag', $flag, PDO::PARAM_STR);
      $date = date("Y/m/d H:i:s");
      $flag = 0;
      $sql -> execute();
      /*データ入力完了*/

      header("Location: newMakeMail.php?adress={$_POST["newEmail"]}");
      exit();
    }

  } else if(isset($_POST["newSend"])) {
    $attention = "メールアドレスを入力してください！";
  }
end:
  include($_SERVER['DOCUMENT_ROOT']."/left.php");
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
