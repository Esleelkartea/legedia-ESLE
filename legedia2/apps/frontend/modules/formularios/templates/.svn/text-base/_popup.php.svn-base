<?php use_helper('Date') ?>
<?php use_helper('Text') ?>
<?php  
    $lista_campos_extra = $tabla->getCamposFormularioOrdenados();
?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('popup_th_tabular', array('tabla' => $tabla, 'lista_campos_extra' => $lista_campos_extra, "valor_sel"=>$valor_sel, "control_name"=>$control_name)) ?>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $formulario): $odd = fmod(++$i, 2) ?>
<?
    $items_formulario = $formulario->getArrayItems();
?>
<tr class="sf_row_<?php echo $odd ?>">
<?php include_partial('popup_td_tabular', array('formulario' => $formulario, 'lista_campos_extra' => $lista_campos_extra, 'items_formulario' => $items_formulario, "valor_sel"=>$valor_sel)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="<?php echo (sizeof($lista_campos_extra)+2);?>">
<div class="float-right">
  <?php
    $value = pager_navigation($pager , 'formularios/popup');
    echo ($value) ? $value : '&nbsp;';
  ?>
</div>
<?php 
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos) ?>
</th></tr>
</tfoot>
</table>

<?php if ($cuantos && false) : ?>  
<ul class="sf_admin_actions">

</ul>
<?php endif;?>
