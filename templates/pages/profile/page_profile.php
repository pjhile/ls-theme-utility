<?
extract(array_merge(array(
  'section' => post('section', 'default')
), $params));
?>  

<div class="wrap-12 box-1">
<?= open_form() ?>
  <? $this->render_block($section) ?>
<?= close_form() ?>
</div>