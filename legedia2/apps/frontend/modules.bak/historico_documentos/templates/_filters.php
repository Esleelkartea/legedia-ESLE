<?php use_helper('Object') ?>

<div class="sf_admin_filters">
  <?php echo form_tag('historico_documentos/list', array('method' => 'get')) ?>
  <fieldset>
    <h2><?php echo __('Filtros') ?></h2>
    <div class="form-row">
      <label for="filters_id_documento"><?php echo __('Documento:') ?></label>
      <div class="content"><?php 
            /*Ana: 04-11-09. El listado de documentos debe estar filtrado por el trabajador actual*/
            $lista_documentos = DocumentoPeer::getAllDocumentosByTrabajadorActual();     
            
            $value = select_tag('filters[id_documento]', 
              objects_for_select($lista_documentos, 
                'getPrimaryKey', 
                '__toString',
                isset($filters['id_documento']) ? $filters['id_documento'] : null,
                array('include_blank' => true)
              )
            );
            echo $value ? $value : '&nbsp';
        ?>  
      </div>
    </div>

    <div class="form-row">
      <label for="fecha"><?php echo __('Fecha Subida:') ?></label>
      <div class="content">
        <?php echo input_date_range_tag('filters[fecha]', isset($filters['fecha']) ? $filters['fecha']: null, array (
            'rich' => true,
            'calendar_button_img' => '/sf/sf_admin/images/date.png',
        )) ?>
      </div>
    </div> 

  </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('Reiniciar'), 'historico_documentos/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('Filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
