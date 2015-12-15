<td><?php echo link_to($tabla->getIdTabla() ? $tabla->getIdTabla() : '-', 'tablas/show?id_tabla='.$tabla->getIdTabla()) ?></td>
<td><?php echo $tabla->getEmpresa() ?></td>
<td><?php echo $tabla->getParametro() ? $tabla->getParametro()->getNombre() : '-' ?></td>
<td><?php echo link_to($tabla->getNombre() ? $tabla->getNombre() : '-', 'tablas/show?id_tabla='.$tabla->getIdTabla()) ?></td>
<td>
 <ul class="sf_admin_td_actions">
  <?php if ($posicion > 1) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_up.png', array('alt' => __('Subir'), 'title' => __('Subir'))), 'tablas/subir/?id_tabla='.$tabla->getIdTabla()) ?></li>
  <?php endif ;?>
  <?php if (!$ultimo ) : ?>
  <li><?php echo link_to(image_tag('/images/icons/bullet_arrow_down.png', array('alt' => __('Bajar'), 'title' => __('Bajar'))), 'tablas/bajar/?id_tabla='.$tabla->getIdTabla()) ?></li>
  <?php endif ; ?>
 </ul>
</td>
