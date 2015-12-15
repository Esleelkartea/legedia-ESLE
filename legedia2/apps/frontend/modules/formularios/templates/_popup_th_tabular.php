 <th></th>
<?php
  /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
  $ruta = UsuarioPeer::getRuta();
  
  $mvalue = "";
  foreach ($lista_campos_extra as $campo) {
    $value = "";
    if (!$campo->getBorrado()){
    
      if ($campo->esTipoLista()) $campo_txt = "id_item_base";
      if ($campo->esTipoTextoCorto()) $campo_txt = "texto_corto";
      if ($campo->esTipoTextoLargo()) $campo_txt = "texto_largo";
      if ($campo->esTipoNumero()) $campo_txt = "numero";
      if ($campo->esTipoFecha()) $campo_txt = "fecha";
      if ($campo->esTipoBooleano()) $campo_txt = "si_no";
      if ($campo->esTipoSelectPeriodo()) $campo_txt = "id_item_base";
      if ($campo->esTipoTabla()) $campo_txt = "id_tabla";
      if ($campo->esTipoObjeto()) $campo_txt = "id_objeto";
      
      if ($sf_user->getAttribute('sort', null, 'sf_admin/formulario/sort') == $campo_txt && $sf_user->getAttribute('sort_campo', null, 'sf_admin/formulario/sort') == $campo->getIdCampo()){
        $url = $ruta.'/formularios/popup?filters[id_empresa]='.$tabla->getIdEmpresa().'&filters[id_tabla]='.$tabla->getIdTabla().'&valor_sel='.$valor_sel.'&control_name='.$control_name.'&filter=filter&sort='.$campo_txt.'&sort_campo='.$campo->getIdCampo().'&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort') == 'asc' ? 'desc' : 'asc');
        $value .= '<a href="'.$url.'">'.$campo->__toString().'</a>';
        $value .= '('.__($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort')).')';
      }else{ 
        $url = $ruta.'/formularios/popup?filters[id_empresa]='.$tabla->getIdEmpresa().'&valor_sel='.$valor_sel.'&control_name='.$control_name.'&filters[id_tabla]='.$tabla->getIdTabla().'&filter=filter&sort='.$campo_txt.'&sort_campo='.$campo->getIdCampo().'&type=asc';
        $value .= '<a href="'.$url.'">'.$campo->__toString().'</a>'; 
      }
      $mvalue .= "<th>".$value."</th>";
    }
  }
  echo $mvalue;
?>