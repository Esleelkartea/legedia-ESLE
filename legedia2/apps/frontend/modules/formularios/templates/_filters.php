<?php use_helper('FormularioModelo')?>
<?php echo form_tag('formularios/list', array('method' => 'get')) ?>
<script language="JavaScript">
    jQuery(document).ready(function() {
        jQuery(".form-row").each(function() {
            jQuery(this).css({'border-bottom': '0px'});
            jQuery(this).css({'padding': '5px'});
        });
    });
</script>
<div class="sf_admin_filters">
<?php 
  if (isset($filters) and ( 
                         (isset($filters['nombre']) and ($filters['nombre'] != '') )
                      or (isset($filters['apellido1']) and ($filters['apellido1'] != ''))
                      or (isset($filters['apellido2']) and ($filters['apellido2'] != ''))
                      or (isset($filters['poblacion']) and ($filters['poblacion'] != ''))
                      or (isset($filters['codigo_postal']) and ($filters['codigo_postal'] != ''))
                      or (isset($filters['id_provincia']) and ($filters['id_provincia'] != ''))
                      or (isset($filters['tiene_datos']) and ($filters['tiene_datos'] != ''))
                      or (isset($filters['id_empresa']) and ($filters['id_empresa'] != ''))
                      or (isset($filters['id_tabla']) and ($filters['id_tabla'] != ''))
                      or (isset($filters['ultimo_contacto']) and ($filters['id_ultimo_contacto'] != ''))
                      or (isset($filters['id_grupo']) and ($filters['id_grupo'] != ''))
                      )
     ) {
      $titulo = __("Filtros activados");
      $clase = "accesos_amarillo";
  }
  else {
      $titulo = __("Filtros");
      $clase = "";
  }

?>
<?php
  $usuario_actual = Usuario::getUsuarioActual();
  $id_empresa = null;
  if (isset($filters['id_empresa']) && $filters['id_empresa'] != '') {
    $empresa= EmpresaPeer::retrievebypk($filters['id_empresa']);
  }
  else {
    $empresa = $usuario_actual->getEmpresaSesion();
  }
  
  $id_empresa = $empresa->getIdEmpresa(); 
  $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
?>

<ul class="sf_admin_actions" style="padding-top: 0px;">
  <?php 
  /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
  $ruta = UsuarioPeer::getRuta();
  ?>
  <li><input class="sf_admin_action_reset_filter" value="<?php echo __('reset');?>" type="button" onclick="document.location.href='<?php echo $ruta;?>/formularios/list?filters[id_empresa]=<?php echo $id_empresa;?>&filters[id_tabla]=<?php echo $id_tabla;?>&filter=filter&reset_filter=1';" /></li>
  <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter')
  ?></li>
</ul>
  
<fieldset id="filtros_formularios" class="<?php echo $clase; ?>">
<h2><?php echo __('Filtros de datos') ?></h2>

<?php
  $tabla = null;
  if (isset($id_tabla) && ($id_tabla!=''))
  {
    $tabla = TablaPeer::retrievebypk($id_tabla);
  }
  
  $campos = array();
  if (isset($tabla))
  {
    $campos = $tabla->getCamposFormularioEmpresaTabla();
  }
  else
  {
    $campos = $empresa->getCamposFormularioOrdenadosGenerales();
  }
  
?>
<?php foreach($campos as $campo) : ?>
<?php if (!$campo->getBorrado()) : ?>
<?php 
  //echo $campo->__toString()."<br />";
  $name_campo = "campo_".$campo->getIdCampo();
  $etiqueta_campo = "filters[".$name_campo."]";
  $filtros = isset($filters[$name_campo]) ? $filters[$name_campo] : array();
  $value = null;
  if ($campo->esTipoLista())
  {
    $items_base = $campo->getItemsBaseOrdenados();
    $opciones = array();
    $id_label_campo = $etiqueta_campo;
    
    if ($campo->esListaTipoRangos())
    {
      $rangos_filtro = array(
        'from'  => (isset($filtros['from']) ? $filtros['from'] : null) , 
        'to'    => (isset($filtros['to']) ? $filtros['to'] : null)
      );
      $value = campo_rangos($id_label_campo , $rangos_filtro , $campo->getHtmlTipoUnidad());
    }
    else //($campo->getSeleccionMultiple())
    {
      $seleccionados = array();
      foreach($items_base as $item)
      {
        $id_label_item = 'item_base_'.$item->getIdItemBase();
        $opciones[$item->getIdItemBase()] = $item->getTexto();
        if (isset($filtros[$id_label_item]))
        {
          $seleccionados[$item->getIdItemBase()] = true;
        }
      }
      $value = campo_lista_checkboxes($etiqueta_campo , $seleccionados , $opciones );
    }
  }
  else
  {
    $id_label_campo = $etiqueta_campo."[item_base]";
    if ($campo->esTipoTextoCorto()) 
    {
      $value = input_tag($id_label_campo,  isset($filtros['item_base']) ? $filtros['item_base'] : null, array("size"=>15));
    }
    if ($campo->esTipoTextoLargo()) {
      $value = input_tag($id_label_campo,  isset($filtros['item_base']) ? $filtros['item_base'] : null, array("size"=>15));
    }
    if ($campo->esTipoNumero()) {
      $value = "Mayor que ".input_tag($id_label_campo."[great]",  isset($filtros['item_base']['great']) ? $filtros['item_base']['great'] : null, array("size"=>5));
      $value .= "y menor que ".input_tag($id_label_campo."[less]",  isset($filtros['item_base']['less']) ? $filtros['item_base']['less'] : null, array("size"=>5));
    }
    if ($campo->esTipoFecha()) {
      $value = input_date_range_tag($id_label_campo,isset($filtros['item_base']) ? $filtros['item_base'] : null, array ('rich' => true, 'calendar_button_img' => '/images/icons/date.png',));      
    }
    if ($campo->esTipoBooleano())
    {
      $value = campo_booleano($id_label_campo , isset($filtros['item_base']) ? $filtros['item_base'] : null);
    }
    if ($campo->esTipoSelectPeriodo())
    {
      //SOBREECRIBIMOS EL LABEL CAMPO
      $id_label_campo = $etiqueta_campo;
      $periodo_desde = isset($filtros['from']['periodo']) ? $filtros['from']['periodo'] : '';
      $year_desde = isset($filtros['from']['year']) ? $filtros['from']['year'] : '';
      $periodo_hasta = isset($filtros['to']['periodo']) ? $filtros['to']['periodo'] : '';
      $year_hasta = isset($filtros['to']['year']) ? $filtros['to']['year'] : '';
      $value = campo_periodos($id_label_campo , $campo->getTipoPeriodo() , $periodo_desde , $year_desde , $periodo_hasta , $year_hasta);
    }
    if ($campo->esTipoTabla()) 
    {
      if (isset($filtros['item_base'])) $filtro = $filtros['item_base'];
      else $filtro = 0;
      //Obtener el campo de la tabla que es el nombre

      $mitabla = TablaPeer::retrieveByPk($campo->getValorTabla());
      if ($mitabla != null){
        //$formularios = $mitabla->getFormularios();
  
        //$value = select_tag($id_label_campo , objects_for_select($formularios , 'getPrimaryKey' , '__toString' , $filtro, array('include_blank' => true)) , 
        //  array('control_name' => $id_label_campo,));
        if ($filtro != 0)
          $formulario_t = FormularioPeer::retrieveByPk($filtro);
        else
          $formulario_t = new Formulario(); 

        $value .= popUp($id_label_campo,$formulario_t,$mitabla->getIdEmpresa(),$campo->getValorTabla());
                
      }
    }
    if ($campo->esTipoObjeto()) 
    {
      if (isset($filtros['item_base'])) $filtro = $filtros['item_base'];
      else $filtro = 0;
      eval("if (in_array('getCriterioAlcance',get_class_methods('".$campo->getValorObjeto()."Peer'))) {\$c = ".$campo->getValorObjeto()."Peer::getCriterioAlcance();} else {\$c = new Criteria();}");
      eval("\$valores = ".$campo->getValorObjeto()."Peer::doSelect(\$c);");
      $value = select_tag($id_label_campo , objects_for_select($valores , 'getPrimaryKey' , '__toString' , $filtro, array('include_blank' => true)) , 
        array('control_name' => $id_label_campo,));
    }
  }
?>
<?php if ($value) : ?>
<div class="form-row">
  <?php echo label_for($id_label_campo , __($campo->getNombre()).":")?>
  <div class="content">
  <?php echo $value ; ?>
  </div>
</div>
<?php endif;?>

<?php endif;?>
<?php endforeach ; ?>

<?php if ($id_tabla == 63) :?>
    <div class="form-row">
      <?php echo label_for("Sin fecha realizacion" , __('Fecha realizacion').":")?>
      <div class="content">
      <input type="radio" name="filters[no_realizacion]" id="filters_no_realizacion" value="1" <?php if ($filters['no_realizacion'] == 1) echo "CHECKED"; ?>><?php echo __('Sin');?>
      <input type="radio" name="filters[no_realizacion]" id="filters_no_realizacion" value="2" <?php if ($filters['no_realizacion'] == 2) echo "CHECKED"; ?>><?php echo __('Con');?>
      </div>
    </div>
<?php endif; ?>

</fieldset>

<fieldset>
  <h2><?php echo $titulo ?></h2>
    
  <input type="hidden" name="filters[id_empresa]" id="filters_id_empresa" control_name="filters[id_empresa]" value="<?php echo $id_empresa;?>">
  <input type="hidden" name="filters[id_tabla]" id="filters_id_tabla" control_name="filters[id_tabla]" value="<?php echo $id_tabla;?>">
    
  <div class="form-row">
    <?php echo label_for("filters[ultimo_contacto][from]" , __('última actualización').":" );?>
    <div class="content">
    <?php echo input_date_range_tag('filters[ultimo_contacto]', isset($filters['ultimo_contacto']) ? $filters['ultimo_contacto'] : null, array (
      'rich' => true,
      'calendar_button_img' => '/images/icons/date.png',
    )) ?>
    </div>
  </div>

  </fieldset>
  
  <ul class="sf_admin_actions">
    <?php 
    /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
    $ruta = UsuarioPeer::getRuta();
    ?>
<?php if (isset($_GET['i']))  echo input_hidden_tag('i', $_GET['i']); ?>
    <li><input class="sf_admin_action_reset_filter" value="<?php echo __('reset'); ?>" type="button" onclick="document.location.href='<?php echo $ruta; ?>/formularios/list?filters[id_empresa]=<?php echo $id_empresa; ?>&filters[id_tabla]=<?php echo $id_tabla; ?>&filter=filter&reset_filter=1';" /></li>
    <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter') 
    ?></li>
  </ul>

</div>

</form>
