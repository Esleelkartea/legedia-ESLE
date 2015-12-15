<?php use_helper('MisObjetos')?>
<?php use_helper('Object', 'Validation')?>
<div id="sf_admin_container">

<h1><?php echo __('Editar usuario', array()) ?></h1>

<div id="sf_admin_header">
<?php //include_partial('usuarios/edit_header', array('usuario' => $usuario)) 
?>
</div>

<div id="sf_admin_content">
<?php include_partial('preferencias/edit_messages', array('usuario' => $usuario, 'labels' => $labels)) ?>
<?php include_partial('preferencias/edit_form', array('usuario' => $usuario, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php //include_partial('usuarios/edit_footer', array('usuario' => $usuario)) 
?>
</div>

</div>
