<?php
// auto-generated by sfAdvancedAdmin
// date: 2008/01/10 11:37:55
?>
<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos') ?></h2>


<div class="form-row">
  <?php echo label_for('log_sesion[id_log]', __($labels['log_sesion{id_log}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getIdLog(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[id_sesion]', __($labels['log_sesion{id_sesion}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getIdSesion(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[fecha]', __($labels['log_sesion{fecha}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = ($log_sesion->getFecha() !== null && $log_sesion->getFecha() !== '') ? format_date($log_sesion->getFecha(), "dd/MM/yyyy HH:mm") : ''; echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[url]', __($labels['log_sesion{url}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getURL(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>
<fieldset id="sf_fieldset_otros_datos" class="">
<h2><?php echo __('Otros Datos') ?></h2>


<div class="form-row">
  <?php echo label_for('log_sesion[modulo]', __($labels['log_sesion{modulo}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getModulo(); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('Módulo') ?></div>  </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[accion]', __($labels['log_sesion{accion}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getAccion(); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('Acción') ?></div>  </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[parametros]', __($labels['log_sesion{parametros}']), 'class="required" ') ?>
  <div class="content">
  <?php /*$value = $log_sesion->getParametros(); echo $value ? $value : '&nbsp;' */?>

   <?php    
	$log_sesion->cadena2array();   
   foreach ($log_sesion->getParamsarray() as $tclave=>$tvalor) : ?>
            
				<?if ($tvalor!="" && $tvalor!="Array") : ?>
				<font style="font-weight:bold;"><?php echo strtoupper(str_replace('_',' ',$tclave)) ?></font>: <?php echo $tvalor ?><br/>
				<?php endif; ?>
			<?php endforeach; ?>


  <div class="sf_admin_edit_help"><?php echo __('Parámetros') ?></div>  </div>
</div>

<div class="form-row">
  <?php echo label_for('log_sesion[mensaje]', __($labels['log_sesion{mensaje}']), 'class="required" ') ?>
  <div class="content">
  <?php $value = $log_sesion->getMensaje(); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_admin_edit_help"><?php echo __('Mensaje') ?></div>  </div>
</div>

</fieldset>

<?php include_partial('show_actions', array('log_sesion' => $log_sesion)) ?>
