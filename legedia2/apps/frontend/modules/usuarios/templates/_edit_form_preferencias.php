
<!--
<fieldset id="sf_fieldset_preferencias" class="">
<h2><?php echo __('Preferencias') ?></h2>

<div class="form-row">
  <?php echo label_for('usuario[id_idioma]', __($labels['usuario{id_idioma}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{id_idioma}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{id_idioma}')): ?>
    <?php echo form_error('usuario{id_idioma}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($usuario, 'getIdIdioma', array (
  'related_class' => 'Catalogue',
  'control_name' => 'usuario[id_idioma]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[alerta_email]', __($labels['usuario{alerta_email}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{alerta_email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{alerta_email}')): ?>
    <?php echo form_error('usuario{alerta_email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($usuario, 'getAlertaEmail', array (
  'control_name' => 'usuario[alerta_email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


</fieldset>
-->
<input type="hidden" id="usuario_id_idioma" name="usuario[id_idioma]" value="1">

