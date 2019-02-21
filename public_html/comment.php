<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$thread_id = $_GET['thread_id'];
$threadApp = new Bbs\Model\Thread();
$thread = $threadApp->getThread($thread_id);
?>
<h1 class="page__ttl"></h1>
<div class="thread">
  <div class="thread__item">
    <div class="thread__head">
      <h2 class="thread__ttl">
        <?= h($thread->title); ?>
      </h2>
    </div>
    <ul class="thread__body">
    <?php
      $comment = $threadApp->getCommentAll($thread->id);
      foreach($comment as $comment_data):
    ?>
      <li class="comment__item">
        <div class="comment__item__head">
          <span class="comment__item__num"><?= h($comment_data->comment_num); ?></span>
          <span class="comment__item__name">名前：<?= h($comment_data->username); ?></span>
          <span class="comment__item__date">投稿日時：<?= h($comment_data->created); ?></span>
        </div>
        <p class="comment__item__content"><?= h($comment_data->content); ?></p>
    <?php endforeach; ?>
      </li>
    </ul>
    <!-- ログインしてないと書き込めないようにする -->
    <form action="comment_confirm.php" method="post" class="form-group"">
      <div class="form-group">
        <label>コメント</label>
        <textarea type="text" name="content" class="form-control" placeholder=""></textarea>
      </div>
      <input type="hidden" name="thread_id" value="<?= h($thread->id); ?>">
      <div class="form-group">
        <input type="submit" value="確認" class="btn btn-primary">
      </div>
    </form>
    <p class="comment-page thread__date">スレッド作成日付：<?= h($thread->created); ?>
    </p>
  </div>
</div><!-- thread -->
<?php
require_once(__DIR__ .'/footer.php');
?>

