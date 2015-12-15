<?php use_helper('I18N','Javascript','Object','Number') ?>

	<?php if (!$nuevo) : ?>
	  <fieldset class="accesos_naranja">
		<h2><?php echo __('Ver')." ".__($DefParametro->getNombre()) ?></h2>	 
  		<?php if ($DefParametro->getEslista()) : ?>		  		 
	  	<ul class="sf_admin_actions">
			<?php if (Usuario::tienePermisos('parametros','borrar_valor')) : ?>
				<?php if ($DefParametro->getEsBorrable()) { ?>
				<li><a href="#" class="sf_admin_action_borrar" onclick="if (confirm('<?php echo __('Estas seguro?')?>')) <?php echo remote_function(array('url'=>'parametros/borrar_valor?idparametro='.$parametro->getidparametro(),'update'=>'datos_parametro', 'script'=>'true', 'complete'=>enlaceACargarParametros($DefParametro))) ?>"><?php echo __("Borrar") ?></a></li>
				<?php } ?>
	  		<?php endif; ?>
	    </ul>
	  	<?php endif; ?>
   <?php else : ?><fieldset class="accesos_verde"><h2><?php echo __('Nuevo')." ".__($DefParametro->getNombre()) ?></h2> 
	<?php endif; ?>
