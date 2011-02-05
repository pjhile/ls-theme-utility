<?
extract(array_merge(array(
  'partial_step' => post('partial_step', false),
  'section' => post('section', 'change_information') //defaults to  the change_information section
), $params));
?>

<? if($partial_step) { $this->render_block($section); return; } ?>

<div class="wrap-12 box-1">
  <? $this->render_block($section) ?>
</div>