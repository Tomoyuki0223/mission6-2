<!-- 左側部分を別で作成 -->
<div class="left">
<div class="intro">
  <a href="home.php">ホーム</a><br>
  <a href="signUp.php">ログイン</a><br>
  <a href="newMake.php">新規登録</a><br>
  <a href="question.php">Q&A</a><br>
  <a href="https://twitter.com/ieso_i" target="_blank"><span class="fa fa-twitter"></span>twitter</a><br>
</div>
<!-- 板のテーマを表示 -->
<div class="board">
  <p class="boardAll">板一覧</p>
  <!-- 板の名前を別ファイルから読み込み！ -->
  <?php require_once('boardName.php'); ?>
  <?php foreach ($boardName as $name): ?>
    <a href="board.php?name=<?php echo $name->getName() ?>&tbname=<?php echo $name->getTbName() ?>">
    <?php echo $name->getName() ?><br>
    </a>
  <?php endforeach ?>
  <p class="boardEnd">最終更新日<br>2021年6月29日</p>
</div>
</div>
