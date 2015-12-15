<?php use_helper('MisObjetos')?>
<div id="sf_admin_container">
<?php
  foreach ($pager->getResults() as $formulario) break;
  if (!isset($formulario)){
    $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
    if (isset($id_tabla) && ($id_tabla!=''))
    {
      $tabla = TablaPeer::retrievebypk($id_tabla);
      $formulario = $tabla->getFormulario();
    }
    else $formulario = new Formulario();
  }  
?>
<h1><?php echo __('Registros de').' '; if ($formulario->getTabla()) echo $formulario->getTabla()->getNombreyEmpresa(); else echo "--"; ?></h1>

<div id="sf_admin_header">
<?php include_partial('formularios/list_header', array('pager' => $pager)) ?>
<?php include_partial('formularios/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content"><?php

if ($formulario->getTabla() == 'Ficheros') {
    if (isset($_GET['i']))  $pre = substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), '&i'));
    else    $pre = Notificaciones::selfURL(); ?>
    <ul class='sf_admin_actions' style="padding-bottom: 2%"><?php
        echo "<li>".button_to(__('Notificados'), $pre.'&i=1', array('class' => 'sf_admin_action_list', 'style' => 'float:left'))."</li>";
        echo "<li>".button_to(__('No Procesados'), $pre.'&i=0', array('class' => 'sf_admin_action_list', 'style' => 'float:left'))."</li>";
        echo "<li>".button_to(__('No Notificados'), $pre.'&i=2', array('class' => 'sf_admin_action_list', 'style' => 'float:left'))."</li>";
        echo "<li>".button_to(__('Todos'), $pre, array('class' => 'sf_admin_action_list', 'style' => 'float:left'))."</li>"; ?>
    </ul><?php
} ?>
<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p>
<?php echo __('no hay resultados') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('formularios/list', array('pager' => $pager, "formulario" => $formulario, "tabla"=>$formulario->getTabla())) ?>
<?php endif; ?>
<?php include_partial('list_actions' , array('pager' => $pager, 'filters' => $filters)) ?>
</div>

<div id="sf_admin_bar">
<?php include_partial('filters', array('filters' => $filters)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('formularios/list_footer', array('pager' => $pager)) ?>
</div>

</div>