<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/05 11:44:53
?>
<?php echo form_tag('sfTransUnit/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($trans_unit, 'getMsgId') ?>

<fieldset id="sf_fieldset_none" class="">

<div class="form-row">
  <?php echo label_for('trans_unit[source]', __($labels['trans_unit{source}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('trans_unit{source}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('trans_unit{source}')): ?>
    <?php echo form_error('trans_unit{source}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($trans_unit, 'getSource', array (
  'control_name' => 'trans_unit[source]',
  'disabled' => false,
  'size' => 60,
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('trans_unit[target]', __($labels['trans_unit{target}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('trans_unit{target}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('trans_unit{target}')): ?>
    <?php echo form_error('trans_unit{target}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('target', array('type' => 'edit', 'trans_unit' => $trans_unit)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

</fieldset>

<?php include_partial('edit_actions', array('trans_unit' => $trans_unit)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($trans_unit->getMsgId()): ?>
<?php echo button_to(__('delete'), 'sfTransUnit/delete?msg_id='.$trans_unit->getMsgId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>