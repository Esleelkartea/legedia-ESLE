<div id="sf_admin_container">

<h2><?php echo __('Código HTML del formulario externo', array()) ?></h2>

<div id="sf_admin_header">
<fieldset id="sf_fieldset_none">
<h2><?php echo __('Fuente de datos')?></h2>
<div class="form-row">
  <?php echo label_for('tabla', __('Nombre').":", '') ?>
  <div class="content">
  <?php 
    echo link_to($tabla->__toString() ? $tabla->__toString() : '-' , 'tablas/show?id_tabla='.$tabla->getPrimaryKey());
  ?>
  </div>
</div>
</fieldset>
</div>

<div id="sf_admin_content">
<?php include_partial('html_formulario_codigo', array('tabla' => $tabla)) ?>
</div>

<div id="sf_admin_footer">
</div>

</div>
