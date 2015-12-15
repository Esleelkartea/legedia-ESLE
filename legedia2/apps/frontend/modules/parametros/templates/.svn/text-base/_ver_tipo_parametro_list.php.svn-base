<?php use_helper('I18N','Javascript','Object') ?>

<?php if ($DefParametro->getEslista()) : ?>
	<?php 
	  echo form_remote_tag(array(
	    'url'     => 'parametros/ver_valor',
	    'update'	=> 'datos_parametro',
	    'complete' => visual_effect('Highlight', 'datos_parametro')
	  ));
	  
    echo select_tag('parametrover',
      objects_for_select($valorParametros,'getIdparametro','getNombreLista'),
      array(
        'size'    => 7,
        'class'   => 'auto',//Rober 21-01-09
       //Ana: 25-02-09 'onclick' => "this.form.auto_complete.value=this.options[this.options.selectedIndex].text;this.form.auto_complete.select();"
    ));
  ?>
  <ul class="sf_admin_actions">
  <li>
  <?php if (Usuario::tienePermisos('parametros','ver_valor')) : ?>
  <?php echo submit_tag(__('Cambiar'),array("alt"=>__('show'), 'class'=>'sf_admin_action_save')) ?>
  <?php endif; ?>	
  </li>
  <li><span class="help"><?php echo __('Nota: Cambiar el nombre de un parámetro puede alterar su significado') ?></span></li>
 
  </ul>

	</form>

<?php endif; ?>
	
