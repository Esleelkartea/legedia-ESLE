<?php use_helper('Date') ?>
<?php use_helper('Text') ?>
<?php $lista_campos_extra = $tabla->getCamposFormularioOrdenados(); ?>
<table cellspacing="0" class="sf_admin_list">
<thead>
<tr>
<?php include_partial('list_th_tabular', array('formulario' => $formulario, 'tabla' => $tabla, 'lista_campos_extra' => $lista_campos_extra)) ?>
</tr>
</thead>
<tbody>
<?php $i = 1; foreach ($pager->getResults() as $formulario): $odd = fmod(++$i, 2) ?>
<?php    $items_formulario = $formulario->getArrayItems(); ?>
<tr class="sf_row_<?php echo $odd ?>">
<?php include_partial('list_td_tabular', array('formulario' => $formulario, 'lista_campos_extra' => $lista_campos_extra, 'items_formulario' => $items_formulario)) ?>
<?php include_partial('list_td_actions', array('formulario' => $formulario)) ?>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr><th colspan="<?php echo (sizeof($lista_campos_extra)+2); ?>">
<div class="float-right">
  <?php
    $s = $sf_user->getAttribute('sort', null, 'sf_admin/formulario/sort');
    $sc = $sf_user->getAttribute('sort_campo', null, 'sf_admin/formulario/sort');
    $st = $sf_user->getAttribute('type', null, 'sf_admin/formulario/sort');
    
    $ruta = UsuarioPeer::getRuta();
    $murl = $ruta.'/formularios/list?filters[id_empresa]='.$tabla->getIdEmpresa().'&filters[id_tabla]='.$tabla->getIdTabla().'&filter=filter';
    if ($s != null) $murl .= '&sort='.$s;
    if ($sc != null) $murl .= '&sort_campo='.$sc;
    if ($st != null) $murl .= '&type='.$st;
    
    $value = pager_navigation($pager, $murl, false);
    echo ($value) ? $value : '&nbsp;'; ?>
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
<?php endif; ?>