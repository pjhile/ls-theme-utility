<?
extract(array_merge(array(
  'suffix' => null
), $params));

$curPageIndex = $pagination->getCurrentPageIndex();
$pageNumber = $pagination->getPageCount();
?>

<? if($pagination->getLastPageRowIndex() == -1): ?>
  <p>Nothing found.</p>
<? return ?>
<? endif ?>

<?
$first_index = $pageNumber > 0 ? $pagination->getFirstPageRowIndex() + 1 : $pagination->getFirstPageRowIndex();
?>
<div class="text-center">
<p class="pagination margin-center">
  <? if($pageNumber > 1): ?>
    <? if($curPageIndex): ?><a href="<?= $base_url . '/' . $curPageIndex . $suffix ?>"><? endif ?>
      &#x2190; Previous Page
    <? if($curPageIndex): ?></a><? endif ?>
     | 
  <? for($i = 1; $i <= $pageNumber; ++$i): ?>
    <? if($i != $curPageIndex + 1): ?>
      <a href="<?= $base_url . '/' . $i . $suffix ?>"><?= $i ?></a>
    <? else: ?>
      <span><?= $i ?></span>
    <? endif ?>
  <? endfor ?>
     | 
    <? if($curPageIndex < $pageNumber - 1): ?><a href="<?= $base_url . '/' . ($curPageIndex + 2) . $suffix ?>"><? endif ?>
     Next Page &#x2192;
    <? if($curPageIndex < $pageNumber - 1):  ?></a><? endif ?>
  <? endif ?>
</p>
</div>