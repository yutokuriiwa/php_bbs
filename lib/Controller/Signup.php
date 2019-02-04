<?php

namespace Bbs\Controller;

class Signup extends \Bbs\Controller {
  public function run() {
    if($this->isLoggedIn()) {
      // header('Location: ' . SITE_URL);
      // exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    // バリデーション
    try {
      $this->_validate();
    } catch (\Bbs\Exception\InvalidEmail $e) {
        // echo $e->getMessage();
        // exit;
        $this->setErrors('email', $e->getMessage());
    } catch (\Bbs\Exception\InvalidPassword $e) {
        // echo $e->getMessage();
        // exit;
        $this->setErrors('password', $e->getMessage());
    }

    //echo "success";
    //exit;

    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      // ユーザー登録
      try {
        $userModel = new \Bbs\Model\User();
        $userModel->create([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      // マイページへリダイレクト
      header('Location: '. SITE_URL . '/login.php');
      exit;
    }
  }


  private function _validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit;
    }
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      throw new \Bbs\Exception\InvalidEmail();
    }
    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \Bbs\Exception\InvalidPassword();
    }
  }
}
