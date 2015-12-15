<?php
// auto-generated by sfPropelAdmin
// date: 2007/08/31 08:58:25
?>
<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Lista de Grupos', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('grupos/list_header', array('pager' => $pager)) ?>
<?php include_partial('grupos/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<?php echo __('Sin Resultados') ?>
<?php else: ?>
<?php include_partial('grupos/list', array('pager' => $pager, 'labels' => $labels)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_bar">
</div>

<div id="sf_admin_footer">
<?php include_partial('grupos/list_footer', array('pager' => $pager)) ?>
</div>

</div>