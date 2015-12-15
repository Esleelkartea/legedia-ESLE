<?php
  $modulo = $sf_context->getModuleName();
  $accion = $sf_context->getActionName();
?>
<div class="sf_admin_filters">
<fieldset id="content_menu">
  <h2><?php echo __('Información') ?></h2>
  <div class="form-row">
    <ul class="content_menu">
      <li class="icon_information"><?php echo link_to(__('Acerca de') , 'content/about' , 
        array('class' => ($accion == "about")? "current" : ""))?></li>
      <!--<li class="icon_help">Preguntas mas frecuentes</li>-->
    </ul>
  </div>
  
  <h2><?php echo __('Contacto') ?></h2>
  <div class="form-row">
    <ul class="content_menu">
      <li class="icon_neofis"><?php echo link_to('www.seinale.com' , 'http://seinale.com')?></li>
      <li class="icon_email"><?php echo mail_to('info@seinale.com' , 'info@seinale.com' , 'encode=true')?></li>
    </ul>
  </div>
  
  <h2><?php echo __('Aplicación') ?></h2>
  <div class="form-row">
    <ul class="content_menu">
      <li class="icon_version"><?php echo __('Versión %1%' , array('%1%' => sfConfig::get('app_general_version'))) ?></li>
      <?php /*
      <li class="icon_bug"><?php echo link_to(__('Informe acerca de un fallo') , 'content/bugreport' ,
        array('class' => ($accion == "bugreport")? "current" : ""))?></li>
      <li class="icon_terms">Terminos de uso</li>
      <li class="icon_privacy">Politica de privacidad</li>
      <li class="icon_terms">Licencia</li>
       * */ ?>
    </ul>
  </div>
  
</fieldset>
</div>
