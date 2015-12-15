<?php 
  use_helper('MisObjetos');
  
  include_partial('parametros/show_show', array(
    'parametro_def' => $parametro_def, 
    'labels' => $labels
  ));
?>

<?php 
  if ($parametro_def->getEsLista())
  {
    include_partial('parametros/show_items', array(
      'parametro_def' => $parametro_def,
      'id_parametro_editado' => $parametro->getPrimaryKey(),
      'labels' => $labels,
    ));
  }
?>
<br />
<?php
  if (isset($show) && $show)
  {
    $url_partial = 'parametros/show_item_show';
  }
  else
  {
    $url_partial = $parametro_def->getEsEditable() ? 'parametros/show_item_form' : 'parametros/show_item_show';
  }
  
  include_partial($url_partial, array(
    'parametro_def' => $parametro_def,
    'parametro'     => $parametro,
    'labels'        => $labels,
  ));
?>
