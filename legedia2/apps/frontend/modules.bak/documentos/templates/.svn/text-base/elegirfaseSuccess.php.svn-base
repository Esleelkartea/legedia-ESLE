<?php use_helper ('I18N','Object','Javascript')?>

<?php if ($sf_request->hasError('documento{id_reunion}')): ?>
  <?php echo form_error('docuemtno{id_reunion}', array('class' => 'form-error-msg')) ?>
<?php endif; ?>
  
<?php $value = select_tag('documento[id_reunion]', objects_for_select($reuniones, 'getIdReunion', 'getNombre','',array(
                            'include_blank' => true,), array('control_name' => 'documento[id_reunion]')))?>
<?php echo $value ? $value : '&nbsp;' ?>
