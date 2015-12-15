<?php use_helper('Object','ObjectAdmin') ?>

<div class="sf_admin_filters">
  <?php echo form_tag('documentos/list', array('method' => 'get')) ?>
  <fieldset>
    <h2><?php echo __('Filtros') ?></h2>
    <?php
      if ($es_administrador) :
    ?>
      <blockquote class="warning"><p>
        <?php echo __('Usuario administrador, sin filtrado por permisos') ?>
      </p></blockquote>
    <?php endif;?>
    <div class="form-row">
      <label for="filters_id_proyecto"><?php echo __('Proyecto:') ?></label>
      <div class="content">
        <?php $value = object_select_tag(isset($filters['id_proyecto']) ? $filters['id_proyecto'] : null, 'getNombre', array (
          'related_class'  => 'Proyecto',
          'control_name'   => 'filters[id_proyecto]',
          'peer_method'    => 'getProyectosEmpresa',
          'text_method'    => 'getNombre',             
          'include_blank'  => true,
          )); 
          echo $value ? $value : '&nbsp;'
        ?>  
        <?php echo observe_field('filters_id_proyecto', array(
  	    'frequency' => 1,
  	    'script' => 'true',
        'update' => 'fases',
        'url'    => 'documentos/elegirproyectofilters',
        'with'   => "'id_proyecto='+ $('filters_id_proyecto').value"
    )) ?>
      </div>
    </div>

    <div class="form-row">
      <label for="filters_id_fase"><?php echo __('Fase:') ?></label>
      <div id="fases" class="content">
        <?php  echo select_tag('filters[id_fase]',options_for_select(array('' => '')).
          objects_for_select($fases,'getIdfase', 'getNombre', isset($filters['id_fase']) ? $filters['id_fase'] : null), array()); ?>
          
        <?php echo observe_field('filters_id_fase', array(
    	    'frequency' => 1,
    	    'script' => 'true',
          'update' => 'reuniones',
          'url'    => 'documentos/elegirfasefilters',
          'with'   => "'id_proyecto='+$('filters_id_proyecto').value+'id_fase='+$('filters_id_fase').value"
      )) ?>  
      </div>
    </div>
      
    <div class="form-row">
      <label for="filters_id_reunion"><?php echo __('Reunion:') ?></label>
      <div id="reuniones" class="content"><?php  
        echo select_tag('filters[id_reunion]',options_for_select(array('' => '')).
          objects_for_select($reuniones,'getIdReunion', 'getNombre', 
          isset($filters['id_reunion']) ? $filters['id_reunion'] : null)
        );
      ?></div>
    </div>
    
    
    <div class="form-row">
      <label for="filters_id_categoria"><?php echo __('Categoría').":" ?></label>
      <div class="content"><?php 
        $value = object_select_tag(isset($filters['id_categoria']) ? $filters['id_categoria'] : null, 'getNombre', array (
          'related_class' => 'Parametro',
          'control_name'  => 'filters[id_categoria]',
          'peer_method'   => 'getCategoriasDocumentos',
          'text_method'   => 'getNombre', 
          'include_blank' => true,
        ));
        echo $value ? $value : '&nbsp;';
      ?>
      </div>
    </div>
    
  </fieldset>


  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('Reiniciar'), 'documentos/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('Filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
