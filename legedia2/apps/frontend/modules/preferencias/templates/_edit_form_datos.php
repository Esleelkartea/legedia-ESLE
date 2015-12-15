<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos personales') ?></h2>


<div class="form-row">
  <?php echo label_for('usuario[nombre]', __($labels['usuario{nombre}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{nombre}')): ?>
    <?php echo form_error('usuario{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getNombre', array (
  'size' => 60,
  'control_name' => 'usuario[nombre]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[apellido1]', __($labels['usuario{apellido1}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{apellido1}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{apellido1}')): ?>
    <?php echo form_error('usuario{apellido1}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getApellido1', array (
  'size' => 60,
  'control_name' => 'usuario[apellido1]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[apellido2]', __($labels['usuario{apellido2}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{apellido2}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{apellido2}')): ?>
    <?php echo form_error('usuario{apellido2}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getApellido2', array (
  'size' => 60,
  'control_name' => 'usuario[apellido2]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[dni]', __($labels['usuario{dni}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{dni}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{dni}')): ?>
    <?php echo form_error('usuario{dni}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getDni', array (
  'size' => 20,
  'control_name' => 'usuario[dni]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[domicilio]', __($labels['usuario{domicilio}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{domicilio}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{domicilio}')): ?>
    <?php echo form_error('usuario{domicilio}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getDomicilio', array (
  'size' => 60,
  'control_name' => 'usuario[domicilio]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[poblacion]', __($labels['usuario{poblacion}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{poblacion}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{poblacion}')): ?>
    <?php echo form_error('usuario{poblacion}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getPoblacion', array (
  'size' => 50,
  'control_name' => 'usuario[poblacion]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[cp]', __($labels['usuario{cp}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{cp}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{cp}')): ?>
    <?php echo form_error('usuario{cp}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getCp', array (
  'size' => 7,
  'control_name' => 'usuario[cp]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[provincia]', __($labels['usuario{provincia}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{provincia}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{provincia}')): ?>
    <?php echo form_error('usuario{provincia}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getProvincia', array (
  'size' => 50,
  'control_name' => 'usuario[provincia]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[pais]', __($labels['usuario{pais}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{pais}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{pais}')): ?>
    <?php echo form_error('usuario{pais}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getPais', array (
  'size' => 50,
  'control_name' => 'usuario[pais]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[movil]', __($labels['usuario{movil}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{movil}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{movil}')): ?>
    <?php echo form_error('usuario{movil}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getMovil', array (
  'size' => 20,
  'control_name' => 'usuario[movil]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[email]', __($labels['usuario{email}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{email}')): ?>
    <?php echo form_error('usuario{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($usuario, 'getEmail', array (
  'size' => 45,
  'control_name' => 'usuario[email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>



</fieldset>

