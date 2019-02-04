<?php
// スレッド作成
require_once(__DIR__ .'/header.php');

if(!isset($_SESSION['me']) && empty($_SESSION['me'])) {
  header('Location: ' . SITE_URL);
  exit;
}

$threadApp = new Bbs\Controller\Thread();
$threadApp->run("createThread");
?>
