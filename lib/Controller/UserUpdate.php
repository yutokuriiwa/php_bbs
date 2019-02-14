<?php

namespace Bbs\Controller;

class UserUpdate extends \Bbs\Controller {
  public function run() {
    $user = new \Bbs\Model\User();
    $userData = $user->find($_SESSION['me']->id);
    $this->setValues('username', $userData->username);
    $this->setValues('email', $userData->email);
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
    }

    $this->setValues('username', $_POST['username']);
    $this->setValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      // ユーザー情報更新
      try {
        $userModel = new \Bbs\Model\User();
        $userModel->update([
          'username' => $_POST['username'],
          'email' => $_POST['email']
        ]);
      }
      catch (\Bbs\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }
    }
    header('Location: '. SITE_URL . '/mypage.php');
    exit;
  }


  private function validate() {
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
  }
}
