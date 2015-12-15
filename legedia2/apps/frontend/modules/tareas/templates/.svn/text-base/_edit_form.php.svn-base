<?php use_helper('MisObjetos');?>
<?php echo form_tag('tareas/edit', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
  'script' => true,
)) ?>

<?php echo object_input_hidden_tag($tarea, 'getIdTarea') ?>

<fieldset id="sf_fieldset_tarea" class="">
<h2><?php echo __('Visible por')?></h2>
<div class="form-row">
  <?php echo label_for('tarea[id_usuario]', __($labels['tarea{id_usuario}']).":", 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{id_usuario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{id_usuario}')): ?>
    <?php echo form_error('tarea{id_usuario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php 
  
    $usuario_actual = Usuario::getUsuarioActual();
    $usuarios = $usuario_actual->getUsuariosAccesibles();
    $opciones = objects_for_select($usuarios , 'getPrimaryKey' , 'getNombreCompleto' , $tarea->getIdUsuario() , 
      array('include_blank' => true)
    );
    $value = select_tag('tarea[id_usuario]', $opciones , array (
      'control_name' => 'tarea[id_usuario]',
    ));
    echo $value ? $value : "-";
  

  ?>
    </div>
    Att: Si ponemos usuario que no sea el nuestro ya no veremos este evento. 
</div>
</fieldset>

<fieldset id="sf_fieldset_tarea" class="">
<h2><?php echo __('Datos') ?></h2>

<?php
if ($tarea->getIdFormulario() != 0) {
  $form = FormularioPeer::retrieveByPK($tarea->getIdFormulario());
  if ($form instanceof Formulario && $form->getTabla() instanceof Tabla) {
?>
    <div class="form-row">
      <?php echo label_for('tarea[objeto_relacionado]', __($labels['tarea{objeto_relacionado}']).":", '') ?>
      <div class="content">
      <?php
        echo link_to($form->getTabla()->__toString()." - ".$form->__toString(),"formularios/edit?id_formulario=".$tarea->getIdFormulario());
      ?>
      </div>
    </div>
<?php
  }
}
?>

<div class="form-row">
  <?php echo label_for('tarea[es_evento]', __($labels['tarea{es_evento}']).":", 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{es_evento}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{es_evento}')): ?>
    <?php echo form_error('tarea{es_evento}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php 
    $value = object_checkbox_tag($tarea, 'getEsEvento', array (
      'control_name' => 'tarea[es_evento]',
      'onchange' => visual_effect('toggle_appear' , 'capa_evento')."; Element.toggle('capa_tarea')",//.visual_effect('toggle_appear' , 'capa_tarea'),
    ));
    echo $value ? $value : "&nbsp;";
  ?>
  </div>
</div>




<div class="form-row">
  <?php echo label_for('tarea[resumen]', __($labels['tarea{resumen}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{resumen}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{resumen}')): ?>
    <?php echo form_error('tarea{resumen}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($tarea, 'getResumen', array (
  'size' => 80,
  'control_name' => 'tarea[resumen]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[descripcion]', __($labels['tarea{descripcion}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{descripcion}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{descripcion}')): ?>
    <?php echo form_error('tarea{descripcion}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($tarea, 'getDescripcion', array (
  'size' => '50x3',
  'control_name' => 'tarea[descripcion]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div id="capa_evento" style="display:none;">

<div class="form-row">
  <?php echo label_for('tarea[id_estado_evento]', __($labels['tarea{id_estado_evento}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{id_estado_evento}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{id_estado_evento}')): ?>
    <?php echo form_error('tarea{id_estado_evento}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $opciones = TareaPeer::getAllEstadosEventos();
    $value = select_tag('tarea[id_estado_evento]' , 
      objects_for_select($opciones , 'getPrimaryKey' , '__toString' , $tarea->getIdEstadoTarea() , 
      array('include_blank' => false , 'control_name' => 'tarea[id_estado_evento]')
    ));
    echo $value ? $value : "&nbsp";
  ?>
  </div>
</div>

</div>

<div class="form-row" id="capa_tarea">
  <?php echo label_for('tarea[id_estado_tarea]', __($labels['tarea{id_estado_tarea}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{id_estado_tarea}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{id_estado_tarea}')): ?>
    <?php echo form_error('tarea{id_estado_tarea}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $opciones = TareaPeer::getAllEstadosTareas();
    $value = select_tag('tarea[id_estado_tarea]' , 
      objects_for_select($opciones , 'getPrimaryKey' , '__toString' , $tarea->getIdEstadoTarea() , 
      array('include_blank' => false , 'control_name' => 'tarea[id_estado_tarea]')
    ));
    echo $value ? $value : "&nbsp";
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[fecha_inicio]', __($labels['tarea{fecha_inicio}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{fecha_inicio}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{fecha_inicio}')): ?>
    <?php echo form_error('tarea{fecha_inicio}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $value = input_fecha_tag('tarea[fecha_inicio]' , $tarea->getFechaInicio());
    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[avisar_email]', __($labels['tarea{avisar_email}']).":") ?>
  <div class="content<?php if ($sf_request->hasError('tarea{avisar_email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{avisar_email}')): ?>
    <?php echo form_error('tarea{avisar_email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php
    $value = object_checkbox_tag($tarea, 'getAvisarEmail', array (
      'control_name' => 'tarea[avisar_email]',
    ));
    echo $value ? $value : "&nbsp;";
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[fecha_vencimiento]', __($labels['tarea{fecha_vencimiento}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tarea{fecha_vencimiento}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{fecha_vencimiento}')): ?>
    <?php echo form_error('tarea{fecha_vencimiento}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $value = input_fecha_tag('tarea[fecha_vencimiento]' , $tarea->getFechaVencimiento());
    echo $value ? $value : '&nbsp;'; 
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[avisar_email_fin]', __($labels['tarea{avisar_email_fin}']).":") ?>
  <div class="content<?php if ($sf_request->hasError('tarea{avisar_email_fin}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tarea{avisar_email_fin}')): ?>
    <?php echo form_error('tarea{avisar_email_fin}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php
    $value = object_checkbox_tag($tarea, 'getAvisarEmailFin', array (
      'control_name' => 'tarea[avisar_email_fin]',
    ));
    echo $value ? $value : "&nbsp;";
  ?>
  </div>
</div>
</fieldset>

<?php include_partial('edit_actions', array('tarea' => $tarea)) ?>

</form>

<?php if ($tarea->getIdTarea()): ?>
<ul class="sf_admin_actions">
  <li class="float-left">
<?php echo button_to(__('borrar'), 'tarea/delete?id_tarea='.$tarea->getIdTarea(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?>
  </li>
</ul>
<?php endif; ?>
