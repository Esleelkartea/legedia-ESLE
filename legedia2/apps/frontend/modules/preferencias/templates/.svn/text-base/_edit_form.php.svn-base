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




<?php include_partial('edit_actions', array('usuario' => $usuario)) ?>

</form>


