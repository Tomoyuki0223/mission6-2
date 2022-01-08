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
<title>Q&A | TECH-BASE掲示板</title>
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<!-- 左側部分を読み込んで表示する -->
<?php include($_SERVER['DOCUMENT_ROOT']."/mission6_2/left.php"); ?>
<!-- 右側部分を表示する -->
<div class="right">
  <h4><?php echo $userinf ?></h4>
  <div class="qAnda">
    <h1>Q&A</h1>
    <h3>Q1：このサイトって何ですか？</h3>
    <p>TECH-BASEインターンにおいて作成した掲示板を拡張させたサイトです．</p>
    <h3>Q2：このサイトを作成するにあたってどのような知識を活用しましたか？</h3>
    <p>主にHTML，CSS，PHPです．TECH-BASEインターンや「Progate」を利用して学習しました</p>
    <h3>Q3：具体的な機能を教えてください</h3>
    <ul>
      <li>ホーム：トップページ．掲示板の使用方法などが書かれている．</li>
      <li>ログイン：ログイン機能</li>
      <li>新規登録：メール認証機能，同一メールアドレスが入力された際の警告など</li>
      <li>ログイン中です：ログイン者のメールアドレスを表示</li>
      <li>掲示板：多数のテーマ，スレ立て，名前とコメントの投稿</li>
    </ul>
    <h3>参考にさせていただいたサイト</h3>
    <ul>
      <li>Progate："https://prog-8.com"</li>    
      <li>5ちゃんねる："https://www2.5ch.net/5ch.html"</li>
      <li>Twitter："https://twitter.com"</li>
      <li>PHPプログラミングの教科書：西沢　直木（著）</li>
      <li>その他，多数のプログラミング解説サイト</li>
    </ul>
  </div>
</div>
</body>
</html>
