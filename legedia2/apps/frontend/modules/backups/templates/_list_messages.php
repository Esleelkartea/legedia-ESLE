<?php
// auto-generated by sfPropelAdmin
// date: 2007/08/30 11:31:00
?>
<?php if ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
</div>

<?php elseif ($sf_user->hasFlash('notice_error')): ?>
<div class="form-errors">
<h2><?php echo __($sf_user->getFlash('notice_error')) ?></h2>
</div>
<?php endif; ?>

