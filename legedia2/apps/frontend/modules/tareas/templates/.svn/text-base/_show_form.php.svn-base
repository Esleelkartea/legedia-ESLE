<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Creado por')?></h2>
<div class="form-row">
  <?php echo label_for('tarea[id_usuario]', __($labels['tarea{id_usuario}']).":", 'class="required" ') ?>
  <div class="content">
  <?php 
    $usuario = $tarea->getUsuario();
    echo $usuario ? $usuario->getNombreCompleto() : '-';
  ?>
  </div>
</div>
</fieldset>

<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos')?></h2>

<?php
if ($tarea->getIdFormulario() != 0) {
  $form = FormularioPeer::retrieveByPK($tarea->getIdFormulario());
  if ($form instanceof Formulario && $form->getTabla() instanceof Tabla) {
?>
    <div class="form-row">
      <?php echo label_for('tarea[objeto_relacionado]', __($labels['tarea{objeto_relacionado}']).":", '') ?>
      <div class="content">
      <?php
        echo link_to($form->getTabla()->__toString()." - ".$form->__toString(),"formularios/edit?=id_formulario=".$tarea->getIdFormulario());
      ?>
      </div>
    </div>
<?php
  }
}
?>

<div class="form-row">
  <?php echo label_for('tarea[resumen]', __($labels['tarea{resumen}']).":", '') ?>
  <div class="content">
  <?php 
    echo $tarea->getResumen() ? $tarea->getResumen() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[descripcion]', __($labels['tarea{descripcion}']).":", '') ?>
  <div class="content">
  <?php 
    echo $tarea->getDescripcion() ? $tarea->getDescripcion() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[id_estado_tarea]', __($labels['tarea{id_estado_tarea}']).":", '') ?>
  <div class="content">
  <?php 
    echo $tarea->getEstadoTarea();
   
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[fecha_inicio]', __($labels['tarea{fecha_inicio}']).":", '') ?>
  <div class="content">
  <?php 
    echo $tarea->getFechaInicio() ? format_date($tarea->getFechaInicio() , 'f') : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[avisar_email]', __($labels['tarea{avisar_email}']).":", '') ?>
  <div class="content">
  <?php
    echo $tarea->getAvisarEmail() ? "SI" : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[fecha_vencimiento]', __($labels['tarea{fecha_vencimiento}']).":", '') ?>
  <div class="content">
  <?php 
    echo $tarea->getFechaVencimiento() ? format_date($tarea->getFechaVencimiento() , 'f') : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tarea[avisar_email_fin]', __($labels['tarea{avisar_email_fin}']).":", '') ?>
  <div class="content">
  <?php
    echo $tarea->getAvisarEmailFin() ? "SI" : '-';
  ?>
  </div>
</div>

</fieldset>

<?php include_partial('show_actions', array('tarea' => $tarea)) ?>

