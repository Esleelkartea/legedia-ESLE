
  <th id="sf_admin_list_th_iddocumento">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'iddocumento'): ?>
      <?php echo link_to(__('Documento'), 'historico_documentos/list?sort=iddocumento&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Documento'), 'historico_documentos/list?sort=iddocumento&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_version">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'version'): ?>
      <?php echo link_to(__('Versión'), 'historico_documentos/list?sort=version&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Versión'), 'historico_documentos/list?sort=version&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_nombre_fich">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'nombre_fich'): ?>
      <?php echo link_to(__('Fichero'), 'historico_documentos/list?sort=nombre_fich&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Fichero'), 'historico_documentos/list?sort=nombre_fich&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_tamano">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'tamano'): ?>
      <?php echo link_to(__('Tamaño'), 'historico_documentos/list?sort=tamano&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Tamaño'), 'historico_documentos/list?sort=tamano&type=asc') ?>
      <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_fecha">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'fecha'): ?>
      <?php echo link_to(__('Fecha de subida'), 'historico_documentos/list?sort=fecha&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
    <?php else: ?>
      <?php echo link_to(__('Fecha de subida'), 'historico_documentos/list?sort=fecha&type=asc') ?>
    <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_id_usuario">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/historico_documento/sort') == 'usuario'): ?>
      <?php echo link_to(__('Subido por'), 'historico_documentos/list?sort=usuario&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/historico_documento/sort')) ?>)
    <?php else: ?>
      <?php echo link_to(__('Subido por'), 'historico_documentos/list?sort=usuario&type=asc') ?>
    <?php endif; ?>
  </th>
