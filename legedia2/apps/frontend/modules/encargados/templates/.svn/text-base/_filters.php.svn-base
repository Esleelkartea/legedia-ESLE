<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('encargados/list', array('method' => 'get')) ?>

  <fieldset>
    <h2><?php echo __('Filtros') ?></h2>

        <div class="form-row">
    <label for="filters_nombre"><?php echo __('Nombre:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[nombre]', isset($filters['nombre']) ? $filters['nombre'] : null, array (
  'size' => NULL,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_razon_social"><?php echo __('Razón social:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[razon_social]', isset($filters['razon_social']) ? $filters['razon_social'] : null, array (
  'size' => NULL,
)) ?>
    </div>
    </div>

        <div class="form-row">
    <label for="filters_cif"><?php echo __('Cif:') ?></label>
    <div class="content">
    <?php echo input_tag('filters[cif]', isset($filters['cif']) ? $filters['cif'] : null, array (
  'size' => 10,
)) ?>
    </div>
    </div>

      </fieldset>

  <ul class="sf_admin_actions">
    <li><?php echo button_to(__('Reiniciar'), 'encargados/list?filter=filter', 'class=sf_admin_action_reset_filter') ?></li>
    <li><?php echo submit_tag(__('Filtrar'), 'name=filter class=sf_admin_action_filter') ?></li>
  </ul>

</form>
</div>
