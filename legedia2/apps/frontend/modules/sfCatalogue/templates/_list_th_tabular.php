<?php
// auto-generated by sfPropelAdmin
// date: 2008/09/05 11:44:50
?>
  <th id="sf_admin_list_th_cat_id">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'cat_id'): ?>
      <?php echo link_to(__($labels['catalogue{cat_id}']), 'sfCatalogue/list?sort=cat_id&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{cat_id}']), 'sfCatalogue/list?sort=cat_id&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_nvisible">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'nvisible'): ?>
      <?php echo link_to(__($labels['catalogue{nvisible}']), 'sfCatalogue/list?sort=nvisible&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{nvisible}']), 'sfCatalogue/list?sort=nvisible&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_name">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'name'): ?>
      <?php echo link_to(__($labels['catalogue{name}']), 'sfCatalogue/list?sort=name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{name}']), 'sfCatalogue/list?sort=name&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_source_lang">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'source_lang'): ?>
      <?php echo link_to(__($labels['catalogue{source_lang}']), 'sfCatalogue/list?sort=source_lang&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{source_lang}']), 'sfCatalogue/list?sort=source_lang&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_target_lang">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'target_lang'): ?>
      <?php echo link_to(__($labels['catalogue{target_lang}']), 'sfCatalogue/list?sort=target_lang&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{target_lang}']), 'sfCatalogue/list?sort=target_lang&type=asc') ?>
      <?php endif; ?>
          </th>
          <!-- <?php /*Ana: 16-02-09 no se necesita esta información
  <th id="sf_admin_list_th_date_created">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'date_created'): ?>
      <?php echo link_to(__($labels['catalogue{date_created}']), 'sfCatalogue/list?sort=date_created&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{date_created}']), 'sfCatalogue/list?sort=date_created&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_date_modified">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'date_modified'): ?>
      <?php echo link_to(__($labels['catalogue{date_modified}']), 'sfCatalogue/list?sort=date_modified&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{date_modified}']), 'sfCatalogue/list?sort=date_modified&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_author">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/catalogue/sort') == 'author'): ?>
      <?php echo link_to(__($labels['catalogue{author}']), 'sfCatalogue/list?sort=author&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/catalogue/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__($labels['catalogue{author}']), 'sfCatalogue/list?sort=author&type=asc') ?>
      <?php endif; ?>
          </th>
  */ ?> -->