<?php
echo form_tag('notificaciones/guardar_supresion', array(
    'id' => 'sf_notis_form',
    'name' => 'sf_notis_form',
    'method' => 'post'));
    include_partial('mostrar', array('id_fichero' => $sf_request->getParameter('id_fichero'), 'notid' => $sf_request->getParameter('id_notificacion'), 'encargado' => $encargado, 'action' => 'supress')); ?>
</form>