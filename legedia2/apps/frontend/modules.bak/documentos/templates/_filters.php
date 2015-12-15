<?php
  //Rober 27-nov-2009: Nueva forma de visualizar los filtros.
  
  //NOMBRE
  $field_nombre = label_for('filters[nombre]', __('Documento').":");
  $field_nombre .= input_tag(
    'filters[nombre]', 
    isset($filters['nombre']) ? $filters['nombre'] : null, 
    array('size' => 20, 'class' => 'full')
  );
  
  //Rober 15-dic-2009: cada vez que cambia un select, se ejecuta el filtro.
  $codigo_js = javascript_tag("
    function enviarFormulario(desde)
    {
      if (desde == 'proyecto')
      {
        /*limpiar id_fase para que no lleguen id_fases de otros proyectos*/
        document.getElementById('filters_id_fase').value = '';
      }
      document.getElementById('boton_filtrar').click();
    }
  ");
  
  //CATEGORIA
  $field_categoria = label_for('filters[id_categoria]', __('Categoría').":");
  $field_categoria .= object_select_tag(
    isset($filters['id_categoria']) ? $filters['id_categoria'] : null, 
    'getNombre', 
    array (
      'related_class' => 'Parametro',
      'control_name'  => 'filters[id_categoria]',
      'peer_method'   => 'getCategoriasDocumentos',
      'text_method'   => 'getNombre',   
      'include_blank' => true,
      'class'         => 'full',
      'onChange'      => "enviarFormulario()",
    )
  );
  
  //PROYECTO
  $field_proyecto = label_for('filters[id_proyecto]', __('Proyecto').":");
  $field_proyecto .= object_select_tag(
    isset($filters['id_proyecto']) ? $filters['id_proyecto'] : null, 
    'getNombre', 
    array (
      'related_class' => 'Proyecto',
      'control_name'  => 'filters[id_proyecto]',
      'peer_method'   => 'getProyectosEmpresa',
      'text_method'   => 'getNombre',             
      'include_blank' => true,
      'class'         => 'full',
      'onChange'      => "enviarFormulario('proyecto'); ",
    )
  );
  
  
  /*
  //Rober 15-dic-2009: js desechado.
  function recargarFasesDeProyecto(id_proyecto)
    {
      ".
      remote_function(array(
        'update'    => 'filters_id_fase',
        'loading'   => "document.getElementById('filters_id_fase').disabled=1",
        'complete'  => "document.getElementById('filters_id_fase').disabled=0",
        'url'       => 'documentos/ajaxfasesdeproyecto',
        'with'      => "'id_proyecto='+ id_proyecto + '&include_custom="."- ".__('Sin definir')." -"."'",
      ))
      ."
    }
  */
  
  //FASE
  $id_proyecto  = isset($filters['id_proyecto']) ? $filters['id_proyecto'] : null;
  $id_fase      = isset($filters['id_fase']) ? $filters['id_fase'] : null;
  $objects_for_select = objects_for_select($fases, 'getPrimaryKey', '__toString', $id_fase, array(
    'include_custom' => "&nbsp;"
  ));
  $field_fase = label_for('filters[id_fase]', __('Fase').":");
  $field_fase .= select_tag(
    'filters[id_fase]', 
    $objects_for_select, 
    array (
      'control_name'  => 'filters[id_fase]',
      'class'         => 'full',
      'onChange'      => "enviarFormulario()",
    )
  ); 
  
  //TIPO
  $id_tipo = isset($filters['tipo']) ? $filters['tipo'] : null;
  $tipos = array('1' => __('Entregable'), '0' => __('Reunión'));
  $field_tipo = label_for('filters[tipo]', __('Tipo').":");
  $field_tipo .= select_tag(
    'filters[tipo]',
    options_for_select($tipos, $id_tipo, array('include_blank' => true)), 
    array (
      'control_name'  => 'filters[id_categoria]',
      'class'         => 'full',
      'onChange'      => "enviarFormulario()",
    )
  );
  
  $first_column   = array($field_nombre, $field_categoria);
  $middle_column  = array($field_proyecto, $field_fase);
  $last_column    = array($field_tipo);
?>



<?php 
  echo $codigo_js;
  echo form_tag('documentos/list', array('method' => 'get', 'id' => 'documentos_list_form'));
?>


<fieldset >
<legend><?php echo __('Búsqueda'); ?></legend>
<?php if ($es_administrador) :?>
<p class="caja_asterisk"><?php echo __('Sin filtrar por permisos, usted es <b>administrador</b>')?></p>
<?php endif; ?>

<div class="grid3col">
  <!-- FIRST -->
  <div class="column first"><?php
    echo implode("<br />\n", $first_column);
  ?></div>
  
  <!-- MIDDLE -->
  <div class="column"><?php
    echo implode("<br />\n", $middle_column);
  ?></div>
  
  <!-- LAST -->
  <div class="column last"><?php
    echo implode("", $last_column);
  ?></div>
</div>
</fieldset>

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Reiniciar'), 'documentos/list?filter=filter', 'class=sf_admin_action_reset_filter'); ?></li>
  <li><?php echo submit_tag(__('Filtrar'), array(
    'name'  => 'filter', 
    'class' => 'sf_admin_action_filter',
    'id'    => 'boton_filtrar',
  )); ?></li>
</ul>

</form>
