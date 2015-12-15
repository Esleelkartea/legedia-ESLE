<!--
<fieldset id="sf_fieldset_empresa" class="">
<h2><?php echo __('Pertenece a')?></h2>
<div class="form-row">
  <?php echo label_for('campo[id_empresa]', __($labels['campo{id_empresa}']).":", '') ?>
  <div class="content">
  <?php 
    $campo = $item->getCampo();
    $empresa = $campo->getEmpresa();
    echo $empresa ? link_to($empresa->__toString() ? $empresa->__toString() : '-' , 'empresas/show?id_empresa='.$empresa->getPrimaryKey()) : '-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[id_campo]', __($labels['campo{id_campo}']).":", '') ?>
  <div class="content">
  <?php echo $campo ? $campo->__toString() : '-'?>
  </div>
</div>
</fieldset>
-->