<?php use_helper('I18N','Javascript','Object','Number') ?>

<?php if (Usuario::tienePermisos('parametros','guardar_valor')) : ?>
<div class="clear">
	<ul class="sf_admin_actions">
	
	<?php echo input_hidden_tag('ver_tipo_parametro',$DefParametro->getTipoParametro()) ?>
	<?php if (!$nuevo) : ?>
		<?php echo input_hidden_tag('guardarcomonuevo' , '0') ?>
		<?php echo input_hidden_tag('idparametro',$parametro->getIdparametro()) ?>
		<li><?php echo submit_tag(__('Guardar'),array("alt"=>__('Modificar'),"class"=>'sf_admin_action_save',"onclick"=>'tinyMCE.triggerSave()')) ?></li>
	<?php else : ?>
		<?php echo submit_tag(__('Guardar'),array("alt"=>__('add'),"class"=>'sf_admin_action_save',"onclick"=>'tinyMCE.triggerSave()')) ?>
	<?php endif; ?>
	<?php if ($DefParametro->getEslista()) : ?>
	
	<?php if (!$nuevo) : ?>
	<li><a href="#" class="sf_admin_action_save" onclick="if (confirm('<?php echo __('Se dispone a guardar los datos como un objeto nuevo. ¿Estas seguro?') ?>')) {document.getElementById('guardarcomonuevo').value='1';tinyMCE.triggerSave();document.getElementById('formulario_guardar').onsubmit();}"><?php echo __("Guardar como nuevo")?></a></li>
	<?php endif; ?>
	
	<li><a href="#" class="sf_admin_action_cancelar" onclick="if (confirm('<?php echo __('Va a cancelar todos los cambios que haya podido hacer, esta seguro de continuar?')?>')) <?php echo remote_function(array('url'=>'parametros/nuevo_valor?ver_tipo_parametro='.$DefParametro->getTipoParametro(),'update'=>'datos_parametro')) ?>"><?php echo __("Cancelar")?></a></li>
	<?php endif; ?>
	</ul>
</div>
<?php endif; ?>
