<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/images/icons/show.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 'usuarios/show?id_usuario='.$usuario->getIdUsuario()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'usuarios/edit?id_usuario='.$usuario->getIdUsuario()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/lock.png', array('alt' => __('Alcance'), 'title' => __('Alcance'))), 'alcance/list?id_usuario='.$usuario->getIdUsuario()) ?></li>
  
  <?php if ($usuario->getIsBorrable()) { ?>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'usuarios/delete?id_usuario='.$usuario->getIdUsuario(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
  <?php } ?>
</ul>
</td>
