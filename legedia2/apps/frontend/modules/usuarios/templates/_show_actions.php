<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'usuarios/list?id_usuario='.$usuario->getIdUsuario(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
<li><?php echo button_to(__('editar'), 'usuarios/edit?id_usuario='.$usuario->getIdUsuario(), array (
  'class' => 'sf_admin_action_edit',
)) ?></li>
<li><?php echo button_to(__('Alcance'), 'alcance/list?id_usuario='.$usuario->getIdUsuario(), array (
  'class' => 'sf_admin_action_security',
)) ?></li>
</ul>
