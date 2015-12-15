<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h2><?php echo __('No ha podido borrarse el objeto %name%', array('%name%' => 'Historico documento')) ?></h2>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php elseif ($sf_user->hasFlash('notice_error')): ?>
<div class="form-errors">
<h2><?php echo __($sf_user->getFlash('notice_error')) ?></h2>
</div>
<?php endif; ?>
