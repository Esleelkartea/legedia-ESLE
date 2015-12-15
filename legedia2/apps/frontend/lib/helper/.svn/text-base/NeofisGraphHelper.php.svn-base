<?php
include_once dirname(__FILE__).'/../php-ofc-library/open_flash_chart_object.php';
include_once dirname(__FILE__).'/../php-ofc-library/open-flash-chart.php'; //Ana: 11-03-09

function grafico($uri = null, $options = array())
{
  $options = _parse_attributes($options);
  $options['width'] = isset($options['width']) ? $options['width'] : '300';
  $options['height'] = isset($options['height']) ? $options['height'] : '200';
  
  $ruta = sfContext::getInstance()->getUser()->getAttribute('ruta', null);
  $direccion = $ruta."/index.php/".$uri;
  
  $value = null;
  try
  {
    $value = open_flash_chart_object_str($options['width'], $options['height'], $direccion, true , $ruta."/");
    return $value ? $value : null;
  }
  catch(Exception $e)
  {
    return null;
  }
  
}
?>
