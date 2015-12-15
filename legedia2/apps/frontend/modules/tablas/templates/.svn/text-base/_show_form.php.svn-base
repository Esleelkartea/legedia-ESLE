<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos')?></h2>
<div class="form-row">
  <div class="etiqueta"><?php echo __($labels['tabla{nombre}']).":"?></div>
  <div class="content">
  <?php echo $tabla->getNombre() ? $tabla->getNombre() : '-'?>
  </div>
</div>

<div class="form-row">

  <div class="etiqueta"><?php echo __($labels['tabla{id_empresa}']).":"?></div>
  <div class="content">
  <?php 
    $empresaAux = $tabla->getEmpresa();
    echo $empresaAux ? $empresaAux : '-'?>
  </div>
</div>

<div class="form-row">

  <div class="etiqueta"><?php echo __($labels['tabla{id_categoria}']).":"?></div>
  <div class="content">
  <?php
    $catAux = $tabla->getParametro();
    echo $catAux ? $catAux->getNombre() : '-'?>
  </div>
</div>

<div class="form-row">
  <div class="etiqueta"><?php echo __($labels['tabla{id_usuario}']).":"?></div>
  <div class="content">
  <?php 
    $usuario = $tabla->getUsuario();
    echo $usuario ? $usuario->getNombreCompleto() : '-'?>
  </div>
</div>


</fieldset>

<?php include_partial('show_actions', array('tabla' => $tabla)) ?>
<!--
<div class="clear">
<h1><?php echo __('Historial de seleccionados')?></h1>
<?php 
  use_helper('NeofisGraph');

  $url = "graficos/show?id=2&id_tabla=".$tabla->getPrimaryKey();
  echo grafico($url, array('width' => 700, 'height' => 300));
  
?>
</div>
-->



