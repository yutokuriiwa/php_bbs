<?php
$current_uri =  $_SERVER["REQUEST_URI"];
if(strpos($current_uri,'login.php') !== false) {
} elseif(strpos($current_uri,'signup.php') !== false) {
} elseif(strpos($current_uri,'index.php') !== false) {
} else {
  if(!isset($_SESSION['me'])){
    header('Location: ' . SITE_URL . '/index.php');
    exit();
  }
}
