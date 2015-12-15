<?php

function item_base_to_string($item , $campo = null)
{
  if (!$item)
  {
    return null;
  }
  if (!$item->getPrimaryKey())
  {
    return null;
  }
  if (!$campo)
  {
    $campo = $item->getCampo();
  }
  
  $value = null;
  if ($campo->esTipoLista())
  {
    if ($campo->esListaTipoRangos())
    {
      //lista de rangos
      $desde = null;
      $hasta = null;

      $unidad = CampoPeer::getHtmlTipoUnidad($campo->getUnidadRangos());
      $unidad = $unidad ? "&nbsp;".$unidad : '';
      
      if ($item->getNumeroInferior() && ($item->getNumeroInferior() != '') )
      {
        $desde = format_number($item->getNumeroInferior()).$unidad;
      }
      if ($item->getNumeroSuperior() && ($item->getNumeroSuperior() != '') )
      {
        $hasta = format_number($item->getNumeroSuperior()).$unidad;
      }
      
      if ($desde && $hasta)
      {
        $value = __('desde %1% hasta %2%' , array('%1%' => $desde , '%2%' => $hasta));
      }
      else if ($desde)
      {
        $value = __('más de %1%' , array('%1%' => $desde));
      }
      elseif ($hasta)
      {
        $value = __('menos de %2%' , array('%2%' => $hasta));
      }
      else
      {
        $value = null;
      }
    }
    else
    {
      $value = __($item->getTexto());
    }
  }
  return $value;
}

function item_to_string($item , $campo = null)
{
  if (!$item)
  {
    return null;
  }
  if (!$item->getPrimaryKey())
  {
    return null;
  }
  if (!$campo)
  {
    $campo = $item->getCampo();
  }
  
  $value = null;
  if (!$campo->esTipoLista())
  {
    if ($campo->esTipoTextoLargo())
    {
      $value = $item->getTextoLargo();
    }
    elseif ($campo->esTipoBooleano())
    {
      $value = image_ok($item->getSiNo());
    }
    elseif ($campo->esTipoSelectPeriodo())
    {
     $value = nombre_periodo($campo->getTipoPeriodo() , $item->getNumero() , $item->getAnio());
    }
    else
    {
      $value = $item->getTextoCorto();
    }
  }
  return $value;
}

function select_periodo_meses($nombre , $valor = '' , $duracion_periodo_meses = 1 , $include_blank = true)
{
  use_helper('DateForm');
  $opciones = array();
  if ($duracion_periodo_meses == 1)
  {
    $value = select_month_tag($nombre , $valor , array('control_name' => $nombre));
  }
  else
  {
    $lista_periodos = array(
      '2' => 'bimestre' , 
      '3' => 'trimestre' , 
      '4' => 'cuatrimestre' , 
      '6' => 'semestre'
    );
    $periodo = $lista_periodos[$duracion_periodo_meses];
    $lista_posiciones = array(
      '1' => __('primer') , 
      '2' => __('segundo'),
      '3' => __('tercer'),
      '4' => __('cuarto'),
      '5' => __('quinto'),
      '6' => __('sexto'),
    );
    $cuantos = floor(12 / $duracion_periodo_meses);
    $opciones = array();
    
    for($i=1; $i<=$cuantos; $i++)
    {
      $opciones[$i] = __('%1% %2%' ,array('%1%' => $lista_posiciones[$i] , '%2%' => $periodo));
    }
    
    $value = select_tag($nombre , 
      options_for_select($opciones , $valor , array('include_blank' => $include_blank)) , 
      array('control_name' => $nombre)
    );
  }
  return $value;
}

function nombre_periodo($duracion_periodo_meses = 1 , $numero_periodo = null, $anio = null)
{
  $resultado = null;
  if (isset($anio))
  {
    if (($duracion_periodo_meses == 1) )
    {
      if ($numero_periodo)
      {
        $mi_date = new Date();
        $mi_date->setMonth($numero_periodo);
        $mi_date->setYear($anio);
        $resultado = format_date($mi_date->getTimestamp() , 'MMMM yyyy');
      }
      else
      {
        $resultado = $anio;
      }
    }
    else
    {
      $lista_posiciones = array(
        '1' => __('primer') , 
        '2' => __('segundo'),
        '3' => __('tercer'),
        '4' => __('cuarto'),
        '5' => __('quinto'),
        '6' => __('sexto'),
      );
      $tipos_periodo = CampoPeer::getTiposPeriodo();
      $periodo = __('%posicion% %periodo%' , array(
        '%posicion%' => isset($lista_posiciones[$numero_periodo]) ? $lista_posiciones[$numero_periodo] : '' , 
        '%periodo%' => isset($tipos_periodo[$duracion_periodo_meses]) ? $tipos_periodo[$duracion_periodo_meses] : '' , 
      ));
      if (isset($numero_periodo) && ($numero_periodo != ''))
      {
        $resultado = __('%periodo% de %year%' , array('%periodo%' => $periodo , '%year%' => $anio ));
      }
      else
      {
        $resultado = $anio;
      }
    }
  }
  return $resultado;
}


function campo_booleano($name, $valor = '1' )
{
  $value = select_tag($name, options_for_select(array(1 => __('si'), 0 => __('no')), isset($valor) ? $valor : null, array (
  'include_custom' => __("si o no"),
  )), array () );
  return $value;
}

function campo_lista_radiobuttons($name , $valor = '' , $opciones = array() )
{
  $value = null;
  if (sizeof($opciones) > 0)
  {
    $value = "<ul class=\"sf_admin_checklist\">\n";
    foreach($opciones as $id=>$nombre_item)
    {
      $id_name = get_id_from_name($name, $id);
      $value .= "<li>";
      $value .= radiobutton_tag($name.'[item_base]' , $id ,($valor == $id ? true : false) , array('id' => $id_name));
      $value .= label_for($id_name , ($nombre_item ? __($nombre_item) : '-') );
      $value .= "</li>\n";
    }
    $value .= "</ul>\n";
  }
  return $value;
}

function campo_select($name , $valor = '' , $opciones = array())
{
  $value = null;
  if (sizeof($opciones))
  {
    $value = select_tag($name.'[item_base]' , options_for_select($opciones, $valor ? $valor : null, array (
    'include_blank' => true,
    )), array ());
  }
  return $value;
}

function campo_lista_checkboxes($name , $valores = array() , $opciones = array())
{
  $value = null;
  if (sizeof($opciones))
  {
    $value = "<ul class=\"sf_admin_checklist\">\n";
    foreach($opciones as $id=>$nombre_item)
    {
      $nombre = $name.'[item_base_'.$id.']';
      $id_nombre = get_id_from_name($nombre, $id);
      $value .= "<li>";
      $value .= checkbox_tag($nombre, $id, (isset($valores[$id]) ? true : false), array('id' => $id_nombre));
      $value .= label_for($id_nombre , ($nombre_item ? __($nombre_item) : '-') );
      $value .= "</li>\n";
    }
    $value .= "</ul>\n";
  }
  return $value;
}

function campo_rangos($nombre = '' , $valores = array() , $unidad_html = '' )
{
  $label_campo = $nombre;
  $label = $label_campo;
  $label_from = $label."[from]";
  $input_from = input_tag($label_from , isset($valores['from']) ? $valores['from'] : null , array('control_name' => $label_from , 'size' => 4));
  $label_to = $label."[to]";
  $input_to = input_tag($label_to , isset($valores['to']) ? $valores['to'] : null , array('control_name' => $label_to , 'size' => 4));
  
  $value = "<ul class=\"sf_admin_checklist\">\n";
  $value .= "<li>";
  $value .= label_for($label_from , __('desde').":" , array('class' => 'fijo'));
  $value .= $input_from.(($unidad_html) ? "&nbsp;".$unidad_html : '');
  $value .= "</li>";
  $value .= "<li>";
  $value .= label_for($label_to , __('hasta').":" , array('class' => 'fijo'));
  $value .= $input_to.(($unidad_html) ? "&nbsp;".$unidad_html : '');
  $value .= "</li>";
  $value .= "</ul>\n";
  
  return $value;
}

function campo_periodos($nombre , $duracion_periodo_meses = 1 , $periodo_from='' , $year_from='' , $periodo_to='' , $year_to='' )
{
  $label_campo = $nombre;
  $label = $label_campo;
  $label_from = $label."[from]";
  $label_to = $label."[to]";
  
  $value = "<ul class=\"sf_admin_checklist\">\n";
  $value .= "<li>";
 
  $value .= select_periodo_meses($label_from.'[periodo]' , $periodo_from , $duracion_periodo_meses);
  $value .= select_year_tag($label_from.'[year]' , $year_from , array('include_blank' => true));
  $value .= "</li>\n";
  $value .= "<li>";

  $value .= select_periodo_meses($label_to.'[periodo]' , $periodo_to , $duracion_periodo_meses);
  $value .= select_year_tag($label_to.'[year]' , $year_to , array('include_blank' => true));
  $value .= "</li>\n";
  $value .= "</ul>\n";
  
  return $value;
}


?>
