<td>
<ul class="sf_admin_td_actions">
  <?php
      $direccion = '?id_campo='.$campo->getIdCampo().'&id_empresa='.$empresa->getPrimaryKey();
      if (isset($id_tabla)) {
          $direccion .= '&id_tabla='.$id_tabla;
      }
  ?>
  <?php if (!$campo->getBorrado()) : ?> 
  <li><?php echo link_to(image_tag('/images/icons/show.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 'formulario_modelo/show_campo'.$direccion) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'formulario_modelo/edit_campo/'.$direccion) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'formulario_modelo/delete_campo/'.$direccion, array ( 'post' => true, 'confirm' => __('¿Desea borrar este objeto?'),)); ?></li>
  <?php else: ?>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Des-Borrar'), 'title' => __('Des-Borrar'))), 'formulario_modelo/undelete_campo/'.$direccion, array ( 'post' => true, 'confirm' => __('¿Desea des-borrar este objeto?'),)); ?></li>
  <?php endif; ?>
    
  <?php /*if ($campo->getOrden() > 1) : */?>
  <?php if ($posicion > 1) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_up.png', array('alt' => __('Subir'), 'title' => __('Subir'))), 'formulario_modelo/ordenar_campo/'.$direccion."&op=up") ?></li>
  <?php endif ;?>
  <?php if (!$ultimo ) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_down.png', array('alt' => __('Bajar'), 'title' => __('Bajar'))), 'formulario_modelo/ordenar_campo/'.$direccion."&op=down") ?></li>
  <?php endif ; ?>
</ul>
</td>
