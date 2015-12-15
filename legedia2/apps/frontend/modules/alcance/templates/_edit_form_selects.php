<div class="form-row">
  <?php echo label_for('alcance[id_tabla]', __($labels['alcance{id_tabla}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('alcance{id_tabla}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('alcance{id_tabla}')): ?>
    <?php echo form_error('alcance{id_tabla}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $c_tabla = TablaPeer::getCriterioAlcance();
    $c_tabla->addAscendingOrderBycolumn(TablaPeer::ID_EMPRESA);
    if ($alcance->getIdEmpresa())
    {
      $c_tabla->add(TablaPeer::ID_EMPRESA , $alcance->getIdEmpresa());
    }
    $tablaes = TablaPeer::doSelect($c_tabla);
  ?>

  <?php 
    $value = select_tag('alcance[id_tabla]' , 
      objects_for_select($tablaes , 'getIdTabla' , 'getNombreyEmpresa' , $alcance->getIdTabla() , 
        array('include_custom' => " - ".__('Todas')." - " , 
      )) , array (
      'control_name' => 'alcance[id_tabla]' , 
      //'onChange' => "recargar_selects();"
    )); 
    echo $value ? $value : '&nbsp;';
?>
    </div>
</div>
