<ul class="sf_admin_actions">
  <?php if ($documento->getPrimaryKey()) : ?>
    <?php if ($documento->getidProyecto()) :  ?>
    <li><?php echo button_to(__('Editar proyecto'), 'proyectos/edit?id_proyecto='.$documento->getIdProyecto(), array (
      'class' => 'sf_admin_action_edit',
    )); ?></li>
    <?php endif;?>
    <li><?php echo button_to(__('Lista'), 'documentos/list?id_documento='.$documento->getIdDocumento(), array (
      'class' => 'sf_admin_action_list',
    )); ?></li>
  <?php endif;?>
  <li><?php 
    echo submit_tag(__('Guardar'), array (
      'name'  => 'save',
      'id'    => 'btnSubmit',
      'class' => 'sf_admin_action_save',
    ));
  ?></li>
  <li><?php 
    echo submit_tag(__('Guardar y añadir'), array (
      'name'  => 'save_and_add',
      'class' => 'sf_admin_action_save_and_add',
    )); 
  ?></li>
</ul>
<div style="clear:both;"><br /></div>
