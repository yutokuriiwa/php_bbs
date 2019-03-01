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
    try {
      $this->validate();
      if (!isset($_POST['content'])) {
        echo "不正な投稿です！";
      exit;
      }
      if ($_POST['content'] === '') {
        throw new \Bbs\Exception\EmptyPost("コメントが入力されていません！");
      }
      if (mb_strlen($_POST['content']) >= 50) {
        throw new \Bbs\Exception\CharLength();
      }
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('comment', $e->getMessage());
    } catch (\Bbs\Exception\CharLength $e) {
        $this->setErrors('comment', $e->getMessage());
    }

    if ($this->hasError()) {
      return;
    } else {
        $threadModel = new \Bbs\Model\Thread();
        $threadModel->createComment([
          'thread_id' => $_POST['thread_id'],
          'user_id' => $_SESSION['me']->id,
          'content' => $_POST['content']
        ]);
    }
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


  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit;
    }
    // if (!isset($_POST['thread_name']) || !isset($_POST['comment']) || !isset($_POST['content'])) {
    //   echo "不正な投稿です！";
    //   exit;
    // }
    // if ($_POST['thread_name'] === '' || $_POST['comment'] === '' || $_POST['content'] === '') {
    //   throw new \Bbs\Exception\EmptyComment();
    // }
  }
}
