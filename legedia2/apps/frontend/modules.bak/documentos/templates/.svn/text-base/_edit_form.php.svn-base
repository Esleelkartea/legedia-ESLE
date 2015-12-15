<?php echo form_tag('documentos/save', array(
  'id'        => 'swfupload_form',
  'name'      => 'swfupload_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($documento, 'getIdDocumento') ?>

<fieldset id="sf_fieldset_none" class="">
  <h2><?php echo __('Datos principales') ?></h2>
<?php if ($entregable = $documento->getEntregable()) : ?>
   <div class="form-row">
    <?php echo label_for('documento[id_proyecto]', __($labels['documento{id_proyecto}']), ''); ?>
    <div class="content"><?php 
      $proyecto = $documento->getProyecto();
      $value = $proyecto ? $proyecto->__toString() : "";
      echo $value ? $value : '&nbsp;';
    ?></div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('documento[id_fase]', __($labels['documento{id_fase}']), ''); ?>
    <div class="content"><?php 
      $fase = $documento->getFase();
      $value = $fase ? $fase->__toString() : "";
      echo $value ? $value : '&nbsp;';
    ?></div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('documento[tipo]', __($labels['documento{tipo}']), ''); ?>
    <div class="content"><b><?php 
      echo __('Entregable');
    ?></b></div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('entregable[id_entregable]', __($labels['entregable{id_entregable}']), ''); ?>
    <div class="content"><?php 
      $value = $entregable->__toString();
      echo $value ? $value : '&nbsp;';
    ?></div>
  </div>
  
<?php else : ?>
  <div class="form-row">
    <?php echo label_for('documento[id_proyecto]', __($labels['documento{id_proyecto}']), '') ?>
    <div class="content<?php if ($sf_request->hasError('documento{id_proyecto}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('documento{id_proyecto}')): ?>
      <?php echo form_error('documento{id_proyecto}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
    if (!$documento->isNew()) {
      echo link_to($documento->getNombreProyecto(), 'proyectos/edit?id_proyecto='.$documento->getIdProyecto());
      echo input_hidden_tag('documento[id_proyecto]', $documento->getIdProyecto());    
    }
    else { 
       $value = object_select_tag($documento, 'getIdProyecto', array (
        'related_class' => 'Proyecto',
        'control_name' => 'documento[id_proyecto]',
        'peer_method' => 'getProyectosEmpresa',
        'text_method' => 'getCodigo',
        'include_custom' => "- ".__('Sin definir')." -",
        //'onchange' => 'cargarFases()',
      )); echo $value ? $value : '&nbsp;';
      
         echo observe_field('documento_id_proyecto', array(
      	    'frequency' => 1,
      	    'script' => 'true',
            'update' => 'fases',
            'url'    => 'documentos/elegirproyecto',
            'with'   => "'id_proyecto='+ $('documento_id_proyecto').value"
        )); 
    }    
    ?>
      </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('documento[id_fase]', __($labels['documento{id_fase}']), '') ?>
    <div id="fases" class="content<?php if ($sf_request->hasError('documento{id_fase}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('documento{id_fase}')): ?>
      <?php echo form_error('documento{id_fase}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>

    <?php $fases = $documento->getIdproyecto() ? FasePeer::getFasesEmpresaProyecto($documento->getIdProyecto()) : array();?>  
  
    <?php  echo select_tag('documento[id_fase]', objects_for_select(
      $fases,'getIdFase', 'getNombre', $documento->getIdfase(), array('include_custom' => "- ".__('Sin definir')." -")), 
      array()); ?>
       
    <?php echo observe_field('documento_id_fase', array(
  	    'frequency' => 1,
  	    'script' => 'true',
        'update' => 'reuniones',
        'url'    => 'documentos/elegirfase',
        'with'   => "'id_proyecto='+$('documento_id_proyecto').value+'id_fase='+$('documento_id_fase').value"
    )) ?>
      </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('documento[id_reunion]', __($labels['documento{id_reunion}']), '') ?>
    <div id="reuniones" class="content<?php if ($sf_request->hasError('documento{id_reunion}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('documento{id_reunion}')): ?>
      <?php echo form_error('documento{id_reunion}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
      
    <?php $reuniones = $documento->getIdproyecto() ? ReunionPeer::getReunionesEmpresaProyecto($documento->getIdProyecto()) : array();?>
      
    <?php  echo select_tag('documento[id_reunion]', objects_for_select(
      $reuniones,'getIdReunion', 'getNombre', $documento->getIdReunion(), 
      array('include_custom' => "- ".__('Sin definir')." -") )); 
    ?>
    </div>
  </div>
<?php endif; ?>
  <div class="form-row">
    <?php echo label_for('documento[id_categoria]', __($labels['documento{id_categoria}']), ''); ?>
    <div class="content"><?php 
      $value = object_select_tag($documento->getIdCategoria(), 'getNombre', array (
        'related_class'   => 'Parametro',
        'control_name'    => 'documento[id_categoria]',
        'peer_method'     => 'getCategoriasDocumentos',
        'text_method'     => 'getNombre',   
        'include_custom'  => "- ".__('Sin definir')." -",
      ));
      echo $value ? $value : '&nbsp;';
    ?></div>
  </div>

</fieldset>

<br />

<fieldset id="sf_fieldset_none" class="">
  <h2><?php echo __('Datos del fichero: ') ?></h2>

  <div class="form-row">
    <?php echo label_for('documento[fichero]', __($labels['documento{fichero}']), '') ?>
    <div class="content<?php if ($sf_request->hasError('documento{fichero}')): ?> form-error<?php endif; ?>">
      <?php if ($sf_request->hasError('documento{fichero}')): ?>
        <?php echo form_error('documento{fichero}', array('class' => 'form-error-msg')) ?>
      <?php endif; ?>
      
      <?php 
        //Subir archivo mediante FLASH.
        use_helper("SWFUpload", "Javascript");
        echo swf_upload_javascript("documentos/subir_temporal",array(), array());
        echo swf_upload_standard_html(); 
        /*
        //Manera clásica de subir archivo.
        echo input_file_tag('fichero', array('size' => 30)); 
        */
      ?>
    </div>
  </div>    

  <div class="form-row">
    <?php echo label_for('documento[nombre]', __($labels['documento{nombre}']), '') ?>
    <div class="content<?php if ($sf_request->hasError('documento{nombre}')): ?> form-error<?php endif; ?>">
      <?php if ($sf_request->hasError('documento{nombre}')): ?>
        <?php echo form_error('documento{nombre}', array('class' => 'form-error-msg')) ?>
      <?php endif; ?>
      
      <?php $value = object_input_tag($documento, 'getNombre', array (
           'size' => 30,
           'control_name' => 'documento[nombre]',
        )); echo $value ? $value : '&nbsp;' ?>
    </div>
  </div>    

</fieldset>

<?php include_partial('edit_actions', array('documento' => $documento)) ?>

</form>




<fieldset id="sf_fieldset_none" class="">
  <legend><?php echo __('Historico de documentos: ') ?></legend>

  <?php if ($pager->getNbResults()): ?>
    <div align="center">
      <?php include_partial('list_documentos', array('pager' => $pager)) ?>
    </div>
  <?php else: ?>
    <div class="form-row">
    <blockquote class="warning"><p>
    <?php echo __('No hay documentos') ?>
    </p></blockquote>
    </div>
  <?php endif; ?>
</fieldset>

<?php 
  //Ana: 03-11-09. Añado que se puedan asignar trabajadores al documento.
  if (!$documento->isNew()) {
    include_partial('edit_form_trabajadores', array('documento' => $documento));
  }

?>


<ul class="sf_admin_actions">
  <li><?php if ($documento->getIdDocumento()): ?>
  <?php echo button_to(__('Borrar'), 'documentos/delete?id_documento='.$documento->getIdDocumento(), array (
  'post' => true,
  'confirm' => __('¿Estás seguro?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
</ul>
