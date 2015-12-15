<table cellspacing="0" class="sf_admin_list">
<thead>
<tr><?php include_partial('notas_th_tabular' , array('labels' => $labels)) ?></tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $nota): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('notas_td_tabular', array('nota' => $nota)) ?>
<?php //include_partial('notas_td_actions', array('nota' => $nota)) 
?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="4">
<div class="float-right">
<?php 
  $cuantos = $pager->getNbResults();
  $texto = format_number_choice('[0] no hay notas|[1] hay 1 nota|(1,+Inf] hay %1% notas', array('%1%' => $cuantos), $cuantos);
  echo link_to($texto , 'notas/list');
?>
</div>
</th></tr>
</tfoot>
</table>
