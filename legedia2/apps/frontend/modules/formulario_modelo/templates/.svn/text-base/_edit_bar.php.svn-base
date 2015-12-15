<div class="sf_admin_filters">
<?php
  $es_inconsistente = false;
  $id_empresa = null;
  foreach($campos as $campo)
  {
    if ($campo->getEsInconsistente())
    {
      $es_inconsistente = true;
      $id_empresa = $campo->getIdEmpresa();
      break;
    }
  }
?>
<?php if ($es_inconsistente) : ?>
  <div class="form-errors">
  <h2><?php echo __('Los campos han cambiado') ?></h2>
  <dl>
    <dt><?php echo __('Actualizar campos') ?></dt>
    <dd><?php echo __('Los cambios en los campos serán guardados sin alterar los campos de los registros') ?></dd>
    <dt><?php echo __('Consolidar campos') ?></dt>
    <dd><?php echo __('Los campos alterados serán borrados de aquellas registros en las que aparezcan') ?></dd>
  </dl>
  </div>
  <ul class="sf_admin_actions">
    <?
    $direccion = 'id_empresa='.$id_empresa;
    if ($id_tabla != "") $direccion .= '&id_tabla='.$id_tabla;
    ?>
    <li><?php 
      echo button_to(__('Actualizar campos'), 'formulario_modelo/actualizar_formulario_modelo?'.$direccion, array(
        'class'=>'sf_admin_action_save' , 
        'confirm' => __('¿Desea continuar con la actualización?')
      ) );?>
    </li>
    
    <li><?php 
      echo button_to(__('Consolidar campos'), 'formulario_modelo/consolidar_formularios?'.$direccion, array(
        'class'=>'sf_admin_action_reset_filter' , 
        'confirm' => __('¿Desea continuar con la consolidación?')
      ) );?>
    </li>
  </ul>
<?php elseif ($sf_user->hasFlash('actualizar_ok')): ?>
  <div class="save-ok">
  <h2><?php echo __($sf_user->getFlash('actualizar_ok')) ?></h2>
  </div>
<?php elseif ($sf_user->hasFlash('consolidar_ok')): ?>
  <div class="save-ok">
  <h2><?php echo __($sf_user->getFlash('consolidar_ok')) ?></h2>
  </div>
<?php endif; ?>
</div>
