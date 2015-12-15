<ul class="sf_admin_actions">
  <li><?php 
    echo button_to(
      __('Lista'), 
      'historico_documentos/list?id_documento='.$historico_documento->getIdDocumento().'&version='.$historico_documento->getVersion(), 
      array (
        'class' => 'sf_admin_action_list',
      )
    );
  ?></li>
</ul>
