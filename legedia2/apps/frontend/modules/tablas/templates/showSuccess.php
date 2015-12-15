<div id="sf_admin_container">

<h1><?php echo __('Datos de las tablas', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('tablas/show_header', array('tabla' => $tabla)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('tablas/show_form', array('tabla' => $tabla , 'labels' => $labels)) ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('tablas/show_accesos_directos', array('tabla' => $tabla)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('tablas/show_footer', array('tabla' => $tabla)) ?>
</div>

</div>

