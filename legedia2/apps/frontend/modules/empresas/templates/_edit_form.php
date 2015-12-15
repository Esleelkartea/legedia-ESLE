<?php echo form_tag('empresas/edit', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($empresa, 'getIdEmpresa') ?>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[nombre]', __($labels['empresa{nombre}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{nombre}')): ?>
    <?php echo form_error('empresa{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getNombre', array (
  'size' => 60,
  'control_name' => 'empresa[nombre]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[id_actividad]', __($labels['empresa{id_actividad}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{id_actividad}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{id_actividad}')): ?>
    <?php echo form_error('empresa{id_actividad}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($empresa, 'getIdActividad', array (
  'related_class' => 'Taula1',
  'control_name' => 'empresa[id_actividad]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[id_usuario]', __($labels['empresa{id_usuario}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{id_usuario}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{id_usuario}')): ?>
    <?php echo form_error('empresa{id_usuario}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php 
    $usuario_actual = Usuario::getUsuarioActual();
    $usuarios = $usuario_actual->getUsuariosAccesibles();
    $opciones = objects_for_select($usuarios , 'getPrimaryKey' , 'getNombreCompleto' , $empresa->getIdUsuario());
    $value = select_tag('empresa[id_usuario]', $opciones , array (
      'control_name' => 'empresa[id_usuario]',
    ));
    echo $value ? $value : '&nbsp;'; 
  ?>
  </div>
</div>
</fieldset>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Dirección')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[domicilio]', __($labels['empresa{domicilio}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{domicilio}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{domicilio}')): ?>
    <?php echo form_error('empresa{domicilio}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_textarea_tag($empresa, 'getDomicilio', array (
  'size' => '50x3',
  'control_name' => 'empresa[domicilio]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[poblacion]', __($labels['empresa{poblacion}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{poblacion}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{poblacion}')): ?>
    <?php echo form_error('empresa{poblacion}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getPoblacion', array (
  'size' => 60,
  'control_name' => 'empresa[poblacion]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[codigo_postal]', __($labels['empresa{codigo_postal}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{codigo_postal}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{codigo_postal}')): ?>
    <?php echo form_error('empresa{codigo_postal}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getCodigoPostal', array (
  'size' => 20,
  'control_name' => 'empresa[codigo_postal]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[id_provincia]', __($labels['empresa{id_provincia}']), 'class="required" ') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{id_provincia}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{id_provincia}')): ?>
    <?php echo form_error('empresa{id_provincia}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_select_tag($empresa, 'getIdProvincia', array (
  'related_class' => 'Provincia',
  'control_name' => 'empresa[id_provincia]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[telefono]', __($labels['empresa{telefono}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{telefono}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{telefono}')): ?>
    <?php echo form_error('empresa{telefono}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getTelefono', array (
  'size' => 20,
  'control_name' => 'empresa[telefono]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[fax]', __($labels['empresa{fax}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{fax}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{fax}')): ?>
    <?php echo form_error('empresa{fax}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getFax', array (
  'size' => 20,
  'control_name' => 'empresa[fax]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[email]', __($labels['empresa{email}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{email}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{email}')): ?>
    <?php echo form_error('empresa{email}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getEmail', array (
  'size' => 20,
  'control_name' => 'empresa[email]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>
</fieldset>

<fieldset id="sf_fieldset_none" class="">
<!--<h2><?php echo __('Configuración')?></h2>-->
<?php if ($empresa->isNew()) {?>
<div class="form-row">
  <?php echo label_for('empresa[imagen]', __($labels['empresa{imagen}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{imagen}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{imagen}')): ?>
    <?php echo form_error('empresa{imagen}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

   <?php  
            if ($empresa->getLogoMed() != "") {
               echo image_tag('/images/logos/'.$empresa->getLogoMed(), 
                              array('title' => $empresa->__toString(), 
                                    'alt' => $empresa->__toString(),                                    
                                   )
                              );
             }
          ?>
  <?php $value = input_file_tag('empresa[imagen]'); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>
<?php } ?>

<div class="form-row">
  <?php echo label_for('empresa[smtp_server]', __($labels['empresa{smtp_server}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_server}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_server}')): ?>
    <?php echo form_error('empresa{smtp_server}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpServer', array (
    'size' => 35,
    'control_name' => 'empresa[smtp_server]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Dirección del servidor')?></div>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('empresa[smtp_user]', __($labels['empresa{smtp_user}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_user}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_user}')): ?>
    <?php echo form_error('empresa{smtp_user}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpUser', array (
    'size' => 35,
    'control_name' => 'empresa[smtp_user]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Nombre de usuario')?></div>
  </div>
</div>

<?php use_helper('Javascript')?>
<div class="form-row">
  <?php echo label_for('empresa[change_smtp_password]', __($labels['empresa{change_smtp_password}']).":", '') ?>
  <div class="content">
  <?php
    echo checkbox_tag('empresa[change_smtp_password]', 1, false, array(
      'onclick' => visual_effect('toggle_appear', 'new_password'))
    );
    echo "&nbsp;".__('Marque si desea cambiar la clave');
  ?>

   <div id="new_password" style="display:none;">
  <?php
    $value = input_password_tag('empresa[smtp_password]', '', array (
      'size' => 40,
      'control_name' => 'empresa[smtp_password]',
    ));
  /*
  $value .= "&nbsp;";
  $value .= __('Repita la nueva contraseña').":";
  $value .= input_password_tag('empresa[smtp_password_bis]', '', array (
    'size' => 40,
    'control_name' => 'empresa[smtp_password_bis]',
  ));*/
  echo $value ? $value : '&nbsp;'; ?>
  <div class="sf_edit_help"><?php echo __('Introduzca la nueva clave')?></div>
  </div>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('empresa[smtp_port]', __($labels['empresa{smtp_port}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{smtp_port}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{smtp_port}')): ?>
    <?php echo form_error('empresa{smtp_port}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSmtpPort', array (
    'size' => 3,
    'control_name' => 'empresa[smtp_port]',
  )); echo $value ? $value : '&nbsp;'; ?>
  <div class="sf_edit_help"><?php echo __('Número de puerto. Normalmente es el 25.')?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[sender_address]', __($labels['empresa{sender_address}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{sender_address}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{sender_address}')): ?>
    <?php echo form_error('empresa{sender_address}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSenderAddress', array (
    'size' => 35,
    'control_name' => 'empresa[sender_address]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Dirección de correo remitente')?></div>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[sender_name]', __($labels['empresa{sender_name}']).":", '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{sender_name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{sender_name}')): ?>
    <?php echo form_error('empresa{sender_name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getSenderName', array (
    'size' => 35,
    'control_name' => 'empresa[sender_name]',
  )); echo $value ? $value : '&nbsp;' ?>
  <div class="sf_edit_help"><?php echo __('Nombre del remitente')?></div>
  </div>
</div>
</fieldset>

<?php /*
<script language="JavaScript" type="text/javascript" src="<?php echo dirname(UsuarioPeer::getRuta()) ?>/js/ColorPicker2.js"></script>
<script language="JavaScript" type="text/javascript">

 	var cp2 = new ColorPicker('window');

  function pickColor(color)
  {
  	ColorPicker_targetInput.value = color;
    ColorPicker_targetInput.style.backgroundColor = color;
  }
</script>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Colores')?></h2>
<div class="form-row">
  <?php echo label_for('empresa[color1]', __($labels['empresa{color1}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{color1}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{color1}')): ?>
    <?php echo form_error('empresa{color1}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColor1', array (
  'size' => 10,
  'control_name' => 'empresa[color1]',
  'style'=>'background-color: '.$empresa->getColor1(),
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick1","onClick"=>"cp2.select(document.getElementById('empresa_color1'),'pick1');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #FFFFFF">#FFFFFF</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[color2]', __($labels['empresa{color2}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{color2}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{color2}')): ?>
    <?php echo form_error('empresa{color2}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColor2', array (
  'size' => 10,
  'control_name' => 'empresa[color2]',
  'style'=>'background-color: '.$empresa->getColor2(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick2","onClick"=>"cp2.select(document.getElementById('empresa_color2'),'pick2');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #EAEAF4">#EAEAF4</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[color3]', __($labels['empresa{color3}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{color3}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{color3}')): ?>
    <?php echo form_error('empresa{color3}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColor3', array (
  'size' => 10,
  'control_name' => 'empresa[color3]',
  'style'=>'background-color: '.$empresa->getColor3(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick3","onClick"=>"cp2.select(document.getElementById('empresa_color3'),'pick3');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #3D4584">#3D4584</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[color4]', __($labels['empresa{color4}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{color4}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{color4}')): ?>
    <?php echo form_error('empresa{color4}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColor4', array (
  'size' => 10,
  'control_name' => 'empresa[color4]',
  'style'=>'background-color: '.$empresa->getColor4(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick4","onClick"=>"cp2.select(document.getElementById('empresa_color4'),'pick4');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #FFFEF2">#FFFEF2</span>
    </div>
</div>

<hr />

<div class="form-row">
  <?php echo label_for('empresa[colorletra1]', __($labels['empresa{colorletra1}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{colorletra1}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{colorletra1}')): ?>
    <?php echo form_error('empresa{colorletra1}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColorletra1', array (
  'size' => 10,
  'control_name' => 'empresa[colorletra1]',
  'style'=>'background-color: '.$empresa->getColorLetra1(),
)); echo $value ? $value : '&nbsp;' ?>
  <?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick5","onClick"=>"cp2.select(document.getElementById('empresa_colorletra1'),'pick5');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #000000">#000000</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[colorletra2]', __($labels['empresa{colorletra2}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{colorletra2}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{colorletra2}')): ?>
    <?php echo form_error('empresa{colorletra2}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColorLetra2', array (
  'size' => 10,
  'control_name' => 'empresa[colorletra2]',
  'style'=>'background-color: '.$empresa->getColorLetra2(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick6","onClick"=>"cp2.select(document.getElementById('empresa_colorletra2'),'pick6');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #FFFFFF">#FFFFFF</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[colorletra3]', __($labels['empresa{colorletra3}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{colorletra3}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{colorletra3}')): ?>
    <?php echo form_error('empresa{colorletra3}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColorLetra3', array (
  'size' => 10,
  'control_name' => 'empresa[colorletra3]',
  'style'=>'background-color: '.$empresa->getColorLetra3(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick7","onClick"=>"cp2.select(document.getElementById('empresa_colorletra3'),'pick7');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #333333">#333333</span>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[colorletra4]', __($labels['empresa{colorletra4}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('empresa{colorletra4}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('empresa{colorletra4}')): ?>
    <?php echo form_error('empresa{colorletra4}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($empresa, 'getColorLetra4', array (
  'size' => 10,
  'control_name' => 'empresa[colorletra4]',
  'style'=>'background-color: '.$empresa->getColorLetra4(),
)); echo $value ? $value : '&nbsp;' ?>
<?php echo image_tag('icons/bgcolor.gif',array("id"=>"pick8","onClick"=>"cp2.select(document.getElementById('empresa_colorletra4'),'pick8');return false;")) ?>
&nbsp;&nbsp;Original: <span style="background-color: #666666">#666666</span>
    </div>
</div>
</fieldset>

*/ ?>

<?php include_partial('edit_actions', array('empresa' => $empresa)) ?>

</form>

<?php if ($empresa->getIdEmpresa()): ?>
<ul class="sf_admin_actions">
  <li class="float-left">
<?php echo button_to(__('Borrar'), 'empresas/delete?id_empresa='.$empresa->getIdEmpresa(), array (
  'post' => true,
  'confirm' => __('¿Quiere borrar este objeto?'),
  'class' => 'sf_admin_action_delete',
)) ?>
  </li>
</ul>
<?php endif; ?>
