<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('edit_list_th_tabular' , array('labels' => $labels)) ?>
</tr>
</thead>
<tbody>
<?php 
$cuantos = sizeof($campos);
$ultimo = $cuantos;
$posicion = 1;
$i = 1; foreach ($campos as $campo): $odd = fmod(++$i, 2) ?>
<tr class="sf_row_<?php echo $odd ?>">
<?php include_partial('edit_list_td_tabular', array('campo' => $campo, 'empresa' => $empresa, 'id_tabla' => $id_tabla)) ?>
<?php include_partial('edit_list_td_actions', array('campo' => $campo, 'empresa' => $empresa, 'id_tabla' => $id_tabla, 'posicion' => $posicion , 'ultimo' => ($posicion>=$ultimo))) ?>
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
