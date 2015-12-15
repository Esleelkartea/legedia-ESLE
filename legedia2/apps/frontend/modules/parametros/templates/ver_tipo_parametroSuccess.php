<?php use_helper('I18N','Javascript','Object') ?>



<fieldset id="sf_fieldset_datos" class="parametro">
<h2><?php echo __($DefParametro->getNombre()) ?></h2>

<div class="clear">
	<?php echo include_partial('ver_tipo_parametro_list', array(
	  'DefParametro'    => $DefParametro, 
	  'valorParametros' => $valorParametros
	)) ?>
</div>

<div class="clear"></div>

<div id="datos_parametro">
	<?php echo include_partial('parametros/datos_edit',array(
	  'DefParametros' => $DefParametros,
	  'parametro'     => $parametro,
	  'DefParametro'  => $DefParametro,
	  'nuevo'         => $nuevo,
	  'idiomas'       => $idiomas
	)) ?>
</div>
	


</fieldset>

