<?php use_helper('Javascript') ?>
<div id="sf_admin_container" >

<h1><?php echo __('Editar alcance', array()) ?></h1>

<div id="sf_admin_header" style="">
<?php include_partial('alcance/edit_header', array('alcance' => $alcance , 'labels' => $labels)) 
?>
</div>

<div id="sf_admin_content">
<?php include_partial('alcance/edit_messages', array('alcance' => $alcance, 'labels' => $labels)) ?>
<?php include_partial('alcance/edit_form', array('alcance' => $alcance , 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php //include_partial('grupos/edit_footer', array('alcance' => $alcance)) 
?>
</div>

</div>
