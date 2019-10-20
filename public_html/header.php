<?php
require_once(__DIR__ .'/../config/config.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <title>codelab掲示板</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link href="https://fonts.googleapis.com/css?family=Charm|M+PLUS+Rounded+1c&amp;subset=latin-ext,thai,vietnamese" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8bc1904d08.js"></script>
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<header class="sticky-top header">
<div class="header__inner">
  <nav>
    <ul>
      <li><a href="<?= SITE_URL; ?>/">ホーム</a></li>
      <li class="user-btn"><a href="<?= SITE_URL; ?>/login.php">ログイン</a></li>
      <li><a href="<?= SITE_URL; ?>/signup.php">ユーザー登録</a></li>
    </ul>
  </nav>
  <div class="header-r">
  </div>
</div>
</header>
<div class="wrapper">
