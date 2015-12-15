<?php use_helper('MisObjetos')?>
<div id="sf_admin_container">

<h2>
    <?php if ($campo->__toString() == "") :?> Crear nuevo campo <?php else: ?><?php echo __('Editar campo', array()) ?> "<?php echo $campo->__toString(); ?>"<?php endif;?> 
    <?php if (isset($tabla)) :?> de la tabla "<?php echo $tabla->getNombre();?>"<?endif;?>
</h2>

<?php if (!isset($tabla)) $tabla = null ?>
<div id="sf_admin_header">
<?php include_partial('show_campo_header', array('campo' => $campo,'tabla' => $tabla, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('show_campo_messages', array('campo' => $campo, 'labels' => $labels)) ?>
<?php include_partial('show_campo_form', array('campo' => $campo , 'labels' => $labels, 'tabla' => $tabla)) ?>
<br/>
<?php if ($campo->getIdCampo()) : ?>
<?php include_partial('show_campo_items', array('campo' => $campo , 'labels' => $labels, 'tabla' => $tabla)) ?>
<?php endif ; ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('show_campo_bar', array('campo' => $campo, 'tabla' => $tabla)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('show_campo_footer', array('campo' => $campo)) ?>
</div>

</div>
