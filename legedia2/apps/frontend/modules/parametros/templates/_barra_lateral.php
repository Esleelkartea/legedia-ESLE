<?php
  $lista = ParametroDefPeer::getAllByNombre();
  $tabla = array();
  $image_show = image_tag('/images/icons/show.png', array('alt' => __('Ver'), 'title' => __('Ver')));
  foreach ($lista as $parametro_def)
  {
    $tabla[] = array(
      'id'    => $parametro_def->getPrimaryKey(),
      'name'  => $parametro_def->__toString(),
      'type'  => $parametro_def->getEsLista() ? __('Lista') : __('Simple'),
      'actions' => array(
        link_to($image_show, 'parametros/show?id='.$parametro_def->getPrimaryKey()),
      ),
    );
  }
?>
<div class="sf_admin_filters">
<fieldset>
  <h2><?php echo __('Lista de parámetros') ?></h2>
<?php if (!sizeof($tabla)) : ?>
  <blockquote class="warning"><p><?php 
    echo __('No hay parametros definidos');
  ?></p></blockquote>
<?php else : ?>
  <table cellspacing="0" style="border: none;" width="100%">
    <thead><tr>
      <th><?php echo __('Nombre')?></th>
      <th><?php echo __('Tipo')?></th>
      <th>&nbsp;</th>
    </tr></thead>
    <?php foreach ($tabla as $dato) : ?>
    <tr class="<?php echo ($dato['id']==$id_parametro_def) ? 'highlight strong' : '';?>">
      <td><?php echo $dato['name']?></td>
      <td><?php echo $dato['type']?></td>
      <td align="right"><?php echo implode(" ", $dato['actions'])?></td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
</fieldset>
</div>
