<td align="right">
<ul class="sf_admin_td_actions">
  <?php $ultima_version = HistoricoDocumentoPeer::getUltimaVersionReal($documento->getPrimaryKey()); ?>
  <?php if ($ultima_version != 0) : ?>
    <li><?php echo link_to(
      image_tag('/images/icons/bullet_down.png', array('alt' => __('Descargar'), 'title' => __('Descargar'))), 
      'historico_documentos/descargar?id_documento='.$documento->getPrimaryKey().'&version='.$ultima_version); 
  ?></li>
  <?php endif; ?> 
  <li><?php 
    echo link_to(
      image_tag('/images/icons/filter.png', array('alt' => __('ver'), 'title' => __('ver'))), 
      'documentos/show?id_documento='.$documento->getPrimaryKey()
    ); 
  ?></li>
  <li><?php 
    echo link_to(
      image_tag('/images/icons/edit_icon.png', array('alt' => __('editar'), 'title' => __('editar'))), 
      'documentos/edit?id_documento='.$documento->getPrimaryKey()
    ); 
  ?></li>
  <li><?php 
    echo link_to(
      image_tag('/images/icons/delete_icon.png', array('alt' => __('borrar'), 'title' => __('borrar'))), 
      'documentos/delete?id_documento='.$documento->getPrimaryKey(), 
      array (
        'post' => true,
        'confirm' => __('¿Estás seguro?'),
      )
    ); 
  ?></li>
</ul>
</td>
