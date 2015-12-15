<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Javascript') ?>

<div id="sf_admin_container">

<h1><?php echo $documento->getPrimaryKey() ? __('Edición de documento') : __('Creación de nuevo documento'); ?></h1>

<div id="sf_admin_header"><?php 
  include_partial('documentos/edit_header', array('documento' => $documento));
?></div>

<div id="sf_admin_content_full">
<?php include_partial('documentos/edit_messages', array('documento' => $documento, 'labels' => $labels)); ?>
<?php 
  include_partial('documentos/edit_form', array(
    'documento' => $documento, 
    'labels'    => $labels, 
    'pager'     => $pager
  ));
?>
</div>

<div id="sf_admin_footer">
<?php include_partial('documentos/edit_footer', array('documento' => $documento)) ?>
</div>

</div>
