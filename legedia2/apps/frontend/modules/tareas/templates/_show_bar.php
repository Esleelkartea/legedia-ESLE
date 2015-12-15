<div class="sf_admin_filters">
<?php echo form_tag('tareas/edit', array()) ?>
<?php echo object_input_hidden_tag($tarea , 'getIdTarea');?>

<fieldset>
  <h2><?php echo __('cambiar estado') ?></h2>
  <div class="form-row">
    <?php echo label_for("tarea[id_estado_tarea]" , __('estado').":" )?>
    <div class="content">
    <?php 
      if ($tarea->getEsEvento())
      {
        $opciones = TareaPeer::getAllEstadosEventos();
      }
      else
      {
        $opciones = TareaPeer::getAllEstadosTareas();
      }
      $value = select_tag('tarea[id_estado_tarea]' , 
        objects_for_select($opciones , 'getPrimaryKey' , '__toString' , $tarea->getIdEstadoTarea() , array('include_blank' => false))
      );
      echo $value ? $value : "&nbsp";
    ?>
    </div>
  </div>
</fieldset>
  <ul class="sf_admin_actions">
    <li><?php echo submit_tag(__('cambiar'), array('name'=>'save_and_show' , 'class'=>'sf_admin_action_save')) ?></li>
  </ul>
</form>
</div>
