<?php

//ユーザー新規登録
require_once(__DIR__ .'/header.php');

$app = new Bbs\Controller\Signup();
$app->run();
?>
<div class="container">
  <form action="" method="post" id="signup" class="form">
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" name="email" placeholder="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?>" class="form-control">
      <p class="err"><?= h($app->getErrors('email')); ?></p>
    </div>
    <div class="form-group">
      <label>パスワード</label>
      <input type="password" name="password" placeholder="password" class="form-control">
      <p class="err"><?= h($app->getErrors('password')); ?></p>
    </div>
    <button class="btn btn-primary" onclick="document.getElementById('signup').submit();">登録</button>
    <p class="fs12"><a href="<?= SITE_URL; ?>/login.php">ログイン</a></p>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!-- container -->
<?php require_once(__DIR__ .'/footer.php'); ?>
