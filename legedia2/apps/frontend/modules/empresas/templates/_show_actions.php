<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista de empresas'), 'empresas/list', array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <!--
  <li><?php echo button_to(__('Campos'), 'formulario_modelo/edit?id_empresa='.$empresa->getPrimaryKey(), array (
  'class' => 'sf_admin_action_form',
  )) ?></li>
  -->
  <li><?php echo button_to(__('Editar'), 'empresas/edit?id_empresa='.$empresa->getPrimaryKey(), array (
  'class' => 'sf_admin_action_edit',
)) ?></li>
</ul>
