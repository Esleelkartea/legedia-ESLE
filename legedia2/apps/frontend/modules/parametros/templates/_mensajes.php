<?php if ($sf_request->getError('delete')): ?>
<div class="form-error">
   <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php elseif ($sf_user->hasFlash('notice_error')): ?>
<div class="form-error">
<h2><?php echo __($sf_user->getFlash('notice_error')) ?></2>
</div>
<?php endif; ?>
