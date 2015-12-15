<?php echo form_tag('empresas/edit_email', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($empresa, 'getIdEmpresa') ?>

<fieldset id="sf_fieldset_smtp" class="">
<h2><?php echo __('Datos SMTP')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[smtp_server]', __($labels['empresa{smtp_server}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_server}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_server}')): ?>
    <?php echo form_error('empresa{smtp_server}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpServer', array (
    'size' => 60,
    'control_name' => 'empresa[smtp_server]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Dirección del servidor')?></div>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('empresa[smtp_user]', __($labels['empresa{smtp_user}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_user}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_user}')): ?>
    <?php echo form_error('empresa{smtp_user}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpUser', array (
    'size' => 40,
    'control_name' => 'empresa[smtp_user]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Nombre de usuario')?></div>
  </div>
</div>

<?php use_helper('Javascript')?>
<div class="form-row">
  <?php echo label_for('empresa[change_smtp_password]', __($labels['empresa{change_smtp_password}']).":", '') ?>
  <div class="content">
  <?php 
    echo checkbox_tag('empresa[change_smtp_password]', 1, false, array(
      'onChange' => visual_effect('toggle_appear', 'new_password'))
    );
    echo "&nbsp;".__('Marque si desea cambiar la clave');
  ?>
  
   <div id="new_password" style="display:none;">
  <?php 
    $value = input_password_tag('empresa[smtp_password]', '', array (
      'size' => 40,
      'control_name' => 'empresa[smtp_password]',
    ));
  /*
  $value .= "&nbsp;";
  $value .= __('Repita la nueva contraseña').":";
  $value .= input_password_tag('empresa[smtp_password_bis]', '', array (
    'size' => 40,
    'control_name' => 'empresa[smtp_password_bis]',
  ));*/ 
  echo $value ? $value : '&nbsp;'; ?>
  <div class="sf_edit_help"><?php echo __('Introduzca la nueva clave')?></div>
  </div>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('empresa[smtp_port]', __($labels['empresa{smtp_port}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_port}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_port}')): ?>
    <?php echo form_error('empresa{smtp_port}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpPort', array (
    'size' => 3,
    'control_name' => 'empresa[smtp_port]',
  )); echo $value ? $value : '&nbsp;'; ?>
  <div class="sf_edit_help"><?php echo __('Número de puerto. Normalmente es el 25.')?></div>
  </div>
</div>
</fieldset>


<fieldset id="sf_fieldset_sender" class="">
<h2><?php echo __('Datos de envío')?></h2>

<div class="form-row">
  <?php echo label_for('empresa[sender_address]', __($labels['empresa{sender_address}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{sender_address}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{sender_address}')): ?>
    <?php echo form_error('empresa{sender_address}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSenderAddress', array (
    'size' => 60,
    'control_name' => 'empresa[sender_address]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Dirección de correo remitente')?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[sender_name]', __($labels['empresa{sender_name}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{sender_name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{sender_name}')): ?>
    <?php echo form_error('empresa{sender_name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSenderName', array (
    'size' => 40,
    'control_name' => 'empresa[sender_name]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Nombre del remitente')?></div>
  </div>
</div>

</fieldset>


<?php include_partial('edit_email_actions', array('empresa' => $empresa)) ?>

</form>
