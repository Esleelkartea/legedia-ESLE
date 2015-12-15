<?php use_helper ('I18N','Object','Javascript')?>

<?php if ($sf_request->hasError('documento{id_fase}')): ?>
  <?php echo form_error('documento{id_fase}', array('class' => 'form-error-msg')) ?>
<?php endif; ?>
  
<?php $value = select_tag('documento[id_fase]', objects_for_select($fases, 'getIdFase', 'getNombre','',array(
                            'include_blank' => true,), array('control_name' => 'documento[id_fase]')))?>
<?php echo $value ? $value : '&nbsp;' ?>

<?php echo observe_field('documento_id_fase', array(
  	    'frequency' => 1,
  	    'script' => 'true',
        'update' => 'reuniones',
        'url'    => 'documentos/elegirfase',
        'with'   => "'id_proyecto='+$('documento_id_proyecto').value+'id_fase='+$('documento_id_fase').value"
)) ?>

<?php echo javascript_tag(remote_function(array(
  	    'script' => 'true',
        'update' => 'reuniones',
        'url'    => 'documentos/elegirfase',
        'with'   => "'id_proyecto='+$('documento_id_proyecto').value+'id_fase='+$('documento_id_fase').value"
))) ?>
