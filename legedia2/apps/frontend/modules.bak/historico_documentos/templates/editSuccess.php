<?php
// auto-generated by sfAdvancedAdmin
// date: 2009/03/04 10:19:36
?>
<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Edición de ficheros', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('historico_documentos/edit_header', array('historico_documento' => $historico_documento)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('historico_documentos/edit_messages', array('historico_documento' => $historico_documento, 'labels' => $labels)) ?>
<?php include_partial('historico_documentos/edit_form', array('historico_documento' => $historico_documento, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('historico_documentos/edit_footer', array('historico_documento' => $historico_documento)) ?>
</div>

</div>