<?php

namespace Bbs\Controller;

// Controllerクラス継承
class Logout extends \Bbs\Controller {

  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // CSRF対策
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "Invalid Token!";
        exit;
      }

      // セッション変数に格納されている値を空にする
      $_SESSION = [];
      // $_SESSION = array();

      // クッキーにセッションで使用されているクッキーの名前がセットされていたら空にする
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 86400, '/');
      }

      // セッションの破棄
      // セッションハイジャック対策
      session_destroy();

    }

    // ログインページへリダイレクト
    header('Location: ' . SITE_URL . '/login.php');
  }
}
