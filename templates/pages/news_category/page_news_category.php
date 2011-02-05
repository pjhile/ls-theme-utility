<div class="col-8">
  <? if($category): ?>
    <h1><?= h($category->name) ?></h1>
    <p><?= h($category->description) ?></p>
    <br /><br />
    
    <? if(!$posts->count): ?>
      <p>This category is empty.</p>
    <? endif ?>
  
    <? foreach($posts as $post):
      $content = $post->content;
  
      if(strlen($content) > $site_settings->news->preview->trim_length)
        $content = substr($content, 0, $site_settings->news->preview->trim_length) . '...';
    ?>
      <h1 class="post-title"><a href="<?= root_url($site_settings->news->path) ?>/post/<?= $post->url_title ?>/"><?= h($post->title) ?></a></h1>
      <p class="post-details"><?= $post->published_date->format('%F') ?></p>
      <?= $content ?>
    <? endforeach ?>
  <? else: ?>
    <h2>Category not found</h2>
    <p>We are sorry, the category you were looking for is not found. Return to <a href="<?= root_url($site_settings->news->path) ?>">news</a>.</p>
  <? endif ?>
</div>