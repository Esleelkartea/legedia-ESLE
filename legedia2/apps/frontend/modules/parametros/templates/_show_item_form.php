<?php 
  $form_options = array(
    'id'        => 'sf_admin_edit_form',
    'name'      => 'sf_admin_edit_form',
    'multipart' => true,
  );
  if ($parametro_def->getCampoFichero())
  {
    $form_options['enctype'] = "multipart/form-data";
  }
  
  echo form_tag('parametros/edit_item', $form_options);
?>

<fieldset id="fieldset_parametro">
<legend><?php 
  if (!$parametro_def->getEsLista())
  {
    $value = __('Editar valor');
  }
  else
  {
    $value = $parametro->getPrimaryKey() ? __('Editar elemento') : __('Crear nuevo elemento');
  }
  echo $value ? $value : "&mdash;";
?></legend>


<?php
  echo input_hidden_tag('id', $parametro->getTipoParametro());
  echo input_hidden_tag('item', $parametro->getPrimaryKey()); 
?>

<?php // ###### NOMBRE #########################################################
  if ($parametro_def->getCampoNombre()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[nombre]', $parametro_def->getCampoNombre(), 'class="required" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{nombre}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{nombre}')): ?>
      <?php echo form_error('parametro{nombre}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value = input_tag('parametro[nombre]', $parametro->getNombre(), array('size' => 30));
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### NUMERO #########################################################
  if ($parametro_def->getCampoNumero()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[numero]', $parametro_def->getCampoNumero(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{numero}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{numero}')): ?>
      <?php echo form_error('parametro{numero}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value= input_tag('parametro[numero]', $parametro->getNumero(), array('size' => 6));
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### NUMERO 2 #######################################################
  if ($parametro_def->getCampoNumero2()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[numero2]', $parametro_def->getCampoNumero2(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{numero2}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{numero2}')): ?>
      <?php echo form_error('parametro{numero2}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value= input_tag('parametro[numero2]', $parametro->getNumero2(), array('size' => 6));
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### SI / NO ########################################################
  if ($parametro_def->getCampoSiNo() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[si_no]', $parametro_def->getCampoSiNo(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{si_no}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{si_no}')): ?>
      <?php echo form_error('parametro{si_no}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value= select_tag('parametro[si_no]', options_for_select(array(0 => __('No'), 1 => __('Si')), $parametro->getSiNo()) );
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### FECHA ##########################################################
  if ($parametro_def->getCampoFecha() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[fecha]', $parametro_def->getCampoFecha(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{fecha}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{fecha}')): ?>
      <?php echo form_error('parametro{fecha}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value= input_date_tag('parametro[fecha]', $parametro->getFecha(), array('rich' => true));
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### CADENA #########################################################
  if ($parametro_def->getCampoCadena() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[cadena]', $parametro_def->getCampoCadena(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{cadena}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{cadena}')): ?>
      <?php echo form_error('parametro{cadena}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      //echo "<p id=\"p_pc\">";
      $value = textarea_tag('parametro[cadena]', $parametro->getCadena(), array('size' => "30x3"));
      echo $value ? $value : '&nbsp;';
      //echo javascript_tag("addWikiFormattingToolbar(document.getElementById('parametro_cadena'));");
      //echo "</p>";
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### CADENA 1 #######################################################
  if ($parametro_def->getCampoCadena1() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[cadena1]', $parametro_def->getCampoCadena1(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{cadena1}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{cadena1}')): ?>
      <?php echo form_error('parametro{cadena1}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value = textarea_tag('parametro[cadena1]', $parametro->getCadena1(), array('size' => "30x3"));
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### FICHERO #######################################################
  if ($parametro_def->getCampoFichero() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[fichero]', $parametro_def->getCampoFichero(), 'class="" '); ?>
  <div class="content<?php if ($sf_request->hasError('parametro{fichero}')): ?> form-error<?php endif; ?>">
    <?php if ($sf_request->hasError('parametro{fichero}')): ?>
      <?php echo form_error('parametro{fichero}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>
    <?php 
      $value = input_file_tag('parametro[fichero]', "", array('size' => "30"));
      if ($parametro->getFichero())
      {
        $value .= "<br />";
        $nombre = $parametro->getNombreFichero() ? $parametro->getNombreFichero() : __('Sin nombre');
        $value .= link_to( $nombre ? $nombre : "&mdash;", "parametros/download?item=".$parametro->getPrimaryKey());
        $value .= " (".$parametro->getFormatedFileSizeFichero().")";
      }
      else
      {
        $value .= "<br />";
        $value .= __('Todavía no se ha definido un archivo');
      }
      echo $value ? $value : '&nbsp;';
    ?>
  </div>
</div>
<?php endif; ?>

<?php // ###### MULTIIDIOMA ####################################################
?>
<?php // ###### OTROOBJETO #####################################################
?>


</fieldset>




<ul class="sf_admin_actions">
  <?php if (!$parametro_def->getEsLista()) : ?>
    <li><?php echo submit_tag(__('Guardar')."...", array(
      'name'  => 'save',
      'class' => 'sf_admin_action_save',
      'confirm' => __('¿Desa guardar el elemento?'),
    ))?></li>
  <?php else : ?>
    <li><?php 
      $opciones = array(
        'name' => 'save',
        'class' => 'sf_admin_action_save',
        'confirm' => __('¿Desa guardar el elemento?'),
      );
      echo submit_tag(__('Guardar')."...", $opciones);
    ?></li>
    <?php if ($parametro->getPrimaryKey()) : ?>
    <li><?php echo submit_tag(__('Guardar como nuevo')."...", array(
      'name'  => 'save_as_new',
      'class' => 'sf_admin_action_create',
      'confirm' => __('¿Desa guardarlo como un nuevo elemento?'),
    ))?></li>
    <?php endif; ?>
  <?php endif;?>
  <li><?php echo button_to(__('Volver a la lista'), 'parametros/list', array(
      'class' => 'sf_admin_action_list',
    ))?></li>
</ul>
</form>


