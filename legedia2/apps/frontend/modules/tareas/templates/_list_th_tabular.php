<th id="sf_admin_list_th_id_tarea">
  <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/tareas/sort') == 'id_tarea'): ?>
  <?php echo link_to(__($labels['tarea{id_tarea}']), 'tareas/list?sort=id_tarea&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort')) ?>)
   <?php else: ?>
   <?php echo link_to(__($labels['tarea{id_tarea}']), 'tareas/list?sort=id_tarea&type=asc') ?>
   <?php endif; ?>
</th>

<th id="sf_admin_list_th_id_usuario">
  <?php
     if ($sf_user->getAttribute('sort', null, 'sf_admin/tareas/sort') == 'id_usuario'){
        echo link_to(__($labels['tarea{id_usuario}']), 'tareas/list?sort=id_usuario&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort') == 'asc' ? 'desc' : 'asc'));
        echo " (".__($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort')).")";
     }
     else {
        echo link_to(__($labels['tarea{id_usuario}']), 'tareas/list?sort=id_usuario&type=asc');
     }
  ?>
</th>

<th id="sf_admin_list_th_texto">
  <?php echo __('Resumen')?>
</th>

<th id="sf_admin_list_th_creacion">
  <?php
     if ($sf_user->getAttribute('sort', null, 'sf_admin/tareas/sort') == 'fecha_inicio'){
        echo link_to(__($labels['tarea{fecha_inicio}']), 'tareas/list?sort=fecha_inicio&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort') == 'asc' ? 'desc' : 'asc'));
        echo " (".__($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort')).")";
     }
     else {
        echo link_to(__($labels['tarea{fecha_inicio}']), 'tareas/list?sort=fecha_inicio&type=asc');
     }
  ?>
</th>
<th id="sf_admin_list_th_vencimiento">
    <?php
     if ($sf_user->getAttribute('sort', null, 'sf_admin/tareas/sort') == 'fecha_vencimiento'){
        echo link_to(__($labels['tarea{fecha_vencimiento}']), 'tareas/list?sort=fecha_vencimiento&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort') == 'asc' ? 'desc' : 'asc'));
        echo " (".__($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort')).")";
     }
     else {
        echo link_to(__($labels['tarea{fecha_vencimiento}']), 'tareas/list?sort=fecha_vencimiento&type=asc');
     }
  ?>
</th>
<th id="sf_admin_list_th_tipo">
  <?php echo __('Tipo')?>
</th>
<th id="sf_admin_list_th_estado">
 <?php
     if ($sf_user->getAttribute('sort', null, 'sf_admin/tareas/sort') == 'id_estado_tarea'){
        echo link_to(__($labels['tarea{id_estado}']), 'tareas/list?sort=id_estado_tarea&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort') == 'asc' ? 'desc' : 'asc'));
        echo " (".__($sf_user->getAttribute('type', 'asc', 'sf_admin/tarea/sort')).")";
     }
     else {
        echo link_to(__($labels['tarea{id_estado}']), 'tareas/list?sort=id_estado_tarea&type=asc');
     }
  ?>
</th>
<th id="sf_admin_list_th_acciones">
  <?php echo __('Acciones')?>
</th>
