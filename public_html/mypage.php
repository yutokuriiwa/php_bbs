<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$app = new Bbs\Controller\UserUpdate();
$app->run();
?>
<h1 class="page__ttl">マイページ</h1>
<div class="container">
  <form action="" method="post" id="userupdate" class="form mypage-form" enctype="multipart/form-data">
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
      <label>プロフィール画像</label>
      <label>
      <span class="file-btn btn btn-info">
        ファイルを選んでください
        <input type="file" name="image" class="form" style="display:none" accept="image/*">
      </span>
      </label>
      <p class="err"></p>
      <div class="imgarea">
      <p>現在の画像</p>
      <?= isset($app->getValues()->image) ? '<img src="./gazou/'.h($app->getValues()->image).'">': ''; ?>
      </div>
    </div>
    <p class="err"></p>
    <button class="btn btn-primary" onclick="document.getElementById('userupdate').submit();">更新</button>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="old_image" value="<?= h($app->getValues()->image); ?>">
  </form>
  <form class="user-delete" action="user_delete_confirm.php" method="post">
    <input type="submit" class="btn btn-default" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>
