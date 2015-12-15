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
  include_partial('show_form_trabajadores_partial', array(
    'trabajadores'        => $trabajadores, 
    'list_seleccionados'  => $list_seleccionados
  )); 
?>

</fieldset>


<fieldset id="sf_fieldset_datos" class="">
<legend><?php echo __('Lista de trabajadores que no pertenecen al proyecto y pueden ver el documento') ?></legend>

<?php 
  $trabajadores = ProyectoPeer::getAllNoTrabajadores($documento->getIdProyecto());
  include_partial('show_form_trabajadores_partial', array(
    'trabajadores' => $trabajadores, 
    'list_seleccionados' => $list_seleccionados
  ));
?>

</fieldset>

