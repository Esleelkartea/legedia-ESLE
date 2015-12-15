<ul class="sf_admin_actions">
  <?php if ($tabla != null) : ?>
  <li><?php echo button_to(__('Lista de elementos'), 'formulario_modelo/show_campo?id_campo='.$item->getIdCampo().'&id_tabla='.$tabla->getPrimaryKey(), array ('class' => 'sf_admin_action_list',)) ?></li>
  <?php else : ?>
  <li><?php echo button_to(__('Lista de elementos'), 'formulario_modelo/show_campo?id_campo='.$item->getIdCampo(), array ('class' => 'sf_admin_action_list',)) ?></li>
  <?php endif; ?>
  <li><?php echo submit_tag(__('Guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <li><?php echo submit_tag(__('Guardar y añadir'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)) ?></li>
</ul>
