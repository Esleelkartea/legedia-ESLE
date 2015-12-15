<?php use_helper ('I18N','Object','Javascript')?>

<?php if ($sf_request->hasError('filters{id_reunion}')): ?>
  <?php echo form_error('filters{id_reunion}', array('class' => 'form-error-msg')) ?>
<?php endif; ?>
  
<?php $value = select_tag('filters[id_reunion]', objects_for_select($reuniones, 'getIdReunion', 'getNombre','',array(
                            'include_blank' => true,), array('control_name' => 'filters[id_reunion]')))?>
<?php echo $value ? $value : '&nbsp;' ?>
