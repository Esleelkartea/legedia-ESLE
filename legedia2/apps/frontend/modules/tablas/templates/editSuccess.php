<div id="sf_admin_container">

<h1><?php echo __('Editar tablas', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('tablas/edit_header', array('tabla' => $tabla)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('tablas/edit_messages', array('tabla' => $tabla, 'labels' => $labels)) ?>
<?php include_partial('tablas/edit_form', array('tabla' => $tabla, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('tablas/edit_footer', array('tabla' => $tabla)) ?>
</div>

</div>
