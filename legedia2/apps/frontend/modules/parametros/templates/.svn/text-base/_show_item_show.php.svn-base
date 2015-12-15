<?php if ($parametro->getPrimaryKey()) : ?>

<?php use_helper('Date'); ?>

<fieldset id="fieldset_parametro">
<legend><?php echo __('Ver elemento')?></legend>

<?php // ###### NOMBRE #########################################################
  if ($parametro_def->getCampoNombre()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[nombre]', $parametro_def->getCampoNombre(), 'class="required" '); ?>
  <div class="content"><?php 
    $value = $parametro->getNombre();
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### NUMERO #########################################################
  if ($parametro_def->getCampoNumero()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[numero]', $parametro_def->getCampoNumero(), 'class="" '); ?>
  <div class="content"><?php 
    $value= $parametro->getNumero();
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### NUMERO 2 #######################################################
  if ($parametro_def->getCampoNumero2()) : ?>
<div class="form-row">
  <?php echo label_for('parametro[numero2]', $parametro_def->getCampoNumero2(), 'class="" '); ?>
  <div class="content"><?php 
    $value = $parametro->getNumero2();
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### SI / NO ########################################################
  if ($parametro_def->getCampoSiNo() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[si_no]', $parametro_def->getCampoSiNo(), 'class="" '); ?>
  <div class="content"><?php 
      $value = $parametro->getSiNo() ? 
        image_tag('/images/icons/tick.png', array('alt' => __('si'), 'title' => __('si'))) : 
        image_tag('/images/icons/cross.png', array('alt' => __('no'), 'title' => __('no')));
      echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### FECHA ##########################################################
  if ($parametro_def->getCampoFecha() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[fecha]', $parametro_def->getCampoFecha(), 'class="" '); ?>
  <div class="content"><?php 
    $value= format_date($parametro->getFecha(), 'P');
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### CADENA #########################################################
  if ($parametro_def->getCampoCadena() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[cadena]', $parametro_def->getCampoCadena(), 'class="" '); ?>
  <div class="content"><?php 
    $value = $parametro->getCadena();
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### CADENA 1 #######################################################
  if ($parametro_def->getCampoCadena1() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[cadena1]', $parametro_def->getCampoCadena1(), 'class="" '); ?>
  <div class="content"><?php 
    $value = $parametro->getCadena1();
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### FICHERO ########################################################
  if ($parametro_def->getCampoFichero() != "") : ?>
<div class="form-row">
  <?php echo label_for('parametro[fichero]', $parametro_def->getCampoFichero(), 'class="" '); ?>
  <div class="content"><?php 
    $value = "";
    if ($parametro->getFichero())
    {
      $nombre = $parametro->getNombreFichero() ? $parametro->getNombreFichero() : __('Sin nombre');
      
      $value .= link_to( $nombre ? $nombre : "&mdash;", "parametros/download?item=".$parametro->getPrimaryKey());
      $value .= " (".$parametro->getFormatedFileSizeFichero().")";
    }
    else
    {
      $value .= __('Todavía no se ha definido un archivo');
    }
    echo $value ? $value : '&mdash;';
  ?></div>
</div>
<?php endif; ?>

<?php // ###### MULTIIDIOMA ####################################################
?>
<?php // ###### OTROOBJETO #####################################################
?>

</fieldset>
<?php endif; ?>

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Volver a la lista'), 'parametros/list', array(
      'class' => 'sf_admin_action_list',
    ))?></li>
</ul>

