<table cellspacing="0" class="sf_admin_list">
<thead>
<tr><?php include_partial('list_th_tabular' , array('labels' => $labels)) ?></tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $mensaje_destino): $odd = fmod(++$i, 2) ?>
<?php
  $marcado = (!$mensaje_destino->getLeido()) ? true : false;
?>
<tr class="sf_admin_row_<?php echo $odd ?>" style=<?php if ($marcado) : ?>"font-weight:bold;"<?php endif;?>>
<?php include_partial('list_td_tabular', array('mensaje' => $mensaje_destino->getMensaje())) ?>
<?php include_partial('entrada_td_actions', array('mensaje' => $mensaje_destino->getMensaje())) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="5">
<div class="float-right">
<?php
  $value = pager_navigation($pager , 'mensajes/entrada');
  echo ($value) ? $value : '';
?>
</div>
<?php 
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos); 
?>
</th></tr>
</tfoot>
</table>
