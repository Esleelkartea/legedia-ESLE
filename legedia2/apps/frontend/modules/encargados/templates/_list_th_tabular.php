<?php
// auto-generated by sfPropelAdmin
// date: 2008/07/16 18:56:31
?>
  <th id="sf_admin_list_th_id_cliente">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'id_cliente'): ?>
      <?php echo link_to(__('Id'), 'encargados/list?sort=id_cliente&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Id'), 'encargados/list?sort=id_cliente&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_Nombre">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'Nombre'): ?>
      <?php echo link_to(__('Nombre'), 'encargados/list?sort=nombre&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Nombre'), 'encargados/list?sort=nombre&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_razon_social">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'razon_social'): ?>
      <?php echo link_to(__('Razón social'), 'encargados/list?sort=razon_social&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Razón social'), 'encargados/list?sort=razon_social&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_cif">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'cif'): ?>
      <?php echo link_to(__('Cif'), 'encargados/list?sort=cif&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Cif'), 'encargados/list?sort=cif&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_contacto">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'contacto'): ?>
      <?php echo link_to(__('Contacto'), 'encargados/list?sort=contacto&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Contacto'), 'encargados/list?sort=contacto&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_telefono">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'telefono'): ?>
      <?php echo link_to(__('Teléfono'), 'encargados/list?sort=telefono&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Teléfono'), 'encargados/list?sort=telefono&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_movil">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/cliente/sort') == 'movil'): ?>
      <?php echo link_to(__('Móvil'), 'encargados/list?sort=movil&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/cliente/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Móvil'), 'encargados/list?sort=movil&type=asc') ?>
      <?php endif; ?>
          </th>
