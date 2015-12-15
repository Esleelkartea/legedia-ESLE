<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'MisObjetos'); ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo $cliente->getPrimaryKey() ? __('Editar encargado de tratamiento') : __('Crear encargado de tratamiento');?></h1>

<div id="sf_admin_header">
<?php include_partial('encargados/edit_header'  , array('cliente' => $cliente)); ?>
</div>

<div id="sf_admin_content">
<?php include_partial('encargados/edit_messages', array('cliente' => $cliente, 'labels' => $labels)); ?>
<?php include_partial('encargados/edit_form'    , array('cliente' => $cliente, 'labels' => $labels)); ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('encargados/edit_footer'  , array('cliente' => $cliente)); ?>
</div>

</div>
