
<fieldset id="sf_fieldset_datos_de_acceso" class="">
<h2><?php echo __('Datos de acceso') ?></h2>


<div class="form-row">
  <?php echo label_for('usuario[usuario]', __($labels['usuario{usuario}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{usuario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{usuario}')): ?>
    <?php echo form_error('usuario{usuario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getUsuario', array (
  'size' => 30,
  'control_name' => 'usuario[usuario]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[newpassword]', __($labels['usuario{newpassword}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{newpassword}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{newpassword}')): ?>
    <?php echo form_error('usuario{newpassword}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

	<?php echo input_password_tag('usuario[newpassword]', '') ?>
  <?php /*$value = get_partial('newpassword', array('type' => 'edit', 'usuario' => $usuario)); echo $value ? $value : '&nbsp;' */?>
  <div class="sf_admin_edit_help"><?php echo __('Introduce una contraseña para modificar su valor o dejalo vacío para mantener la contraseña actual') ?></div>  </div>
</div>


</fieldset>






