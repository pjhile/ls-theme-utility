<h3>Categories</h3>

<ul class="style-4">
  <? $categories = Blog_Category::create()->order('name')->find_all(); ?>
  
  <? foreach ($categories as $category): ?>
    <li><a href="<?= root_url('/') ?>news/category/<?= $category->url_name ?>/"><?= h($category->name) ?> (<?= $category->published_post_num ?>)</a></li>
  <? endforeach ?>
</ul>

<h3>Archive</h3>

<ul class="style-4">
  <? for($i = date('Y'), $l = date('Y') - 10; $i > $l; --$i): ?>
    <? $year_total = 0 ?>
      <? ob_start() ?>
      <? for($j = 12, $k = 0; $j > $k; --$j): ?>
        <?
          $start_date = $i . "-" . $j . "-01";
          $end_date = ($j == 12) ? ($i + 1) . "-01-01" : $i . "-" . ($j + 1) . "-01";
          
          $posts = Blog_Post::create()->where("blog_posts.published_date >= '{$start_date}' AND blog_posts.published_date <= '{$end_date}' AND is_published=1")->find_all();
          
          $month_total = count($posts);
        ?>
        <? if($month_total): ?>
        <li class="parent">
          <a class="parent" href="javascript:;"><?= date('F', strtotime($start_date)) ?> (<?= $month_total ?>)<span></span></a>
          <ul>
            <? foreach($posts as $post): ?>
            <li><a href="<?= root_url('/') ?>news/post/<?= $post->url_title ?>/"><?= h($post->title) ?></a></li>
            <? endforeach ?>
          </ul>
        <? endif ?>
        </li>
        <? $year_total += $month_total ?>
      <? endfor ?>
      <? $html = ob_get_contents() ?>
      <? ob_end_clean() ?>
      <? if($year_total): ?>
      <li class="parent">
        <a class="parent" href="javascript:;"><?= $i ?> (<?= $year_total ?>)<span></span></a>
        <ul>
          <?= $html ?>
        </ul>
      </li>
      <? endif ?>
  <? endfor ?>
</ul>