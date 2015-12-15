<fieldset id="sf_fieldset_datos_mensaje" class="">
<h2><?php echo __('Mensaje') ?></h2>

<div class="form-row">
  <?php echo label_for('mensaje[id_usuario]', __($labels['mensaje{id_usuario}']).":", '') ?>
  <div class="content">
  <?php 
    $usuario = $mensaje->getUsuario();
    echo $usuario ? $usuario->getNombreCompleto() : '-';
  ?>
  </div>
</div>

<?php
  $usuario_actual = Usuario::getusuarioActual();
  if ($mensaje->getIdUsuario() == $usuario_actual->getPrimaryKey()):
?>
<div class="form-row">
  <?php echo label_for('mensaje_destino[id_usuario]', __($labels['mensaje_destino{id_usuario}']).":", '') ?>
  <div class="content">
  <?php 
    $mensaje_destinos = $mensaje->getMensajeDestinosJoinUsuario();
  ?>
  <ul class="sf_admin_checklist">
  <?php foreach($mensaje_destinos as $md) : ?>
  <li><?php 
    $destinatario = $md->getUsuario();
    echo $destinatario ? $destinatario->getNombreCompleto() : '-';?></li>
  <?php endforeach;?>
  <ul>
  </div>
</div>
<?php endif ; ?>

<div class="form-row">
  <?php echo label_for('mensaje[asunto]', __($labels['mensaje{asunto}']).":", '') ?>
  <div class="content">
  <?php 
    $value = $mensaje->getAsunto();
    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('mensaje[cuerpo]', __($labels['mensaje{cuerpo}']).":", '') ?>
  <div class="content">
  <?php 
    $value = $mensaje->getCuerpo();
    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('mensaje[fecha]', __($labels['mensaje{fecha}']).":", '') ?>
  <div class="content">
  <?php 
    echo format_date($mensaje->getFecha() , 'f');
  ?>
  </div>
</div>

</fieldset>

<?php include_partial('leer_actions', array('mensaje' => $mensaje)) ?>
