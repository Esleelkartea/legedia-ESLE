<table cellspacing="0" class="sf_admin_list">
<thead>
<tr><?php include_partial('mensajes_th_tabular' , array('labels' => $labels)) ?></tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $mensaje): $odd = fmod(++$i, 2) ?>
<?php
  $marcado = (!$mensaje->getLeido()) ? true : false;
?>
<tr class="sf_admin_row_<?php echo $odd ?>" style=<?php if ($marcado) : ?>"font-weight:bold;"<?php endif;?>>
<?php include_partial('mensajes_td_tabular', array('mensaje' => $mensaje->getMensaje())) ?>
<?php //include_partial('mensajes_td_actions', array('mensaje' => $mensaje->getMensaje())) 
?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="3">
<div class="float-right">
<?php 
  $cuantos = $pager->getNbResults();
  $texto = format_number_choice('[0] no hay mensajes|[1] hay 1 mensaje|(1,+Inf] hay %1% mensajes', array('%1%' => $cuantos), $cuantos);
  echo link_to($texto , 'mensajes/entrada');
?>
</div>
</th></tr>
</tfoot>
</table>
