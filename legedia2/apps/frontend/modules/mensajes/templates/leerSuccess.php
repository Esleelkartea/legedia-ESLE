<?php use_helper('MisObjetos')?>
<?php use_helper('Date')?>
<div id="sf_admin_container">

<h1><?php echo __('Leer mensaje', array()) ?></h1>

<div id="sf_admin_header">
<?php //include_partial('edit_header', array('usuario' => $usuario)) 
?>
</div>

<div id="sf_admin_content">
<?php //include_partial('edit_messages', array('mensaje' => $mensaje, 'labels' => $labels)) 
?>
<?php include_partial('leer_form', array('mensaje' => $mensaje, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php //include_partial('edit_footer', array('mensaje' => $mensaje)) 
?>
</div>

</div>
