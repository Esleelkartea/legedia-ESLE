<td>
<ul class="sf_admin_td_actions">
  <!--
  <?
  use_helper('LightWindow');
  /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
  $ruta = UsuarioPeer::getRuta();
  echo "<li><a href=\"#\" align=\"right\" onclick=\"openPopup('','850','450','','".$ruta."/formularios/edit/id_formulario/".$formulario->getIdFormulario()."/?id_formulario_proviene=".$id_formulario."&id_tabla_proviene=".$id_tabla."&layout=popup',false);\" >".image_tag('/images/icons/edit_icon.png')."</a></li>";
  ?>
  -->
  <li><?php echo link_to(image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 'formularios/edit?id_formulario='.$formulario->getIdFormulario()."&id_formulario_proviene=".$id_formulario."&id_tabla_proviene=".$id_tabla) ?></li>
  <li><?php echo link_to(image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 'formularios/delete?id_formulario='.$formulario->getIdFormulario()."&id_formulario_proviene=".$id_formulario, array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
)) ?></li>
</ul>
</td>
