<?php
// auto-generated by sfPropelAdmin
// date: 2007/08/31 08:58:25
?>
  <th id="sf_admin_list_th_id_grupo">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/grupo/sort') == 'id_grupo'): ?>
      <?php echo link_to(__($labels['grupo{id_grupo}']), 'grupos/list?sort=id_grupo&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/grupo/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/grupo/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['grupo{id_grupo}']), 'grupos/list?sort=id_grupo&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_nombre">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/grupo/sort') == 'nombre'): ?>
      <?php echo link_to(__($labels['grupo{nombre}']), 'grupos/list?sort=nombre&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/grupo/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/grupo/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['grupo{nombre}']), 'grupos/list?sort=nombre&type=asc') ?>
      <?php endif; ?>
          </th>
