<?php use_helper('Number') ?>
<?php use_helper('DateForm') ?>

<?php echo form_tag('formularios/edit', array(
  'id'        => 'sf_edit_form',
  'name'      => 'sf_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($formulario, 'getIdFormulario') ?>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos del cliente') ?></h2>
<?php if ($formulario->getIdCliente() ) : ?>
<div class="form-row">
  <?php echo label_for('cliente[nombre]', __('nombre completo'), '') ?>
  <div class="content">
    <?php 
      $cliente = $formulario->getCliente();
      echo $cliente ? $cliente : '-';
      echo object_input_hidden_tag($formulario, 'getIdCliente' , array(
        'control_name' => 'formulario[id_cliente]'));
    ?>
  </div>
</div>

<?php else : ?>

<div class="form-row">
  <?php echo label_for('formulario[id_cliente]', __($labels['formulario{id_cliente}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{id_cliente}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{id_cliente}')): ?>
    <?php echo form_error('formulario{id_cliente}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($formulario, 'getIdCliente', array (
  'related_class' => 'Cliente',
  'control_name' => 'formulario[id_cliente]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<?php endif; ?>
</fieldset>

<fieldset id="sf_fieldset_editable" class="">
<h2><?php echo __('Datos de la formulario') ?></h2>

<div class="form-row">
  <?php echo label_for('formulario[fecha]', __($labels['formulario{fecha}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{fecha}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{fecha}')): ?>
    <?php echo form_error('formulario{fecha}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
    <?php $value = object_input_date_tag($formulario, 'getFecha', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/images/icons/date.png',
  'control_name' => 'formulario[fecha]',
),'now'); echo $value ? $value : '&nbsp;' ?>

  
    </div>
</div>


<div class="form-row">
  <?php echo label_for('formulario[vivienda_actual]', __($labels['formulario{vivienda_actual}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{vivienda_actual}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{vivienda_actual}')): ?>
    <?php echo form_error('formulario{vivienda_actual}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php 
    $espacios = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    
    $opciones = array(
      '1' => __('de alquiler') , '2' => __('de su familia') , '3' => __('de su propiedad'));
    $valorSeleccionado = $formulario->getViviendaActual() ? $formulario->getViviendaActual() : '0';
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[vivienda_actual]' , $i , $valorSeleccionado == $i , 'id=formulario_vivienda_actual_'.$i);
      $html .= "<label for=formulario_vivienda_actual_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
    ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[motivos_nueva]', __($labels['formulario{motivos_nueva}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{motivos_nueva}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{motivos_nueva}')): ?>
    <?php echo form_error('formulario{motivos_nueva}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('por acceso a propiedad') , '2' => __('por boda') , '3' => __('por independencia') , 
      '4' => __('por inversión') , '5' => __('por reposición'));
    $valorSeleccionado = $formulario->getMotivosNueva() ? $formulario->getMotivosNueva() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[motivos_nueva]' , $i , $valorSeleccionado == $i , 'id=formulario_motivos_nueva_'.$i);
      $html .= "<label for=formulario_motivos_nueva_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('formulario[zona]', __($labels['formulario{zona}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{zona}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{zona}')): ?>
    <?php echo form_error('formulario{zona}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <ul class="sf_admin_checklist">
  <li><?php $value = object_checkbox_tag($formulario, 'getZonaCentro', array (
  'control_name' => 'formulario[zona_centro]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[zona_centro]', __($labels['formulario{zona_centro}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getZonaSemicentro', array (
  'control_name' => 'formulario[zona_semicentro]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[zona_semicentro]', __($labels['formulario{zona_semicentro}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getZonaPeriferia', array (
  'control_name' => 'formulario[zona_periferia]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[zona_periferia]', __($labels['formulario{zona_periferia}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getZonaOtrasPoblaciones', array (
  'control_name' => 'formulario[zona_otras_poblaciones]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[zona_otras_poblaciones]', __($labels['formulario{zona_otras_poblaciones}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getZonaOtrasZonas', array (
  'control_name' => 'formulario[zona_otras_zonas]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[zona_otras_zonas]', __($labels['formulario{zona_otras_zonas}']), '') ?>
  </li>
  </ul>
  
  </div>
</div>


<div class="form-row">
  <?php echo label_for('formulario[dormitorios]', __($labels['formulario{dormitorios}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{dormitorios}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{dormitorios}')): ?>
    <?php echo form_error('formulario{dormitorios}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <ul class="sf_admin_checklist">
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitorios1', array (
  'control_name' => 'formulario[dormitorios1]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios1]', __($labels['formulario{dormitorios1}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitorios2', array (
  'control_name' => 'formulario[dormitorios2]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios2]', __($labels['formulario{dormitorios2}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitorios3', array (
  'control_name' => 'formulario[dormitorios3]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios3]', __($labels['formulario{dormitorios3}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitorios4', array (
  'control_name' => 'formulario[dormitorios4]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios4]', __($labels['formulario{dormitorios4}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitoriosMasDe4', array (
  'control_name' => 'formulario[dormitorios_mas_de4]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios_mas_de4]', __($labels['formulario{dormitorios_mas_de4}']), '') ?>
  </li>
  <li><?php $value = object_checkbox_tag($formulario, 'getDormitoriosDuplex', array (
  'control_name' => 'formulario[dormitorios_duplex]',
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo label_for('formulario[dormitorios_duplex]', __($labels['formulario{dormitorios_duplex}']), '') ?>
  </li>
  </ul>

  </div>
</div>


<div class="form-row">
  <?php echo label_for('formulario[superficie]', __($labels['formulario{superficie}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{superficie}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{superficie}')): ?>
    <?php echo form_error('formulario{superficie}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php 
    $opciones = array(
      '1' => __('de %1% a %2%' , array('%1%' => 50 , '%2%' => 70)) , 
      '2' => __('de %1% a %2%' , array('%1%' => 70 , '%2%' => 90)) , 
      '3' => __('de %1% a %2%' , array('%1%' => 90 , '%2%' => 110)) , 
      '4' => __('más de %1%' , array('%1%' => 110)) , 
      '5' => __('más de %1%' , array('%1%' => 150)) );
    $valorSeleccionado = $formulario->getSuperficie() ? $formulario->getSuperficie() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[superficie]' , $i , $valorSeleccionado == $i , 'id=formulario_superficie_'.$i);
      $html .= "<label for=formulario_superficie_".$i.">";
      $html .= $opciones[$i]."&nbsp;m&sup2;";
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[precio_puede_pagar]', __($labels['formulario{precio_puede_pagar}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{precio_puede_pagar}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{precio_puede_pagar}')): ?>
    <?php echo form_error('formulario{precio_puede_pagar}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('menos de %1%' , array('%1%' => format_currency(120000,'EUR')) )  , 
      '2' => __('de %1% a %2%' , array('%1%' => format_currency(120000,'EUR') , '%2%' => format_currency(180000,'EUR'))) , 
      '3' => __('de %1% a %2%' , array('%1%' => format_currency(180000,'EUR') , '%2%' => format_currency(240000,'EUR'))) , 
      '4' => __('de %1% a %2%' , array('%1%' => format_currency(240000,'EUR') , '%2%' => format_currency(300000,'EUR'))) , 
      '5' => __('de %1% a %2%' , array('%1%' => format_currency(300000,'EUR') , '%2%' => format_currency(360000,'EUR'))) , 
      '6' => __('de %1% a %2%' , array('%1%' => format_currency(360000,'EUR') , '%2%' => format_currency(420000,'EUR'))) , 
      '7' => __('de %1% a %2%' , array('%1%' => format_currency(420000,'EUR') , '%2%' => format_currency(480000,'EUR'))) , 
      '8' => __('de %1% a %2%' , array('%1%' => format_currency(480000,'EUR') , '%2%' => format_currency(600000,'EUR'))) , 
      '9' => __('más de %1%' , array('%1%' => format_currency(600000,'EUR'))) );
    $valorSeleccionado = $formulario->getPrecioPuedePagar() ? $formulario->getPrecioPuedePagar() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[precio_puede_pagar]' , $i , $valorSeleccionado == $i , 'id=formulario_precio_puede_pagar_'.$i);
      $html .= "<label for=formulario_precio_puede_pagar_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[entrada]', __($labels['formulario{entrada}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{entrada}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{entrada}')): ?>
    <?php echo form_error('formulario{entrada}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('%1% por ciento' , array('%1%' => 5) ) , 
      '2' => __('%1% por ciento' , array('%1%' => 10) ) , 
      '3' => __('%1% por ciento' , array('%1%' => 15) ) , 
      '4' => __('más del %1% por ciento' , array('%1%' => 15)) );
    $valorSeleccionado = $formulario->getEntrada() ? $formulario->getEntrada() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[entrada]' , $i , $valorSeleccionado == $i , 'id=formulario_entrada_'.$i);
      $html .= "<label for=formulario_entrada_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[cuota]', __($labels['formulario{cuota}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{cuota}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{cuota}')): ?>
    <?php echo form_error('formulario{cuota}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php 
    $opciones = array(
      '1' => __('menos de %1%' , array('%1%' => format_currency(300,'EUR')) )  , 
      '2' => __('de %1% a %2%' , array('%1%' => format_currency(300,'EUR') , '%2%' => format_currency(600,'EUR'))) ,
      '3' => __('de %1% a %2%' , array('%1%' => format_currency(600,'EUR') , '%2%' => format_currency(900,'EUR'))) , 
      '4' => __('de %1% a %2%' , array('%1%' => format_currency(900,'EUR') , '%2%' => format_currency(1200,'EUR'))) , 
      '5' => __('más de %1%' , array('%1%' => format_currency(1200,'EUR'))) );
    $valorSeleccionado = $formulario->getCuota() ? $formulario->getCuota() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[cuota]' , $i , $valorSeleccionado == $i , 'id=formulario_cuota_'.$i);
      $html .= "<label for=formulario_cuota_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[medios]', __($labels['formulario{medios}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{medios}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{medios}')): ?>
    <?php echo form_error('formulario{medios}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('amigos') , '2' => __('folleto') , '3' => __('prensa') , 
      '4' => __('publicaciones inmobiliarias') , '5' => __('radio') , '6' => __('visita obra') , 
      '7' => __('valla') , '8' => __('otros'));
    $valorSeleccionado = $formulario->getMedios() ? $formulario->getMedios() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[medios]' , $i , $valorSeleccionado == $i , 'id=formulario_medios_'.$i);
      $html .= "<label for=formulario_medios_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "<li>";
    $html .= label_for('formulario[medios_otros]', __($labels['formulario{medios_otros}']), '');
    $value = object_input_tag($formulario, 'getMediosOtros', array (
      'size' => 60,
      'control_name' => 'formulario[medios_otros]',
    ));
    $html .= $value ? $value : "";
    $html .= "</li>";
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[edad]', __($labels['formulario{edad}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{edad}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{edad}')): ?>
    <?php echo form_error('formulario{edad}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('menos de %1%' , array('%1%' => 20) )  , 
      '2' => __('de %1% a %2%' , array('%1%' => 20 , '%2%' => 30)) ,
      '3' => __('de %1% a %2%' , array('%1%' => 30 , '%2%' => 40)) , 
      '4' => __('de %1% a %2%' , array('%1%' => 40 , '%2%' => 50)) , 
      '5' => __('de %1% a %2%' , array('%1%' => 50 , '%2%' => 60)) , 
      '6' => __('más de %1%' , array('%1%' => 60)) );
    $valorSeleccionado = $formulario->getEdad() ? $formulario->getEdad() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[edad]' , $i , $valorSeleccionado == $i , 'id=formulario_edad_'.$i);
      $html .= "<label for=formulario_edad_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[sexo]', __($labels['formulario{sexo}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{sexo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{sexo}')): ?>
    <?php echo form_error('formulario{sexo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array('1' => __('hombre') , '2' => __('mujer'));
    $valorSeleccionado = $formulario->getSexo() ? $formulario->getSexo() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[sexo]' , $i , $valorSeleccionado == $i , 'id=formulario_sexo_'.$i);
      $html .= "<label for=formulario_sexo_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[estado_civil]', __($labels['formulario{estado_civil}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{estado_civil}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{estado_civil}')): ?>
    <?php echo form_error('formulario{estado_civil}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('casado/a') , '2' => __('pareja') , '3' => __('divorciado/a') , 
      '4' => __('soltero/a') , '5' => __('viudo/a'));
    $valorSeleccionado = $formulario->getEstadoCivil() ? $formulario->getEstadoCivil() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[estado_civil]' , $i , $valorSeleccionado == $i , 'id=formulario_estado_civil_'.$i);
      $html .= "<label for=formulario_estado_civil_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[unidad_familiar]', __($labels['formulario{unidad_familiar}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{unidad_familiar}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{unidad_familiar}')): ?>
    <?php echo form_error('formulario{unidad_familiar}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $valorSeleccionado = $formulario->getUnidadFamiliar() ? $formulario->getUnidadFamiliar() : '0';
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[unidad_familiar]' , $i , $valorSeleccionado == $i , 'id=formulario_unidad_familiar_'.$i);
      $html .= "<label for=formulario_unidad_familiar_".$i.">";
      $html .= format_number_choice('[1] 1 persona|(1,4] %1% personas|(4,+Inf] más de 4 personas' , array('%1%' => $i), $i);
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>


<div class="form-row">
  <?php echo label_for('formulario[entrega]', __($labels['formulario{entrega}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{entrega}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{entrega}')): ?>
    <?php echo form_error('formulario{entrega}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $cuatrimestres = array('1' => __('primer cuatrimestre') , '2' => __('segundo cuatrimestre') , 
      '3' => __('tercer cuatrimestre') , '4' => __('cuarto cuatrimestre'));
    $value = select_tag('formulario[entrega_cuatrimestre]', options_for_select($cuatrimestres, $formulario->getEntregaCuatrimestre(), array ('include_blank' => true,)), array () );
    echo $value ? $value : '&nbsp;';
    $anyo = $formulario->getEntregaAnio() ? $formulario->getEntregaAnio() : '';
    $selectAnyo = select_year_tag('formulario[entrega_anio]' , $anyo , array('year_start' => 2007 , 'year_end' => 2015 , 'include_blank' => 'true'));
    echo $selectAnyo ? $selectAnyo : '&nbsp;';
  ?>
    </div>
</div>




<div class="form-row">
  <?php echo label_for('formulario[interesa_cualquier_tabla]', __($labels['formulario{interesa_cualquier_tabla}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{interesa_cualquier_tabla}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{interesa_cualquier_tabla}')): ?>
    <?php echo form_error('formulario{interesa_cualquier_tabla}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($formulario, 'getInteresaCualquierTabla', array (
  'control_name' => 'formulario[interesa_cualquier_tabla]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Marque si le interesa cualquier fuente de datos') ?></div>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[especial]', __($labels['formulario{especial}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{especial}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{especial}')): ?>
    <?php echo form_error('formulario{especial}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_checkbox_tag($formulario, 'getEspecial', array (
  'control_name' => 'formulario[especial]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Marque si es un cliente especial') ?></div>
  <?php $value = object_textarea_tag($formulario, 'getEspecialDescripcion', array (
  'size' => '50x3',
  'control_name' => 'formulario[especial_descripcion]',
)); echo $value ? $value : '&nbsp;' ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[comentario]', __($labels['formulario{comentario}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{comentario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{comentario}')): ?>
    <?php echo form_error('formulario{comentario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($formulario, 'getComentario', array (
  'size' => '50x3',
  'control_name' => 'formulario[comentario]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('formulario[estado_interes]', __($labels['formulario{estado_interes}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('formulario{estado_interes}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('formulario{estado_interes}')): ?>
    <?php echo form_error('formulario{vendido}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  
  <?php
    $opciones = array(
      '1' => __('poco interesado') , '2' => __('muy interesado') , 
      '3' => __('reservado') , '4' => __('vendido'));
    $valorSeleccionado = $formulario->getEstadoInteres() ? $formulario->getEstadoInteres() : '0';
    
    $html = "";
    $html .= "<ul class=\"sf_admin_checklist\">\n";
    for($i=1;$i<=count($opciones);$i++){
      $html .= "<li>";
      $html .= radiobutton_tag('formulario[estado_interes]' , $i , $valorSeleccionado == $i , 'id=formulario_estado_interes_'.$i);
      $html .= "<label for=formulario_estado_interes_".$i.">";
      $html .= $opciones[$i];
      $html .= "</label>";
      $html .= "</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('formulario' => $formulario)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($formulario->getIdFormulario()): ?>
<?php echo button_to(__('Borrar'), 'formularios/delete?id_formulario='.$formulario->getIdFormulario(), array (
  'post' => true,
  'confirm' => __('¿Desea borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
</ul>
