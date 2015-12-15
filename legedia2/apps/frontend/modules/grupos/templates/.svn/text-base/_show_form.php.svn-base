

<?php echo object_input_hidden_tag($grupo, 'getIdGrupo') ?>
<?php include_partial('show_actions', array('grupo' => $grupo)) ?>
<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos') ?></h2>


<div class="form-row">
  <?php echo label_for('grupo[nombre]', __($labels['grupo{nombre}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('grupo{nombre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('grupo{nombre}')): ?>
    <?php echo form_error('grupo{nombre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($grupo, 'getNombre', array (
  'size' => 60,
  'control_name' => 'grupo[nombre]',
  'readonly' => true, 
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('grupo[padre]', $labels['grupo{padre}'], '') ?>
  <div class="content<?php if ($sf_request->hasError('grupo{padre}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('grupo{padre}')): ?>
    <?php echo form_error('grupo{padre}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>
  <?php
    $padres = Grupo::arbolGrupos(true);
    $value = select_tag('grupo[padre]' , options_for_select($padres , $grupo->getPadre() ) , array('control_name' => 'grupo[padre]', 'disabled' => true, ));
    echo $value ? $value : "&nbsp;";
  ?>
  </div>
</div>


</fieldset>

<?php if ($grupo->getIdGrupo()) : ?>
<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Permisos') ?></h2>
<?php
  $permisos = $grupo->obtenerTodosPermisos();
  $i = 0;
?>
<?php foreach($permisos as $modulo=>$acciones) : ?>
<div class="form-row">
  <?php echo label_for('grupo['.$modulo.']', str_replace("_"," ",$modulo), '') ?>
  <div class="content">
    <ul class="sf_admin_checklist">
    <?php 
      foreach($acciones as $accion=>$permiso)
      { 
        $html = "";
        $html .= "<li>";
        $html .= input_hidden_tag('modulo['.$i.']' , $modulo , array('control_name' => 'modulo['.$i.']'));
        $html .= input_hidden_tag('accion['.$i.']' , $accion , array('control_name' => 'accion['.$i.']'));
        $html .= input_hidden_tag('heredado['.$i.']' , $permiso , array('control_name' => 'heredado['.$i.']'));
        $is_checked = ($permiso==1 || $permiso==2);
        $html .= checkbox_tag('seleccionado['.$i.']' , 1 , $is_checked , array(
          'control_name' => 'seleccionado['.$i.']',
          'disabled' => true
          ));
        $html .= label_for('seleccionado['.$i.']' , str_replace("_"," ",$accion) , ($permiso==2) ? 'class=required' : '');
        $html .= "</li>\n";
        echo $html;
        $i++;
      }
      if (count($acciones) <= 0){
        echo "<li><i>".__('vacío')."</i></li>\n";
      }
    ?>
   
    </ul>
  </div>
</div>
<?php endforeach; ?>


</fieldset>
<?php endif ; ?>
<?php include_partial('show_actions', array('grupo' => $grupo)) ?>


