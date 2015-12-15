<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'tablas/list?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
<?php if ($tabla->getIdTabla()!=0) : ?>
  <li><?php echo button_to(__('Ver'), 'tablas/show?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_show',
  )) ?></li>
  <li><?php echo button_to(__('Ver Campos'), 'formulario_modelo/edit?id_empresa='.$tabla->getIdEmpresa().'&id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_show',
  )) ?></li>
  <li><?php echo button_to(__('Añadir registro'), 'formularios/create?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_create',
  )) ?></li>
<?php endif; ?>
  <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar y añadir'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)) ?></li>

</ul>
