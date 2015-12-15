<ul class="sf_admin_actions">
  <li><?php echo button_to(__('lista'), 'tareas/list?id_tarea='.$tarea->getIdTarea(), array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <li><?php echo submit_tag(__('guardar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <?php if ($tarea->getIdTarea()) : ?>
  <li><?php echo button_to(__('ver'), 'tareas/show?id_tarea='.$tarea->getIdTarea(), array (
  'class' => 'sf_admin_action_show',
)) ?></li>
  <?php endif ; ?>
</ul>
