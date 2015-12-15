<fieldset id="sf_fieldset_datos" class="">
<h2><?php echo __('Datos personales') ?></h2>


<div class="form-row">
  <?php echo label_for('usuario[nombre_completo]', __($labels['usuario{nombre_completo}']), '') ?>
  <div class="content">
  <?php 
    echo $usuario->getNombreCompleto() ? $usuario->getNombreCompleto() :'-'?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[dni]', __($labels['usuario{dni}']), '') ?>
  <div class="content">
  
  <?php $value = $usuario->getDni(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[domicilio]', __($labels['usuario{domicilio}']), '') ?>
  <div class="content">
  <?php 
    echo $usuario->getDireccionFormato() ? $usuario->getDireccionFormato() : '-'?>
  </div>
</div>




<div class="form-row">
  <?php echo label_for('usuario[movil]', __($labels['usuario{movil}']), '') ?>
  <div class="content">
  <?php $value = $usuario ->getMovil(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('usuario[email]', __($labels['usuario{email}']), '') ?>
  <div class="content">
  <?php 
    echo $usuario->getEmail() ? $usuario->getEmail() : '-'?>
  </div>
</div>


</fieldset>

