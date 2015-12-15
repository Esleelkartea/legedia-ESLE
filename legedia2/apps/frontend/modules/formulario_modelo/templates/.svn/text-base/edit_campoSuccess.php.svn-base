<?php use_helper('MisObjetos')?>
<?php use_helper('JavascriptBase')?>
<div id="sf_admin_container">

<h2>
    <?php if ($campo->__toString() == "") :?> Crear nuevo campo <?php else: ?><?php echo __('Editar campo', array()) ?> "<?php echo $campo->__toString(); ?>"<?php endif;?> 
    <?php if (isset($tabla)) :?> de la tabla "<?php echo $tabla->getNombre();?>"<?endif;?>
</h2>

<div id="sf_admin_header">
<?php include_partial('formulario_modelo/edit_campo_header', array('campo' => $campo, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('formulario_modelo/edit_campo_messages', array('campo' => $campo, 'labels' => $labels)) ?>
<?php
    if (!isset($tabla)) $tabla = null; 

    include_partial('formulario_modelo/edit_campo_form', array('campo' => $campo, 'tabla' => $tabla,  'labels' => $labels)); 
    
?>
</div>

<div id="sf_admin_footer">
<?php include_partial('formulario_modelo/edit_campo_footer', array('campo' => $campo)) ?>
</div>

</div>
