<?php
// HTML特殊文字をエスケープする関数→XSS(クロスサイトスクリプティング)対策
// htmlspecialchars関数が長いのでユーザー定義関数で短くしている
function h($s){
  return htmlspecialchars($s, ENT_QUOTES,'UTF-8');
}
