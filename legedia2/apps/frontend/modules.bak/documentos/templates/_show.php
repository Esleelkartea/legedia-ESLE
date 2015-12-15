<?php
  $undefined = "&mdash;";
?>
<fieldset id="sf_fieldset_none">
  <h2 style="color:white">
    <?php echo __('Datos principales: ') ?>
  </h2>

  <div class="form-row">
    <?php echo label_for('documento[id_proyecto]', __($labels['documento{id_proyecto}']), 'class="required" ') ?>
    <div class="content"><?php 
      $proyecto = $documento->getProyecto();
      $value = $proyecto ? $proyecto->__toString() : "";
      echo $value ? $value : $undefined;
    ?></div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('documento[id_fase]', __($labels['documento{id_fase}']), 'class="required" ') ?>
    <div class="content"><?php 
      $fase = $documento->getFase();
      $value = $fase ? $fase->__toString() : "";
      echo $value ? $value : $undefined;
    ?></div>
  </div>
  
  <?php if ($entregable = $documento->getEntregable()) : ?>
    <div class="form-row">
      <?php echo label_for('documento[tipo]', __($labels['documento{tipo}']), '') ?>
      <div class="content"><?php 
        echo __('Entregable');
      ?></div>
    </div>
    
    <div class="form-row">
      <?php echo label_for('documento[id_entregable]', __($labels['documento{id_entregable}']), '') ?>
      <div class="content"><?php 
        $value = "";
        $texto = $entregable->__toString();
        $value = link_to($texto ? $texto : $undefined, 
          'fases/edit_entregable?id_entregable='.$entregable->getPrimaryKey()
        );
        echo $value ? $value : $undefined; 
      ?></div>
    </div>
  <?php else : ?>
    <div class="form-row">
      <?php echo label_for('documento[id_reunion]', __($labels['documento{id_reunion}']), 'class="required" ') ?>
      <div class="content"><?php 
        $reunion = $documento->getReunion();
        $value = $reunion ? $reunion->__toString() : "";
        echo $value ? $value : $undefined; 
      ?></div>
    </div>
  <?php endif; ?>
  <div class="form-row">
    <?php echo label_for('documento[id_categoria]', __($labels['documento{id_categoria}']), 'class="required" ') ?>
    <div class="content"><?php 
      $categoria = $documento->getCategoria();
      $value = $categoria ? $categoria->__toString() : "";
      echo $value ? $value : $undefined;
    ?></div>
  </div>

</fieldset>

<br />

<fieldset id="sf_fieldset_none" class="">
  <h2 style="color:white">
    <?php echo __('Nombre: ') ?>
  </h2>
  
  <div class="form-row">
    <?php echo label_for('documento[nombre]', __($labels['documento{nombre}']), 'class="required" ') ?>
    <div class="content"><?php 
      $value = $documento->getNombre(); 
      echo $value ? $value : $undefined;
    ?></div>
  </div>

</fieldset>

<br />



<fieldset id="sf_fieldset_none" class="">
  <h2 style="color:white">
    <?php echo __('Historico de este documento :') ?>
  </h2>

  <?php if ($pager->getNbResults()): ?>
    <div align="center">
      <?php include_partial('list_documentos', array('pager' => $pager)) ?>
    </div>
  <?php else : ?>
  <blockquote class="warning"><p>
    <?php echo __('No hay resultados') ?>
  </p></blockquote>
  <?php endif; ?>
</fieldset>

<?php 
  //Ana: 03-11-09. Añado que se puedan asignar trabajadores al documento.
  if (!$documento->isNew()) {
    include_partial('show_form_trabajadores', array('documento' => $documento));
  }

?>

<?php include_partial('show_actions', array('documento' => $documento)) ?>
