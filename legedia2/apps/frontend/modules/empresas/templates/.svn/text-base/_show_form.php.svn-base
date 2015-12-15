<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[nombre]', __($labels['empresa{nombre}']).":", '') ?>
  <div class="content">
  <?php echo $empresa->getNombre() ? $empresa->getNombre() : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[id_usuario]', __($labels['empresa{id_usuario}']).":", '') ?>
  <div class="content">
  <?php 
    $usuarioAux = $empresa->getUsuario();
    echo $usuarioAux ? $usuarioAux->__toString() : '-'?>
  </div>
</div>
</fieldset>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Dirección')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[domicilio]', __($labels['empresa{domicilio}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getDomicilio() ? $empresa->getDomicilio() : '-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[poblacion]', __($labels['empresa{poblacion}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getPoblacion() ? $empresa->getPoblacion() : '-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[codigo_postal]', __($labels['empresa{codigo_postal}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getCodigoPostal() ? $empresa->getCodigoPostal() : '-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[id_provincia]', __($labels['empresa{id_provincia}']).":", '') ?>
  <div class="content">
  <?php 
    $provinciaAux = $empresa->getProvincia();
    echo $provinciaAux ? $provinciaAux->__toString() : '-'?>
  </div>
</div>
</fieldset>

<?php /*
<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[color1]', __($labels['empresa{color1}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColor1()."\">".$empresa->getColor1()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[color2]', __($labels['empresa{color2}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColor2()."\">".$empresa->getColor2()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[color3]', __($labels['empresa{color3}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColor3()."\">".$empresa->getColor3()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[color4]', __($labels['empresa{color4}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColor4()."\">".$empresa->getColor4()."</span>" : '-'?>
  </div>
</div>

<hr />

<div class="form-row">
  <?php echo label_for('empresa[colorletra1]', __($labels['empresa{colorletra1}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColorLetra1()."\">".$empresa->getColorLetra1()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[colorletra2]', __($labels['empresa{colorletra2}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColorLetra2()."\">".$empresa->getColorLetra2()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[colorletra3]', __($labels['empresa{colorletra3}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColorLetra3()."\">".$empresa->getColorLetra3()."</span>" : '-'?>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('empresa[colorletra4]', __($labels['empresa{colorletra4}']).":", '') ?>
  <div class="content">
  <?php
    echo $empresa->getColor1() ? "<span style=\"background-color: ".$empresa->getColorLetra4()."\">".$empresa->getColorLetra4()."</span>" : '-'?>
  </div>
</div>
</fieldset>

*/ ?>

<?php include_partial('show_actions', array('empresa' => $empresa)) ?>

