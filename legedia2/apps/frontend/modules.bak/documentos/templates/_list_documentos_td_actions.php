<td align="center">
<?php 
  $parametros = "?id_documento=".$historico_documento->getIdDocumento();
  $parametros .= "&version=".$historico_documento->getVersion();
?>
<ul class="sf_admin_td_actions">
  <!--
  <li><?php 
    echo link_to(
      image_tag('/images/icons/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 
      'historico_documentos/edit'.$parametros
    ); 
  ?></li>
  -->
  <li><?php 
    echo link_to(
      image_tag('/images/icons/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 
      'historico_documentos/delete_from_documentos'.$parametros, 
      array (
        'post' => true,
        'confirm' => __('¿Estás seguro?'),
      )
    );
  ?></li>
  <!--
  <li><?php 
    echo link_to(
      image_tag('/images/icons/filter.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 
      'historico_documentos/show'.$parametros
    );
  ?></li>
  -->
  <li><?php 
    echo link_to(
      image_tag('/images/icons/bullet_down.png', array('alt' => __('Descargar'), 'title' => __('Descargar'))), 
      'historico_documentos/descargar'.$parametros
    ); 
  ?></li> 
</ul>
</td>
