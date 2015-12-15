<?php
use_helper('ModalBox');


function button_to_modal_box_preview($name , $id_formulario , $informe)
{
  use_helper('Javascript');
  $js = "
  function preview_informe()
  {
    Modalbox.show('".url_for('informes/preview?id_informe='.$informe->getPrimaryKey())."', {title: '".__('Vista preliminar del informe')."', width: 700});
  }";
  $html = content_tag('script', $js, array('type' => 'text/javascript'));
  $html .= button_to_function($name , 'preview_informe();' , array('class' => 'sf_action_show','submit' => $id_formulario));
  $html .= "\n";
  
  return $html;
}
?>
