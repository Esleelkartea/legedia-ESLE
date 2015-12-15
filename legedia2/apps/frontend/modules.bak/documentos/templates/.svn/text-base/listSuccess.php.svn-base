<?php use_helper('I18N', 'Date', 'Javascript') ?>

<div id="sf_admin_container">

<h1><?php echo __('Lista de documentos') ?></h1>

<div id="sf_admin_header">
  <?php include_partial('documentos/list_header', array('pager' => $pager)) ?>
  <?php include_partial('documentos/list_messages', array('pager' => $pager)) ?>
</div>

<?php /*
<div id="sf_admin_bar">
  <?php include_partial('filters', array(
    'filters' => $filters, 'fases' => $fases, 'reuniones' => $reuniones, 'es_administrador' => $es_administrador
  )) ?>
</div>
*/
?>

<div id="content_full">

<div style="clear:both"><?php 
  include_partial('documentos/filters', array(
    'filters' => $filters, 'fases' => $fases, 'reuniones' => $reuniones, 'es_administrador' => $es_administrador
  ));
?></div>

<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('documentos/list', array('pager' => $pager)) ?>
<?php endif; ?>
<?php include_partial('list_actions') ?>
<br />
</div>

<div id="sf_admin_footer">
<?php include_partial('documentos/list_footer', array('pager' => $pager)) ?>
</div>

</div>
