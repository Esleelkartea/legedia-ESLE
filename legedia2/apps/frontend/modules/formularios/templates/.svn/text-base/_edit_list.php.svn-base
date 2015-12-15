<?php use_helper('Date') ?>
<?php use_helper('Text') ?>
<?php  
    $lista_campos_extra = $tabla->getCamposFormularioOrdenados();
?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('edit_list_th_tabular', array('tabla' => $tabla, 'lista_campos_extra' => $lista_campos_extra, "id_formulario"=>$id_formulario, "id_tabla"=> $id_tabla)) ?>
</tr>
</thead>
<tbody>
<?php /*$i = 1; foreach ($tablas_auxiliar as $formulario): $odd = fmod(++$i, 2)*/ ?>
<?php $i = 1; foreach ($pager->getResults() as $formulario): $odd = fmod(++$i, 2) ?>
<?php
    $items_formulario = $formulario->getArrayItems();
?>
<tr class="sf_row_<?php echo $odd ?>">
<?php include_partial('edit_list_td_tabular', array('formulario' => $formulario, 'lista_campos_extra' => $lista_campos_extra, 'items_formulario' => $items_formulario)) ?>
<?php include_partial('edit_list_td_actions', array('formulario' => $formulario, "id_formulario"=>$id_formulario, "id_tabla"=> $id_tabla)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="<?php echo (sizeof($lista_campos_extra)+2);?>">
<div class="float-right">
  <?php
    $value = pager_navigation($pager , 'formularios/edit/?id_formulario='.$id_formulario);
    echo ($value) ? $value : '&nbsp;';
  ?>
</div>
<?php 
  $cuantos = $pager->getNbResults();
  echo format_number_choice('[0] no hay resultados|[1] 1 resultado|(1,+Inf] %1% resultados', array('%1%' => $cuantos), $cuantos) ?>
</th></tr>
</tfoot>
</table>

<ul class="sf_admin_actions">
<div style="clear:left"> </div>
<br />
   <li><?php
      if ($tabla->getIdTabla() != null)
        echo button_to(__('Crear nuevo registro'), 'formularios/create?id_tabla='.$tabla->getIdTabla()."&id_tabla_proviene=".$id_tabla."&id_formulario_proviene=".$id_formulario, array ('class' => 'sf_admin_action_create',)) ?></li>
</ul>
