<?php

namespace Bbs\Model;

class Thread extends \Bbs\Model {
  // 全スレッド取得
  public function getThreadAll(){
    $stmt = $this->db->query("SELECT * FROM threads WHERE delflag = 0 ORDER BY id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // スレッド1件取得
  public function getThread($id){
    $stmt = $this->db->prepare("SELECT * FROM threads WHERE id = :id");
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_OBJ);
  }

  // 最新のコメント取得
  public function getComment($thread_id){
    // コメント5件を表示する
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM (threads inner join comments on threads.id = comments.thread_id) INNER JOIN  users ON comments.user_id = users.id WHERE threads.id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC LIMIT 5;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // コメント全件取得
  public function getCommentAll($thread_id){
    // すべてのコメントを取得する
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM (threads inner join comments on threads.id = comments.thread_id) INNER JOIN  users ON comments.user_id = users.id WHERE threads.id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // コメント数取得
  public function getCommentCount($thread_id) {
    $stmt = $this->db->prepare("SELECT COUNT(comment_num) FROM 	comments  WHERE thread_id = :thread_id AND delflag = 0;");
    $stmt->bindValue('thread_id',$thread_id);
    $stmt->execute();
    // FETCH_ASSOCは列名を記述し配列で取り出す設定をしている。
    $res =  $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res['COUNT(comment_num)'];
  }

  public function createComment($values) {
    try {
      // トランザクションを開始する
      $this->db->beginTransaction();
      $lastNum = 0;
      $sql = "SELECT comment_num FROM comments WHERE thread_id = :thread_id ORDER BY comment_num DESC LIMIT 1";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$values['thread_id']);
      $stmt->execute();
      $res = $stmt->fetch(\PDO::FETCH_OBJ);
      $lastNum = $res->comment_num;
      $lastNum++;
      $sql = "INSERT INTO comments (thread_id,comment_num,user_id,content,created,modified) VALUES (:thread_id,:comment_num,:user_id,:content,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$values['thread_id']);
      $stmt->bindValue('comment_num',$lastNum);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('content',$values['content']);
      $stmt->execute();
      // トランザクション処理を完了する
      $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      // エラーがあったら元に戻す
      $this->db->rollBack();
    }
  }

  // To do不正投稿処理
  public function createThread($values) {
    // スレッド作成後、コメントテーブルに書き込み
    try {
      // トランザクションを開始する
      $this->db->beginTransaction();
      // スレッドテーブルへ書き込み
      $sql = "INSERT INTO threads (user_id,title,created,modified) VALUES (:user_id,:title,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('title',$values['title']);
      $res = $stmt->execute();
      // スレッドテーブルの直前のIDを取得
      $thread_id = $this->db->lastInsertId();
      // コメントテーブルへの書き込み
      $sql = "INSERT INTO comments (thread_id,comment_num,user_id,content,created,modified) VALUES (:thread_id,1,:user_id,:content,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$thread_id);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('content',$values['comment']);
      $res = $stmt->execute();
      // トランザクション処理を完了する
      $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      // エラーがあったら元に戻す
      $this->db->rollBack();
    }
  }
}
