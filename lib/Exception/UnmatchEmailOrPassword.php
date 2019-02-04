<?php

namespace Bbs\Exception;

class UnmatchEmailOrPassword extends \Exception {
  protected $message = 'メールアドレスまたはaaパスワードが一致しません。';
}
