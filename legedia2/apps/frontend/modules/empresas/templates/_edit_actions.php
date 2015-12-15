<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'empresas/list', array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar y añadir'), array (
  'name' => 'save_and_add',
  'class' => 'sf_save_and_add',
)) ?></li>
</ul>
