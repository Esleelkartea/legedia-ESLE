<?php 
  echo form_tag('mensajes/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>

<?php echo object_input_hidden_tag($mensaje, 'getIdMensaje') ?>

<fieldset id="sf_fieldset_datos_mensaje" class="">
<h2><?php echo __('Datos') ?></h2>

<div class="form-row">
  <?php echo label_for('mensaje[asunto]', __($labels['mensaje{asunto}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('mensaje{asunto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('mensaje{asunto}')): ?>
    <?php echo form_error('mensaje{asunto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($mensaje, 'getAsunto', array (
  'size' => 60,
  'control_name' => 'mensaje[asunto]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('mensaje[cuerpo]', __($labels['mensaje{cuerpo}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('mensaje{cuerpo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('mensaje{cuerpo}')): ?>
    <?php echo form_error('mensaje{cuerpo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($mensaje, 'getCuerpo', array (
  'rich'=>true,
  'size' => '60x5',
  'control_name' => 'mensaje[cuerpo]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('mensaje[es_programado]', __($labels['mensaje{es_programado}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('mensaje{es_programado}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('mensaje{es_programado}')): ?>
    <?php echo form_error('mensaje{es_programado}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('mensaje[es_programado]', '1', false ,array (
  'control_name' => 'mensaje[es_programado]',
  'onchange' => 'Element.toggle("capa_fecha")',//visual_effect('toggle_appear' , 'capa_fecha'),
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Marque esta casilla si quiere que el mensaje se envía en una fecha determinada') ?></div>
  </div>
</div>

<div class="form-row" style="display:none;" id="capa_fecha">
  <?php echo label_for('mensaje[fecha]', __($labels['mensaje{fecha}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('mensaje{fecha}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('mensaje{fecha}')): ?>
    <?php echo form_error('mensaje{fecha}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = input_fecha_hora_tag('mensaje[fecha]', $mensaje->getFecha()); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

</fieldset>


<fieldset id="sf_fieldset_usuario_grupos" class="">
<h2><?php echo __('Lista de destinatarios') ?></h2>

<div class="form-row">
  <?php echo label_for('mensaje[destinatarios]', __($labels['mensaje{destinatarios}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('mensaje{destinatarios}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('mensaje{destinatarios}')): ?>
    <?php echo form_error('mensaje{destinatarios}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
  /*  $criteria = UsuarioPeer::getCriteriaUsuariosAccesibles();
    $value = ""; //posiblemente aparezcan TODOS los usuarios, algo que yo no quiero...
    $value = object_double_list($mensaje, 'getMensajeDestinos', array (
  //'control_name' => 'usuario[grupos]',
  'through_class' => 'MensajeDestino',
  'unassociated_label'=>__('no asociados'),
  'associated_label'=>__('asociados'),
  'size' => '10',
  //'ignorar_grupo_todos' => true,//ignora el grupo 1 (que es 'TODOS')
) , null , $criteria); echo $value ? $value : '&nbsp;' 
*/
  $value = object_admin_double_list($mensaje, 'getMensajeDestinos', array ('control_name' => 'mensaje[destinatarios]',
                                                                           'through_class' => 'MensajeDestino',
                                                                                ));
                 echo $value ? $value : '&nbsp;'; 

?>
  </div>
</div>
</fieldset>


<?php include_partial('edit_actions', array('mensaje' => $mensaje)) ?>

</form>

<?php if ($mensaje->getPrimaryKey()): ?>
<ul class="sf_admin_actions">
  <?php
    $value = "";
    $usuario = Usuario::getUsuarioActual();
    if ($usuario->getPrimaryKey() == $mensaje->getIdUsuario())
    {
      $value = "<li class=\"float-left\">";
      $value .= button_to(__('Borrar completamente'), 'mensajes/delete_salida?id_mensaje='.$mensaje->getPrimaryKey(), array (
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
        'confirm' => __('¿Quiere borrar este objeto?'),
        'class' => 'sf_admin_action_delete',
      ));
      $value .= "</li>\n";
    }
    echo $value;
  ?>
</ul>
<?php endif; ?>
