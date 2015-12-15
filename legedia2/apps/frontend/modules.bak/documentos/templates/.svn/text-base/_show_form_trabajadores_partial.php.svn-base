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
  $es_seleccionado_left = null;
  $name_left = null;
  $es_seleccionado_right = null;
  $name_right = null;
  
  if (isset($trabajadores_left[$i]))
  {
    $trabajador = $trabajadores_left[$i];
    $es_seleccionado_left = in_array($trabajador->getPrimaryKey(), $list_seleccionados) ? 1 : 0; 
    $name_left = $trabajador->__toString();
    if ($es_seleccionado_left) $name_left = "<b>".$name_left."</b>";
  }
  if (isset($trabajadores_right[$i]))
  {
    $trabajador = $trabajadores_right[$i];
    $es_seleccionado_right = in_array($trabajador->getPrimaryKey(), $list_seleccionados) ? 1 : 0;
    $name_right = $trabajador->__toString();
    if ($es_seleccionado_right) $name_right = "<b>".$name_right."</b>";
  }
  
?>
<tr class="sf_admin_row_<?php echo $odd ?>">
  <td><?php echo is_null($es_seleccionado_left) ? "&nbsp;" : 
    ($es_seleccionado_left ? image_tag('/images/icons/tick.png') : image_tag('/images/icons/cross.png'));
  ?></td>
  <td><?php echo $name_left ? $name_left : "&nbsp;"?></td>
  <td><?php echo is_null($es_seleccionado_right) ? "&nbsp;" : 
    ($es_seleccionado_right ? image_tag('/images/icons/tick.png') : image_tag('/images/icons/cross.png'));
  ?></td>
  <td><?php echo $name_right ? $name_right : "&nbsp;"?></td>
</tr>
<?php endfor; ?>
</tbody>
</table>
<?php endif; ?>
