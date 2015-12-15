<?php
  $usuario_actual = Usuario::getUsuarioActual();
?>
<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/images/icons/show.png', array('alt' => __('Leer'), 'title' => __('Leer'))), 'mensajes/leer?id_mensaje='.$mensaje->getIdMensaje()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'mensajes/delete_salida?id_mensaje='.$mensaje->getIdMensaje(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
</ul>
</td>
