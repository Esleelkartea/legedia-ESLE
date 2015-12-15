<div class="sf_admin_filters">
<?php if ($campo->getEsInconsistente()) : ?>
  <div class="form-errors">
  <h2><?php echo __('La formulario modelo ha cambiado') ?></h2>
  <dl>
    <dt><?php echo __('Actualizar formulario modelo') ?></dt>
    <dd><?php echo __('Los cambios de la formulario modelo serán guardados sin alterar los registros') ?></dd>
    <dt><?php echo __('Consolidar formularios') ?></dt>
    <dd><?php echo __('Los campos alterados serán borrados de aquellos registros en las que aparezcan') ?></dd>
  </dl>
  </div>
  <ul class="sf_admin_actions">
    <?
    $direccion = 'id_empresa='.$campo->getIdEmpresa();
    if ($tabla != null) $direccion .= '&id_tabla='.$tabla->getPrimaryKey();
    ?>
    <li><?php 
      echo button_to(__('Actualizar formulario modelo'), 'formulario_modelo/actualizar_formulario_modelo?'.$direccion, array(
        'class'=>'sf_admin_action_save' , 
        'confirm' => __('¿Desea continuar con la actualización?')
      ) );?>
    </li>
    
    <li><?php 
      echo button_to(__('Consolidar formularios'), 'formulario_modelo/consolidar_formularios?'.$direccion, array(
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
