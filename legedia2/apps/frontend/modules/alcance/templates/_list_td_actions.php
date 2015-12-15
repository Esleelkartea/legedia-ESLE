<?php
  $parametros = "?id_usuario=".$alcance->getIdUsuario();
  $parametros .= "&id_alcance=".$alcance->getIdAlcance();
?>
<td>
<ul class="sf_admin_td_actions">
  
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'alcance/edit'.$parametros) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), 'alcance/delete'.$parametros, array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
</ul>
</td>
