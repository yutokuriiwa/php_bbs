<?php

namespace Bbs\Controller;

// Controllerクラス継承
class Signup extends \Bbs\Controller {
  public function run() {
    // ログインしていればトップページへ移動
    if($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }
    // POSTメソッドがリクエストされていればpostProcessメソッド実行
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    // バリデーション
    try {
      $this->validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
        $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\InvalidName $e) {
        $this->setErrors('username', $e->getMessage());
    } catch (\Bbs\Exception\InvalidPassword $e) {
        $this->setErrors('password', $e->getMessage());
    }

    $this->setValues('email', $_POST['email']);
    $this->setValues('username', $_POST['username']);

    if ($this->hasError()) {
      return;
    } else {
      // ユーザー新規登録
      try {
        $userModel = new \Bbs\Model\User();
        $user = $userModel->create([
          'email' => $_POST['email'],
          'username' => $_POST['username'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      // ユーザー登録後、ログイン処理
      //session_regenerate_id関数･･･現在のセッションIDを新しいものと置き換える。セッションハイジャック対策
      // session_regenerate_id(true);
      // $_SESSION['me'] = $user;
      // var_dump($user);
      // exit;

      // Todo トップページへリダイレクトへ修正
      header('Location: '. SITE_URL . '/login.php');
      exit;
    }
  }


  // バリデーションメソッド
  private function validate() {
    // トークンが空またはPOST送信とセッションに格納された値が異なるとエラー
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit;
    }
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      throw new \Bbs\Exception\InvalidEmail();
    }
    if ($_POST['username'] === '') {
      throw new \Bbs\Exception\InvalidName();
    }
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \Bbs\Exception\InvalidPassword();
    }
  }
}
