<?php echo form_tag('historico_documentos/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($historico_documento, 'getIddocumento') ?>
<?php echo object_input_hidden_tag($historico_documento, 'getVersion') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('historico_documento[id_documento]', __($labels['historico_documento{id_documento}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('historico_documento{id_documento}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('historico_documento{id_documento}')): ?>
    <?php echo form_error('historico_documento{id_documento}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $value = object_input_tag($historico_documento, 'getNombre', array (
      'size' => 30,
      'control_name' => 'historico_documento[id_documento]',
    )); echo $value ? $value : '&nbsp;'; 
  ?>
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
    'size' => 30,
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
    'disabled' => true,
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
    //  'withtime' => true,
    'calendar_button_img' => '/sf/sf_admin/images/date.png',
    'control_name' => 'historico_documento[fecha]',
    'disabled' => true,
  )); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[id_usuario]', __($labels['historico_documento{id_usuario}']), '') ?>
  <div class="content">
  <?php 
    $usuario = $historico_documento->getUsuario();
    $value = $usuario ? $usuario->__toString() : "- ".__('Sin definir')." -";
    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('historico_documento' => $historico_documento)) ?>

</form>

<ul class="sf_admin_actions">
  <li class="float-left"><?php 
  if ($historico_documento->getIddocumento() && $historico_documento->getVersion()): ?>
<?php 
  $url = 'historico_documentos/delete?id_documento='.$historico_documento->getIddocumento();
  $url .= '&version='.$historico_documento->getVersion();
  echo button_to(
    __('Borrar'), $url, 
    array (
      'post' => true,
      'confirm' => __('¿Estás seguro?'),
      'class' => 'sf_admin_action_delete',
    )
  ); 
?>
<?php endif; ?>
</li>
</ul>
