    <td><?php echo link_to($tarea->getIdTarea() ? $tarea->getIdTarea() : __('-'), 'tareas/show?id_tarea='.$tarea->getIdTarea()) ?></td> 
    <td><?php 
      $usuario = $tarea->getUsuario();
      echo link_to($usuario ? $usuario : '-', 'tareas/show?id_tarea='.$tarea->getIdTarea()); ?>
    </td>
    <td><?php echo link_to(($tarea->getResumen() ? $tarea->getResumen() : '-' ) , 'tareas/show?id_tarea='.$tarea->getIdTarea() ) ?></td>
    <td><?php echo ($tarea->getFechaInicio() !== null && $tarea->getFechaInicio() !== '') ? format_date($tarea->getFechaInicio(), "g") : '' ?></td>
    <td><?php echo ($tarea->getFechaVencimiento() !== null && $tarea->getFechaVencimiento() !== '') ? format_date($tarea->getFechaVencimiento(), "g") : '' ?></td>
    <td>
<?php
if ($tarea->getIdFormulario() != 0) {
  $form = FormularioPeer::retrieveByPK($tarea->getIdFormulario());
  if ($form instanceof Formulario) {
  echo link_to($form->__toString(),"formularios/edit?=id_formulario=".$tarea->getIdFormulario());
  }
}else {
   echo $tarea->getEsEvento() ? __('evento') : __('tarea');
}
?>
    </td>
    <td><?php echo $tarea->getEstadoTarea(); ?></td>
