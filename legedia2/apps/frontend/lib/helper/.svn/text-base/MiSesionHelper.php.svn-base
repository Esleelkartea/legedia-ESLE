<?php

function logo_empresa_sesion()
{
  $value = null;
  
  $usuario = Usuario::getUsuarioActual();
  if ($usuario)
  {
    $empresa = $usuario->getEmpresaSesion();
    if (isset($empresa))
    {
      //$nombre_imagen = $empresa->getLogoMin();
      //if (!$nombre_imagen)
      //{
        //$image_tag = "&mdash;&nbsp;".$empresa->__toString()."&nbsp;&mdash;";
      //}
      //else
      //{
        //$imagen = "/upload/".$empresa->getImagen();
        $imagen = $empresa->getUrlLogoMin();
        $image_tag = image_tag($imagen , array('alt' => $empresa->__toString() , 'title' => $empresa->__toString() ));
      //}
      //print_r $usuario->get
      /*
      if ($usuario->isMultiplesEmpresasSesion())
      {
        use_helper('Javascript');
        $logo = link_to_function($image_tag , visual_effect('toggle_appear' , 'sesion_empresa') , array('title' => __('Pulse para cambiar de empresa')));
        $empresas = $usuario->getListaEmpresasSesion();
        $html = "<div id=\"sesion_empresa\" style=\"display:none\" >";
        $html .= form_tag('panel/empresa_sesion', array('multipart' => true ));
        $html .= select_tag('id_empresa' , objects_for_select($empresas, 'getPrimaryKey' , '__toString' , $empresa->getPrimaryKey()) , 
          array('control_name' => 'id_empresa'));
        $html .= submit_tag(__('Cambiar'), array (
          'name' => 'save_and_show',
          'confirm' => __('¿Desea cambiar de empresa?'),
          //'class' => 'sf_action_save',
        ));
        $html .= button_to_function(__('Cancelar'), visual_effect('toggle_appear' , 'sesion_empresa'));
        $html .= "</form>\n";
        $html .= "</div>";
        $value = $html.$logo;
        
      }
      else
      {
        $value = $image_tag;
      }
      */
      $value = $image_tag;
    }
    
  }
  return $value;
}


?>
