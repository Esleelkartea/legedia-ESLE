<fieldset id="sf_fieldset_usuario" class="">
<h2><?php echo __('Usuario')?></h2>
<div class="form-row">
  <?php echo label_for('usuario[nombre]', __($labels['usuario{nombre}']).":", '') ?>
  <div class="content">
  <?php 
    $usuario = $alcance->getUsuario();
    echo  $usuario ? $usuario->getNombreCompleto() : '-';?>
  </div>
</div>
</fieldset>
