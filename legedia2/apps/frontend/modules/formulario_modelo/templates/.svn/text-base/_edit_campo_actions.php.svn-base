<ul class="sf_admin_actions">
  <li><?php 
      if (isset($tabla)) {
            echo button_to(__('Lista de campos'), 
                           'formulario_modelo/edit?id_empresa='.$campo->getIdEmpresa().'&id_tabla='.$tabla->getPrimaryKey(), 
                            array ('class' => 'sf_admin_action_list',));
      }
      else {
          echo button_to(__('Lista de campos'), 
                           'formulario_modelo/edit?id_empresa='.$campo->getIdEmpresa(), 
                            array ('class' => 'sf_admin_action_list',));


      }


 ?></li>
  <li><?php echo submit_tag(__('Guardar y editar'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
   <li><?php echo submit_tag(__('save and add'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)) ?></li>
   <li><?php echo submit_tag(__('save and list'), array (
  'name' => 'save_and_list',
  'class' => 'sf_admin_action_save_and_list',
)) ?></li>
  <?php if ($campo->getIdCampo()) : ?>
  <li><?php 
      if (isset($tabla)) {
           echo button_to(__('Editar elementos del campo'), 
                         'formulario_modelo/show_campo?id_campo='.$campo->getIdCampo().'&id_tabla='.$tabla->getPrimaryKey(), 
                         array ('class' => 'sf_admin_action_edit',));
      }
      else {
          echo button_to(__('Editar elementos del campo'), 
                         'formulario_modelo/show_campo?id_campo='.$campo->getIdCampo(), 
                         array ('class' => 'sf_admin_action_edit',));
      }
  
 ?></li>
  <?php endif ; ?>
</ul>
