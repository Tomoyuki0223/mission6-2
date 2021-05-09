<div class="left">

  <div class="intro">
    <a href="home.php">ホーム</a><br>
    <a href="signUp.php">ログイン</a><br>
    <a href="newMake.php">新規登録</a><br>
    <a href="question.php">Q&A</a><br>
    <a href="https://twitter.com/tb_221121" target="_blank"><span class="fa fa-twitter"></span>twitter</a><br>
  </div>

  <div class="board">
    <p class="boardAll">板一覧</p>

<?php require_once('boardName.php'); ?>
  <?php foreach ($boardName as $name): ?>
    <a href="board.php?name=<?php echo $name->getName() ?>&tbname=<?php echo $name->getTbName() ?>">
    <?php echo $name->getName() ?><br>
    </a>
  <?php endforeach ?>
    <p class="boardEnd">最終更新日<br>2021年2月13日</p>
  </div>

</div>
