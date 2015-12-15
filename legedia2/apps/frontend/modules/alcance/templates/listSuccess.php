<?php use_helper('MisObjetos'); ?>

<div id="sf_admin_container">

<h1><?php echo __('Datos del alcance del usuario', array()) ?></h1>

<div id="sf_admin_header">
</div>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()) : ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados') ?>
</p></blockquote>
<?php else : ?>
<?php include_partial('alcance/list', array('pager' => $pager , 'usuario' => $usuario , 'labels' => $labels )) ?>
<?php endif ; ?>
<?php include_partial('alcance/list_actions' , array('usuario' => $usuario)) ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('alcance/list_header', array('usuario' => $usuario , 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('alcance/list_footer', array()) ?>
</div>

</div>

