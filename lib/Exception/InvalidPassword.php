<?php

namespace Bbs\Exception;

class InvalidPassword extends \Exception {
  protected $message = 'パスワードが不正です!';
}
