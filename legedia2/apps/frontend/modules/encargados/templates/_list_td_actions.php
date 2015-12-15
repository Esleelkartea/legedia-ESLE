<td>
<ul class="sf_admin_td_actions">
  <li><?php 
    echo link_to(
      image_tag('/sf/sf_admin/images/filter.png', array('alt' => __('Ver'), 'title' => __('Ver'))), 
      'encargados/show?id_cliente='.$cliente->getIdCliente()
    ); 
  ?></li>
  <li><?php 
    echo link_to(
      image_tag('/sf/sf_admin/images/edit_icon.png', array('alt' => __('Editar'), 'title' => __('Editar'))), 
      'encargados/edit?id_cliente='.$cliente->getIdCliente()
    ); 
  ?></li>
  <li><?php 
    echo link_to(image_tag('/sf/sf_admin/images/delete_icon.png', array('alt' => __('Borrar'), 'title' => __('Borrar'))), 
      'encargados/delete?id_cliente='.$cliente->getIdCliente(), array (
        'post' => true,
      'confirm' => __('Estas seguro?'),
      )
    ); 
  ?></li>
</ul>
</td>
