<?php if (!$campo->esTipoLista()) : ?>

<?php $item = $campo->getElementoUnico();?>
<?php echo form_tag('formulario_modelo/edit_item', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>
<?php echo object_input_hidden_tag($item, 'getIdItemBase') ?>
<?php echo object_input_hidden_tag($item, 'getIdCampo') ?>
<?php echo object_input_hidden_tag($tabla, 'getIdTabla') ?>

<fieldset id="sf_fieldset_simple" class="">
<h2><?php echo __('Características', array()) ?></h2>
<div class="form-row">
  <?php echo label_for('item[ayuda]', __($labels['item{ayuda}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('item{ayuda}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('item{ayuda}')): ?>
    <?php echo form_error('item{ayuda}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $value = textarea_tag('item[ayuda]' , $item->getAyuda() , array(
      'size' => "60x3",
      'control_name' => 'item[ayuda]',
      'rich'=>true,
    ));
    echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Texto de ayuda. Déjelo vacío para que no aparezca.') ?></div>
  </div>
</div>
</fieldset>

<?php else : ?>

<?php 
  $items = $campo->getItemsBaseOrdenados();
?>
<?php if (!sizeof($items)) : ?>
<blockquote class="warning"><p>
<?php echo __('No hay resultados') ?>
</p></blockquote>
<?php else : ?>
<?php include_partial('show_campo_items_list' , array('items' => $items , 'labels' => $labels, 'tabla' => $tabla)); ?>
<?php endif ; ?>

<?php endif ; ?>

<?php include_partial('show_campo_items_actions' , array('campo' => $campo, 'tabla' => $tabla));?>

<?php if (!$campo->esTipoLista()) : ?>
</form>
<?php endif ; ?>

