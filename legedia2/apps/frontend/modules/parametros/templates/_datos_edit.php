<?php use_helper('I18N','Javascript','Object','Number') ?>
<?php echo include_partial('parametros/mensajes') ?>


<?php 
  include_partial('datos_edit_titulo', array(
    'DefParametro' => $DefParametro, 
    'parametro' => $parametro, 
    'nuevo' => $nuevo
  )); 
?>

<?php if ($DefParametro->getCampoFichero() != "") : ?>

  <?php echo form_tag('parametros/guardar_valor', array('ENCTYPE'=>"multipart/form-data" , 'method'=>'post', 'id'=>'formulario_guardar')) ?>
<?php else : ?>
<?php echo form_remote_tag(array(
	'url'		=> 'parametros/guardar_valor',
	'update'	=> 'datos_parametro',
	'script'=>'true',
	'complete'	=> enlaceACargarParametros($DefParametro)
),'id=formulario_guardar') ?>
<?php endif; ?>




<?php if ($DefParametro->getCampoNombre()!="") : ?>
<div class="form-row clear">  
  <?php echo label_for('nombre', __($DefParametro->getCampoNombre())) ?>
  <div class="row-data">  
  <?php echo object_input_tag($parametro,'getNombre','size=40') ?>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCampoNumero()!="") : ?>
<div class="form-row"> 
	<?php echo label_for('numero', __($DefParametro->getCampoNumero())) ?>
	 <div class="row-data">  
	<?php echo object_input_tag($parametro,'getNumero','size=8') ?>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCampoNumero2()!="") : ?>
<div class="form-row"> 
<?php echo label_for('numero2', __($DefParametro->getCampoNumero2())) ?>
 <div class="row-data"> 	
	<?php echo object_input_tag($parametro,'getNumero2','size=8') ?>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCampoCadena()!="") : ?>
<?php $vals = explode("##",$DefParametro->getCampoCadena());  if (!isset($vals[1])) $vals[1] = 0; ?>
<table class="form"><?php /* Rober 21-01-09 */?>
<tr>
  <th class="col1">
  	<?php echo label_for('cadena', __($vals[0])) ?>
  </th>
	<td class="fullrow" colspan="3">
    <?php echo textarea_tag('cadena',$parametro->getCadena(), array('size'=>'50x15', 'class' => 'full')) ?>
  </td>
  <?php if($vals[1]==1) : ?>
  <script language="Javascript">tinyMCE.idCounter = 0; tinyMCE.execCommand( 'mceAddControl', true, "cadena");</script>
  <?php endif; ?>
</tr>
</table>
<?php endif; ?>


<?php if ($DefParametro->getCampoCadena1()!="") : ?>
<?php $vals = explode("##",$DefParametro->getCampoCadena1()); if (!isset($vals[1])) $vals[1] = 0; ?>
<div class="form-row">
	<?php echo label_for('cadena1', __($vals[0])) ?>
	<div class="row-data">
	<?php echo textarea_tag('cadena1',$parametro->getCadena1(), array('size'=>'80x15','rich'=>($vals[1]==1))) ?>
  </div>
</div>
<?php if($vals[1]==1) : ?>
<script language="Javascript">tinyMCE.idCounter = 0; tinyMCE.execCommand( 'mceAddControl', true, "cadena1");</script>
<?php endif; ?>
<?php endif; ?>


<?php if ($DefParametro->getCampoCadenaMultiIdioma()!="") : ?>
<div class="form-row">
	<?php echo label_for('cadena1', __($DefParametro->getCampoCadenaMultiIdioma()))?>
		<div class="row-data">
		<table cellspacing="0" cellpadding="0" border="0"  style="background: #FFFFFF">
		<?php foreach ($idiomas as $tidioma) : ?>
			<tr>
				<td>
					<input type="hidden" name="idiomas[]" id="idiomas" value="<?php echo $tidioma->getIdidioma() ?>">
					<?php $parametro->setCulture($tidioma->getIdidioma()) ?>
					<?php echo $tidioma->getNombre() ?>
				</td>
				<td><textarea name="cadenaMultiIdioma[]" id="cadenaMultiIdioma"><?php echo $parametro->getCadenamultiidioma() ?></textarea>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCampoOtroObjeto()!="") : ?>
<?php
	$valoresObjeto=explode('#',$DefParametro->getCampoOtroObjeto());
	eval(trim($valoresObjeto[1]));
?>
<div class="form-row">
	<?php echo label_for('otroObjeto', __(trim($valoresObjeto[0]))) ?>
	<div class="row-data">
	<?php 
	  $objects_for_select = objects_for_select(
	    $valorObjeto ,
	    trim($valoresObjeto[2]),
	    trim($valoresObjeto[3]),
	    $parametro->getOtroobjeto()
	  );
	  echo select_tag('otroObjeto',$objects_for_select, array('style' => 'auto')) ?>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCamposino()!="") : ?>
<div class="form-row">
	<?php echo label_for('sino', __($DefParametro->getCamposino())) ?>
	<div class="row-data">
		<?php echo object_checkbox_tag($parametro,'getSino') ?>
  </div>
</div>
<?php endif; ?>
<?php if ($DefParametro->getCampoFecha()!="") : ?>
<div class="form-row">
	<?php echo label_for('fecha', __($DefParametro->getCampoFecha())) ?>
	<div class="row-data">
		<?php echo object_input_date_tag($parametro,'getFecha',"rich=true calendar_button_img=calendar_button_img") ?>
  </div>
</div>
<?php endif; ?>


<?php if ($DefParametro->getCampoFichero()!="") : ?>
<div class="form-row">
	<?php echo label_for('nombrefichero', __($DefParametro->getCampoFichero())) ?>
	<div class="row-data">
	    <?php echo input_file_tag('nombrefichero', 0) ?><br />
      <?php if (!$parametro->getTamano()) : ?>
          <font class='error'><?php echo __('No hay fichero definido') ?></font>
      <?php else : ?>
          <?php  echo link_to($parametro->getNombrefichero(),'parametros/bajar?idparametro='.$parametro->getIdparametro() ,
                              'onclick="descargar_fichero = true;setTimeout (\'descargar_fichero = false\',1000);" ')?>
        <?php if ($parametro->getTamano() < 1000) : ?>
          (<?php echo format_number($parametro->getTamano()) ?> B)
        <?php else :?>
          (<?php echo format_number( round($parametro->getTamano()/1000,2) )?> KB)
        <?php endif ; ?>
      <?php endif ; ?>
  </div>
</div>
<?php endif; ?>

<?php include_partial('datos_edit_actions', array('DefParametro' => $DefParametro, 'parametro' => $parametro, 'nuevo' => $nuevo)) ?>


</form>


<?php
function enlaceACargarParametros($DefParametro){
	$tipo_paramatros=$DefParametro->getTipoParametro();
	if ($DefParametro->getEslista()) $eslista="true";
	else $eslista="false";
	
	return "cargarParametros('$tipo_paramatros',$eslista);";
}
?>
<?php 
//</div>
//</div>
?>

</fieldset>
