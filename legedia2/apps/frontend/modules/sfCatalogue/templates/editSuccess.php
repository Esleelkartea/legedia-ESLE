<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/05 11:44:50
?>
<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Nuevo idioma', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sfCatalogue/edit_header', array('catalogue' => $catalogue)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('sfCatalogue/edit_messages', array('catalogue' => $catalogue, 'labels' => $labels)) ?>
<?php include_partial('sfCatalogue/edit_form', array('catalogue' => $catalogue, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sfCatalogue/edit_footer', array('catalogue' => $catalogue)) ?>
</div>

</div>
