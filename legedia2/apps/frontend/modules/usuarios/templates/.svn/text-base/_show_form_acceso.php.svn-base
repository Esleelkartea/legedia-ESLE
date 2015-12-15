
<fieldset id="sf_fieldset_datos_de_acceso" class="">
<h2><?php echo __('Datos de acceso') ?></h2>


<div class="form-row">
  <?php echo label_for('usuario[usuario]', __($labels['usuario{usuario}']), '') ?>
  <div class="content">
  <?php echo $usuario->getUsuario() ? $usuario->getUsuario() : '-'?>
  </div>
</div>


<div class="form-row">
  <?php echo label_for('usuario[grupos]', __($labels['usuario{grupos}']), '') ?>
  <div class="content">
  <?php 
    $grupos = $usuario->getGrupos();
    $html = "<ul class=\"sf_admin_checklist\">\n";
    
    foreach($grupos as $grupo){
      $html .= "<li>";
      $html .= $grupo->__toString();
      $html .= "</li>\n";
    }
    if (sizeof($grupos) <= 0){
      $html .= "<li>"."<i>".__('vacío')."</i>"."</li>\n";
    }
    $html .= "</ul>\n";
    echo $html;
  ?>
  </div>
</div>

</fieldset>



