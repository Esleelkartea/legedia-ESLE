
<?php use_helper('I18N', 'Date', 'MisObjetos') ?>

<div id="sf_admin_container">

<h1><?php echo __('Lista de parámetros', array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('parametros/messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados'); ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('parametros/list', array('pager' => $pager, 'labels' => $labels)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('list_filters', array()) ?>
</div>

<div id="sf_admin_footer">
</div>

</div>
