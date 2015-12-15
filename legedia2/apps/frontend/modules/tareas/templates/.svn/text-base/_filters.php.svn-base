<div class="sf_admin_filters">
<?php echo form_tag('tareas/list', array('method' => 'get', 'name'=>'form_filtros')) ?>

<fieldset >
  <h2><?php echo __('filtros') ?></h2>
  
  <div class="form-row">
  <?php echo label_for("filters[es_evento]" , __('tipo').":" )?>
    <div class="content">
    <?php 
      $opciones = array('0' => __('tareas') , '1' => __('eventos'));
      $tipo_tarea = isset($filters['es_evento']) ? $filters['es_evento'] : null;
      $value = select_tag('filters[es_evento]' , options_for_select($opciones , $tipo_tarea , array('include_custom' => __('tareas y eventos'))));
      echo $value ? $value : "&nbsp";
    ?>
    </div>
  </div>

  
  <div class="form-row">
    <?php echo label_for("filters[estado_tarea]" , __('estado tarea').":" )?>
    <div class="content">
    <?php 
      $opciones = TareaPeer::getAllEstadosTareas();
      $html = "";
      $html .= "<ul class=\"sf_admin_checklist\">\n";
      foreach ($opciones as $estado)
      {
        $i = $estado->getPrimaryKey();
        $es_seleccionado = isset($filters['estado_'.$i]) ? true : false;
        $html .= "<li>";
        $html .= checkbox_tag('filters[estado_'.$i.']' , true , $es_seleccionado );
        $html .= label_for("filters[estado_".$i."]" , $estado->__toString() ? __($estado->__toString()) : '-' );
        $html .= "</li>\n";
      }
      $html .= "</ul>\n";
      echo $html;
    ?>
    </div>
  </div>
    
    <div class="form-row">
    <?php echo label_for("filters[estado_evento]" , __('estado evento').":" )?>
    <div class="content">
    <?php 
      $opciones = TareaPeer::getAllEstadosEventos();

      $html = "";
      $html .= "<ul class=\"sf_admin_checklist\">\n";
      foreach ($opciones as $estado)
      {
        $i = $estado->getPrimaryKey();
        $es_seleccionado = isset($filters['estado_'.$i]) ? true : false;
        $html .= "<li>";
        $html .= checkbox_tag('filters[estado_'.$i.']' , true , $es_seleccionado );
        $html .= label_for("filters[estado_".$i."]" , $estado->__toString() ? __($estado->__toString()) : '-' );
        $html .= "</li>\n";
      }
      $html .= "</ul>\n";
      echo $html;
    ?>
    </div>
  </div>
    
    <div class="form-row">
    <?php echo label_for("filters[fecha_inicio]" , __('inicio').":" );?>
    <div class="content">
    <?php echo input_date_range_tag('filters[fecha_inicio]', isset($filters['fecha_inicio']) ? $filters['fecha_inicio'] : null, array (
  'rich' => true,
  'withtime' => false,
  'calendar_button_img' => '/images/icons/date.png',
)) ?>
    </div>
    </div>
    
    <div class="form-row">
    <?php echo label_for("filters[fecha_vencimiento]" , __('vencimiento').":" );?>
    <div class="content">
    <?php echo input_date_range_tag('filters[fecha_vencimiento]', isset($filters['fecha_vencimiento']) ? $filters['fecha_vencimiento'] : null, array (
  'rich' => true,
  'withtime' => false,
  'calendar_button_img' => '/images/icons/date.png',
)) ?>
    </div>
    </div>
    
  </fieldset>
	<!--Ana: Para el filtro por calendario -->
    <input type="hidden" name="filtro_calendario" id="filtro_calendario" value="0">
    <input type="hidden" name="mes" id="mes" value="<?php echo date('m') ?>">
    <input type="hidden" name="year" id="year" value="<?php echo date('Y') ?>">
  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('reiniciar'), 'tareas/list', 'class=sf_admin_action_reset_filter');//?filter=filter
    ?></li>
    <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>

