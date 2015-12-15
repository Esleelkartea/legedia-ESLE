<?php 
  use_helper('Date');
  use_helper('MisObjetos');
?>
<div id="sf_admin_container">
<h1><?php echo __('Lista de tareas y eventos', array()) ?></h1>
</div>


<div id="sf_admin_container">
<div id="sf_admin_header">
<?php include_partial('tareas/list_header', array('pager' => $pager)) ?>
<?php include_partial('tareas/list_messages', array('pager' => $pager)) ?>
</div>

<div id="sf_admin_content">
<!-- Ana: Código para que se vea el calendario --->
 <div <?php /*if (!isset($mes)) { echo 'style="display:none"'; } */?> id="div_calendario">
    <?php echo $calendarMes;?><br />
  </div>
<!-- Fin ana: -->

<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p><?php echo __('no hay resultados') ?></p></blockquote>
<?php else: ?>
<?php include_partial('tareas/list', array('pager' => $pager, 'labels' => $labels)) ?>
<?php endif; ?>

<?php include_partial('list_actions', array('fuente_datos' => isset($fuente_datos) ? $fuente_datos : null)) ?>
</div>
    
<div  id="sf_admin_bar" >
<!-- Ana: Código para que se vea el calendario --->
<ul class="panel_acciones">
  <li>
  <?php echo link_to_function(__('Mostrar / ocultar calendario'),  visual_effect('toggle_appear', 'div_calendario')  , array('class' => 'calendario') ) ?>
  </li>
</ul>
<!-- Fin ana: -->

<!-- Filtros especificos de tiempo -->
<ul class="acciones_llamadas">
  <li><?php 
   if (isset($pendientes) and $pendientes == 1) {
    echo link_to(__('Desactivar filtro "pendientes" '),  'tareas/list'  , array('class' => 'activo') );
   }
   else {
    echo link_to(__('Activar filtro "pendientes" '),  'tareas/list?pendientes=1'  , array('class' => 'inactivo') );
   }
   ?>
  </li>
  <li><?php 
   if (isset($pendientes) and $pendientes == 2) {
    echo link_to(__('Desactivar filtro "de hoy"'),  'tareas/list'  , array('class' => 'activo') );
   }
   else {
    echo link_to(__('Activar filtro "hoy"'),  'tareas/list?pendientes=2'  , array('class' => 'inactivo') );
   }
   ?>
  </li>

</ul>
<!-- Fin filtros especificos -->

<?php include_partial('filters', array('filters' => $filters)) ?>

</div>

<div id="sf_admin_footer">
<?php include_partial('tareas/list_footer', array('pager' => $pager)) ?>
</div>

</div>

