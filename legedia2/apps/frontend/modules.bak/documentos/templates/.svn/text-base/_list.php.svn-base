<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular') ?>
<th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
</tr>
</thead>
<tfoot>
<tr><th colspan="7">
<div class="float-right">
<?php echo pager_navigation($pager, 'documentos/list'); ?>
</div>
<?php 
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos);
?>
</th></tr>
</tfoot>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $documento): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('list_td_tabular', array('documento' => $documento)) ?>
<?php include_partial('list_td_actions', array('documento' => $documento)) ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
