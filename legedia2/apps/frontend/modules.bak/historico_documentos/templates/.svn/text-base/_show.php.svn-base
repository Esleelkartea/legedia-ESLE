<?php
  $undefined = "&mdash;";
?>
<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('historico_documento[id_documento]', __($labels['historico_documento{id_documento}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $historico_documento->getDocumento()->getNombre(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[version]', __($labels['historico_documento{version}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $historico_documento->getVersion(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[nombre_fich]', __($labels['historico_documento{nombre_fich}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $historico_documento->getNombreFich(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[tamano]', __($labels['historico_documento{tamano}']), 'class="required" ') ?>
  <div class="content">
  <?php 
    $value = $historico_documento->getTamanoFormateado(); 
    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('historico_documento[fecha]', __($labels['historico_documento{fecha}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $historico_documento->getFecha() ? format_date($historico_documento->getFecha(), "f") : ''; 
  echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('show_actions', array('historico_documento' => $historico_documento)) ?>
