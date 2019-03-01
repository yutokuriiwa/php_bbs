<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$app = new Bbs\Controller\UserDelete();
$app->run();
