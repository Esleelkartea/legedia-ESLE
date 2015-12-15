<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('alcance/list_th_tabular' , array('labels' => $labels)) ?>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $alcance): $odd = fmod(++$i, 2) ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<?php include_partial('alcance/list_td_tabular', array('alcance' => $alcance)) ?>
<?php include_partial('alcance/list_td_actions', array('alcance' => $alcance)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="8">
<div class="float-right">
  <?php
  $value = pager_navigation($pager , 'alcance/list?id_usuario='.$usuario->getIdUsuario());
  echo ($value) ? $value : '';
?>
</div>
<?php echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $pager->getNbResults()), $pager->getNbResults()) ?>
</th></tr>
</tfoot>
</table>
