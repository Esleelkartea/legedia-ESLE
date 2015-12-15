<?php echo form_tag('formulario_modelo/edit_campo', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
  'onsubmit'  => 'double_list_submit(); return true;'
)) ?>

<?php echo object_input_hidden_tag($campo, 'getIdCampo') ?>
<?php echo object_input_hidden_tag($campo, 'getIdEmpresa') ?>

<fieldset id="sf_fieldset_campo" class="">
<h2><?php echo __('Datos del campo', array()) ?></h2>
<div class="form-row">
  <?php echo label_for('campo[nombre]', __($labels['campo{nombre}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{nombre}')): ?>
    <?php echo form_error('campo{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($campo, 'getNombre', array (
  'size' => 60,
  'control_name' => 'campo[nombre]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[descripcion]', __($labels['campo{descripcion}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{descripcion}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{descripcion}')): ?>
    <?php echo form_error('campo{descripcion}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($campo, 'getDescripcion', array (
  'size' => '50x3',
  'control_name' => 'campo[descripcion]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<!--
<div class="form-row">
  <?php echo label_for('campo[es_general]', __($labels['campo{es_general}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{es_general}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{es_general}')): ?>
    <?php echo form_error('campo{es_general}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('campo[es_general]', '1', $campo->getEsGeneral() ,array (
  'control_name' => 'campo[es_general]',
  'onchange' => 'Element.toggle("capa_tablas")',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Si es general se mostrará en todas las tablas') ?></div>
  </div>
</div>
-->

<?php echo object_input_hidden_tag($tabla, 'getIdTabla');?>
<!--
<div class="form-row" <?php if($campo->getEsGeneral()) echo "style=\"display:none;\"";?> id="capa_tablas">
  <?php echo label_for('campo[id_tabla]', __($labels['campo{id_tabla}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{id_tabla}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{id_tabla}')): ?>
    <?php echo form_error('campo{id_tabla}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php
    //if (isset($tabla) and $campo->isNew()) {
    //  echo $tabla->getNombreyempresa();
    //  echo object_input_hidden_tag($tabla, 'getIdTabla');   
   //}
   //else {

     $criteria = TablaPeer::getCriteriaByEmpresa($campo->getIdEmpresa());

     $value = object_double_list_ver2($campo, 'getCampoTablas', array ('control_name' => 'campania[grupos]',
                                                                    'through_class' => 'RelCampoTabla',
                                                                    ), null, $criteria);
     echo $value ? $value : '&nbsp;'; 
      
   //}
  ?>

  </div>
</div>
-->

<div class="form-row">
  <?php echo label_for('campo[en_lista]', __($labels['campo{en_lista}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{en_lista}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{en_lista}')): ?>
    <?php echo form_error('campo{en_lista}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('campo[en_lista]', '1', $campo->getEnLista() ,array (
  'control_name' => 'campo[en_lista]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Se debe mostrar el valor de este campo en las listas de la tabla?') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[es_nombre]', __($labels['campo{es_nombre}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{es_nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{es_nombre}')): ?>
    <?php echo form_error('campo{es_nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('campo[es_nombre]', '1', $campo->getEsNombre() ,array (
  'control_name' => 'campo[es_nombre]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Este campo identifica al formulario') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[obligatorio]', __($labels['campo{obligatorio}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{obligatorio}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{obligatorio}')): ?>
    <?php echo form_error('campo{obligatorio}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('campo[obligatorio]', '1', $campo->getObligatorio() ,array (
  'control_name' => 'campo[obligatorio]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indica que este campo no puede estar vacio a la hora de introducirse un valor.') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[misma_fila]', __($labels['campo{misma_fila}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{misma_fila}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{misma_fila}')): ?>
    <?php echo form_error('campo{misma_fila}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = checkbox_tag('campo[misma_fila]', '1', $campo->getMismaFila() ,array (
  'control_name' => 'campo[misma_fila]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indica que este campo estará en la misma fila que el anterior.') ?></div>
  </div>
</div>

</fieldset>

<fieldset id="sf_fieldset_campo_caracteristicas">
<h2><?php echo __('Características del campo') ?></h2>
<div class="form-row">
  <?php echo label_for('campo[tipo]', __($labels['campo{tipo}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tipo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tipo}')): ?>
    <?php echo form_error('campo{tipo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $tipos_campo = CampoPeer::getTiposCampos();
    //$value = select_tag('campo[tipo]', options_for_select($tipos_campo , $campo->getTipo()), array (
    //  'control_name' => 'campo[tipo]',
    //)); 
    //echo $value ? $value : '&nbsp;'; 
    
    
    $html_select = select_tag('campo[tipo]', options_for_select($tipos_campo , $campo->getTipo()), array (
      'control_name' => 'campo[tipo]',
      'onChange' => "mostrar_ocultar_campos(this.value);",
    ));
    
    $html = $html_select;
    $html .= "\n";
    $js = "
    function mostrar_ocultar_campos(id_tipo_campo)
    {
      var id_tipo_campo_lista = ".CampoPeer::ID_LISTA.";
      var id_tipo_campo_periodo = ".CampoPeer::ID_SELECT_PERIODO.";
      var id_tipo_campo_tabla = ".CampoPeer::ID_TABLA.";
      var id_tipo_campo_objeto = ".CampoPeer::ID_OBJETO.";
      var id_tipo_campo_texto_corto = ".CampoPeer::ID_TEXTO_CORTO.";
      var id_tipo_campo_texto_largo = ".CampoPeer::ID_TEXTO_LARGO.";
      var id_tipo_campo_numero = ".CampoPeer::ID_NUMERO.";
      var id_tipo_campo_fecha = ".CampoPeer::ID_FECHA.";
      var id_tipo_campo_sino = ".CampoPeer::ID_BOOLEANO.";
      var id_tipo_campo_documento = ".CampoPeer::ID_DOCUMENTO.";
      
      if (id_tipo_campo == id_tipo_campo_lista)
      {
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_lista');
      }
      else if(id_tipo_campo == id_tipo_campo_periodo)
      {
        Element.hide('capa_lista');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_periodo');
      }
      else if(id_tipo_campo == id_tipo_campo_tabla)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_tabla');
      }
      else if(id_tipo_campo == id_tipo_campo_objeto)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_objeto');
      }
      else if(id_tipo_campo == id_tipo_campo_texto_corto)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_texto_corto');
      }
      else if(id_tipo_campo == id_tipo_campo_texto_largo)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_texto_largo');
      }
      else if(id_tipo_campo == id_tipo_campo_numero)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_numero');
      }
      else if(id_tipo_campo == id_tipo_campo_fecha)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_numero');
        Element.hide('capa_texto_largo');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
        
        Element.show('capa_fecha');
      }
      else if(id_tipo_campo == id_tipo_campo_sino)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        
        Element.hide('capa_texto_corto');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_texto_largo');
        Element.hide('capa_documento');

        Element.show('capa_sino');
      }
      else if(id_tipo_campo == id_tipo_campo_documento)
      {
        Element.hide('capa_lista');
        Element.hide('capa_periodo');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');

        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');

        Element.show('capa_documento');
      }
      else
      {
        Element.hide('capa_periodo');
        Element.hide('capa_lista');
        Element.hide('capa_tabla');
        Element.hide('capa_objeto');
        Element.hide('capa_texto_corto');
        Element.hide('capa_texto_largo');
        Element.hide('capa_numero');
        Element.hide('capa_fecha');
        Element.hide('capa_sino');
        Element.hide('capa_documento');
      }

    }";
    $html .= content_tag('script', $js, array('type' => 'text/javascript'));
    echo $html;
  ?>
  </div>
</div>

<div id="capa_lista" <?php if (!$campo->esTipoLista()) echo "style=\"display:none;\"";?> >
<div class="form-row">
  <?php echo label_for('campo[seleccion_multiple]', __($labels['campo{seleccion_multiple}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{seleccion_multiple}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{seleccion_multiple}')): ?>
    <?php echo form_error('campo{seleccion_multiple}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $value = checkbox_tag('campo[seleccion_multiple]' , '' ,$campo->getSeleccionMultiple() , array('control_name' => 'campo[seleccion_multiple]'));
    echo $value ? $value : '&nbsp;'; 
  ?>
  <div class="sf_edit_help"><?php echo __('Marque esta opción si quiere que puedan seleccionarse varios elementos de la lista') ?></div>
  </div>
</div>
<div class="form-row">
  <?php echo label_for('campo[desplegable]', __($labels['campo{desplegable}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{desplegable}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{desplegable}')): ?>
    <?php echo form_error('campo{desplegable}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $value = checkbox_tag('campo[desplegable]' , '' ,$campo->getDesplegable() , array('control_name' => 'campo[desplegable]'));
    echo $value ? $value : '&nbsp;'; 
  ?>
  <div class="sf_edit_help"><?php echo __('Marque esta opción si quiere que aparezca una lista desplegable') ?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('campo[tipo_items]', __($labels['campo{tipo_items}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tipo_items}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tipo_items}')): ?>
    <?php echo form_error('campo{tipo_items}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $lista_tipos = CampoPeer::getTiposItems();
    $value = "<ul class=\"sf_admin_checklist\">\n";
    $tipo_items_campo = $campo->getTipoItems() ? $campo->getTipoItems() : CampoPeer::getDefaultIdTipoItems();
    foreach($lista_tipos as $id=>$nombre_tipo)
    {
      $value .= "<li>";
      $value .= radiobutton_tag('campo[tipo_items]', $id, ($tipo_items_campo==$id) , array('id' => 'campo_tipo_items_'.$id));
      $value .= label_for('campo_tipo_items_'.$id, __($nombre_tipo), '');
      $value .= "</li>\n";
    }
    $value .= "</ul>\n";
    echo $value ? $value : '-';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el tipo de los elementos de la lista') ?></div>
  </div>
</div>

<div class="form-row" >
  <?php echo label_for('campo[unidad_rangos]', __($labels['campo{unidad_rangos}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{unidad_rangos}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{unidad_rangos}')): ?>
    <?php echo form_error('campo{unidad_rangos}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $lista_unidades = CampoPeer::getTiposUnidades();
    $opciones = options_for_select($lista_unidades , $campo->getUnidadRangos() , array('include_custom' => __('sin definir')) );
    $value = select_tag('campo[unidad_rangos]' , $opciones , array('control_name' => 'campo[unidad_rangos]') );
    echo $value ? $value : '-';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el tipo de unidad. Sólo para el tipo de elementos Rangos de Valores') ?></div>
  </div>
</div>

</div>

<div class="form-row" id="capa_periodo" <?php if (!$campo->esTipoSelectPeriodo()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[tipo_periodo]', __($labels['campo{tipo_periodo}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tipo_periodo}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tipo_periodo}')): ?>
    <?php echo form_error('campo{tipo_periodo}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $lista_periodos = CampoPeer::getTiposPeriodo();
    $opciones = options_for_select($lista_periodos , $campo->getTipoPeriodo() , array() );
    $value = select_tag('campo[tipo_periodo]' , $opciones , array('control_name' => 'campo[tipo_periodo]') );
    echo $value ? $value : '-';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el tipo de periodicidad') ?></div>
  </div>
</div>


<div class="form-row" id="capa_tabla" <?php if (!$campo->esTipoTabla()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[tipo_tabla]', __($labels['campo{tipo_tabla}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tipo_tabla}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tipo_tabla}')): ?>
    <?php echo form_error('campo{tipo_tabla}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $crit_tabla= TablaPeer::getCriterioAlcance();
    $crit_tabla->addAnd(TablaPeer::ID_EMPRESA,$campo->getIdEmpresa(),Criteria::EQUAL);
    $lista_tablas = TablaPeer::doSelect($crit_tabla);
            
    $opciones = objects_for_select($lista_tablas, 'getPrimaryKey' , '__toString' , $campo->getValorTabla(), array('include_blank' => true));
    $value = select_tag('campo[tipo_tabla]' , $opciones , array('control_name' => 'campo[tipo_tabla]') );
    echo $value ? $value : '-';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique la tabla a la que referencia') ?></div>
  </div>
  
  <?php if ($campo->getValorTabla() != null && $campo->getValorTabla() != "") : ?>
  <!-- VALOR DEFECTO TABLA -->
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?
      //Obtener el campo de la tabla que es el nombre
      $mitabla = TablaPeer::retrieveByPk($campo->getValorTabla());
      if ($mitabla != null){
        //$formularios = $mitabla->getFormularios(FormularioPeer::getCriterioAlcance());
  
        //$value = select_tag("campo[defecto_tabla]" , objects_for_select($formularios , 'getPrimaryKey' , '__toString' , $campo->getDefecto(), array('include_blank' => true)) , 
        //array('control_name' => "campo[defecto_tabla]"));
        if ($campo->getDefecto() != 0)
          $formulario_t = FormularioPeer::retrieveByPk($campo->getDefecto());
        else
          $formulario_t = new Formulario(); 

        $value = popUp("campo[defecto_tabla]", $formulario_t, $mitabla->getIdEmpresa(), $campo->getValorTabla());  
      }
      
      echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
  <?php endif; ?>
  
  <?php echo label_for('campo[mostrar_en_padre]', __($labels['campo{mostrar_en_padre}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{mostrar_en_padre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{mostrar_en_padre}')): ?>
    <?php echo form_error('campo{mostrar_en_padre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = checkbox_tag('campo[mostrar_en_padre]', '1', $campo->getMostrarEnPadre() ,array (
  'control_name' => 'campo[mostrar_en_padre]',
  )); echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique si quiere mostrar en los registros de la tabla padre un listado de los registros de la tabla actual') ?></div>
  </div>
</div>
 
<div class="form-row" id="capa_objeto" <?php if (!$campo->esTipoObjeto()) echo "style=\"display:none;\"";?> >
  <?php echo label_for('campo[tipo_objeto]', __($labels['campo{tipo_objeto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tipo_objeto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tipo_objeto}')): ?>
    <?php echo form_error('campo{tipo_objeto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    //COGEMOS LOS OBJETOS INTERESANTES DE LA APLICACIÓN => NO TODOS
    $directorio=SF_ROOT_DIR."/lib/model/";
    $tmp_objetos=array(); $objetos=array();  
    $noobjetos=array("Item", "ItemPeer", "ItemBase", "ItemBasePeer", "RelCampoTabla", "RelCampoTablaPeer", "Campo", "CampoPeer", "Formulario", "FormularioPeer",  
                    "Catalogue", "CataloguePeer", "TransUnit", "TransUnitPeer", 
                    "Sesion", "SesionPeer", "SesionLog", "SesionLogPeer", "UsuarioGrupo", "UsuarioGrupoPeer", "Parametro", "ParametroPeer", "ParametroDef", "ParametroDefPeer", 
                    "Alcance", "AlcancePeer", "Mensaje", "MensajePeer", "MensajeDestino", "MensajeDestinoPeer", "GrupoModulo", "GrupoModuloPeer", 
);
    if ($dir = opendir($directorio)) {
        while ($file = readdir($dir)) {
            if ($file != "." && $file != ".." && (!is_dir($directorio.$file))) {
                $pos = strrpos($file, ".");
                $name = substr($file,0,$pos);
                
                $tmp_objetos[] = $name;

            }
        }
        closedir($dir);
        sort($tmp_objetos);
        
        foreach ($tmp_objetos as $obj){
          if (!in_array($obj,$noobjetos)){            
            $objetos[] = $obj;
            $noobjetos[] = $obj;
            $noobjetos[] = $obj."Peer";
          }
        }
    }
    $misObj = array();
    foreach ($objetos as $obj) $misObj[$obj] = $obj;

    $opciones = options_for_select($misObj , $campo->getValorObjeto(), array('include_blank' => true));
    $value = select_tag('campo[tipo_objeto]' , $opciones , array('control_name' => 'campo[tipo_objeto]') );
    echo $value ? $value : '-';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el objeto al que se referencia') ?></div>
  </div>
  
  <?php if ($campo->getValorObjeto() != null && $campo->getValorObjeto() != "") : ?>
  
  <!-- VALOR DEFECTO OBJETO -->
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?
      eval("if (in_array('getCriterioAlcance',get_class_methods('".$campo->getValorObjeto()."Peer'))) {\$c = ".$campo->getValorObjeto()."Peer::getCriterioAlcance();} else {\$c = new Criteria();}");
      eval("\$valores = ".$campo->getValorObjeto()."Peer::doSelect(\$c);");
      $value = select_tag("campo[defecto_objeto]" , objects_for_select($valores , 'getPrimaryKey' , '__toString' ,  $campo->getDefecto(), array('include_blank' => true)), 
        array('control_name' => "campo[defecto_objeto]"));
      echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
  <?php endif; ?>
</div>

<div class="form-row" id="capa_texto_corto" <?php if (!$campo->esTipoTextoCorto()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[defecto_texto_corto]', $campo->getDefecto(), array (
  'size' => 60,
  'control_name' => 'campo[defecto_texto_corto]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
  <?php echo label_for('campo[tamano]', __($labels['campo{tamano}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tamano}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tamano}')): ?>
    <?php echo form_error('campo{tamano}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[tamano_texto_corto]', $campo->getTamano(), array (
  'size' => 5,
  'control_name' => 'campo[tamano_texto_corto]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el tamaño del campo') ?></div>
  </div>
</div>

<div class="form-row" id="capa_texto_largo" <?php if (!$campo->esTipoTextoLargo()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = textarea_tag('campo[defecto_texto_largo]', $campo->getDefecto(), array (
  'size' => '50x3',
  'control_name' => 'campo[defecto_texto_largo]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
  <?php echo label_for('campo[tamano]', __($labels['campo{tamano}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tamano}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tamano}')): ?>
    <?php echo form_error('campo{tamano}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[tamano_texto_largo]', $campo->getTamano(), array (
  'size' => 5,
  'control_name' => 'campo[tamano_texto_largo]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el tamaño del campo') ?></div>
  </div>
</div>

<div class="form-row" id="capa_numero" <?php if (!$campo->esTipoNumero()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[defecto_numero]', $campo->getDefecto(), array (
  'size' => 5,
  'control_name' => 'campo[defecto_numero]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
  <?php echo label_for('campo[tamano]', __($labels['campo{tamano}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{tamano}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{tamano}')): ?>
    <?php echo form_error('campo{tamano}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[tamano_numero]', $campo->getTamano(), array (
  'size' => 5,
  'control_name' => 'campo[tamano_numero]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique el tamaño del campo') ?></div>
  </div>
</div>

<div class="form-row" id="capa_fecha" <?php if (!$campo->esTipoFecha()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <select name="campo[defecto_fecha]" id="campo_defecto_fecha" >
    <option value="0"></option> 
    <option value="1" <?php if ($campo->getDefecto() == 1):?>SELECTED<?endif;?>><?php echo __('Día en curso');?></option>
    <option value="2" <?php if ($campo->getDefecto() == 2):?>SELECTED<?endif;?>><?php echo __('Día anterior');?></option>
    <option value="3" <?php if ($campo->getDefecto() == 3):?>SELECTED<?endif;?>><?php echo __('Día Posterior');?></option>
    <option value="4" <?php if ($campo->getDefecto() == 4):?>SELECTED<?endif;?>><?php echo __('Primero Mes');?></option>
    <option value="5" <?php if ($campo->getDefecto() == 5):?>SELECTED<?endif;?>><?php echo __('Ultimo Mes');?></option>
    <option value="6" <?php if ($campo->getDefecto() == 6):?>SELECTED<?endif;?>><?php echo __('Primero Año');?></option>
    <option value="7" <?php if ($campo->getDefecto() == 7):?>SELECTED<?endif;?>><?php echo __('Ultimo Año');?></option>
  </select>
      
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>

  <?php echo label_for('campo[alarma]', __("Fecha de alarma?").":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{mostrar_en_padre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{mostrar_en_padre}')): ?>
    <?php echo form_error('campo{mostrar_en_padre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $value = checkbox_tag('campo[mostrar_en_padre]' , '' ,$campo->getMostrarEnPadre() , array('control_name' => 'campo[mostrar_en_padre]'));
    echo $value ? $value : '&nbsp;';
  ?>
  <div class="sf_edit_help"><?php echo __('Indique si se ha de avisar antes de esta fecha') ?></div>
  </div>
</div>

<div class="form-row" id="capa_sino" <?php if (!$campo->esTipoBooleano()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_defecto]', __($labels['campo{valor_defecto}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_defecto}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_defecto}')): ?>
    <?php echo form_error('campo{valor_defecto}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php 
    $value = checkbox_tag('campo[defecto_sino]' , '' ,$campo->getDefecto() , array('control_name' => 'campo[defecto_sino]'));
    echo $value ? $value : '&nbsp;'; 
  ?>
  <div class="sf_edit_help"><?php echo __('Indique el valor por defecto del campo') ?></div>
  </div>
</div>

<div class="form-row" id="capa_documento" <?php if (!$campo->esTipoTextoCorto()) echo "style=\"display:none;\"";?>  >
  <?php echo label_for('campo[valor_tipos_documentos]', __($labels['campo{valor_tipos_documentos}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('campo{valor_tipos_documentos}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('campo{valor_tipos_documentos}')): ?>
    <?php echo form_error('campo{valor_tipos_documentos}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php $value = input_tag('campo[defecto_texto_corto]', $campo->getDefecto(), array (
  'size' => 60,
  'control_name' => 'campo[defecto_texto_corto]',
)); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Indique los posibles valores separados por puntos y comas. Ej: Para solo ficheros PDF y Word: pdf;doc;') ?></div>
  </div>
</div>

</fieldset>

<?php include_partial('edit_campo_actions', array('campo' => $campo, 'tabla' => $tabla)) ?>

</form>

<?php if ($campo->getIdCampo() && !$campo->getEsInconsistente()): ?>
<ul class="sf_admin_actions">
  <li class="float-left">
<?php echo button_to(__('Borrar'), 'formulario_modelo/delete_campo?id_campo='.$campo->getIdCampo(), array (
  'post' => true,
  'confirm' => __('¿Quiere borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?>
  </li>
</ul>
<?php endif; ?>


