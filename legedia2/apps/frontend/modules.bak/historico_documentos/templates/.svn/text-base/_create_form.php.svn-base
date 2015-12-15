<?php echo form_tag('historico_documentos/create', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($historico_documento, 'getIdDocumento') ?>
<?php echo object_input_hidden_tag($historico_documento, 'getVersion') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('historico_documento[id_documento]', __($labels['historico_documento{id_documento}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{id_documento}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{id_documento}')): ?>
    <?php echo form_error('historico_documento{id_documento}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($historico_documento, 'getIdDocumento', array (
  'size' => 5,
  'control_name' => 'historico_documento[id_documento]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[version]', __($labels['historico_documento{version}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{version}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{version}')): ?>
    <?php echo form_error('historico_documento{version}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($historico_documento, 'getVersion', array (
  'size' => 5,
  'control_name' => 'historico_documento[version]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[nombre_fich]', __($labels['historico_documento{nombre_fich}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{nombre_fich}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{nombre_fich}')): ?>
    <?php echo form_error('historico_documento{nombre_fich}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($historico_documento, 'getNombreFich', array (
  'size' => 80,
  'control_name' => 'historico_documento[nombre_fich]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[tamano]', __($labels['historico_documento{tamano}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{tamano}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{tamano}')): ?>
    <?php echo form_error('historico_documento{tamano}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($historico_documento, 'getTamano', array (
  'size' => 7,
  'control_name' => 'historico_documento[tamano]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[fecha]', __($labels['historico_documento{fecha}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{fecha}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{fecha}')): ?>
    <?php echo form_error('historico_documento{fecha}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($historico_documento, 'getFecha', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
  'control_name' => 'historico_documento[fecha]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('create_actions', array('historico_documento' => $historico_documento)) ?>

</form>
