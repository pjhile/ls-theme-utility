<?
$pagination = $posts->paginate($this->request_param(0, 1)-1, $site_settings->news->per_page);
$posts = $posts->find_all();
?>

<? if($posts): ?>
<div class="col-8">
  <h1>News</h1>
  <p>Check here often for news and information on new products, events and tips.</p>
  <br /><br />
  <? 
  foreach($posts as $post): 
    $content = $post->content;
    
    if(preg_match_all('#<p>(.*)</p>#simU', $content, $m1, PREG_SET_ORDER) && count($m1) >= 2) { // more than 2 paragraphs
      $trim = $site_settings->news->preview->trim_length;
      $l_1 = strlen($m1[0][1]);
      $l_2 = strlen($m1[1][1]);
     
      if($l_1 < ($trim * 0.75) && $l_2 < $trim)
        $content = '<p>' . $m1[0][1] . '</p>' . '<p>' . $m1[1][1] . '</p>';
      else if($l_1 < $trim)
        $content = '<p>' . $m1[0][1] . '</p>';
      else
        $content = '<p>' . substr($m1[0][1], 0, $trim) . ' ...</p>';
    }
  ?>
    <h1 class="post-title"><a href="<?= root_url($site_settings->news->path) ?>/post/<?= $post->url_title ?>/"><?= h($post->title) ?></a></h1>
    <p class="post-details"><?= $post->published_date->format('%F') ?></p>
    <?= $content ?>
  <? endforeach ?>
    
  <? $this->render_partial('cms:pagination', array('pagination' => $pagination, 'base_url' => '/news')) ?>
</div>
<? endif ?>