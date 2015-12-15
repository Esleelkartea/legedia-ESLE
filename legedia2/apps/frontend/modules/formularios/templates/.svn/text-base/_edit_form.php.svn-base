<?php 
  $tabla = $formulario->getTabla();
  $empresa = $tabla->getEmpresa();
  /*$campos = $tabla->getCamposFormularioEmpresaTabla();*/$campos = $empresa->getCamposFormularioOrdenadosAlcancetablas($formulario->getIdtabla());
  $items_formulario = $formulario->getArrayItems();//todos los campos, generales o no. ?>
<script language="JavaScript">
jQuery(document).ready(function() {
    jQuery(".form-row").each(function() {
        jQuery(this).css({'border-bottom': '0px'});
        jQuery(this).css({'padding': '5px'});
    });
    jQuery("#sf_edit_form").submit(function() {
        var submit = true;<?php
        foreach ($campos as $campo) {
            if (!$campo->getBorrado()) {
                if ($campo->getObligatorio()) {
                    $item_base = $campo->getElementoUnico();
                    $control_name = "campo_". $campo->getIdCampo() . "_item_base_".$item_base->getIdItemBase();
                    if ($campo->esTipoTextoLargo() || $campo->esTipoTextoCorto() || $campo->esTipoNumero() || $campo->esTipoFecha()) { ?>
                        var campo = document.getElementById('<?php echo $control_name; ?>');
                        if (trim(campo.value) == '') {
                            submit = false;
                            alert('<?php echo __("No ha introducido ningun dato para el campo \'%1%\'", array("\'%1%\'" => $campo->getNombre())); ?>');
                            campo.focus();
                            campo.select();
                            return false;
                        }<?php
                    }
                    if ($campo->esTipoTabla() || $campo->esTipoObjeto()) { ?>
                        var campo = document.getElementById('<?php echo $control_name; ?>');
                        if (campo.options[campo.selectedIndex].value == '') {
                            submit = false;
                            alert('<?php echo __("No ha seleccionado ningun dato para el campo \'%1%\'", array("\'%1%\'" => $campo->getNombre())); ?>');
                            campo.focus();
                            return false;
                        }<?php
                    }
                    if ($campo->esTipoLista()) {
                        $item_bases = $campo->getItemBases(); ?>
                        var seleccionado = false;<?php
                        foreach ($item_bases as $item_base_t) {
                            $control_temp_name = "campo_". $campo->getIdCampo() . "_item_base_".$item_base_t->getIdItemBase(); ?>
                            seleccionado = (seleccionado || document.getElementById('<?php echo $control_temp_name; ?>').checked);<?php
                        } ?>
                        if (!seleccionado) {
                            submit = false;
                            alert('<?php echo __("No ha seleccionado ningun dato para el campo \'%1%\'", array("\'%1%\'" => $campo->getNombre())); ?>');
                            campo.focus();
                            return false;
                        }<?php
                    }
                    if ($campo->esTipoNumero()) { ?>
                        var campo = document.getElementById('<?php echo $control_name; ?>');
                        if (!/^([0-9])*$/.test(trim(campo.value))) {
                            submit = false;
                            alert('<?php echo __("El valor del campo \'%1%\' no es un número", array("\'%1%\'" => $campo->getNombre())); ?>');
                            campo.focus();
                            campo.select();
                            return false;
                        }<?php
                    }
                }
            }
        } ?>
        if (!submit) {
            return false;
        }
    });
});


</script><?php

echo form_tag('formularios/edit', array(
  'id' => 'sf_edit_form',
  'name' => 'sf_edit_form',
  'multipart' => true
)) ?>

<?php echo input_hidden_tag("id_formulario_proviene", $id_formulario_proviene) ?>
<?php echo input_hidden_tag("id_tabla_proviene", $id_tabla_proviene) ?>
<?php echo object_input_hidden_tag($formulario, 'getIdFormulario') ?>
<?php echo object_input_hidden_tag($formulario, 'getIdTabla') ?>

<fieldset id="sf_fieldset_campos" >
<!--<h2><?php //echo __('Campos') ?></h2>-->

<?php $cerrado = true; ?>
<?php foreach ($campos as $indice=>$campo) : ?>
<?php if (!$campo->getBorrado()) : ?>

<?php
//MIRAR SI VIENE DE MISMA FILA
if ($cerrado) echo "<div class=\"form-row\">";
else echo "&nbsp;&nbsp;";

//CALCULAR LA QUE VIENE
if (isset($campos[$indice+1])){
  if (!$campos[$indice+1]->getMismaFila()) {
    $cerrado_futura = true;
  }else $cerrado_futura = false;
}
else {
  $cerrado_futura = true;
}
?>

<?php
  $value = "";
  $campo_name = "campo_".$campo->getIdCampo();
  
  if (!$campo->esTipoLista())
  {
    //el campo tiene un unico item
    $item_base = $campo->getElementoUnico();
    $control_name = $campo_name . "[item_base_".$item_base->getIdItemBase()."]";
    if ($campo->getEsCodAgencia()) echo "<script lang='Javascript'>input_cod_agencia = '".$campo_name."_item_base_".$item_base->getIdItemBase()."'</script>";
     
    if ($campo->__toString() != "") $value = label_for($control_name, __($campo->__toString()).":", '');
    else $value = "";
    
    if ($cerrado) $value .= "<div class=\"content\">";
    
    $valor = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
    if ($campo->esTipoTextoLargo())
    {  
      if ($campo->getTamano() != null && $campo->getTamano() != "") $tamano = $campo->getTamano();
      else $tamano = '50x3';
      $value .= textarea_tag($control_name , ($valor ? $valor->getTextoLargo() : $campo->getDefecto()) , array('control_name' => $control_name , 'size' => $tamano));
    }
    elseif($campo->esTipoBooleano())
    {
      $value .= checkbox_tag($control_name , ($valor ? $valor->getSiNo() : $campo->getDefecto()) , ($valor ? $valor->getSiNo() : $campo->getDefecto()), array());
    }
    elseif ($campo->esTipoSelectPeriodo())
    {
      $value .= select_periodo_meses($control_name , ($valor)?$valor->getNumero():'' , $campo->getTipoPeriodo());
      $control_name_anio = $campo_name . "[item_base_year_".$item_base->getIdItemBase()."]";
      $value .= select_year_tag($control_name_anio , ($valor)?$valor->getAnio():'' , array('include_blank' => true));
      //select_year_tag
    }
    elseif($campo->esTipoTextoCorto())
    {
      if ($campo->getTamano() != null && $campo->getTamano() != "") $tamano = $campo->getTamano();
      else $tamano = '60';
      $value .= input_tag($control_name , ($valor ? $valor->getTextoCorto() : $campo->getDefecto()) , array('control_name' => $control_name , 'size' => $tamano));
    }
    elseif($campo->esTipoFecha())
    {
      if ($valor == null){
        $valor_fecha = "";
        switch ($campo->getDefecto()){
          case 1:
            $fecha = new Date();
            $valor_fecha = $fecha->getTimestamp();
          case 2:
            $fecha = new Date();
            $fecha->addDays(-1);
            $valor_fecha = $fecha->getTimestamp();
            break;
          case 3:
            $fecha = new Date();
            $fecha->addDays(1);
            $valor_fecha = $fecha->getTimestamp();
            break;
          case 4:
            $fecha = new Date();
            $fecha->setFirstDayOfMonth();
            $valor_fecha = $fecha->getTimestamp();
            break;
          case 5:
            $fecha = new Date();
            $fecha->setLastDayOfMonth();
            $valor_fecha = $fecha->getTimestamp();
            break;
          case 6:
            $fecha = new Date();
            $fecha->setFirstDayOfYear();
            $valor_fecha = $fecha->getTimestamp();
            break;
          case 7:
            $fecha = new Date();
            $fecha->setLastDayOfYear();
            $valor_fecha = $fecha->getTimestamp();
            break;
        }
      }else {
        $valor_fecha = $valor->getFecha();
      }
      $value .= input_date_tag($control_name , $valor_fecha , array('control_name' => $control_name , 'rich' => true , 'calendar_button_img' => '/images/icons/date.png'));

      if ($campo->getMostrarEnPadre()){
        use_helper('Javascript');
        
        if ($valor == null) $valor_sino = false;
        else $valor_sino = $valor->getSiNo();

        $value .= " ".__("Configurar alarma").": ".checkbox_tag($campo_name.'[tiene_alarma]' , '' ,$valor_sino , array('control_name' => $campo_name.'[tiene_alarma]', 'onclick' => 'if (this.checked) document.getElementById(\'capa_campo_'.$campo->getIdCampo().'\').style.display = \'block\'; else document.getElementById(\'capa_campo_'.$campo->getIdCampo().'\').style.display = \'none\';'));

        if (!$valor_sino) $txt_vis = "style=\"display:none;\"";
        else $txt_vis = "";

        $valores = explode("##",($valor ? $valor->getTextoCorto() : ""));
        //for ($i = 1; $i <= 5 ; $i++){
        //    $var_temp = "selected".$i;
        //    $$var_temp = in_array("1",$valores) ? "SELECTED" : "";
        //}

        $value .= "\n
            <div id=\"capa_campo_".$campo->getIdCampo()."\" ".$txt_vis.">
                ".__("Avisar a").":
                ".select_tag($campo_name.'[usuario_avisar]' , objects_for_select(UsuarioPeer::doSelect(UsuarioPeer::getCriteriaUsuariosAccesibles()) , 'getPrimaryKey' , '__toString' , ($valor ? $valor->getNumero() : "0"), array("include_blank"=>true)) ,
                array('control_name' => $campo_name.'[usuario_avisar]',))."
                ".__('Cuando?: ')."
                <select id=\"".$campo_name."_cuando_alarma\" name=\"".$campo_name."[cuando_alarma][]\" size=\"5\" multiple>
                    <option value=\"1\" ".(in_array("1",$valores) ? "SELECTED" : "").">".__('1 mes antes')."</option>
                    <option value=\"2\" ".(in_array("2",$valores) ? "SELECTED" : "").">".__('2 semanas antes')."</option>
                    <option value=\"3\" ".(in_array("3",$valores) ? "SELECTED" : "").">".__('1 semana antes')."</option>
                    <option value=\"4\" ".(in_array("4",$valores) ? "SELECTED" : "").">".__('1 día antes')."</option>
                    <option value=\"5\" ".(in_array("5",$valores) ? "SELECTED" : "").">".__('el día')."</option>
                </select>
            </div>
        ";
      }
    }
    elseif($campo->esTipoNumero())
    {
      if ($campo->getTamano() != null && $campo->getTamano() != "") $tamano = $campo->getTamano();
      else $tamano = '5';
      $value .= input_tag($control_name , ($valor ? $valor->getNumero() : $campo->getDefecto()) , array('control_name' => $control_name , 'size' => $tamano));
    }
    elseif($campo->esTipoDocumento())
    {
      if ($valor && $valor->getTextoCorto() != ""){
          $fname = explode("_",basename($valor->getTextoCorto()));
          if (sizeof($fname) > 1) $fname = substr(basename($valor->getTextoCorto()), strlen($fname[0])+1 );
          else $fname = $fname[0];
          
          $value .= "<a href=\"".dirname(UsuarioPeer::getRuta())."/index.php/formularios/download/?id_item=".$valor->getIdItem()."&id_formulario=".$valor->getIdFormulario()."\" target=\"_NEW\">".$fname."<a><br />";
      }
      $value .= input_file_tag($campo_name);
      $value .= input_hidden_tag($control_name, "1");
    }
    elseif($campo->esTipoTabla())
    {
      if ($id_tabla_proviene != null && $id_tabla_proviene = $campo->getValorTabla()){
        $fproviene = FormularioPeer::retrieveByPk($id_formulario_proviene);
        $value .= "<b>".$fproviene->__toString()."</b>";
        $value .= input_hidden_tag($control_name, $id_formulario_proviene);
      }else {
        
        //Obtener el campo de la tabla que es el nombre
        $mitabla = TablaPeer::retrieveByPk($campo->getValorTabla());
        //$formularios = $mitabla->getFormularios(FormularioPeer::getCriterioAlcance());
        //$value .= select_tag($control_name , objects_for_select($formularios , 'getPrimaryKey' , '__toString' , ($valor ? $valor->getIdTabla() : $campo->getDefecto()), array("include_blank"=>true)) , 
        //          array('control_name' => $control_name));
        
        $formulario_t = FormularioPeer::retrieveByPk(($valor ? $valor->getIdTabla() : $campo->getDefecto()));
        if ($formulario_t == null) $formulario_t = new Formulario();
        $value .= popUp($control_name, $formulario_t, $mitabla->getIdEmpresa(), $campo->getValorTabla());

        $value .= "&nbsp;&nbsp;o&nbsp;&nbsp;".
        link_to(image_tag("icons/add.png"),"formularios/create?id_tabla=".$campo->getValorTabla()."&id_tabla_proviene=".$tabla->getIdTabla()."&id_formulario_proviene=".$formulario->getIdFormulario());
      }
    }
    elseif($campo->esTipoObjeto())
    {
      eval("if (in_array('getCriterioAlcance',get_class_methods('".$campo->getValorObjeto()."Peer'))) {\$c = ".$campo->getValorObjeto()."Peer::getCriterioAlcance();} else {\$c = new Criteria();}");
      eval("\$valores = ".$campo->getValorObjeto()."Peer::doSelect(\$c);");
      $value .= select_tag($control_name , objects_for_select($valores , 'getPrimaryKey' , '__toString' , ($valor ? $valor->getIdObjeto() : $campo->getDefecto()), array("include_blank"=>true)) , 
        array('control_name' => $control_name,));

      $modulo = strtolower($campo->getValorObjeto());
      if (substr($modulo, -1) == "a" || substr($modulo, -1) == "e" || substr($modulo, -1) == "i" || substr($modulo, -1) == "o" || substr($modulo, -1) == "u")
              $modulo = $modulo."s";
      else $modulo = $modulo."es";

      $value .= "&nbsp;&nbsp;o&nbsp;&nbsp;".
      link_to(image_tag("icons/add.png"),$modulo."/create");
    }
  
    //texto de ayuda
    if ($item_base->getAyuda() && ($item_base->getAyuda()!=''))
    {
      $value .= "<div class=\"sf_edit_help\">";
      $value .= __($item_base->getAyuda());
      $value .= "</div>";
    }
    if ($cerrado_futura) $value .= "</div>";
  }
  else
  {
    //varios items por campo
    $items_base = $campo->getItemsBaseOrdenados();
    $control_name = $campo_name."[item_base]";
    
    if ($campo->__toString() != "") $value = label_for($control_name, __($campo->__toString()).":", '');
    else $value = "";
    if ($cerrado) $value .= "<div class=\"content\">";
    
    $control_name_radio = $campo_name."[item_base]";
    $control_id_radio = $campo_name."_item_base_";
    $control_name_check = $campo_name."[item_base_";

    if ($campo->getDesplegable()) $value .= "<select name=\"".$control_name_radio."\" id=\"".$control_id_radio."\">\n";
    else $value .= "<ul class=\"sf_admin_checklist\">\n";
    
    $es_primero = true;    
    foreach($items_base as $item_base)
    {
      $valor = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
      $etiqueta =  item_base_to_string($item_base , $campo);
        
      if ($campo->getDesplegable()){
        if ($valor){
          if ($valor->getSiNo()) $selected = "SELETED";
          else $selected = ""; 
        }
        else $selected = ""; 

        $value .= "<option value=\"".$item_base->getPrimaryKey()."\" $selected>".(isset($etiqueta) ? $etiqueta : '-')."</option>";
      }
      else {
        $value .= "<li>";

        if (!$campo->getSeleccionMultiple())
        {
          $id_aux = $control_id_radio.$item_base->getPrimaryKey();
          $value .= radiobutton_tag($control_name_radio , $item_base->getPrimaryKey() ,($valor ? ($valor->getSiNo() || $es_primero) : $es_primero) , array('id' => $id_aux));
          $value .= "<label ".$item_base->getEstilo().">".(isset($etiqueta) ? $etiqueta : '-')."</label>";
        }
        else
        {
          $control_name_aux = $control_name_check.$item_base->getPrimaryKey()."]";
          $value .= checkbox_tag($control_name_aux , $item_base->getPrimaryKey() , ($valor? ($valor->getSiNo() || $es_primero) :$es_primero) , array(
            'control_name' => $control_name_aux , 
          ));

          $value .= "<label ".$item_base->getEstilo().">".(isset($etiqueta) ? $etiqueta : '-')."</label>";
          //$value .= label_for($control_name_aux , ((isset($etiqueta) ? $etiqueta : '-')));
        }
        $value .= "</li>\n";
        if ($item_base->getTextoAuxiliar())
        {
          $control_name_text = $campo_name."[item_base_texto_".$item_base->getPrimaryKey()."]";
          $texto = $valor ? $valor->getTextoAuxiliar() : null;
          $value .= "<li>";
          $value .= input_tag($control_name_text , $texto , array('control_name' => $control_name_text , 'size' => '30'));
          $value .= "</li>\n";
        }
      }
      
      $es_primero = false;
    }
    
    if ($campo->getDesplegable()) $value .= "</select>";
    else $value .= "</ul>\n";
    
    if ($cerrado_futura) $value .= "</div>";
  }
  echo $value;
?>

<?php
$cerrado = $cerrado_futura;
if ($cerrado) echo "</div>";
?>

<?php endif;?>
<?php endforeach ; ?>
</fieldset>

<?php echo object_input_hidden_tag($empresa, 'getPrimaryKey' , array('control_name' => 'formulario[id_empresa]')); ?>
<?php if ($tabla) : ?>
  <?php echo object_input_hidden_tag($formulario, 'getIdTabla' , array('control_name' => 'formulario[id_tabla]')); ?>
<?php endif; ?>
    
<!--   
<fieldset id="sf_fieldset_formulario" class="">
<h2><?php //echo __('Datos') ?></h2>

<div class="form-row">
  <?php //echo label_for('formulario[id_empresa]', __($labels['formulario{id_empresa}']).":", '') ?>
  <div class="content">
    <?php 
      //echo link_to(($empresa ? $empresa->__toString() : '-') , 'empresas/show?id_empresa='.$empresa->getPrimaryKey());
      //echo object_input_hidden_tag($empresa, 'getPrimaryKey' , array('control_name' => 'formulario[id_empresa]'));
    ?>
  </div>
</div>
     
<?php //if ($tabla == null) : ?>
<div class="form-row">
  <?php //echo label_for('formulario[id_tabla]', __($labels['formulario{id_tabla}']).":", 'class="required" ') ?>
  <div class="content<?php //if ($sf_request->hasError('formulario{id_tabla}')): ?> form-error<?php //endif; ?>">
  <?php //if ($sf_request->hasError('formulario{id_tabla}')): ?>
    <?php //echo form_error('formulario{id_tabla}', array('class' => 'form-error-msg')) ?>
  <?php //endif; ?>

  <?php 
//    $tablas = TablaPeer::doSelect(Tabla::getCriterioAlcance());
//    $opciones = objects_for_select($tablas , 'getPrimaryKey' , '__toString');
//    $value = select_tag('formulario[id_tabla]' , $opciones, array ('control_name' => 'formulario[id_tabla]',
//    )); echo $value ? $value : '&nbsp;'?>
    </div>
</div>
<?php //endif; ?>

<div class="form-row">
//  <?php //echo label_for('formulario[fecha]', __($labels['formulario{fecha}']).":", '') ?>
  <div class="content<?php //if ($sf_request->hasError('formulario{fecha}')): ?> form-error<?php //endif; ?>">
  <?php //if ($sf_request->hasError('formulario{fecha}')): ?>
    <?php //echo form_error('formulario{fecha}', array('class' => 'form-error-msg')) ?>
  <?php //endif; ?>
  
  <?php
//    $value = input_fecha_hora_tag('formulario[fecha]' , $formulario->getFecha());
//    echo $value ? $value : '&nbsp;';
  ?>
  </div>
</div>
</fieldset>
-->

<?php //include_partial('edit_actions', array('formulario' => $formulario, 'id_formulario_proviene'=>$id_formulario_proviene)) ?>
<!--</form>-->
<?php
//echo form_tag('notificaciones/guardar_empezar_proceso', array(
//    'id' => 'sf_notis_form',
//    'name' => 'sf_notis_form',
//    'method' => 'post')); ?>
    <div id="modelo">
        <fieldset class="quitar_borde">
            <legend><?php echo __('Modelo de declaración'); ?></legend><br /><?php
            echo __('Si la notificación se refiere a un tratamiento de datos sobre miembros de comunidades de propietarios, clientes propios, libro de recetario, (clientes de farmacias), nóminas-recursos humanos (empleados) o pacientes, y la finalidad es la gestión propia de estos colectivos, puede marcar el cuadro TIPO y seleccionar el modelo que corresponda (se rellenan determinados apartados con valores apropiados) o bien seleccionar NORMAL para partir de un formulario totalmente vacío.'); ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde" width="50%" style="text-align: center">
                        <input id="normal" type="radio" name="modelo" value="Normal" class="mod"/> <?php echo __('Normal'); ?>
                    </td><td class="quitar_borde" width="50%" style="text-align: left">
                        <input id="tip" type="radio" name="modelo" value="Tipo" class="mod"/> <?php echo __('Tipo'); ?>
                    </td>
                </tr>
            </table>
        </fieldset >
    </div>
    <div id="tip2">
        <fieldset class="quitar_borde">
            <legend><?php echo __('Tipos'); ?></legend>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="1" class="mota" /> <?php echo __('Comunidad de propietarios'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="4" class="mota" /> <?php echo __('Nóminas - Recursos Humanos'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="7" class="mota" /> <?php echo __('Videovigilancia'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="2" class="mota" /> <?php echo __('Clientes y/o proveedores'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="5" class="mota" /> <?php echo __('Pacientes'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="3" class="mota" /> <?php echo __('Libro Recetario'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde" colspan="2" width="100%">
                        <input type="radio" name="tip" value="6" class="mota" /> <?php echo __('Gestión Escolar'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div id="documentacion">
        <fieldset class="quitar_borde">
            <legend><?php echo __('Presentación de la documentación'); ?></legend><?php
                        echo __('¿Cuál es el sistema que empleará para presentar la declaración?'); ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="1" /> <?php echo __('Formulario en papel'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="2" /> <?php echo __('Internet'); ?>
                    </td>
                </tr><!--<tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="3" /> <?php echo __('Internet firmado con certificado digital'); ?>
                    </td>
                </tr>
                -->
            </table>
        </fieldset>
    </div><!--
    <fieldset id="bot"  class="quitar_borde boton">
        <table class="quitar_borde" width="100%">
            <tr>
                <td class="quitar_borde" width="50%" align="center"><?php
                    //echo submit_tag("Cumplimentar", array('id' => 'commit', 'class' => 'submit cump')); ?>
                </td>
                <td class="quitar_borde" width="50%" align="center">
                    <input id="reinicia" type="reset" name="reiniciar" value="<?php //echo __('Reiniciar'); ?>" class="reset cump" />
                </td>
            </tr>
        </table>
    </fieldset>-->

<?php include_partial('edit_actions', array('formulario' => $formulario, 'id_tabla_proviene'=>$id_tabla_proviene, 'id_formulario_proviene'=>$id_formulario_proviene)) ?>
</form>

<?php if (sizeof($tablas_auxiliares) > 0) : ?>
<?php foreach ($tablas_auxiliares as $tablas_auxiliar) : ?>
<?php $tabla = TablaPeer::retrievebypk($tablas_auxiliar['id_tabla']); ?>
<fieldset id="sf_fieldset_formulario" class="quitar_borde">
<?php   
  /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
  $ruta = UsuarioPeer::getRuta();
?>
<h2><a href="<?php echo $ruta; ?>/formularios/list?filters[id_empresa]=<?php echo $tabla->getIdEmpresa(); ?>&filters[id_tabla]=<?php echo $tabla->getIdTabla(); ?>&filter=filter" style="color: white;"><?php echo __('Registros Relacionados de')." ".strtoupper($tabla->getNombre()); ?></a></h2>

<?php include_partial('formularios/edit_list', array('pager' => $tablas_auxiliar['forms'], "tabla"=>$tabla, "id_tabla"=> $formulario->getIdTabla(), "id_formulario"=>$formulario->getIdFormulario())) ?>
<?php /*include_partial('list_actions' , array('pager' => $pager, 'filters' => $filters))*/ ?>
</fieldset>
<?php endforeach; ?>
<?php endif; ?>