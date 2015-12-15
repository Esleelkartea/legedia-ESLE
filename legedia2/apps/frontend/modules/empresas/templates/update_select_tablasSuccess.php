<?php 
  $opciones = array();
  if ($include_blank == 'true')
  {
    $opciones = array('include_blank' => true);
  }
    $value = select_tag($control_name , 
      objects_for_select($tablas , 'getIdTabla' , '__toString' , ''  , $opciones) , 
      array ('control_name' => $control_name
    )); 
    echo $value ? $value : '&nbsp;';
?>
