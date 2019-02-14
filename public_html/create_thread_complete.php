<?php
// スレッド作成
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$threadApp = new Bbs\Controller\Thread();
$threadApp->run("createThread");
?>
