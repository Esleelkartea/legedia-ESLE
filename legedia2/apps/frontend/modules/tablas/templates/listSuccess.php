<?php use_helper('MisObjetos')?>
<div id="sf_admin_container">
<h1><?php echo __('Lista de tablas', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('tablas/list_header', array('pager' => $pager)) ?>
<?php include_partial('tablas/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('tablas/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('filters', array('filters' => $filters)) 
?>
</div>

<div id="sf_admin_footer">
<?php include_partial('tablas/list_footer', array('pager' => $pager)) ?>
</div>

</div>
