<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Lista de tablas'), 'tablas/list', array (
  'class' => 'sf_admin_action_list',
)) ?></li>
  <?php 
      $direccion = 'formulario_modelo/create_campo?id_empresa='.$empresa->getPrimaryKey();
      if (isset($id_tabla)) {
          $direccion .= '&id_tabla='.$id_tabla;
      }
  ?>
  <li><?php echo button_to(__('Añadir nuevo campo'), $direccion, array (
  'class' => 'sf_admin_action_create',
)) ?></li>
</ul>
