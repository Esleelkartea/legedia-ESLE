<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular') ?>
  <th id="sf_admin_list_th_sf_actions"><?php echo __('Actions') ?></th>
</tr>
</thead>
<tfoot>
<tr><th colspan="6">
<div class="float-right">
  <?php pager_navigation($pager, 'parametros/list'); ?>
</div>
<?php 
  echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', 
    array('%1%' => $pager->getNbResults()), $pager->getNbResults()
  );
?>
</th></tr>
</tfoot>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $parametro_def): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
  <?php include_partial('list_td_tabular', array('parametro_def' => $parametro_def)) ?>
  <?php include_partial('list_td_actions', array('parametro_def' => $parametro_def)) ?>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<br />
