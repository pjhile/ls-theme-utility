<? if(!$post): ?>
  <h1>Post not found!</h1>
  <p>Sorry, the post you were looking for is not found.</p>
  <p>Return to the <a href="<?= root_url($site_settings->news->path) ?>">News</a> page</p>
<? return ?>
<? endif ?>

<div class="col-12 post">
  <h1 class="post-title"><?= h($post->title) ?></h1>
  <p class="post-details"> <? if ($post->published_date): ?><?= $post->published_date->format('%F') ?><? endif ?></p>
  <?= $post->content ?>
</div>