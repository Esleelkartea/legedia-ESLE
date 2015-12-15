<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/05 11:44:53
?>
<?php use_helper('I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Translation list', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('sfTransUnit/list_header', array('pager' => $pager)) ?>
<?php include_partial('sfTransUnit/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<?php echo __('no result') ?>
<?php else: ?>
<?php include_partial('sfTransUnit/list', array('pager' => $pager, 'labels' => $labels)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('filters', array('filters' => $filters, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('sfTransUnit/list_footer', array('pager' => $pager)) ?>
</div>

</div>
