<div id="sf_admin_container">

<h1>
    <?php 
    if (!isset($id_tabla)) $id_tabla = null;
    $tabla = TablaPeer::retrieveByPk($id_tabla);
    ?>
    <?php echo __('Editar modelo de campos', array()) ?>
    <?php if (isset($tabla)) :?> de la tabla "<?php echo $tabla->getNombre();?>"<?endif;?>
</h1>

<div id="sf_admin_header">
</div>

<div id="sf_admin_content">
<?php if (!sizeof($campos)): ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('formulario_modelo/edit_list', array('campos' => $campos, 'empresa' => $empresa, 'labels' => $labels, 'id_tabla' => $id_tabla)) ?>
<?php endif; ?>
<?php
    include_partial('formulario_modelo/edit_actions', array('empresa' => $empresa, 'id_tabla' => $id_tabla));
?>
</div>

<div id="sf_admin_bar">
<?php include_partial('formulario_modelo/edit_header', array('empresa' => $empresa , 'id_tabla' => $id_tabla,  'labels' => $labels)); ?>
<?php include_partial('formulario_modelo/edit_messages', array('labels' => $labels)) ?>
<?php include_partial('formulario_modelo/edit_bar', array('campos' => $campos, 'id_tabla' => $id_tabla)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('formulario_modelo/edit_footer', array()) ?>
</div>

</div>
