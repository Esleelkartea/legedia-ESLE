<?php
// auto-generated by sfPropelAdmin
// date: 2007/10/04 15:13:44
?>
<?php if ($sf_request->hasErrors()): ?>
<div class="form-errors">
<h2><?php echo __('There are some errors that prevent the form to validate') ?></h2>
</div>
<?php elseif ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>
<?php elseif ($sf_user->hasFlash('notice_error')): ?>
<div class="form-errors">
<h2><?php echo __($sf_user->getFlash('notice_error')) ?></h2>
</div>
<?php endif; ?>
