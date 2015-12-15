<?php echo form_tag('content/bugreport', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>

<fieldset id="sf_fieldset_datos_usuario" class="">
<h2><?php echo __('Por favor, sea lo más específico posible. ¡Gracias!') ?></h2>

<div class="form-row">
  <?php echo label_for('bug[name]', __($labels['bug{name}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('bug{name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('bug{name}')): ?>
    <?php echo form_error('bug{name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = input_tag('bug[name]', '' , array (
  'size' => 50,
  'control_name' => 'bug[name]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique su nombre')?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('bug[email]', __($labels['bug{email}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('bug{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('bug{email}')): ?>
    <?php echo form_error('bug{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = input_tag('bug[email]', '' , array (
  'size' => 60,
  'control_name' => 'bug[email]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique su dirección de correo electrónico')?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('bug[url]', __($labels['bug{url}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('bug{url}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('bug{url}')): ?>
    <?php echo form_error('bug{url}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = input_tag('bug[url]', '', array (
  'size' => 60,
  'control_name' => 'bug[url]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('¿Dónde ha experimentado el problema?')?></div>
  </div>  
</div>

<div class="form-row">
  <?php echo label_for('bug[description]', __($labels['bug{description}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('bug{description}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('bug{description}')): ?>
    <?php echo form_error('bug{description}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = textarea_tag('bug[description]', '', array (
  'size' => '50x5',
  'control_name' => 'bug[description]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Describa el problema lo más detalladamente posible')?></div>
  </div>
</div>

</fieldset>

<?php include_partial('bugreport_actions', array()) ?>

</form>
