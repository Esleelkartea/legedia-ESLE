<div style="clear:left"> </div>
<br />
<ul class="sf_admin_actions">
   <li><?php
      $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
      if ($id_tabla != null)
        echo button_to(__('Crear nuevo registro'), 'formularios/create?id_tabla='.$id_tabla, array ('class' => 'sf_admin_action_create',)) ?></li>
<li><?php echo button_to(__('Exportar a Excel'), 'formularios/excel?id_tabla='.$id_tabla, array (
  'class' => 'sf_action_excel',
)) ?></li>
<li><?php echo button_to(__('Exportar a CSV'), 'formularios/csv?id_tabla='.$id_tabla, array (
  'class' => 'sf_action_excel',
)) ?></li>
</ul>

