  <th id="sf_admin_list_th_nombre">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/parametros/sort') == 'nombre'): ?>
      <?php echo link_to(__('Nombre'), 'parametros/list?sort=nombre&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/parametros/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/parametros/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Nombre'), 'parametros/list?sort=nombre&type=asc') ?>
    <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_descripcion">
    <?php echo __('Descripción'); ?>
  </th>
  <th id="sf_admin_list_th_tipo">
    <?php echo __('Tipo'); ?>
  </th>
   <th id="sf_admin_list_th_editable">
    <?php echo __('¿Editar?'); ?>
  </th>
   <th id="sf_admin_list_th_borrable">
    <?php echo __('¿Borrar?'); ?>
  </th>
