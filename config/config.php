<?php
  // ini_set('display_errors',1);

  define('DSN','mysql:host=localhost;charset=utf8;dbname=db_bbs');
  define('DB_USERNAME','test');
  define('DB_PASSWORD','KB3Z73sMsf4UUTIS');


  define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/php/bbs/public_html');

  require_once(__DIR__ .'/../lib/Controller/functions.php');
  require_once(__DIR__ . '/autoload.php');
  session_start();

