<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\UserUpdate();
$app->run();
?>
<h1 class="page__ttl">マイページ</h1>
<div class="container">
  <form action="" method="post" id="userupdate" class="form mypage-form row" enctype="multipart/form-data">
    <div class="col-md-8">
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
      <button class="btn btn-primary" onclick="document.getElementById('userupdate').submit();">更新</button>
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      <input type="hidden" name="old_image" value="<?= h($app->getValues()->image); ?>">
      <p class="err"></p>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <!-- <p class="err"></p> -->
        <div class="imgarea <?= isset($app->getValues()->image) ? '': 'noimage' ?>">
          <label>
          <span class="file-btn">
            編集
            <input type="file" name="image" class="form" style="display:none" accept="image/*">
          </span>
          </label>
          <div class="imgfile">
            <img src="<?= isset($app->getValues()->image) ? './gazou/'. h($app->getValues()->image) : './asset/img/noimage.png'; ?>" alt="">
          </div>
        </div>
      </div>
    </div>
  </form>
  <form class="user-delete" action="user_delete_confirm.php" method="post">
    <input type="submit" class="btn btn-default" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
</div><!--container -->
<?php
require_once(__DIR__ .'/footer.php');
?>
