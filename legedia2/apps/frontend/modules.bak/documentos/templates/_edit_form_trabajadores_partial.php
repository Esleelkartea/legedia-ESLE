<?php 
  $mitad = ceil((sizeof($trabajadores))/2);
  $trabajadores_left = array_slice($trabajadores, 0, $mitad);
  $trabajadores_right = array_slice($trabajadores, $mitad);
?>
<?php if (!sizeof($trabajadores)) : ?>
<blockquote class="warning"><p><?php echo __('No hay trabajadores')?></p></blockquote>
<?php else : ?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
  <th id="sf_admin_list_th_id_trabajador_1" width="5%"><?php echo "&nbsp;" ?></th>
  <th id="sf_admin_list_th_nombre_trabajador_1" width="45%"><?php echo __('Nombre') ?></th>
  <th id="sf_admin_list_th_id_trabajador_2" width="5%"><?php echo "&nbsp;" ?></th>
  <th id="sf_admin_list_th_nombre_trabajador_2" width="45%"><?php echo __('Nombre') ?></th>
</tr>
</thead>

<tbody>
<?php 
  $max = max(sizeof($trabajadores_left), sizeof($trabajadores_right));  
?>
<?php for ($i=0; $i < $max; $i++): $odd = fmod($i, 2); ?>
<?php
  $checkbox_left      = "";
  $name_left          = "";
  $label_left         = "";
  $id_checkbox_left   = "";
  $checkbox_right     = "";
  $name_right         = "";
  $label_right        = "";
  $id_checkbox_right  = "";
  $es_seleccionado_left = 0;
  $es_seleccionado_right = 0;
  if (isset($trabajadores_left[$i]))
  {
    $trabajador           = $trabajadores_left[$i];
    $id_checkbox_left     = 'documento[id_trabajador]['.$trabajador->getPrimaryKey().']';
    $es_seleccionado_left = in_array($trabajador->getPrimaryKey(), $list_seleccionados) ? 1 : 0;
    $checkbox_left        = checkbox_tag($id_checkbox_left, 
      $trabajador->getPrimaryKey(), $es_seleccionado_left);
    $name_left            = $trabajador->__toString();
    if ($es_seleccionado_left) $name_left = "<b>".$name_left."</b>";
    $label_left           = label_for($id_checkbox_left, $name_left);
  }
  if (isset($trabajadores_right[$i]))
  {
    $trabajador             = $trabajadores_right[$i];
    $id_checkbox_right      = 'documento[id_trabajador]['.$trabajador->getPrimaryKey().']';
    $es_seleccionado_right  = in_array($trabajador->getPrimaryKey(), $list_seleccionados) ? 1 : 0;
    $checkbox_right         = checkbox_tag($id_checkbox_right, 
      $trabajador->getPrimaryKey(), $es_seleccionado_right);
    $name_right             = $trabajador->__toString();
    if ($es_seleccionado_right) $name_right = "<b>".$name_right."</b>";
    $label_right            = label_for($id_checkbox_right, $name_right);
  }
?>
<tr class="sf_admin_row_<?php echo $odd ?>">
  <td><?php echo $checkbox_left   ? $checkbox_left  : "&nbsp;"?></td>
  <td><?php echo $label_left      ? $label_left     : "&nbsp;"?></td>
  <td><?php echo $checkbox_right  ? $checkbox_right : "&nbsp;"?></td>
  <td><?php echo $label_right     ? $label_right    : "&nbsp;"?></td>
</tr>
<?php endfor; ?>
</tbody>
</table>
<?php endif; ?>
