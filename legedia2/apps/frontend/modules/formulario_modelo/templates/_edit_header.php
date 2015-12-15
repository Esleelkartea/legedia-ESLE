<fieldset id="sf_fieldset_empresa" class="">
<h2><?php echo __('Empresa a la que pertenece')?></h2>
<div class="form-row">
  <?php echo label_for('campo[id_empresa]', __($labels['campo{id_empresa}']), '') ?>
  <div class="content">
  <?php 
    echo $empresa ? link_to($empresa->__toString() ? $empresa->__toString() : '-' , 'empresas/show?id_empresa='.$empresa->getPrimaryKey() ) : '-';
  ?>
  </div>
</div>
<?php if (isset($id_tabla)) {
?>
<div class="form-row">
  <?php echo label_for('campo[id_tabla]', __($labels['campo{id_tabla}']), '') ?>
  <div class="content">
  <?php 
    $tabla = TablaPeer::retrievebypk($id_tabla);
    echo $tabla ? link_to($tabla->__toString() ? $tabla->__toString() : '-' , 'tablas/show?id_tabla='.$tabla->getPrimaryKey() ) : '-';
  ?>
  </div>
</div>
<?php
}
?>
</fieldset>
