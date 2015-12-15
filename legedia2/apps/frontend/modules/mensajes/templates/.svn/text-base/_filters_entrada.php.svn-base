<div class="sf_admin_filters">
<?php echo form_tag('mensajes/entrada', array('method' => 'get')) ?>

<fieldset>
  <h2><?php echo __('filtros') ?></h2>
    
  <div class="form-row">
    <?php echo label_for("filters[entrada_id_usuario]" , __('enviados por').":" )?>
    <div class="content">
    <?php 
      $usuario_actual = Usuario::getUsuarioActual();
      $usuarios = $usuario_actual->getUsuariosAccesibles();
      $id_usuario = isset($filters['entrada_id_usuario']) ? $filters['entrada_id_usuario'] : null;
      $value = select_tag('filters[entrada_id_usuario]' , 
        objects_for_select($usuarios , 'getPrimaryKey' , 'getNombreCompleto' , $id_usuario , array('include_blank' => true)), 
        array ('control_name' => 'filters[entrada_id_usuario]' ) 
      ); 
      echo $value ? $value : '&nbsp;';
     ?>
    </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for("filters[entrada_asunto]" , __('asunto').":" )?>
    <div class="content">
    <?php echo input_tag('filters[entrada_asunto]', isset($filters['entrada_asunto']) ? $filters['entrada_asunto'] : null, array (
     'control_name' => 'filters[entrada_asunto]',
    )) ?>
    </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for('filters[entrada_leido]', __('leido').":", '') ?>
    <div class="content">
    <?php echo select_tag('filters[entrada_leido]', options_for_select(array(1 => __('si'), 0 => __('no')), isset($filters['entrada_leido']) ? $filters['entrada_leido'] : null, array (
  'include_custom' => __("si o no"),
)), array (
)) ?>
    </div>
  </div>
  
  <div class="form-row">
    <?php echo label_for("filters[entrada_fecha]" , __('fecha').":" );?>
    <div class="content">
    <?php echo input_date_range_tag('filters[entrada_fecha]', isset($filters['entrada_fecha']) ? $filters['entrada_fecha'] : null, array (
  'rich' => true,
  'withtime' => false,
  'calendar_button_img' => '/images/icons/date.png',
)) ?>
    </div>
  </div>
    
  </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('reiniciar'), 'mensajes/entrada?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
