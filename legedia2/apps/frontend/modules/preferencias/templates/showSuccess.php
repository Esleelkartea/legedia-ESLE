<div id="sf_admin_container">

<h1><?php echo __('Datos del usuario', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('preferencias/show_header', array('usuario' => $usuario)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('preferencias/show_form', array('usuario' => $usuario , 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('preferencias/show_footer', array('usuario' => $usuario)) ?>
</div>

</div>
