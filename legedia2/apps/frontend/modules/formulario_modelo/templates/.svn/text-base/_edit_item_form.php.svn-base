<?php echo form_tag('formulario_modelo/edit_item', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($item, 'getIdItemBase') ?>
<?php echo object_input_hidden_tag($item, 'getIdCampo') ?>
<?php if ($tabla != null): ?>
<?php echo object_input_hidden_tag($tabla, 'getIdTabla') ?>
<?php endif; ?>
<?php $campo = $item->getCampo();?>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos del elemento') ?></h2>


<?php if (!$campo->esListaTipoRangos()) : ?>
<div class="form-row">
  <?php echo label_for('item[texto]', __($labels['item{texto}']).":", '') ?>
  <div class="content">
    <?php 
      echo object_input_tag($item, 'getTexto' , array(
        'size' => 60,
        'control_name' => 'item[texto]'));
    ?>
  </div>
</div>

<?php else : ?>
<div class="form-row">
  <?php echo label_for('item[numero_inferior]', __($labels['item{numero_inferior}']).":", '') ?>
  <div class="content">
    <?php 
      echo object_input_tag($item, 'getNumeroInferior' , array(
        'size' => 20,
        'control_name' => 'item[numero_inferior]'));
      echo $campo->getHtmlTipoUnidad() ? "&nbsp;".$campo->getHtmlTipoUnidad() : "";
    ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('item[numero_superior]', __($labels['item{numero_superior}']).":", '') ?>
  <div class="content">
    <?php 
      echo object_input_tag($item, 'getNumeroSuperior' , array(
        'size' => 20,
        'control_name' => 'item[numero_superior]'));
      echo $campo->getHtmlTipoUnidad() ? "&nbsp;".$campo->getHtmlTipoUnidad() : "";
    ?>
  </div>
</div>
<?php endif;?>

<div class="form-row">
  <?php echo label_for('item[ayuda]', __($labels['item{ayuda}']).":", '') ?>
  <div class="content">
    <?php 
      echo object_input_tag($item, 'getPadreAyuda' , array(
        'size' => 60,
        'control_name' => 'item[ayuda]'));
    ?>
  <div class="sf_edit_help"><?php echo __('Puede mostrar un texto de ayuda como este para la comprensión del elemento') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('item[texto_auxiliar]', __($labels['item{texto_auxiliar}']).":", '') ?>
  <div class="content">
    <?php 
      echo object_checkbox_tag($item, 'getTextoAuxiliar' , array(
        'control_name' => 'item[texto_auxiliar]'));
    ?>
  <div class="sf_edit_help"><?php echo __('Active la casilla si quiere que el usuario pueda introducir un texto descriptivo') ?></div>
  </div>
</div>

</fieldset>

<?php include_partial('edit_item_actions', array('item' => $item, 'tabla' => $tabla)) ?>
</form>
