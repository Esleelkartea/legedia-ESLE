<ul class="sf_admin_actions">
  <li><?php 
      if (isset($tabla)) {
          echo button_to(__('Lista de campos'), 'formulario_modelo/edit?id_empresa='.$campo->getIdEmpresa().'&id_tabla='.$tabla->getPrimaryKey(), array (
  'class' => 'sf_admin_action_list',
));
      }
      else {
          echo button_to(__('Lista de campos'), 'formulario_modelo/edit?id_empresa='.$campo->getIdEmpresa(), array (
  'class' => 'sf_admin_action_list',
));
      }

   ?></li>
  <li><?php 
      if (isset($tabla)) {
          echo button_to(__('Editar'), 'formulario_modelo/edit_campo?id_campo='.$campo->getIdCampo().'&id_tabla='.$tabla->getPrimaryKey(), array (
  'class' => 'sf_admin_action_edit',
));
      }
      else {
         echo button_to(__('Editar'), 'formulario_modelo/edit_campo?id_campo='.$campo->getIdCampo(), array (
  'class' => 'sf_admin_action_edit',
));
  
      }

?></li>
</ul>
