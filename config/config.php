<?php
  ini_set('display_errors',1);
  // define('DSN','mysql:host=172.26.0.2;charset=utf8;dbname=bbs');
  define('DSN','mysql:host=us-cdbr-iron-east-02.cleardb.net;charset=utf8;dbname=heroku_695e49ce879d94a');
  // define('DB_USERNAME','root');
  define('DB_USERNAME','b38dfe910df109');
  // define('DB_PASSWORD','root');
  define('DB_PASSWORD','bc1c069a');
  define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '');
  require_once(__DIR__ .'/../lib/Controller/functions.php');
  require_once(__DIR__ . '/autoload.php');
  session_start();
