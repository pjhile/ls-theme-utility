<?
extract(array_merge(array(
  'list' => array()
), $site_settings->product_detailed_item->image, $params));

if($list instanceof Db_DataCollection)
  $list = $list->as_array();

if(count($list)):
  $medium_url = $list[0]->getThumbnailPath($medium_width, $medium_height);
  $large_url = $list[0]->getThumbnailPath($large_width, $large_height);
?>
  <a id="gallery-viewport" class="cloud-zoom" rel="position: 'inside', showTitle: false, adjustX: -4, adjustY: -4" href="<?= $large_url ?>">
    <img src="<?= $medium_url ?>" title="" alt="" width="<?= $medium_width ?>" height="<?= $medium_height ?>" />
  </a>
  <div class="gallery-thumbs">
  <?
  if(count($list) > 1):
    foreach($list as $i => $item):
      $small_url = $item->getThumbnailPath($small_width, $small_height);
      $medium_url = $item->getThumbnailPath($medium_width, $medium_height);
      $large_url = $item->getThumbnailPath($large_width, $large_height);
  ?>
    <a href="javascript:;" onclick="
      $('#gallery-viewport > img').attr('src', $('img', this).attr('alt'));
      $('#gallery-viewport').attr('href', $('img', this).attr('rel')).CloudZoom();
    "><img src="<?= $small_url ?>" title="Preview" alt="<?= $medium_url ?>" rel="<?= $large_url ?>" /></a>
    <? endforeach ?>
  <? endif ?>
  </div>
<? endif ?>