<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista de usuarios'), 'usuarios/list', array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo button_to(__('Crear una nueva regla'), 'alcance/create?id_usuario='.$usuario->getPrimaryKey(), array (
  'class' => 'sf_admin_action_create',
)) ?></li>
</ul>
