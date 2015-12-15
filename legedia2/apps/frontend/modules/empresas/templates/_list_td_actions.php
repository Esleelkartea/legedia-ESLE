<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/images/icons/show.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 'empresas/show?id_empresa='.$empresa->getIdEmpresa()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'empresas/edit?id_empresa='.$empresa->getIdEmpresa()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/application_double.png', array('alt' => __('Duplicar'), 'title' => __('Duplicar'))), 'empresas/duplicate?id_empresa='.$empresa->getIdEmpresa(), array (
  'post' => true,
  'confirm' => __('¿Desea duplicar esta empresa y todas las tablas asociadas?'),
)) ?></li>
  <?php if ($empresa->getIdEmpresa() != 10) : ?>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'empresas/delete?id_empresa='.$empresa->getIdEmpresa(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
  <?php endif; ?>
   <!--
   <li><?php echo link_to(image_tag('/images/icons/chart_organisation.png', array('alt' => __('Campos'), 'title' => __('Campos'))), 'formulario_modelo/edit?id_empresa='.$empresa->getIdEmpresa()) ?></li>
   -->
</ul>
</td>
