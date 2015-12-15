<?php

use_helper('Javascript', 'Number');


function pager_navigation($pager, $uri)
{
  $navigation = '';
 
  if ($pager->haveToPaginate())
  {  
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';
    
    //$navigation .= "<div class=\"navigation\">";

    // First and previous page
    $navigation .= link_to(image_tag('/images/icons/first.png', array('align' => 'absmiddle', 'alt' => __('primero'), 'title' => __('primero')) ), $uri.'1');
    $navigation .= link_to(image_tag('/images/icons/previous.png', array('align' => 'absmiddle', 'alt' => __('previo'), 'title' => __('previo'))), $uri.$pager->getPreviousPage()).'&nbsp;';

    // Pages one by one
    $links = array();
    foreach ($pager->getLinks() as $page)
    {
      $links[] = link_to_unless($page == $pager->getPage(), $page, $uri.$page);
    }
    $navigation .= join('&nbsp;&nbsp;', $links);

    // Next and last page
    $navigation .= '&nbsp;'.link_to(image_tag('/images/icons/next.png', array('align' => 'absmiddle', 'alt' => __('siguiente'), 'title' => __('siguiente')) ), $uri.$pager->getNextPage());
    $navigation .= link_to(image_tag('/images/icons/last.png', array('align' => 'absmiddle', 'alt' => __('último'), 'title' => __('último')) ), $uri.$pager->getLastPage());
    
    //$navigation .= "</div>";
  }

  return $navigation;
}


function pager_navigation_remote($pager, $uri , $options = array())
{
  $navigation = '';
  
  $options = _parse_attributes($options);
  
  if (!isset($options['update']))
  {
    return null;
  }
  $update = $options['update'];
  $loading = isset($options['loading']) ? $options['loading'] : '';
  $complete = isset($options['complete']) ? $options['complete'] : '';
  
  if ($pager->haveToPaginate())
  {
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';
    
    $navigation .= link_to_remote(
      image_tag('/images/icons/first.png', array('align' => 'absmiddle', 'alt' => __('primero'), 'title' => __('primero'))), 
      array('update'    => $update , 
            'url'       =>  $uri.'1' , 
            'loading'   => $loading,
            'complete'  => $complete
    ));
    $navigation .= link_to_remote(
      image_tag('/images/icons/previous.png', array('align' => 'absmiddle', 'alt' => __('previo'), 'title' => __('previo'))), 
      array('update'    => $update , 
            'url'       => $uri.$pager->getPreviousPage() , 
            'loading'   => $loading,
            'complete'  => $complete
    ));
    
    // Pages one by one
    $links = array();
    foreach ($pager->getLinks() as $page)
    {
      if ($page == $pager->getPage())
      {
        $links[] = $page;
      }
      else
      {
        $links[] = link_to_remote($page, array(
          'update'    => $update , 
          'url'       => $uri.$page,
          'loading'   => $loading,
          'complete'  => $complete
          ));
      }
    }
    $navigation .= join('&nbsp;&nbsp;', $links);

    $navigation .= link_to_remote(image_tag('/images/icons/next.png', array('align' => 'absmiddle', 'alt' => __('siguiente'), 'title' => __('siguiente'))), 
      array('update'    => $update , 
            'url'       => $uri.$pager->getNextPage() , 
            'loading'   => $loading,
            'complete'  => $complete
            ));
    $navigation .= link_to_remote(image_tag('/images/icons/last.png', array('align' => 'absmiddle', 'alt' => __('último'), 'title' => __('último'))), 
      array('update'    => $update , 
            'url'       => $uri.$pager->getLastPage() , 
            'loading'   => $loading,
            'complete'  => $complete
    ));
  }
  
  return $navigation;
}

function rank_navigation($uri, $rank=1 , $max=1)
{
  $navigation = '';
 
  if ($rank>1 or $rank<$max)
  {  
    $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'op=';
    if ($rank<$max)
    {
      $navigation .= link_to(
        image_tag('/images/icons/bullet_arrow_down.png', array('align' => 'absmiddle', 'alt' => __('bajar'), 'title' => __('bajar')) ), 
        $uri.'down'
      );
    }
    if ($rank>1)
    {
      $navigation .= link_to(
        image_tag('/images/icons/bullet_arrow_up.png', array('align' => 'absmiddle', 'alt' => __('subir'), 'title' => __('subir')) ), 
        $uri.'up'
      );
    }
  }
  return $navigation;
}



function object_double_list_ver2($object, $method, $options = array(), $callback = null , $criteria=null)
{
  $options = _parse_attributes($options);

  $options['multiple'] = true;
  $options['class'] = 'sf_multiple';
  if (!isset($options['size']))
  {
    $options['size'] = 10;
  }
  
  if (is_null($criteria)) $criteria = new Criteria();
  $label_all   = __(isset($options['unassociated_label']) ? $options['unassociated_label'] : 'Unassociated');
  $label_assoc = __(isset($options['associated_label'])   ? $options['associated_label']   : 'Associated');

  // get the lists of objects
  list($all_objects, $objects_associated, $associated_ids) = _get_object_list_nuevo($object, $method, $options, $callback , $criteria);
  
  $objects_unassociated = array();
  foreach ($all_objects as $object)
  {
    if (!in_array($object->getPrimaryKey(), $associated_ids))
    {
      $objects_unassociated[] = $object;
    }
  }

  // override field name
  unset($options['control_name']);
  $name  = _convert_method_to_name($method, $options);
  $name1 = 'unassociated_'.$name;
  $name2 = 'associated_'.$name;
  $select1 = select_tag($name1, options_for_select(_get_options_from_objects($objects_unassociated), '', $options), $options);
 //Ana: 31-03-09 $options['class'] = 'sf_multiple-selected';
  $options['class'] = 'sf_admin_multiple-selected';
  $select2 = select_tag($name2, options_for_select(_get_options_from_objects($objects_associated), '', $options), $options);

  $html =
  '<div>
  <div style="float: left">
    <div style="font-weight: bold; padding-bottom: 0.5em">%s</div>
    %s
  </div>
  <div style="float: left">
    %s<br />
    %s
  </div>
  <div style="float: left">
    <div style="font-weight: bold; padding-bottom: 0.5em">%s</div>
    %s
  </div>
  <br style="clear: both" />
</div>
';

  $response = sfContext::getInstance()->getResponse();
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype');
 //Ana: 31-03-09 Ojo, sino no funciona el combo de las campañas.$response->addJavascript('/js/mis_funciones');//neofis
  $response->addJavascript(sfConfig::get('sf_admin_web_dir').'/js/double_list');

  return sprintf($html,
    $label_all,
    $select1,
    submit_image_tag('/images/icons/next.png', "style=\"border: 0\" onclick=\"double_list_move(\$('{$name1}'), \$('{$name2}')); return false;\""),
    submit_image_tag('/images/icons/previous.png', "style=\"border: 0\" onclick=\"double_list_move(\$('{$name2}'), \$('{$name1}')); return false;\""),
    $label_assoc,
    $select2
  );
}

function object_double_list($object, $method, $options = array(), $callback = null , $criteria=null)
{
  $options = _parse_attributes($options);

  $options['multiple'] = true;
  $options['class'] = 'sf_multiple';
  if (!isset($options['size']))
  {
    $options['size'] = 10;
  }
  if (is_null($criteria)) $criteria = new Criteria();
  $label_all   = __(isset($options['unassociated_label']) ? $options['unassociated_label'] : 'Unassociated');
  $label_assoc = __(isset($options['associated_label'])   ? $options['associated_label']   : 'Associated');

  // get the lists of objects
  list($all_objects, $objects_associated, $associated_ids) = _get_object_list_nuevo($object, $method, $options, $callback , $criteria);
  
  $objects_unassociated = array();
  foreach ($all_objects as $object)
  {
    if (!in_array($object->getPrimaryKey(), $associated_ids))
    {
      $objects_unassociated[] = $object;
    }
  }

  // override field name
  unset($options['control_name']);
  $name  = _convert_method_to_name($method, $options);
  $name1 = 'unassociated_'.$name;
  $name2 = 'associated_'.$name;
  $select1 = select_tag($name1, options_for_select(_get_options_from_objects($objects_unassociated), '', $options), $options);
  $options['class'] = 'sf_multiple-selected'; 
  $select2 = select_tag($name2, options_for_select(_get_options_from_objects($objects_associated), '', $options), $options);

  $html =
  '<div>
  <div style="float: left">
    <div style="font-weight: bold; padding-bottom: 0.5em">%s</div>
    %s
  </div>
  <div style="float: left">
    %s<br />
    %s
  </div>
  <div style="float: left">
    <div style="font-weight: bold; padding-bottom: 0.5em">%s</div>
    %s
  </div>
  <br style="clear: both" />
</div>
';

  $response = sfContext::getInstance()->getResponse();
  $response->addJavascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype');
  $response->addJavascript('/js/mis_funciones');//neofis
 

  return sprintf($html,
    $label_all,
    $select1,
    submit_image_tag('/images/icons/next.png', "style=\"border: 0\" onclick=\"double_list_move(\$('{$name1}'), \$('{$name2}')); return false;\""),
    submit_image_tag('/images/icons/previous.png', "style=\"border: 0\" onclick=\"double_list_move(\$('{$name2}'), \$('{$name1}')); return false;\""),
    $label_assoc,
    $select2
  );
}

function _get_propel_object_list_nuevo($object, $method, $options, $criteria=null)
{
  
  // get the lists of objects
  $through_class = _get_option($options, 'through_class');
  //neofis
  //print_r($criteria);
  //$cr = ($criteria instanceof Criteria) ? $criteria : null;
  /*
  $criteria = new Criteria();
  if ($ignorar_grupo_todos = _get_option($options, 'ignorar_grupo_todos')){
    $criteria->add(GrupoPeer::ID_GRUPO , 1 , Criteria::NOT_EQUAL);
  }
  if ($nuevo_criteria = _get_option($options, 'criteria'))
  {
    $criteria = ($nuevo_criteria instanceof Criteria) ? $nuevo_criteria : new Criteria();
  }
  */
  $objects = sfPropelManyToMany::getAllObjects($object, $through_class , '', $criteria);
  $objects_associated = sfPropelManyToMany::getRelatedObjects($object, $through_class);
  $ids = array_map(create_function('$o', 'return $o->getPrimaryKey();'), $objects_associated);
  return array($objects, $objects_associated, $ids);
}

function _get_object_list_nuevo($object, $method, $options, $callback , $criteria=null)
{
  $object = get_class($object) == 'sfOutputEscaperObjectDecorator' ? $object->getRawValue() : $object;
  // the default callback is the propel one

  if (!$callback)
  {
    $callback = '_get_propel_object_list_nuevo';
  }
  
  return call_user_func($callback, $object, $method, $options , $criteria);
}






function select_empresas($name, $option_tags = null, $options = array())
{
  $options = _parse_attributes($options);
  if (!isset($options['control_name']))
  {
    $options['control_name'] = 'empresa[id_empresa]';
  }
  if (!isset($options['div_tablas']))
  {
    $options['div_tablas'] = 'capa_tablas';
  }
  if (!isset($options['control_name_tablas']))
  {
    $options['control_name_tablas'] = 'tabla[id_tabla]';
  }
  if (!isset($options['include_blank']))
  {
    $options['include_blank'] = false;
  }
  $include_blank = $options['include_blank'] ? 'true' :'false';
  $id_select_empresa = get_id_from_name($options['control_name']);
  $select = select_tag($name , $option_tags , array(
    'control_name' => $options['control_name'],
    'onChange' => "recargar_tablas();",
  ));
  $html = $select;
  $html .= "\n";
  $js = "
  function recargar_tablas()
  {
    var empresa = document.getElementById('".$id_select_empresa."').value;
    ".remote_function(array(
    'update'  => $options['div_tablas'],
    'url'     => 'empresas/update_select_tablas',
    'with'    => "'id_empresa='+empresa + '&control_name='+ '".$options['control_name_tablas']."' + '&include_blank='+ ".$include_blank.""
  ))."
  }";
  $html .= content_tag('script', $js, array('type' => 'text/javascript'));
  return $html;
}


function select_empresas2($name, $option_tags = null, $options = array())
{
  $options = _parse_attributes($options);
  
  if (!isset($options['control_name']))
  {
    $options['control_name'] = 'empresa[id_empresa]';
  }
  if (!isset($options['control_name_tablas']))
  {
    $options['control_name_tablas'] = 'tabla[id_tabla]';
  }
  $include_custom = _get_option($options, 'include_custom');
  $include_blank = _get_option($options, 'include_custom') ? 'true' : 'false';
  $param_include_custom = (isset($include_custom) && $include_custom!='') ? " + '&include_custom=' + ".$include_custom."" : null;
  
  $id_select_empresa = get_id_from_name($options['control_name']);
  $id_select_tablas = get_id_from_name($options['control_name_tablas']);
  $select = select_tag($name , $option_tags , array(
    'control_name' => $options['control_name'],
    'onChange' => "recargar_tablas();",
  ));
  $html = $select;
  $html .= "\n";
  $js = "
  function recargar_tablas()
  {
    var empresa = document.getElementById('".$id_select_empresa."').value;
    ".remote_function(array(
    'update'  => $id_select_tablas,
    'url'     => 'empresas/update_select_tablas2',
    'with'    => "'id_empresa='+empresa + '&include_blank='+ ".$include_blank."".$param_include_custom.""
  ))."
  }";
  $html .= content_tag('script', $js, array('type' => 'text/javascript'));
  return $html;
}

function image_ok($valor = true)
{
  if ($valor && trim(strtoupper($valor)) != "NO")
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
  else
  {
    $value = null;
  }
  return $value;
}

function image_ok_or_error($valor = true)
{
  if ($valor)
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
  else
  {
    $value = image_tag('/images/icons/error.png' , array('alt' => __('error') , 'title' => __('error')));;
  }
  return $value;
}

function image_true_false($valor = true)
{
  if ($valor)
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('si') , 'title' => __('si')));
  }
  else
  {
    $value = image_tag('/images/icons/close.png' , array('alt' => __('no') , 'title' => __('no')));
  }
  return $value;
}

function input_fecha_hora_tag($name, $fecha = null, $options = array())
{
  use_helper('DateForm');
  $mi_fecha = (!$fecha || $fecha == '') ? 'now' : $fecha;
  $value = "";
  $value .= input_date_tag($name.'[date]', $mi_fecha, array('rich' => true , 'calendar_button_img' => '/images/icons/date.png'));
  $value .= select_time_tag($name, $mi_fecha, array('include_second' => false, '12hour_time' => false));
  return $value;
}

function input_fecha_tag($name, $fecha = null, $options = array())
{
  use_helper('DateForm');
  $mi_fecha = (!$fecha || $fecha == '') ? 'now' : $fecha;
  $value = "";
  $value .= input_date_tag($name.'[date]', $mi_fecha, array('rich' => true , 'calendar_button_img' => '/images/icons/date.png'));
  return $value;
}

function popUp($control_name, $formulario, $empresa = 0, $tabla = 0){
  use_helper('LightWindow');
  /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_ingema',null);*/
  $ruta = UsuarioPeer::getRuta();
  
  $ccontrol_name = str_replace("]","",str_replace("[","_",$control_name));
  $value = "";
  $value .= input_hidden_tag($control_name, $formulario->getIdFormulario(),array('control_name' => $control_name));
        
  $value .= "<a href=\"#\" align=\"right\" onclick=\"openPopup('','850','450','$control_name','".$ruta."/formularios/popup/?&control_name=".$control_name."&filters[id_empresa]=".$empresa."&filters[id_tabla]=".$tabla."&filter=filter',true);\" >".image_tag("icons/application_view_columns","border=0")."</a>&nbsp;";
  $value .= input_tag($control_name."_name",$formulario->__toString(),array("control_name" => $control_name, "disabled"=>true,"size"=>15, "style"=>"border: 0px; color: #000000; background-color : transparent; font-weight: bold;"));
  $value .= "<a href=\"#\" onclick=\"document.getElementById('".$ccontrol_name."').value = ''; document.getElementById('".$ccontrol_name."_name').value = '';\">".image_tag("icons/close","border=0")."</a>&nbsp;";

  return $value;
}


function select_diasemana($name, $value = null, $options = array(), $html_options = array())
{
  $options = _parse_attributes($options);
  if (!isset($options['control_name']))
  {
    $options['control_name'] = 'empresa[id_empresa]';
  }
  if (!isset($options['include_blank']))
  {
    $options['include_blank'] = false;
  }
  $include_blank = $options['include_blank'] ? 'true' :'false';
  
  $culture = sfContext::getInstance()->getUser()->getCulture();
  $dateFormatInfo = sfDateTimeFormatInfo::getInstance($culture);
  $dayNames = $dateFormatInfo->getDayNames();
  $optionsForSelect = options_for_select($dayNames, $value, $options);
  
  $html = select_tag($name , $optionsForSelect , $html_options);
  
  return $html;
}

function getNameDiaSemana($dia_semana)
{
  if (isset($dia_semana))
  {
    $culture        = sfContext::getInstance()->getUser()->getCulture();
    $dateFormatInfo = sfDateTimeFormatInfo::getInstance($culture);
    $dayNames       = $dateFormatInfo->getDayNames();
    
    $value = isset($dayNames[$dia_semana]) ? $dayNames[$dia_semana] : "";
    
    return $value;
  }
  return null;
}

function select_centimos($name, $value = null, $html_options = array())
{
  $lista_decimales = array();
  $rango = range(0, 99);
  foreach ($rango as $valor)
  {
    $lista_decimales[$valor] = ($valor < 10) ? "0".$valor : $valor;
  }
  return select_tag($name, options_for_select($lista_decimales, $value), $html_options);
}

//Rober 04-feb-2010
function get_imagen_tipo_situacion_entregable($tipo = null)
{
  if (is_null($tipo))
  {
    return null;
  }
  
  if (EntregablePeer::isTipoSituacionEntregableSin($tipo))
  {
    $value = image_tag('/images/icons/flag_yellow.png' , array(
      'alt'   => __('No hay entregables asociados') , 
      'title' => __('No hay entregables asociados'),
    ));
  }
  elseif (EntregablePeer::isTipoSituacionEntregablePendiente($tipo))
  {
    $value = image_tag('/images/icons/flag_red.png' , array(
      'alt'   => __('Hay entregables sin documentos asociados') , 
      'title' => __('Hay entregables sin documentos asociados'),
    ));
  }
  elseif (EntregablePeer::isTipoSituacionEntregableCompleto($tipo))
  {
    $value = image_tag('/images/icons/flag_green.png' , array(
      'alt'   => __('Todos los entregables tienen documentos asociados ') , 
      'title' => __('Todos los entregables tienen documentos asociados'),
    ));
  }
  else
  {
    $value = "error";
  }
  
  return $value;
}

?>
