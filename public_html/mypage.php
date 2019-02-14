<?php
// マイページ
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

// $user = new Bbs\Model\User();
// $user->find();
$app = new Bbs\Controller\UserUpdate();
$app->run();
?>
<h1 class="page__ttl">マイページ</h1>
<div class="container">
  <form action="" method="post" id="userupdate" class="form">
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="text" name="email" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email): ''; ?>" class="form-control">
      <p class="err"><?= h($app->getErrors('email')); ?></p>
    </div>
    <div class="form-group">
      <label>ユーザー名</label>
      <input type="text" name="username" value="<?= isset($app->getValues()->username) ? h($app->getValues()->username): ''; ?>" class="form-control">
      <p class="err"><?= h($app->getErrors('username')); ?></p>
    </div>
    <div class="form-group">
      <label>アイコン画像</label>
      <input type="file" name="file" value="" class="form">
      <p class="err"></p>
    </div>
    <p class="err"></p>
    <button class="btn btn-primary" onclick="document.getElementById('userupdate').submit();">更新</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>
