<?php

namespace Bbs\Controller;

class Comment extends \Bbs\Controller {
  public function run() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->createComment();
    }
  }

  public function createComment() {
    try {
      $this->validate();
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('comment', $e->getMessage());
    } catch (\Bbs\Exception\CharLength $e) {
        $this->setErrors('comment', $e->getMessage());
    }

    $this->setValues('content', $_POST['content']);

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
    header('Location: '. SITE_URL . '/comment.php?thread_id=' . $_POST['thread_id']);
    exit;
  }

  // コントローラーに入れる
  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "不正なトークンです!";
      exit;
    }
    if (!isset($_POST['content'])) {
      echo "不正な投稿です！";
    exit;
    }
    if ($_POST['content'] === ''){
      throw new \Bbs\Exception\EmptyPost("コメントが入力されていません！");
    }
    if (mb_strlen($_POST['content']) > 200) {
      throw new \Bbs\Exception\CharLength("コメントが長すぎます！");
    }
  }
}
