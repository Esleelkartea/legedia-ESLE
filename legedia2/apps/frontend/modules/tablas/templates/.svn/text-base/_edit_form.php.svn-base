
<?php echo form_tag('tablas/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
    'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>

<?php echo object_input_hidden_tag($tabla, 'getIdTabla') ?>

<fieldset id="sf_fieldset_editable" class="">
<h2><?php echo __('Datos') ?></h2>

<div class="form-row">
  <?php echo label_for('tabla[nombre]', __($labels['tabla{nombre}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('tabla{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{nombre}')): ?>
    <?php echo form_error('tabla{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($tabla, 'getNombre', array (
  'size' => 60,
  'control_name' => 'tabla[nombre]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('tabla[id_empresa]', $labels['tabla{id_empresa}'], 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('tabla{id_empresa}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{id_empresa}')): ?>
    <?php echo form_error('tabla{id_empresa}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',false);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',true);
    
    $c = EmpresaPeer::getCriterioAlcance();
    $empresas = EmpresaPeer::doSelect($c);
    
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',$todas_empresas);
    
    $value = select_tag('tabla[id_empresa]' , objects_for_select($empresas , 'getIdEmpresa' , '__toString' , $tabla->getIdEmpresa()) , 
      array('control_name' => 'tabla[id_empresa]',
    ));
    echo $value ? $value : '&nbsp;'
    
  ?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('tabla[id_usuario]', __($labels['tabla{id_usuario}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('tabla{id_usuario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{id_usuario}')): ?>
    <?php echo form_error('tabla{id_usuario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $usuario_actual = Usuario::getUsuarioActual();
    $usuarios = $usuario_actual->getUsuariosAccesibles();
    $opciones = objects_for_select($usuarios , 'getPrimaryKey' , 'getNombreCompleto' , $tabla->getIdUsuario());
    $value = select_tag('tabla[id_usuario]', $opciones , array (
      'control_name' => 'tabla[id_usuario]',
    ));
    echo $value ? $value : '&nbsp;'; 
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tabla[id_categoria]', __($labels['tabla{id_categoria}'])) ?>
  <div class="content<?php if ($sf_request->hasError('tabla{id_categoria}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{id_categoria}')): ?>
    <?php echo form_error('tabla{id_categoria}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($tabla, 'getIdCategoria', array (
  'related_class' => 'Parametro',
  'control_name' => 'tabla[id_categoria]',
  'peer_method' => 'getCategorias',
  'include_custom' => "- ".__('Sin definir')." -",
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tabla[mostrar_en_lista]', __($labels['tabla{mostrar_en_lista}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tabla{mostrar_en_lista}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{mostrar_en_lista}')): ?>
    <?php echo form_error('tabla{mostrar_en_lista}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $value = checkbox_tag('tabla[mostrar_en_lista]' , '' ,$tabla->getMostrarEnLista() , array('control_name' => 'tabla[mostrar_en_lista]'));
    echo $value ? $value : '&nbsp;'; 
  ?>
  <div class="sf_edit_help"><?php echo __('Indique si desea que se muestre al usuario esta tabla en la lista de tablas') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('tabla[orden]', __($labels['tabla{orden}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('tabla{orden}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('tabla{orden}')): ?>
    <?php echo form_error('tabla{orden}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('tabla[orden]', $tabla->getOrden(), array (
  'size' => 5,
  'control_name' => 'tabla[orden]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el orden de la tabla dentro de la lisa') ?></div>
  </div>
</div>

</fieldset>



<?php include_partial('edit_actions', array('tabla' => $tabla)) ?>

</form>

<?php if ($tabla->getIdTabla()): ?>
<ul class="sf_admin_actions">
  <li class="float-left">
<?php echo button_to(__('Borrar'), 'tablas/delete?id_tabla='.$tabla->getIdTabla(), array (
  'post' => true,
  'confirm' => __('¿Quiere borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?>
  </li>
</ul>
<?php endif; ?>
