<?php
// コメント確認
require_once(__DIR__ .'/header.php');

?>
<div class="thread comment-confirm">
  <div class="thread__item">
    <p class="guide">内容に問題がなければ、書き込みボタンを押してください。</p>
    <form action="comment_complete.php" method="post" class="form-group">
      <div class="form-group">
        <p class="content"><?= $_POST['content']; ?></p>
      </div>
      <input type="hidden" name="thread_id" value="<?= $_POST['thread_id']; ?>">
      <input type="hidden" name="content" value="<?= $_POST['content']; ?>">
      <div class="form-group">
        <input value="戻る" onclick="history.back();" type="button" class="btn">
        <input type="submit" value="書き込み" class="btn btn-primary">
      </div>
    </form>
  </div>
</div><!-- thread -->
<?php
require_once(__DIR__ .'/footer.php');
?>

