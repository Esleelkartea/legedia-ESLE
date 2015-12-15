<!--<td><?php echo $campo->getOrden();?></td>-->
<td align="center"><?php 
  $direccion = '?id_campo='.$campo->getIdCampo().'&id_empresa='.$empresa->getPrimaryKey();
  if (isset($id_tabla)) {
      $direccion .= '&id_tabla='.$id_tabla;
  }
      
  $value = "";
  if (!$campo->getEsInconsistente())
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
  else
  {
    $value = image_tag('/images/icons/error.png' , array('alt' => __('ha sido alterado') , 'title' => __('ha sido alterado')));
  }
  echo $value;
?></td>
<td align="center"><?php 
  $value = null;
  if ($campo->getEsNombre())
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
   echo $value;
  ?>
</td>
<td align="center"><?php 
  $value = null;
  if ($campo->getObligatorio())
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
   echo $value;
  ?>
</td>
<td><?php 
  $nombre = $campo->__toString();
  echo link_to($nombre ? $nombre : '-' , 'formulario_modelo/show_campo/'.$direccion);
?></td>
<td><?php 
  echo __(CampoPeer::getNombreTipo($campo->getTipo()));
?></td>
<td><?php echo $campo->getDescripcion() ?></td>
<!--
<td><?php 
  $value = null;
  if ($campo->getEsGeneral())
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
  else
  {
    $lista_rel = $campo->getRelCampoTablas();
    $value= "<ul class='sf_admin_lista'>";
    foreach ($lista_rel as $rel) {
        $value .= "<li>".$rel->getTabla()->__toString()."</li>";
    }
    $value .= "</ul>";
  /*  Ana: 16-04-09 $cuantos = $campo->countRelCampoTablas();
    $value = format_number_choice('[0] ninguna fuente de datos|[1] 1 fuente de datos|(1,+Inf] %1% fuentes de datos', array('%1%' => $cuantos), $cuantos);*/
  }
  echo $value;
?></td>
-->