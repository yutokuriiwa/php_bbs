<?php
require_once(__DIR__ .'/../config/config.php');
$thread_id=$_POST['thread_id'];
$threadCon = new Bbs\Controller\Thread();
$threadCon->outputCsv($thread_id);
exit();