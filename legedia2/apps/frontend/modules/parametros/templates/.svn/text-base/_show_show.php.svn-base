<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos') ?></h2>

<?php $undefined = "&mdash;"; ?>

<div class="form-row">
  <?php echo label_for('parametro_def[id]', __($labels['parametro_def{id}']).":", '') ?>
  <div class="content"><?php 
    echo $parametro_def->getPrimaryKey(); 
  ?></div>
</div>

<div class="form-row">
  <?php echo label_for('parametro_def[nombre]', __($labels['parametro_def{nombre}']).":", '') ?>
  <div class="content"><?php 
    echo $parametro_def->getNombre() ? $parametro_def->getNombre() : $undefined; 
  ?></div>
</div>

<div class="form-row">
  <?php echo label_for('parametro_def[descripcion]', __($labels['parametro_def{descripcion}']).":", '') ?>
  <div class="content"><?php 
    echo $parametro_def->getDescripcion() ? $parametro_def->getDescripcion() : $undefined; 
  ?></div>
</div>

</fieldset>
