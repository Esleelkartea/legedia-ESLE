<ul id="botones_registro" class="sf_admin_actions">
<?php if ($id_formulario_proviene != null) : ?>
  <li><?php echo button_to(__('Volver'), 'formularios/edit?id_formulario='.$id_formulario_proviene, array (
  'class' => 'sf_admin_action_list',
)) ?></li>
<?php elseif ($id_tabla_proviene != null) : ?>
  <li><?php echo button_to(__('Volver'), 'formularios/create?id_tabla='.$id_tabla_proviene, array (
  'class' => 'sf_admin_action_list',
)) ?></li>
<?php else : ?>
<?php
   /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
   $ruta = UsuarioPeer::getRuta(); 
?>
<li><input class="sf_admin_action_list" value="Cancelar" type="button" onclick="document.location.href='<?php echo $ruta; ?>/formularios/list?filters[id_empresa]=<?php echo $formulario->getTabla()->getIdEmpresa(); ?>&filters[id_tabla]=<?php echo $formulario->getIdTabla(); ?>&filter=filtrar';"></li>
<?php endif; ?>

<?php /*
  <li> //echo button_to(__('Lista de campos'), 'formulario_modelo/edit?id_empresa='.$formulario->getTabla()->getIdEmpresa()."&id_tabla=".$formulario->getIdTabla(), array ('class' => 'sf_admin_action_list',)) ?></li>
*/
?>

<li><?php echo submit_tag(__('Guardar'), array ('id' => 'bot', 'name' => 'save', 'class' => 'sf_admin_action_save',)) ?></li>

<?php if (!$formulario->getTabla()->getEsFicheros() || $formulario->getIdformulario() != '') : ?>
    <li><?php echo submit_tag(__('save and add'), array ('name' => 'save_and_add', 'class' => 'sf_admin_action_save_and_add',)) ?></li>
    <li><?php echo submit_tag(__('save and list'), array ('name' => 'save_and_list', 'class' => 'sf_admin_action_save_and_list',)) ?></li>
<?php endif; ?>
</ul>

