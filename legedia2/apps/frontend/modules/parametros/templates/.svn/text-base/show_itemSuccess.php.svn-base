<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date', 'Text') ?>

<div id="sf_admin_container">
<h1><?php echo __('Ver elemento del parámetro') ?></h1>

<div id="sf_admin_header">
<?php include_partial('parametros/messages', array()) ?>
</div>

<div id="sf_admin_content">
  <?php include_partial('parametros/show', array(
    'parametro_def' => $parametro_def, 
    'parametro' => $parametro,
    'labels' => $labels,
    'show'  => true
  )) ?>
</div>

<div id="sf_admin_bar">
  <?php include_partial('parametros/barra_lateral', array('id_parametro_def' => $parametro_def->getPrimaryKey())) ?>
</div>

</div>
