<?php echo form_tag('alcance/edit', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>

<?php 
  echo object_input_hidden_tag($alcance, 'getIdAlcance');
  echo object_input_hidden_tag($alcance, 'getIdUsuario');
?>


<fieldset id="sf_fieldset_editable" class="">
<h2><?php echo __('Añadir nueva regla') ?></h2>

<div class="form-row">
  <?php echo label_for('alcance[titulo]', __($labels['alcance{titulo}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('alcance{titulo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('alcance{titulo}')): ?>
    <?php echo form_error('alcance{titulo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($alcance, 'getTitulo', array (
  'size' => 40,
  'control_name' => 'alcance[titulo]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('alcance[descripcion]', __($labels['alcance{descripcion}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('alcance{descripcion}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('alcance{descripcion}')): ?>
    <?php echo form_error('alcance{descripcion}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($alcance, 'getDescripcion', array (
  'size' => '50x3',
  'control_name' => 'alcance[descripcion]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('alcance[id_empresa]', __($labels['alcance{id_empresa}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('alcance{id_empresa}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('alcance{id_empresa}')): ?>
    <?php echo form_error('alcance{id_empresa}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',false);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',true);
    
    $c = EmpresaPeer::getCriterioAlcance();
    $empresas = EmpresaPeer::doSelect($c);
    
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',$todas_empresas);
    
    $value = select_tag('alcance[id_empresa]' , objects_for_select($empresas , 'getIdEmpresa' , '__toString' , $alcance->getIdEmpresa(),array('include_custom' => " - ".__('Todas')." - ")) , 
      array('control_name' => 'alcance[id_empresa]','onChange' => "recargar_selects();"));
    echo $value ? $value : '&nbsp;'
    
  ?>
    </div>
</div>

<div id="grupo_selects">
  <?php //selects
    include_partial('alcance/edit_form_selects' , array('alcance' => $alcance , 'labels' => $labels)); 
  ?>
</div>

<div class="form-row">
  <?php echo label_for('alcance[ver_todos_registros]', __($labels['alcance{ver_todos_registros}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('alcance{ver_todos_registros}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('alcance{ver_todos_registros}')): ?>
    <?php echo form_error('alcance{ver_todos_registros}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('alcance[ver_todos_registros]', '1', $alcance->getVerTodosRegistros() ,array (
  'control_name' => 'alcance[ver_todos_registros]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  
  <div class="sf_edit_help"><?php echo __('Si no marca esta opción el usuario solo podrá ver aquellos registros que haya creado') ?></div>
    </div>
</div>

</fieldset>

<?php include_partial('alcance/edit_actions', array('alcance' => $alcance)) ?>

</form>

<?php echo javascript_tag("
  function recargar_selects()
  {
    var empresa = document.getElementById('alcance_id_empresa').value;
    
    ".remote_function(array(
    'update'  => 'grupo_selects',
    'url'     => 'alcance/update_selects',
    'with'    => "'id_empresa='+empresa"
  ))."
  }
");

?>

