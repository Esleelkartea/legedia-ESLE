<?php echo form_tag('documentos/trabajadores', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($documento, 'getIdDocumento') ?>

<?php 
  $rels_documento_trabajador = $documento->getRelDocumentoTrabajadorsJoinTrabajador();
  $list_seleccionados = array();
  foreach ($rels_documento_trabajador as $rpt)
  {
    $list_seleccionados[] = $rpt->getIdTrabajador();
  }

?>


<fieldset id="sf_fieldset_datos" class="">
<legend><?php echo __('Lista de trabajadores que pertenecen al proyecto y pueden ver el documento') ?></legend>

<?php
  $trabajadores = ProyectoPeer::getAllTrabajadores($documento->getIdProyecto());
  include_partial('edit_form_trabajadores_partial', array(
    'trabajadores'        => $trabajadores, 
    'list_seleccionados'  => $list_seleccionados,
  ));
?>

</fieldset>


<fieldset id="sf_fieldset_datos" class="">
<legend><?php echo __('Lista de trabajadores que NO pertenecen al proyecto y pueden ver el documento') ?></legend>

<?php 
  $trabajadores = ProyectoPeer::getAllNoTrabajadores($documento->getIdProyecto());
  include_partial('edit_form_trabajadores_partial', array(
    'trabajadores'        => $trabajadores, 
    'list_seleccionados'  => $list_seleccionados,
  )); 
?>

</fieldset>

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Enviar aviso')."...", 'documentos/enviar_aviso?id_documento='.$documento->getPrimaryKey(), array (
    'class'   => 'sf_admin_action_email',
    'confirm' => __('¿Desea enviar un aviso a los trabajadores asociados con el documento?'),
  )); ?></li>
  <li><?php echo submit_tag(__('Vincular/desvincular trabajadores')."...", array(
    'class'   => 'sf_admin_action_save',
    'name'    => 'save',
    'confirm' => __('¿Desea vincular/desvincular los trabajadores marcados del documento?'),
  ))?></li>
</li>
</ul>
</form>
