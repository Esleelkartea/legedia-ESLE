<?php use_helper('Javascript')?>
<div class="sf_admin_filters">
<?php echo form_tag('empresas/upload_logo', array(
  'multipart' => true
));?>

<?php echo object_input_hidden_tag($empresa, 'getIdEmpresa') ?>

<fieldset id="logo" class="accesos_directos">
  <h2><?php echo __('Logo') ?></h2>
  
  <div class="form-row">
    <?php
      //$imagen_ok = false;
      $imagen_ok = ($empresa->getLogoMed()) ? true : false;
      
    ?>
    <?php if (!$imagen_ok) : ?>
    <blockquote class="warning"><p>
      <?php echo link_to_function( __('No hay logo definido'), visual_effect('toggle_appear' , 'formulario_imagen')); ?>
    </p></blockquote>
    <?php else : ?>
    <?php 

      
      $image_tag = image_tag($empresa->getUrlLogoMed() , array(
        'alt' => __('Logotipo') , 'title' => __('Logotipo') , //'absolute' => true
      ));
      $value = link_to_function( $image_tag, visual_effect('toggle_appear' , 'formulario_imagen') );
      echo $value ? $value : '-';
    ?>
    <?php endif; ?>
    <div class="sf_edit_help"></div>
  </div>
  
  <div class="form-row" id="formulario_imagen" <?php if (!$sf_request->hasError('imagen')):?>style="display:none;"<?php endif;?> >
    <div class="<?php if ($sf_request->hasError('imagen')): ?>form-error<?php endif; ?>">
      <?php if ($sf_request->hasError('imagen')): ?>
      <?php echo form_error('imagen', array('class' => 'form-error-msg')) ?>
      <?php endif; ?>
      <?php echo input_file_tag('imagen');?>
      <div class="sf_edit_help"><?php echo __('Seleccione el logotipo de la empresa') ?></div>
    <ul class="sf_admin_actions">
    <li><?php echo submit_tag(__('Guardar'), array (
        'name' => 'save_and_show',
        'class' => 'sf_admin_action_save',
      ));?></li>
    </ul>
    </div>
    
  </div>
  
</fieldset>

</form>
</div>
