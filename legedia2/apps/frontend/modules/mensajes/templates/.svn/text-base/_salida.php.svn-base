<table cellspacing="0" class="sf_admin_list">
<thead>
<tr><?php include_partial('list_th_tabular' , array('labels' => $labels)) ?></tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $mensaje): $odd = fmod(++$i, 2) ?>
<?php
  $date_now = new Date();
  $date_mensaje = new Date();
  $date_mensaje->fromDatetime($mensaje->getFecha());
  $marcado = ($date_now->compareTo($date_mensaje) <= 0) ? true : false;
?>
<tr class="sf_admin_row_<?php echo $odd ?>" style="<?php if ($marcado) : ?>font-weight:bold;<?php endif;?>">
<?php include_partial('list_td_tabular', array('mensaje' => $mensaje) ) ?>
<?php include_partial('salida_td_actions', array('mensaje' => $mensaje)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="5">
<div class="float-right">
<?php
  $value = pager_navigation($pager , 'mensajes/salida');
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
