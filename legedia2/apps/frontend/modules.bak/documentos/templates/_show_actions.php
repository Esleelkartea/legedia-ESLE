<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista'), 'documentos/list?id_documento='.$documento->getPrimaryKey(), array (
    'class' => 'sf_admin_action_list',
  )); ?></li>
  <li><?php echo button_to(__('Editar'), 'documentos/edit?id_documento='.$documento->getPrimaryKey(), array (
    'class' => 'sf_admin_action_edit',
  )); ?></li>
  <li><?php echo button_to(__('Enviar aviso')."...", 'documentos/enviar_aviso?id_documento='.$documento->getPrimaryKey(), array (
    'class' => 'sf_admin_action_email',
    'confirm' => __('¿Desea enviar un aviso a los trabajadores asociados con el documento?'),
  )); ?></li>
</ul>
