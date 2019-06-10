<?php

namespace Bbs\Controller;

class Thread extends \Bbs\Controller {
  public function run() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // var_dump($_POST['type']);
      // exit();
      // $_POST['type'] = $_POST['type'];
      if ($_POST['type']  === 'createthread') {
        $this->createThread();
      } elseif($_POST['type']  === 'outputcsv') {
        // var_dump('csv');
        // exit();
      } elseif($_POST['type']  === 'createcomment') {
        $this->createComment();
      }
    }
  }

  public function createThread(){
    try {
      $this->validate();
    } catch (\Bbs\Exception\EmptyPost $e) {
        $this->setErrors('create_thread', $e->getMessage());
    } catch (\Bbs\Exception\CharLength $e) {
        $this->setErrors('create_thread', $e->getMessage());
    }

    $this->setValues('thread_name', $_POST['thread_name']);
    $this->setValues('comment', $_POST['comment']);

    if ($this->hasError()){
      return;
    } else {
      $threadModel = new \Bbs\Model\Thread();
        $threadModel->createThread([
          'title' => $_POST['thread_name'],
          'comment' => $_POST['comment'],
          'user_id' => $_SESSION['me']->id
        ]);

      header('Location: '. SITE_URL);
      exit;
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
      header('Location: '. SITE_URL . '/thread_disp.php?thread_id=' . $_POST['thread_id']);
      exit;
  }

  // コントローラーに入れる
  private function validate() {
    if ($_POST['type'] === 'createthread') {
      if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "不正なトークンです!";
        exit;
      }
      if (!isset($_POST['thread_name'])){
        echo '不正な投稿です';
        exit;
      }
      if ($_POST['thread_name'] === '' || $_POST['comment'] === ''){
        throw new \Bbs\Exception\EmptyPost("スレッド名または最初のコメントが入力されていません！");
      }
    } elseif( $_POST['type'] === 'createcomment' ) {
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
}
