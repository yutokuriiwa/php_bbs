<?php
require_once(__DIR__ .'/header.php');
require_once(__DIR__ . '/redirect.php');

$threadCon = new Bbs\Controller\Thread();
$threadMod = new Bbs\Model\Thread();
$threads =$threadCon->searchThread();
?>
<h1 class="page__ttl">CODE LAB BBS</h1>
<form action="" method="get" class="form-group form-search">
  <div class="form-group">  
    <input type="text" name="keyword" value="<?= isset($threadCon->getValues()->keyword) ? h($threadCon->getValues()->keyword): ''; ?>" placeholder="スレッド検索">
    <p class="err"></p>
  </div>
  <div class="form-group">
    <input type="submit" value="検索" class="btn btn-primary" value="">
  </div>
</form>
<ul class="thread">
  <?php foreach($threads as $thread): ?>
    <li class="thread__item">
      <div class="thread__head">
        <h2 class="thread__ttl">
          <?= h($thread->title); ?>
        </h2>
      </div>
      <ul class="thread__body">
        <?php
          $comments = $threadMod->getComment($thread->id);
          foreach($comments as $comment):
        ?>
        <li class="comment__item">
          <div class="comment__item__head">
            <span class="comment__item__num"><?= h($comment->comment_num); ?></span>
            <span class="comment__item__name">名前：<?= h($comment->username); ?></span>
            <span class="comment__item__date">投稿日時：<?= h($comment->created); ?></span>
          </div>
          <p class="comment__item__content"><?= h($comment->content); ?></p>
        <?php endforeach; ?>
        </li>
      </ul>
      <div class="operation">
        <a href="<?= SITE_URL; ?>/thread_disp.php?thread_id=<?= $thread->id; ?>">書き込み&すべて読む(<?= h($threadMod->getCommentCount($thread->id)); ?>)</a>
        <p class="thread__date">
          スレッド作成日時：<?= h($thread->created); ?>
        </p>
      </div>
    </li>
  <?php endforeach?>
</ul><!-- thread -->
<?php
require_once(__DIR__ .'/footer.php');
?>
