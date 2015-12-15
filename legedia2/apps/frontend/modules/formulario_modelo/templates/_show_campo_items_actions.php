<ul class="sf_admin_actions">
  <?php if (!$campo->esTipoLista()) : ?>
  <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save_and_campo',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <?php else : ?>
  <li>
    <?php if ($tabla != null) : ?>
    <?php echo button_to(__('Añadir elemento'), 'formulario_modelo/create_item?id_campo='.$campo->getIdCampo()."&id_tabla=".$tabla->getPrimaryKey(), array ( 'class' => 'sf_admin_action_create',)) ?>
    <?php else : ?>
    <?php echo button_to(__('Añadir elemento'), 'formulario_modelo/create_item?id_campo='.$campo->getIdCampo(), array ( 'class' => 'sf_admin_action_create',)) ?>
    <?php endif; ?>
  </li>
  
  <?php endif;?>
</ul>
