<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/05 11:44:50
?>
<?php echo form_tag('sfCatalogue/save', array(
  'id'        => 'sf_admin_edit_form',
  'name'      => 'sf_admin_edit_form',
  'multipart' => true,
)) ?>

<?php echo object_input_hidden_tag($catalogue, 'getCatId') ?>

<fieldset id="sf_fieldset_none" class="">
<h2><?php echo __('Datos') ?></h2>
<div class="form-row">
  <?php echo label_for('catalogue[nvisible]', __($labels['catalogue{nvisible}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{nvisible}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{nvisible}')): ?>
    <?php echo form_error('catalogue{nvisible}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($catalogue, 'getNvisible', array (
  'size' => 60,
  'control_name' => 'catalogue[nvisible]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('catalogue[name]', __($labels['catalogue{name}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{name}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{name}')): ?>
    <?php echo form_error('catalogue{name}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($catalogue, 'getName', array (
  'size' => 60,
  'control_name' => 'catalogue[name]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('catalogue[source_lang]', __($labels['catalogue{source_lang}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{source_lang}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{source_lang}')): ?>
    <?php echo form_error('catalogue{source_lang}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($catalogue, 'getSourceLang', array (
  'size' => 60,
  'control_name' => 'catalogue[source_lang]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('catalogue[target_lang]', __($labels['catalogue{target_lang}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{target_lang}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{target_lang}')): ?>
    <?php echo form_error('catalogue{target_lang}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($catalogue, 'getTargetLang', array (
  'size' => 60,
  'control_name' => 'catalogue[target_lang]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<!--
<div class="form-row">
  <?php echo label_for('catalogue[date_created]', __($labels['catalogue{date_created}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{date_created}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{date_created}')): ?>
    <?php echo form_error('catalogue{date_created}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($catalogue, 'getDateCreated', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
  'control_name' => 'catalogue[date_created]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('catalogue[date_modified]', __($labels['catalogue{date_modified}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{date_modified}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{date_modified}')): ?>
    <?php echo form_error('catalogue{date_modified}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_date_tag($catalogue, 'getDateModified', array (
  'rich' => true,
  'withtime' => true,
  'calendar_button_img' => '/sf/sf_admin/images/date.png',
  'control_name' => 'catalogue[date_modified]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>

<div class="form-row">
  <?php echo label_for('catalogue[author]', __($labels['catalogue{author}']), '') ?>
  <div class="content<?php if ($sf_request->hasError('catalogue{author}')): ?> form-error<?php endif; ?>">
  <?php if ($sf_request->hasError('catalogue{author}')): ?>
    <?php echo form_error('catalogue{author}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($catalogue, 'getAuthor', array (
  'size' => 60,
  'control_name' => 'catalogue[author]',
)); echo $value ? $value : '&nbsp;' ?>
    </div>
</div>
-->
</fieldset>

<?php include_partial('edit_actions', array('catalogue' => $catalogue)) ?>

</form>

<ul class="sf_admin_actions">
      <li class="float-left"><?php if ($catalogue->getCatId()): ?>
<?php echo button_to(__('delete'), 'sfCatalogue/delete?cat_id='.$catalogue->getCatId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
  'class' => 'sf_admin_action_delete',
)) ?><?php endif; ?>
</li>
  </ul>
