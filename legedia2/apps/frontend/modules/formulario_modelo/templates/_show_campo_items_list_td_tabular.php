<td><?php echo $item->getOrden();?></td>
<td><?php 
  $value = "";
  if (!$item->getEsInconsistente())
  {
    $value = image_tag('/images/icons/tick.png' , array('alt' => __('ok') , 'title' => __('ok')));
  }
  else
  {
    $value = image_tag('/images/icons/error.png' , array('alt' => __('ha sido alterado') , 'title' => __('ha sido alterado')));
  }
  echo $value;
?></td>
<td><?php 
  $valor = item_base_to_string($item);
  echo $valor ? $valor : '-'; 
?></td>
<td><?php 
  $tiene_ayuda = $item->getAyuda() && ($item->getAyuda()!='');
  echo image_ok($tiene_ayuda);
?></td>
<td><?php 
  $tiene_texto_auxiliar = $item->getTextoAuxiliar();
  echo image_ok($tiene_texto_auxiliar);
?></td>
