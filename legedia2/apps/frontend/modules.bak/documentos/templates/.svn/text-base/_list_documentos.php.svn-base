<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_documentos_th_tabular') ?>
  <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $historico_documento): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('list_documentos_td_tabular', array('historico_documento' => $historico_documento)) ?>
<?php include_partial('list_documentos_td_actions', array('historico_documento' => $historico_documento)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="7">
<div class="float-right">
<?php echo pager_navigation($pager, 'historico_documentos/list'); ?>
</div>
<?php 
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] sin resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos);
?>
</th></tr>
</tfoot>
</table>
