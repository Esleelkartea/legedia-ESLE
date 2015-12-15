<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'usuarios/list?id_usuario='.$usuario->getIdUsuario(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar y añadir'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)) ?></li>
  <?php if ($usuario->getIdUsuario()) : ?>
  <li><?php echo button_to(__('Alcance'), 'alcance/list?id_usuario='.$usuario->getIdUsuario(), array (
  'class' => 'sf_admin_action_security',
)) ?></li>
  <?php endif ; ?>
</ul>

