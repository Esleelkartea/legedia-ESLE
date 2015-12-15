<?php
  $undefined = "&mdash;";
?>
<td><?php 
  $value = $documento->__toString();
  echo link_to($value ? $value : $undefined, 'documentos/edit?id_documento='.$documento->getPrimaryKey()); ?>
</td>
<td><?php 
  $proyecto = $documento->getProyecto();
  $value = $proyecto ? $proyecto->__toString() : "";
  echo link_to_if(
    ($proyecto instanceof Proyecto) ? 1 : 0, 
    $value ? $value : $undefined, 
    'proyectos/edit?id_proyecto='.$documento->getIdProyecto());
?></td>
<td><?php 
  $fase = $documento->getFase();
  $value = $fase ? $fase->__toString() : "";
  echo link_to_if(
    ($fase instanceof Fase) ? 1 : 0, 
    $value ? $value : $undefined, 
    'fases/edit?id_fase='.$documento->getIdFase()
  );
?></td>
<td><?php 
  echo $documento->getIdEntregable() ? __('Entregable') : __('Reunión');
?></td>
<td><?php
  $value = "";
  if ($documento->getIdEntregable())
  {
    $entregable = $documento->getEntregable();
    if ($entregable instanceof Entregable)
    {
      $texto = $entregable->__toString();
      $value = link_to($texto ? $texto : "&mdash;", "asignaciones/edit_entregable?id_entregable=".$entregable->getPrimaryKey());
    }
  }
  else
  {
    $reunion = $documento->getReunion();
    if ($reunion instanceof Reunion)
    {
      $texto = $reunion->__toString();
      $value = link_to($texto ? $texto : "&mdash;", 'reuniones/show?id_reunion='.$reunion->getPrimaryKey());
    }
  }
  echo $value ? $value : "&mdash;";
?></td>
<td><?php 
  $categoria = $documento->getCategoria();
  echo $categoria ? $categoria->__toString() : "&mdash;";
?></td>
