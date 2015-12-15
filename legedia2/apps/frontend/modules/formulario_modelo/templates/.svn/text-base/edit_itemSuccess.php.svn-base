<div id="sf_admin_container">

<h2><?php echo __('Editar elemento del campo', array()) ?> "<?php echo $itemBase->getCampo() ? $itemBase->getCampo()->__toString() : '-'?>" <?php if (isset($tabla)) :?> de tabla "<?php echo $tabla->getNombre();?>"<?endif;?></h2>

<div id="sf_admin_header">
<?php include_partial('formulario_modelo/edit_item_header', array('item' => $itemBase , 'labels' => $labels, 'tabla' => $tabla)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('formulario_modelo/edit_item_messages', array('item' => $itemBase, 'labels' => $labels)) ?>
<?php include_partial('formulario_modelo/edit_item_form', array('item' => $itemBase, 'labels' => $labels, 'tabla' => $tabla)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('formulario_modelo/edit_item_footer', array('item' => $itemBase)) ?>
</div>

</div>
