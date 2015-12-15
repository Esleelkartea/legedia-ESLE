<?php use_helper('MisObjetos') ?>

<?php echo form_tag('usuarios/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>

<?php echo object_input_hidden_tag($usuario, 'getIdUsuario') ?>

<?php include_partial('edit_form_datos', array('usuario' => $usuario, 'labels' => $labels)); ?>
<?php include_partial('edit_form_acceso', array('usuario' => $usuario, 'labels' => $labels)); ?>
<?php include_partial('edit_form_preferencias', array('usuario' => $usuario, 'labels' => $labels)); ?>



<!--
<fieldset id="sf_fieldset_usuario_categorias_informes" class="">
<h2><?php echo __('Categorías de informes a las que tiene acceso') ?></h2>
<div class="form-row">
  <?php echo label_for('usuario[categorias_informes]', __($labels['usuario{categorias_informes}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('usuario{categorias_informes}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('usuario{categorias_informes}')): ?>
    <?php echo form_error('usuario{categorias_informes}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $value = ""; 
   /* $value = object_double_list($usuario, 'getRelUsuarioCategoriaInforme', array (
  //'control_name' => 'usuario[grupos]',
  'through_class' => 'RelUsuarioCategoriaInforme',
  'unassociated_label'=>__('no asociados'),
  'associated_label'=>__('asociados'),
  'size' => '10',
)); echo $value ? $value : '&nbsp;' */ ?>

  </div>
</div>
</fieldset>
-->





<?php include_partial('edit_actions', array('usuario' => $usuario)) ?>

</form>

<?php if ($usuario->getIdUsuario()): ?>
<ul class="sf_admin_actions">
  <li class="float-left">
<?php echo button_to(__('delete'), 'usuarios/delete?id_usuario='.$usuario->getIdUsuario(), array (
  'post' => true,
  'confirm' => __('¿Quiere borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?>
  </li>
</ul>
<?php endif; ?>
