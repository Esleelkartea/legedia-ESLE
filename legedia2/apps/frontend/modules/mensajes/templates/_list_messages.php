<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h3><?php echo __('No ha podido borrarse el objeto')?></h3>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php endif; ?>
