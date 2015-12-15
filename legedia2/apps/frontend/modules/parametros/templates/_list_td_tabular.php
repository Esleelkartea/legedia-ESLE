<?php
  $undefined = "&mdash;";
?>
<td><?php 
  $nombre = $parametro_def->getNombre();
  $value = link_to(
    $nombre ? $nombre : $undefined, 
    'parametros/show?id='.$parametro_def->getPrimaryKey()
  );
  echo $value ? $value : $undefined;
?></td>
<td><?php 
  $value = $parametro_def->getDescripcion();
  echo $value ? $value : $undefined;
?></td>
<td><?php 
  echo $parametro_def->getEsLista() ? __('Lista') : __('Simple');
?></td>
<td><?php 
  echo $parametro_def->getEsEditable() ? 
    image_tag('/images/icons/tick.png', array('alt' => __('si'), 'title' => __('si'))) : 
    image_tag('/images/icons/cross.png', array('alt' => __('no'), 'title' => __('no')));
?></td>
<td><?php
  $value = ""; 
  if ($parametro_def->getEsLista())
  {
    $value = $parametro_def->getEsBorrable() ? 
      image_tag('/images/icons/tick.png', array('alt' => __('si'), 'title' => __('si'))) : 
      image_tag('/images/icons/cross.png', array('alt' => __('no'), 'title' => __('no')));
  }
  echo $value ? $value : "&mdash;";
?></td>
