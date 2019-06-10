<?php
require_once(__DIR__ .'/../config/config.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>掲示板</title>
  <link href="https://fonts.googleapis.com/css?family=Charm|M+PLUS+Rounded+1c&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="./js/bbs.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<header class="sticky-top header">
  <nav>
    <ul>
      <li><a href="<?= SITE_URL; ?>">ホーム</a></li>
      <?php
      if(isset($_SESSION['me'])) { ?>
      <li><a href="<?= SITE_URL; ?>/thread_create.php">スレッド作成</a></li>
      <li class="mypage"><a href="<?= SITE_URL; ?>/mypage.php">マイページ</a></li>
      <?php } else { ?>
        <li class="user-btn"><a href="<?= SITE_URL; ?>/login.php">ログイン</a></li>
        <li><a href="<?= SITE_URL; ?>/signup.php">ユーザー登録</a></li>
      <?php } ?>
    </ul>
  </nav>
  <?php
    if(isset($_SESSION['me'])) { ?>
    <div class="prof-show">こんにちは <span class="name"><?= h($_SESSION['me']->username); ?></span>さん<span class="image"><img src="./gazou/img_5cfa2e5c0c60e.jpg" alt=""></span></div>
    <form action="logout.php" method="post" id="logout" class="user-btn">
      <input type="submit" value="ログアウト">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <?php  } ?>
</header>
<div class="wrapper">

