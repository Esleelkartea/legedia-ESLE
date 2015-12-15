<div id="sf_admin_container">

<h1><?php echo (!$tarea->getEsEvento()) ? __('Editar tarea') : __('Editar evento') ?><?php if(!$tarea->isNew()) echo '['.$tarea->getPrimaryKey().']' ?></h1>

<div id="sf_admin_header">
<?php include_partial('tareas/edit_header', array('tarea' => $tarea)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('tareas/edit_messages', array('tarea' => $tarea, 'labels' => $labels)) ?>
<?php include_partial('tareas/edit_form', array('tarea' => $tarea, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('tareas/edit_footer', array('tarea' => $tarea)) ?>
</div>

</div>
