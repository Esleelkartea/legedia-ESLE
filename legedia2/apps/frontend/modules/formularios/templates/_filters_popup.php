<?php use_helper('FormularioModelo')?>
<div class="sf_admin_filters">
<?php 
 //  print_r($filters);

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
<?php echo form_tag('formularios/popup', array('name'=>'filter_form','method' => 'get')) ?>


<?php
  $usuario_actual = Usuario::getUsuarioActual();
  if (isset($filters['id_empresa']) && $filters['id_empresa'] != '') {
    $empresa= EmpresaPeer::retrievebypk($filters['id_empresa']);
  }
  else {
    $empresa = $usuario_actual->getEmpresaSesion();
  }
?>

<fieldset id="filtros_formularios"  class="<?php echo $clase; ?>">
<h2><?php echo __('filtros de datos') ?></h2>
<!-- Ana: 16-04-09
<div class="form-row">
  <?php echo label_for("filters[id_tabla]" , __('Tabla').":" )?>
  <div class="content">
  <?php 
    $tablas = TablaPeer::doSelect(TablaPeer::getCriterioAlcance());
    $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
    $value = select_tag('filters[id_tabla]' , 
      objects_for_select($tablas , 'getPrimaryKey' , '__toString' , $id_tabla , array('include_blank' => true)) , 
      array('control_name' => 'filters[id_tabla]') 
    );
    echo $value ? $value : '-';
  //Ana: 16-04-09  echo input_hidden_tag('filters[id_empresa]' , $empresa->getPrimaryKey());
   ?>
  </div>
</div>
-->
<?php
  $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
  $tabla = null;
  if (isset($id_tabla) && ($id_tabla!=''))
  {
    $tabla = TablaPeer::retrievebypk($id_tabla);
   /*Ana: eins?? 16-04-09 foreach($tablas as $promo)
    {
      if ($promo->getPrimaryKey()==$id_tabla)
      {
        $tabla = $promo;
        
        break;
      }
    }*/
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
      $value = input_tag($id_label_campo,  isset($filtros['item_base']) ? $filtros['item_base'] : null, array("size"=>10));
    }
    if ($campo->esTipoTextoLargo()) {
      $value = input_tag($id_label_campo,  isset($filtros['item_base']) ? $filtros['item_base'] : null, array("size"=>10));
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
      $formularios = $mitabla->getFormularios();

      $value = select_tag($id_label_campo , objects_for_select($formularios , 'getPrimaryKey' , '__toString' , $filtro, array('include_blank' => true)) , 
        array('control_name' => $id_label_campo,));
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
  <?php echo label_for($id_label_campo , __($campo->getNombre()).":" )?>
  <div class="content">
  <?php echo $value ; ?>
  </div>
</div>
<?php endif;?>

<?php endif;?>
<?php endforeach ; ?>

</fieldset>

  <?php $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null; 
     $id_empresa = isset($filters['id_empresa']) ? $filters['id_empresa'] : null; ?>
  <input type="hidden" name="filters[id_empresa]" id="filters_id_empresa" control_name="filters[id_empresa]" value="<?php echo $id_empresa; ?>">
  <input type="hidden" name="filters[id_tabla]" id="filters_id_tabla" control_name="filters[id_tabla]" value="<?php echo $id_tabla; ?>">
  <input type="hidden" name="control_name" id="control_name" control_name="control_name" value="<?php echo $control_name; ?>">
  <input type="hidden" name="valor_sel" id="valor_sel" control_name="valor_sel" value="<?php echo $valor_sel; ?>">

  <ul class="sf_admin_actions">
    <?php 
    /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
    $ruta = UsuarioPeer::getRuta();
    ?>
    <li><input class="sf_admin_action_reset_filter" value="<?php echo __('reset'); ?>" type="button" onclick="document.location.href='<?php echo $ruta; ?>/formularios/popup?control_name=<?php echo $valor_sel; ?>&valor_sel=<?php echo $valor_sel; ?>&filters[id_empresa]=<?php echo $id_empresa; ?>&filters[id_tabla]=<?php echo $id_tabla; ?>&filter=filter&reset_filter=1';" /></li>
    <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter') ?>
    </li>
  </ul>

</form>

</div>
