<?php
// auto-generated by sfPropelAdmin
// date: 2007/08/30 11:31:00
?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular') ?>
  <th id="sf_admin_list_th_sf_actions"><?php echo __('Acciones') ?></th>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($listaBackups as $backup): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('list_td_tabular', array('backup' => $backup)) ?>
<?php include_partial('list_td_actions', array('backup' => $backup)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="4">
&nbsp;
</th></tr>
</tfoot>
</table>
