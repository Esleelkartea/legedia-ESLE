<?php

use_helper('Javascript');

function _load_jscookmenu_resources($theme)
{
  sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/JSCookMenu');
  switch ($theme) {
    case 'cmThemeGray':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemeGray/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemeGray/theme');
    break;
    case 'cmThemeIE':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemeIE/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemeIE/theme');
    break;
    case 'cmThemeMiniBlack':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemeMiniBlack/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemeMiniBlack/theme');
    break;
    case 'cmThemeOffice':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemeOffice/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemeOffice/theme');
    break;
    case 'cmThemeOffice2003':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemeOffice2003/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemeOffice2003/theme');
    break;
    case 'cmThemePanel':
      sfContext::getInstance()->getResponse()->addJavascript('/pmJSCookMenuPlugin/js/ThemePanel/theme');
      sfContext::getInstance()->getResponse()->addStylesheet('/pmJSCookMenuPlugin/css/ThemePanel/theme');
    break;
  }
}

function _get_item($array)
{
  use_helper('I18N');

  $url = 'null';

  if (isset($array['before_url']))
    $url_before = $array['before_url'];
  else $url_before = "";

  if (isset($array['after_url']))
    $url_after = $array['after_url'];
  else $url_after = "";

  if (isset($array['url'])){
    if ($url_before != ""){
    $url = "'".$url_before.$array['url'].$url_after."'";
    }else{
        $url = "'".url_for($array['url']).$url_after."'";
    }
 }

 $item = (isset($array['icon'])?"'".image_tag($array['icon'])."'":'null').", ".
          (isset($array['title'])?"'".__($array['title'])."'":'null').", ".
          $url.", ".
          (isset($array['target'])?"'".$array['target']."'":"'_self'").", ".
          (isset($array['description'])?"'".__($array['description'])."'":'null');
  return $item;
}

function _jscookmenu($arr, $name, $orientation, $theme)
{
  $arr2 = array();
  $id_empresa_sel = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
  $categorias = ParametroPeer::getCategorias();
  foreach ($categorias as $cat){
    $tmp_array = array();
    $tmp_array["title"] = strtoupper($cat->getNombre());
   
    $c= TablaPeer::getCriterioAlcance(true);
    $c->addAnd(TablaPeer::ID_EMPRESA, $id_empresa_sel, Criteria::EQUAL);
    $c->addAnd(TablaPeer::ID_CATEGORIA, $cat->getIdParametro(), Criteria::EQUAL);
    $tablas = TablaPeer::doSelect($c);


    $cont = 1;
    if (sizeof($tablas) > 0) $tmp_array["submenu"] = array(); 
    foreach ($tablas as $tabla){
      $tmp_array["submenu"]["menu0".$cat->getIdParametro().".".$cont] = array("title"=> $tabla->getNombre(),"url"=> 'formularios/list', "after_url"=>'/?filters[id_empresa]='.$id_empresa_sel.'&filters[id_tabla]='.$tabla->getIdTabla().'&filter=filter');
      $cont ++;
    }
    
    if (sizeof($tablas) > 0) $arr2["menu0".$cat->getIdParametro()] = $tmp_array;
  }

   foreach($arr as $key => $ar){
    $arr2[$key] = $ar;
   }     
   
   $arr = $arr2;
   
  _load_jscookmenu_resources($theme);

  $sf_user = sfContext::getInstance()->getUser();

  $js = "var $name = [";
  foreach ($arr as $item) {
    if (is_array($item)) {
      // check credentials
      $display = true;
      //if (isset($item['credentials']))
      // $display = $sf_user->hasCredential($item['credentials']);
      if (isset($item['url'])){
        $actions = explode("/", $item['url']);
        if (!isset($actions[1])) $actions[1] = "index";
        $display = Usuario::tienePermisos($actions[0],$actions[1]);
      }
      
      // if sf_user has credentials, display the menu item
      if ($display) {
        $js .= "["._get_item($item);
        if (isset($item['submenu'])) {
          foreach ($item['submenu'] as $subitem) {
            if (is_array($subitem)) {
              // check credentials
              $display = true;
              if (isset($subitem['url'])){
                $actions = explode("/",$subitem['url']);
                if (!isset($actions[1])) $actions[1] = "index";
                $display = Usuario::tienePermisos($actions[0],$actions[1]);
              }
              //if (isset($subitem['credentials']))
              //$display = $sf_user->hasCredential($subitem['credentials']);

              // if sf_user has credentials, display the menu item
              if ($display) {
                $js .= ", ["._get_item($subitem);
                if (isset($subitem['submenu'])) {
                  foreach ($subitem['submenu'] as $subsubitem) {
                    if (is_array($subsubitem)) {
                      // check credentials
                      $display = true;
                      if (isset($subsubitem['url'])){
                        $actions = explode("/",$subsubitem['url']);
                        if (!isset($actions[1])) $actions[1] = "index";
                        $display = Usuario::tienePermisos($actions[0],$actions[1]);
                      }
                      //if (isset($subsubitem['credentials']))
                      //$display = $sf_user->hasCredential($subsubitem['credentials']);

                      // if sf_user has credentials, display the menu item
                       if ($display) {
                         $js .= ", ["._get_item($subsubitem)."]";
                       }
                    } else if ($subsubitem == '_cmSplit') {
                      $js .= ", ".$subsubitem;
                    }
                  }
                }
                $js .= "]";
              }
            } else if ($subitem == '_cmSplit') {
              $js .= ', '.$subitem;
            }
          }
        }
        $js .= "], ";
      }
    } else if ($item == '_cmSplit') {
      $js .= $item.', ';
    }
  }
  $js = substr($js, 0, strlen($js) - 2);
  $js .= "];";

  $html = tag('div', array('id' => "$name"), true);
  $html .= tag('/div', array(), true);

  $js2 = "cmDraw('$name', $name, '$orientation', $theme);";

  return javascript_tag($js).$html.javascript_tag($js2);
}

function jscookmenu_from_array($arr, $name, $orientation, $name)
{
  return _jscookmenu($arr, $name, $orientation, $theme);
}

function jscookmenu_from_yml($yml_file, $name, $orientation, $theme)
{
  return _jscookmenu(sfYaml::load($yml_file), $name, $orientation, $theme);
}
