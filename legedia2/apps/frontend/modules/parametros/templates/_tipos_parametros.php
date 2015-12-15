<?php use_helper('DateForm')?>



<fieldset class="parametro">
<h2><?php echo __('Lista de parámetros') ?></h2>

<ul class="sf_admin_checklist">
<?php foreach($DefParametros as $param) : ?>
<li><?php 
  $remote_function = remote_function(array(
    'url'     => 'parametros/ver_tipo_parametro?ver_tipo_parametro='.$param->getTipoparametro(),
    'update'  => 'datosTipoParametro',
    'script'  => 'true'
  ));
  echo link_to_function(__('Ver %1%', array('%1%' => $param->getNombre())), $remote_function);
?></li>


<?php endforeach; ?>
</ul>
  
 
</fieldset>

<script lang="Javascript">
	function cargarParametros(ver_tipo_parametro,eslista){
		<?php if (Usuario::tienePermisos('parametros','listar_valor')) : ?>
			if (eslista) {
			<?php echo remote_function(array(
			  'url'=>"parametros/listar_valor", 
			  'with'=>"'ver_tipo_parametro='+ver_tipo_parametro", 			
			  'complete'	=>  visual_effect("Hightlight", "datosTipoParametro") )) ?>	
			}
		<?php endif; ?>
	}
</script>



