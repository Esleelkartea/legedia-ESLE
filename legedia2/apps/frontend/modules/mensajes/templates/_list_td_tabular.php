<?php
  $modulo = $sf_context->getModuleName();
  $accion = $sf_context->getActionName();
?>
<td><?php
  $value = null;
  if ($accion == "entrada")
  {
    $remitente = $mensaje->getUsuario();
    $value = isset($remitente) ? $remitente->getNombreCompleto() : null;
  }
  else
  {
    $destinos = $mensaje->getMensajeDestinos();
    if (sizeof($destinos))
    {
      if (sizeof($destinos)==1)
      {
        $value = $destinos[0]->getUsuario()->getNombreCompleto();
      }
      else
      {
        $value = $destinos[0]->getUsuario()->getNombreCompleto()." (+ ".(sizeof($destinos)-1).")";
      }
    }
  }
  echo $value ? $value : '-';
?></td>
<td><?php echo link_to($mensaje->getAsunto() , 'mensajes/leer?id_mensaje='.$mensaje->getPrimaryKey()) ?></td>
<td><?php echo truncate_text($mensaje->getCuerpo() , 50) ?></td>
<td><?php echo format_date($mensaje->getFecha() , 'f') ?></td>
