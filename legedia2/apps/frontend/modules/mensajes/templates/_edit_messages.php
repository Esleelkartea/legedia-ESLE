<?php if ($sf_user->hasFlash('notice')): ?>
<div class="save-ok">
<h3><?php echo __($sf_user->getFlash('notice')) ?></h3>
</div>
<?php endif; ?>
