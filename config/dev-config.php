<?php
  ini_set('display_errors',1);
  define('DSN','mysql:host=172.26.0.2;charset=utf8;dbname=bbs');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','root');
  define('DB_PASSWORD','bc1c069a');
  define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/public_html');
  require_once(__DIR__ .'/../lib/Controller/functions.php');
  require_once(__DIR__ . '/autoload.php');
  session_start();
