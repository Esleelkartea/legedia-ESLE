<?php
// auto-generated by sfAdvancedAdmin
// date: 2008/01/10 11:37:49
?>
<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h2><?php echo __('Could not delete the selected %name%', array('%name%' => 'Sesion')) ?></h2>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php endif; ?>