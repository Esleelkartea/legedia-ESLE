<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular') ?>
  <th id="sf_admin_list_th_sf_admin_actions"><?php echo __('Acciones') ?></th>
</tr>
</thead>
<tbody>
<?php
$ultimo = $pager->getNbResults();
$posicion = 1; 
$i = 1; foreach ($pager->getResults() as $tabla): $odd = fmod(++$i, 2) 
?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('list_td_tabular', array('tabla' => $tabla, 'posicion'=> $posicion, 'ultimo'=> ($posicion>=$ultimo))) ?>
<?php include_partial('list_td_actions', array('tabla' => $tabla)) ?>
</tr>
<?php $posicion++;?>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="6">
<div class="float-right">
<?php
  $value = pager_navigation($pager , 'tablas/list');
  echo ($value) ? $value : '';
?>
</div>
<?php echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>
</table>
