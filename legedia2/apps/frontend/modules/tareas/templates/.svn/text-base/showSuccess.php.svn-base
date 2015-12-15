<?php use_helper('Date');?>
<div id="sf_admin_container">

<h1><?php echo (!$tarea->getEsEvento()) ? __('Datos de la tarea') : __('Datos del evento') ?><?php if(!$tarea->isNew()) echo '['.$tarea->getPrimaryKey().']' ?></h1>

<div id="sf_admin_header">
      <?php include_partial('tareas/show_header', array('tarea' => $tarea)) ?>
</div>



<div id="sf_admin_content">
<?php include_partial('tareas/show_messages', array()) ?>
<?php 
      include_partial('tareas/show_form', array('tarea' => $tarea , 'labels' => $labels));
?>
</div>

<div id="sf_admin_bar">
<?php
        include_partial('tareas/show_bar', array('tarea' => $tarea));
 ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('tareas/show_footer', array('tarea' => $tarea)) ?>
</div>

</div>
