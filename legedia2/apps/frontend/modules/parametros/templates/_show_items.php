<?php
  use_helper('Text');
  // Partial para mostrar los datos del parámetro de TIPO LISTA.
  
  $id_parametro_editado = isset($id_parametro_editado) ? $id_parametro_editado : null;
  $parametros = $parametro_def->getParametrosByOrden();
?>
<?php if (!sizeof($parametros)) : ?>
  <blockquote class="warning"><p><?php echo __('No hay datos'); ?></p></blockquote>
<?php else : ?>


<?php
  $num_columnas_extra = 0;
?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
  <th id="sf_admin_list_th_orden"><?php echo __('Orden') ?></th>
  <th id="sf_admin_list_th_mover"><?php echo __('Mover') ?></th>
  <?php if ($parametro_def->getCampoNombre()) : ?>
    <th id="sf_admin_list_th_campo_nombre"><?php echo $parametro_def->getCampoNombre(); ?></th>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoNumero()) : ?>
    <th id="sf_admin_list_th_campo_numero"><?php echo $parametro_def->getCampoNumero(); ?></th>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoCadena1()) : ?>
    <th id="sf_admin_list_th_campo_cadena1"><?php echo $parametro_def->getCampoCadena1(); ?></th>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoSiNo()) : ?>
    <th id="sf_admin_list_th_campo_sino"><?php echo $parametro_def->getCampoSiNo(); ?></th>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoFichero()) : ?>
    <th id="sf_admin_list_th_campo_fichero"><?php echo $parametro_def->getCampoFichero(); ?></th>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoFecha()) : ?>
    <th id="sf_admin_list_th_campo_fecha"><?php echo $parametro_def->getCampoFecha(); ?></th>
  <?php endif; ?>
  <th id="sf_admin_list_th_estado"><?php echo __('Estado') ?></th>
  <th id="sf_admin_list_th_acciones"><?php echo __('Acciones') ?></th>
</tr>
</thead>



<?php
  $max = ParametroPeer::getMaxOrden($parametro_def->getPrimaryKey());
?>

<tbody>
<?php $i = 1; foreach ($parametros as $parametro): $odd = fmod(++$i, 2) ?>
<?php 
  $td_class = "sf_admin_row_".$odd; 
  if ($parametro->getPrimaryKey() == $id_parametro_editado)
  {
    $td_class = "highlight strong";
  }
  if ($parametro->getFechaBorrado())
?>
<tr class="<?php echo $td_class ?>">
  <td style="width: 50px;"><?php echo $parametro->getOrden(); ?></td>
  <td style="width: 50px;"><?php 
    $value = "";
    if ($parametro_def->getEsEditable())
    {
      $value = rank_navigation("parametros/order_item?item=".$parametro->getPrimaryKey(), $parametro->getOrden(), $max);
    }
    echo $value ? $value : "&mdash;";
  ?></td>
  
  <?php if ($parametro_def->getCampoNombre()) : ?>
    <td><?php echo $parametro->getNombre() ? $parametro->getNombre() : "&mdash;"; ?></td>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoNumero()) : ?>
    <td align="right"><?php echo $parametro->getNumero() ? $parametro->getNumero() : "0"; ?></td>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoCadena1()) : ?>
    <td><?php echo $parametro->getCadena1() ? truncate_text($parametro->getCadena1(), 50) : "&mdash;"; ?></td>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoSiNo()) : ?>
    <td><?php echo $parametro->getSino() ? __('Si') : __('No'); ?></td>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoFichero()) : ?>
    <td><?php  
      $value = "";
      if ($parametro->getFichero())
      {
        $nombre = $parametro->getNombreFichero() ? $parametro->getNombreFichero() : __('Sin nombre');
        $value = link_to( $nombre ? $nombre : "&mdash;", "parametros/download?item=".$parametro->getPrimaryKey());
        $value .= " (".$parametro->getFormatedFileSizeFichero().")";
      }
      else
      {
        $value = "&mdash;";
      }
      echo $value;
    ?></td>
  <?php endif; ?>
  <?php if ($parametro_def->getCampoFecha()) : ?>
    <td><?php echo $parametro->getFecha() ? $parametro->getFecha() : "&mdash;"; ?></td>
  <?php endif; ?>
  
  <td><?php echo $parametro->getFechaBorrado() ? 
    "<span class=\"strong\" style=\"color: red;\">".__('Desactivado')."</span>" : 
    __('Activado'); 
  ?></td>
  <td align="right" style="width: 100px;"><?php
    $acciones = array();
    $acciones[] = link_to(
        image_tag('/images/icons/show.png', array('alt' => __('ver'), 'title' => __('ver'))), 
        'parametros/show_item?item='.$parametro->getPrimaryKey());
    if ($parametro_def->getEsEditable())
    {
      $acciones[] = link_to(
        image_tag('/images/icons/edit.png', array('alt' => __('editar'), 'title' => __('editar'))), 
        'parametros/edit_item?item='.$parametro->getPrimaryKey()
      );
      $imagen_enable = $parametro->getFechaBorrado() ? 
        image_tag('/images/icons/reset.png', array('alt' => __('activar'), 'title' => __('activar'))) : 
        image_tag('/images/icons/cancel.png', array('alt' => __('desactivar'), 'title' => __('desactivar')));
      $acciones[] = link_to($imagen_enable, 'parametros/enable_item?item='.$parametro->getPrimaryKey(),
        array('confirm' => $parametro->getFechaBorrado() ? 
          __('¿Desea volver a activar el elemento?') : 
          __('¿Desea desactivar el elemento?')
        )
      );
    }
    if ($parametro_def->getEsBorrable())
    {
      $acciones[] = link_to(
        image_tag('/images/icons/bin.png', array('alt' => __('borrar'), 'title' => __('borrar'))), 
        'parametros/delete_item?item='.$parametro->getPrimaryKey(),
        array('confirm' => __('¿Desea borrar el elemento?'))
      );
    }
    
    $value = "";
    if (sizeof($acciones))
    {
      $value = "<ul class=\"sf_admin_td_actions\">\n<li>";
      $value .= implode("</li>\n<li>", $acciones);
      $value .= "</li>\n</ul>\n";
    }
    
    echo $value ? $value : "&mdash;";
  ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>


<?php if ($parametro_def->getEsEditable() && sizeof($parametros) > 1) : ?>
<?php 
  echo form_tag('parametros/reorder_items', array(
    'id'        => 'sf_admin_edit_form',
    'name'      => 'sf_admin_edit_form',
    'multipart' => true,
  ));
  echo input_hidden_tag('id', $parametro_def->getPrimaryKey());
?>
<ul class="sf_admin_actions" style="clear: both;">
  <li style="float: left;"><?php 
    $options_for_select = options_for_select($parametro_def->getArrayCamposActivosParameter(), '');
    $value = select_tag('order_by', $options_for_select);
    echo $value ? $value : "";
  ?></li>
  <li style="float: left;"><?php 
    $options_for_select = options_for_select(array('asc' => __('asc'), 'des' => __('des')), '');
    $value = select_tag('order_type', $options_for_select);
    echo $value ? $value : "";
  ?></li>
  <li style="float: left;"><?php
    echo submit_tag(__('Reordenar')."...", array(
      'name'  => 'save',
      'class' => 'sf_admin_action_save',
      'confirm' => __('¿Desea reordenar la lista de elementos?'),
    ));
  ?></li>
</ul>

</form>
<br /><br />
<?php endif; ?>

<?php endif; ?>
