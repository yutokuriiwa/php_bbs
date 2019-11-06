<?php
namespace Bbs\Model;
class Thread extends \Bbs\Model {
  public function createThread($values) {
    try {
      $this->db->beginTransaction();
      $sql = "INSERT INTO threads (user_id,title,created,modified) VALUES (:user_id,:title,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('title',$values['title']);
      $res = $stmt->execute();
      $thread_id = $this->db->lastInsertId();
      $sql = "INSERT INTO comments (thread_id,comment_num,user_id,content,created,modified) VALUES (:thread_id,1,:user_id,:content,now(),now())";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue('thread_id',$thread_id);
      $stmt->bindValue('user_id',$values['user_id']);
      $stmt->bindValue('content',$values['comment']);
      $res = $stmt->execute();
      $this->db->commit();
    } catch (\Exception $e) {
      echo $e->getMessage();
      $this->db->rollBack();
    }
  }

  // 全スレッド取得
  public function getThreadAll(){
    $stmt = $this->db->query("SELECT id,title,created FROM threads WHERE delflag = 0 ORDER BY id desc");
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  // 最新のコメント取得
  public function getComment($thread_id){
    $stmt = $this->db->prepare("SELECT comment_num,username,content,comments.created FROM (threads INNER JOIN comments on threads.id = comments.thread_id) INNER JOIN  users ON comments.user_id = users.id WHERE threads.id =:thread_id AND comments.delflag = 0 ORDER BY comment_num ASC LIMIT 5;");
    $stmt->execute([':thread_id' => $thread_id]);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }
}
