<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h2><?php echo __('No se ha podido borrar el objeto %name%', array('%name%' => 'Parametro')) ?></h2>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php elseif ($sf_user->hasFlash('error')): ?>
<div class="form-errors">
<h2><?php echo __($sf_user->getFlash('error')) ?></h2>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php endif; ?>
