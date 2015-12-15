<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular') ?>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $empresa): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('list_td_tabular', array('empresa' => $empresa)) ?>
<?php include_partial('list_td_actions', array('empresa' => $empresa)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="9">
<div class="float-right">
  <?php
  $value = pager_navigation($pager , 'empresas/list');
  echo ($value) ? $value : '';
?>
</div>
<?php echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>
</table>
