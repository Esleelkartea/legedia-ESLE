<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos del campo')?></h2>
<div class="form-row">
  <?php echo label_for('campo[nombre]', __($labels['campo{nombre}']).":", '') ?>
  <div class="content">
  <?php echo $campo->getNombre() ? $campo->getNombre() : '-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[descripcion]', __($labels['campo{descripcion}']).":", '') ?>
  <div class="content">
  <?php 
    echo $campo->getDescripcion() ? $campo->getDescripcion() : '-';?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[tipo]', __($labels['campo{tipo}']).":", '') ?>
  <div class="content">
  <?php 
    $nombre = CampoPeer::getNombreTipo($campo->getTipo());
    echo $nombre ? $nombre : "-";
  ?>
  </div>
</div>

<?php if ($campo->esTipoLista()) : ?>
<div class="form-row">
  <?php echo label_for('campo[tipo_items]', __($labels['campo{tipo_items}']).":", '') ?>
  <div class="content">
  <?php 
    $nombre = CampoPeer::getNombreTipoItem($campo->getTipoItems());
    echo $nombre ? $nombre : "-";
  ?>
  </div>
</div>
<?php if ($campo->esListaTipoRangos()) : ?>
<div class="form-row">
  <?php echo label_for('campo[unidad_rangos]', __($labels['campo{unidad_rangos}']).":", '') ?>
  <div class="content">
  <?php 
    $nombre = CampoPeer::getNombreTipoUnidad($campo->getUnidadRangos());
    echo $nombre ? $nombre : "-";
  ?>
  </div>
</div>
<?php endif ; ?>

<?php endif;?>
</fieldset>

<?php include_partial('show_campo_actions', array('campo' => $campo, 'tabla' => $tabla)) ?>
