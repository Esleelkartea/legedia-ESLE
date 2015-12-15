
<fieldset id="sf_fieldset_preferencias" class="">
<h2><?php echo __('Preferencias') ?></h2>

<div class="form-row">
  <?php echo label_for('usuario[id_idioma]', __($labels['usuario{id_idioma}']), 'class="required" ') ?>
  <div class="content">

  <?php 
        $value = $usuario ->getIdioma(); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>



</fieldset>



