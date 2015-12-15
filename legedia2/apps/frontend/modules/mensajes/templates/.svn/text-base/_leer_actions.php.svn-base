<ul class="sf_admin_actions">
  <?php
    $value = "";
    $usuario = Usuario::getUsuarioActual();
    if ($usuario->getPrimaryKey() == $mensaje->getIdUsuario())
    {
      $value = "<li class=\"float-left\">";
      $value .= button_to(__('borrar completamente'), 'mensajes/delete_salida?id_mensaje='.$mensaje->getPrimaryKey(), array (
        'post' => true,
        'confirm' => __('¿Quiere borrar este mensaje? También se borrarán las copias enviadas a los destinatarios'),
        'class' => 'sf_admin_action_delete',
      ));
      $value .= "</li>\n";
      
      $mensaje_destino = MensajeDestinoPeer::retrieveByPk($mensaje->getPrimaryKey() , $usuario->getPrimaryKey());
      if (isset($mensaje_destino))
      {
        $value .= "<li class=\"float-left\">";
        $value .= button_to(__('borrar copia recibida'), 'mensajes/delete_entrada?id_mensaje='.$mensaje->getPrimaryKey(), array (
          'post' => true,
          'confirm' => __('¿Quiere borrar esta copia? El mensaje original se mantendrá intacto'),
          'class' => 'sf_admin_action_delete',
        ));
        $value .= "</li>\n";
      }
    }
    else
    {
      $value = "<li class=\"float-left\">";
      $value .= button_to(__('Borrar'), 'mensajes/delete_entrada?id_mensaje='.$mensaje->getPrimaryKey(), array (
        'post' => true,
        'confirm' => __('¿Quiere borrar este mensaje?'),
        'class' => 'sf_admin_action_delete',
      ));
      $value .= "</li>\n";
    }
    echo $value;
  ?>
  <?php 
    if ($mensaje->getIdUsuario() == $usuario->getPrimaryKey()) : ?>
  <li><?php echo button_to(__('Editar'), 'mensajes/edit?id_mensaje='.$mensaje->getPrimaryKey(), array (
  'class' => 'sf_admin_action_edit',
)) ?></li>
  <?php else : ?>
  <li><?php echo button_to(__('Responder'), 'mensajes/entrada', array (
  'class' => 'sf_admin_action_comment',
)) ?></li>
  <?php endif; ?>
</ul>
