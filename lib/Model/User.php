<?php

namespace Bbs\Model;

class User extends \Bbs\Model {
  public function create($values) {
    $stmt = $this->db->prepare("INSERT INTO users (username,email,password,created,modified) VALUES (:username,:email,:password,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      // パスワードのハッシュ化
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT)
    ]);
    // メールアドレスがユニークでなければfalseを返す
    if ($res === false) {
      throw new \Bbs\Exception\DuplicateEmail();
    }
    // $this->login($values['email']);
  }

  public function update($values) {
    $stmt = $this->db->prepare("UPDATE users SET username = :username,email = :email,modified = now() where id = :id");
    $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      ':id' => $_SESSION['me']->id,
    ]);
    // メールアドレスがユニークでなければfalseを返す
    if ($res === false) {
      throw new \Bbs\Exception\DuplicateEmail();
    }
    // $_SESSION['me'] = $user;
  }

  public function login($values) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email;");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }

    return $user;
  }

  public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = id;");
    $stmt->bindValue('id',$id);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
    return $user;
  }

  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM users ORDER BY id;");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
