<?php
// auto-generated by sfAdvancedAdmin
// date: 2008/01/10 11:37:49
?>
<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Lista de Sesiones', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sesiones/list_header', array('pager' => $pager)) ?>
<?php include_partial('sesiones/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<?php include_partial('sesiones/list', array('pager' => $pager, 'labels' => $labels)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('filters', array('filters' => $filters, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sesiones/list_footer', array('pager' => $pager)) ?>
</div>

</div>