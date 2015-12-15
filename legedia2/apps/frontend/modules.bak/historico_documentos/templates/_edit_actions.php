
<ul class="sf_admin_actions">
  <li><?php 
    $url = 'historico_documentos/list?id_documento='.$historico_documento->getIdDocumento();
    $url .= '&version='.$historico_documento->getVersion();
    echo button_to(__('Lista'), $url, array (
      'class' => 'sf_admin_action_list',
    ));
  ?></li>
  <li><?php 
    echo submit_tag(__('Guardar'), array (
      'name' => 'save',
      'class' => 'sf_admin_action_save',
    )); 
  ?></li>
</ul>
