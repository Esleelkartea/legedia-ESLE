<div class="sf_admin_filters">
<?php echo form_tag('trabajadores/list', array('method' => 'get')) ?>

<fieldset>
  <h2><?php echo __('Atención') ?></h2>
  <div class="form-row">
    <p><?php 
      $texto = 'Para añadir nuevos parámetros, así como para poder editar/borrar';
      $texto .= ' aquellos que no lo permitan, póngase en contacto con el administrador.';
      echo __($texto);
    ?></p>
  </div>
</fieldset>
</div>
