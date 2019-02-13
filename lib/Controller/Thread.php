<?php

namespace Bbs\Controller;

class Thread extends \Bbs\Controller {
  public function run($page) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'createThread') {
      $this->createThread();
    } else if($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'createComment') {
      $this->createComment();
    }
  }

  public function createComment() {
    $threadModel = new \Bbs\Model\Thread();
    $threadModel->createComment([
      'thread_id' => $_POST['thread_id'],
      'user_id' => $_SESSION['me']->id,
      'content' => $_POST['content']
    ]);
  }

  public function createThread() {
    // try {
    //   $this->_validate();
    // } catch (\Bbs\Exception\EmptyPost $e) {
    //     $this->setErrors('login', $e->getMessage());
    // }

    // $this->setValues('email', $_POST['email']);

    // if ($this->hasError()) {
    //   return;
    // } else {
    //   try {
        $threadModel = new \Bbs\Model\Thread();
        $threadModel->createThread([
          'title' => $_POST['thread_name'],
          'comment' => $_POST['comment'],
          'user_id' => $_SESSION['me']->id
        ]);
      // }
      // catch (\Bbs\Exception\UnmatchEmailOrPassword $e) {
      //   $this->setErrors('login', $e->getMessage());
      //   return;
      // }

      // login処理
      // session_regenerate_id(true);
      // $_SESSION['me'] = $user;

      // redirect to home
      header('Location: '. SITE_URL);
      exit;
    // }
  }


  // private function _validate() {
  //   if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
  //     echo "Invalid Token!";
  //     exit;
  //   }
  //   if (!isset($_POST['email']) || !isset($_POST['password'])) {
  //     echo "Invalid Form!";
  //     exit;
  //   }
  //   if ($_POST['email'] === '' || $_POST['password'] === '') {
  //     throw new \Bbs\Exception\EmptyPost();
  //   }
  // }
}
