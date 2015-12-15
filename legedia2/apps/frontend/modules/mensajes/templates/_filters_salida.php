<div class="sf_admin_filters">
<?php echo form_tag('mensajes/salida', array('method' => 'get')) ?>

<fieldset>
  <h2><?php echo __('filtros') ?></h2>
    
  <div class="form-row">
    <?php echo label_for("filters[salida_id_usuario]" , __('enviados a').":" )?>
    <div class="content">
    <?php 
      $usuario_actual = Usuario::getUsuarioActual();
      $usuarios = $usuario_actual->getUsuariosAccesibles();
      $id_usuario = isset($filters['salida_id_usuario']) ? $filters['salida_id_usuario'] : null;
      $value = select_tag('filters[salida_id_usuario]' , 
        objects_for_select($usuarios , 'getPrimaryKey' , 'getNombreCompleto' , $id_usuario , array('include_blank' => true)), 
        array ('control_name' => 'filters[salida_id_usuario]' ) 
      ); 
      echo $value ? $value : '&nbsp;';
     ?>
    </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for("filters[salida_asunto]" , __('asunto').":" )?>
    <div class="content">
    <?php echo input_tag('filters[salida_asunto]', isset($filters['salida_asunto']) ? $filters['salida_asunto'] : null, array (
     'control_name' => 'filters[salida_asunto]',
    )) ?>
    </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for("filters[salida_fecha]" , __('fecha').":" );?>
    <div class="content">
    <?php echo input_date_range_tag('filters[salida_fecha]', isset($filters['salida_fecha']) ? $filters['salida_fecha'] : null, array (
  'rich' => true,
  'withtime' => false,
  'calendar_button_img' => '/images/icons/date.png',
)) ?>
    </div>
  </div>
    
  </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('reiniciar'), 'mensajes/salida?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
