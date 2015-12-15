<?php $ruta = UsuarioPeer::getRuta(); ?>
<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/images/icons/show.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 'tablas/show?id_tabla='.$tabla->getIdTabla()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'tablas/edit?id_tabla='.$tabla->getIdTabla()) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'tablas/delete?id_tabla='.$tabla->getIdTabla(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/application_double.png', array('alt' => __('Duplicar'), 'title' => __('Duplicar'))), 'tablas/duplicate?id_tabla='.$tabla->getIdTabla(), array (
  'post' => true,
  'confirm' => __('¿Desea duplicar este objeto?'),
)) ?></li>
    <li><?php echo link_to(image_tag('/images/icons/chart_organisation.png', array('alt' => __('Campos'), 'title' => __('Campos'))), 'formulario_modelo/edit?id_empresa='.$tabla->getIdEmpresa().'&id_tabla='.$tabla->getIdTabla(), array (
  'post' => true, 
)) ?></li>
   <li><a href="<?php echo $ruta; ?>/formularios/list?filters[id_empresa]=<?php echo $tabla->getIdEmpresa()?>&filters[id_tabla]=<?php echo $tabla->getIdTabla()?>&filter=filtrar"><?php echo image_tag('/images/icons/application_view_columns.png', array('alt' => __('registros'), 'title' => __('registros'))); ?> </a>
</li>
</ul>
</td>
