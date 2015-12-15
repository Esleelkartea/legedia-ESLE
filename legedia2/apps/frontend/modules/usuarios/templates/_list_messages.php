<?php if ($sf_request->getError('delete')): ?>
<div class="form-errors">
  <h3><?php __('No ha podido borrarse el objeto')?></h3>
  <ul>
    <li><?php echo $sf_request->getError('delete') ?></li>
  </ul>
</div>
<?php endif; ?>
