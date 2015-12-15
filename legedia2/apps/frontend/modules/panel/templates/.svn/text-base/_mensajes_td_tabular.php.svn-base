<td><?php
  $remitente = $mensaje->getUsuario();
  $value = isset($remitente) ? $remitente->getNombreCompleto() : null;
  echo $value ? $value : '-';
?></td>
<td><?php echo link_to(truncate_text($mensaje->getAsunto() , 25) , 'mensajes/leer?id_mensaje='.$mensaje->getPrimaryKey()) ?></td>
<td><?php echo format_date($mensaje->getFecha() , 'f') ?></td>
