<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'tablas/list?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_list',
  )) ?></li>
  <li><?php echo button_to(__('Editar'), 'tablas/edit?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_edit',
  )) ?></li>
  <li><?php echo button_to(__('Ver Campos'), 'formulario_modelo/edit?id_empresa='.$tabla->getIdEmpresa().'&id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_show',
  )) ?></li>
  <li><?php echo button_to(__('Añadir registro'), 'formularios/create?id_tabla='.$tabla->getIdTabla(), array (
  'class' => 'sf_admin_action_create',
  )) ?></li>

</ul>
