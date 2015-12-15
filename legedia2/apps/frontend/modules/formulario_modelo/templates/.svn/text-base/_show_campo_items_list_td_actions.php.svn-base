<td>
<ul class="sf_admin_td_actions">
  <?php if ($tabla != null) : ?>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'formulario_modelo/edit_item?id_item_base='.$item->getIdItemBase()."&id_tabla=".$tabla->getPrimaryKey()) ?></li>
  <?php else : ?>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'formulario_modelo/edit_item?id_item_base='.$item->getIdItemBase()) ?></li>
  <?endif;?>
  <?php if (!$item->getBorrado()) : ?>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'formulario_modelo/delete_item?id_item_base='.$item->getIdItemBase()."&id_tabla=".$tabla->getPrimaryKey(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
  <?php endif;?>
  <?php if ($item->getOrden() > 1) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_up.png', array('alt' => __('Subir'), 'title' => __('Subir'))), 'formulario_modelo/ordenar_item?id_item_base='.$item->getIdItemBase()."&id_tabla=".$tabla->getPrimaryKey()."&op=up") ?></li>
  <?php endif ;?>
  <?php if (!$ultimo ) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_down.png', array('alt' => __('Bajar'), 'title' => __('Bajar'))), 'formulario_modelo/ordenar_item?id_item_base='.$item->getIdItemBase()."&id_tabla=".$tabla->getPrimaryKey()."&op=down") ?></li>
  <?php endif ; ?>
</ul>
</td>
