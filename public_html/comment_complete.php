<?php
// コメント全件表示
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$threadApp = new Bbs\Controller\Thread();
$threadApp->run("createComment");
?>
<div class="comment-complete">
  <p>書き込みが完了しました。</p>
  <a href="<?= SITE_URL; ?>/comment.php?thread_id=<?= $_POST['thread_id']; ?>">コメント一覧へ戻る</a>
</div>
<?php
require_once(__DIR__ .'/footer.php');
?>

