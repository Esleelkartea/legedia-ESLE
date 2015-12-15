<?php if ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php endif; ?>
<?php  if ($sf_user->hasFlash('notice_error')): ?>
<div class="form-error">
<h2><?php echo __($sf_user->getFlash('notice_error')) ?></h2>
</div>

<?php endif; ?>
