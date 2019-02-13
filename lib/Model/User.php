<?php

namespace Bbs\Model;

class User extends \Bbs\Model {
  public function create($values) {
    $stmt = $this->db->prepare("insert into users (username,email,password,created,modified) values (:username,:email,:password,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['name'],
      ':email' => $values['email'],
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT)
    ]);
    if ($res === false) {
      throw new \Bbs\Exception\DuplicateEmail();
    }
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from users where email = :email");
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

  public function findAll() {
    $stmt = $this->db->query("select * from users order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
