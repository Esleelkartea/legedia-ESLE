<div style="width: 95%; border-bottom: 1px dotted black; font-weight: bold; font-size: 15px;">
<?echo __('Bandeja de entrada')?>
</div>

<div style="clear: both; height: 6px;"></div>

<div style="width: 95%; background-color: black; color: white; height: 25px; font-weight: bold; font-size: 12px; text-align: right; padding-top: 10px;">
<?php
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] No Tiene Mensajes |[1] Tiene 1 Mensaje |(1,+Inf] Tiene %1% Mensajes', array('%1%' => $cuantos), $cuantos);
?>&nbsp;&nbsp;
</div>


<table cellspacing="0" cellpadding="0" border="0" style="width: 95%; border: 0px;">
<?php $i = 1; foreach ($pager->getResults() as $mensaje): $odd = fmod(++$i, 2) ?>
<?php
  $marcado = (!$mensaje->getLeido()) ? true : false;
?>
<tr style=<?php if ($marcado) : ?>"font-weight:bold;"<?php endif;?>>
    <td width="25%" valign="middle" style="border: 0px; text-align: center; height: 20px;" ><?php
        $remitente = $mensaje->getMensaje()->getUsuario();
         $value = isset($remitente) ? $remitente->getNombreCompleto() : null;
        echo $value ? $value : '-';
    ?></td>
    <td width="50%" valign="middle" style="border: 0px;"><?php echo link_to(truncate_text($mensaje->getMensaje()->getAsunto() , 25) , 'mensajes/leer?id_mensaje='.$mensaje->getMensaje()->getPrimaryKey()) ?></td>
    <td width="25%" valign="middle" style="border: 0px; text-align: center; height: 20px;"><?php echo format_date($mensaje->getMensaje()->getFecha() , 'd') ?></td>
</tr>
<?php endforeach; ?>
</table>

<div style="width: 95%; text-align: right;">
<ul style="list-style-type: none;">
  <li>
    <?php echo link_to(__('Redactar nuevo') , 'mensajes/create', array('style' => 'font-weight: bold; font-size: 13px;'))?>
  </li>
</ul>
</div>

