<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Datos del documento', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('documentos/show_header', array('documento' => $documento)) ?>
<?php include_partial('documentos/edit_messages', array()); ?>
</div>

<div id="sf_admin_content">
<?php include_partial('documentos/show', array('documento' => $documento, 'labels' => $labels, 'pager' => $pager)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('documentos/show_footer', array('documento' => $documento)) ?>
</div>

</div>
