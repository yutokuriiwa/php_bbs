<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$threadApp = new Bbs\Model\Thread();
$thread = $threadApp->getThreadAll();
?>
<h1 class="page__ttl">BBS</h1>
<ul class="thread">
  <?php foreach($thread as $thread_data): ?>
    <li class="thread__item">
      <div class="thread__head">
        <h2 class="thread__ttl">
          <?= h($thread_data->title); ?>
        </h2>
      </div>
      <ul class="thread__body">
        <?php
          $comment = $threadApp->getComment($thread_data->id);
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
      <div class="operation">
        <a href="<?= SITE_URL; ?>/comment.php?thread_id=<?= $thread_data->id; ?>">書き込み&すべて読む(<?= h($threadApp->getCommentCount($thread_data->id)); ?>)</a>
        <p class="thread__date">
          スレッド作成日：<?= h($thread_data->created); ?>
        </p>
      </div>
    </li>
  <?php endforeach?>
</ul><!-- thread -->
<?php
require_once(__DIR__ .'/footer.php');
?>
