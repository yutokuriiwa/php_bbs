<?php
  ini_set('display_errors',1);
  define('DSN','mysql:host=172.26.0.2;charset=utf8;dbname=bbs');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','root');
  define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/public_html');
  require_once(__DIR__ .'/../lib/Controller/functions.php');
  require_once(__DIR__ . '/autoload.php');
  session_start();
  $current_uri =  $_SERVER["REQUEST_URI"];
  if(strpos($current_uri,'login.php') !== false) {
  } elseif(strpos($current_uri,'signup.php') !== false) {
  } elseif(strpos($current_uri,'index.php') !== false) {
  } else {
    if(!isset($_SESSION['me'])){
      header('Location: ' . SITE_URL . '/login.php');
      exit();
    }
  }
