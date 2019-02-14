<?php
if(!isset($_SESSION['me'])){
  header('Location: ' . SITE_URL . '/login.php');
  exit;
}
