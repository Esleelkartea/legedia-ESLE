<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'encargados/list?id_cliente='.$cliente->getIdCliente(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo button_to(__('Editar'), 'encargados/edit?id_cliente='.$cliente->getIdCliente(), array (
  'class' => 'sf_admin_action_edit',
)) ?></li>
</ul>
