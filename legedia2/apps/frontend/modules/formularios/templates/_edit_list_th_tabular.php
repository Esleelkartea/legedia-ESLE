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
        $url = $ruta.'/formularios/edit?id_formulario='.$id_formulario.'&sort='.$campo_txt.'&sort_campo='.$campo->getIdCampo().'&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort') == 'asc' ? 'desc' : 'asc'); 
        $value .= '<a href="'.$url.'">'.$campo->__toString().'</a>';
        $value .= '('.__($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort')).')';
      }else{ 
        $url = $ruta.'/formularios/edit?id_formulario='.$id_formulario.'&sort='.$campo_txt.'&sort_campo='.$campo->getIdCampo().'&type=asc'; 
        $value .= '<a href="'.$url.'">'.$campo->__toString().'</a>'; 
      }
      $mvalue .= "<th>".$value."</th>";
      
      //$mvalue .= "<th>".$campo->__toString()."</th>";
    }
  }
  echo $mvalue;
?>
  <th id="sf_list_th_fecha">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/formulario/sort') == 'fecha_form'): ?>
      <?php 
      $url = $ruta.'/formularios/edit?id_formulario='.$id_formulario.'&sort=fecha_form&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort') == 'asc' ? 'desc' : 'asc'); 
      echo '<a href="'.$url.'">'.__('fecha').'</a>';
      ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/formulario/sort')) ?>)
      <?php else: ?>
      <?php 
      $url = $ruta.'/formularios/edit?id_formulario='.$id_formulario.'&sort=fecha_form&type=asc'; 
      echo '<a href="'.$url.'">'.__('fecha').'</a>'; 
      ?>
      <?php endif; ?>
  </th>
  
  <th id="sf_list_th_actions"><?php echo __('Acciones') ?></th>
