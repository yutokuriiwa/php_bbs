<?php

namespace Bbs\Controller;

class Login extends \Bbs\Controller {
  public function run() {
    if($this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('login', $e->getMessage());
    }

    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      try {
        $userModel = new \Bbs\Model\User();
        $user = $userModel->login([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Bbs\Exception\UnmatchEmailOrPassword $e) {
        $this->setErrors('login', $e->getMessage());
        return;
      }

      // ログイン処理
      session_regenerate_id(true);
      $_SESSION['me'] = $user;

      // トップページへリダイレクト
      header('Location: '. SITE_URL);
      exit;
    }
  }


  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "トークンが不正です!";
      exit;
    }
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "フォームの値が入力されていません!";
      exit;
    }
    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \Bbs\Exception\EmptyPost();
    }
  }
}
