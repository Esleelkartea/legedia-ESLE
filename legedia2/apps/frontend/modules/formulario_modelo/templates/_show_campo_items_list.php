<?php use_helper('FormularioModelo')?>
<?php use_helper('MisObjetos') ?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('show_campo_items_list_th_tabular' , array('labels' => $labels)) ?>
</tr>
</thead>
<tbody>
<?php 
$cuantos = sizeof($items);
$ultimo = $cuantos;
$posicion = 1;
$i = 1; foreach ($items as $item): $odd = fmod(++$i, 2) ?>
<tr class="sf_row_<?php echo $odd ?>">
<?php include_partial('show_campo_items_list_td_tabular', array('item' => $item)) ?>
<?php include_partial('show_campo_items_list_td_actions', array('item' => $item, 'tabla' => $tabla, 'posicion' => $posicion , 'ultimo' => ($posicion>=$ultimo))) ?>
</tr>
<?php $posicion++;?>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="8">
<div class="float-right">
</div>
<?php echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos) ?>
</th></tr>
</tfoot>
</table>
