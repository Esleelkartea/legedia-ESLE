<?php use_helper('MisObjetos')?>
<div id="sf_admin_container">
<?
  foreach ($pager->getResults() as $formulario) break;
  if (!isset($formulario)){
    $id_tabla = isset($filters['id_tabla']) ? $filters['id_tabla'] : null;
    if (isset($id_tabla) && ($id_tabla!=''))
    {
      $tabla = TablaPeer::retrievebypk($id_tabla);
      $formulario = $tabla->getFormulario();
    }
    else $formulario = new Formulario();
  }
  
?>
<h1><?php echo __('Registros de').' '; if ($formulario->getTabla()) echo $formulario->getTabla()->getNombreyEmpresa(); else echo "--"; ?></h1>

<div id="sf_admin_content">
<?php if (!$pager->getNbResults()): ?>
<blockquote class="warning"><p>
<?php echo __('no hay resultados') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('formularios/popup', array('pager' => $pager, "formulario" => $formulario, "tabla"=>$formulario->getTabla(), "valor_sel"=>$valor_sel, "control_name"=>$control_name)) ?>
<?php endif; ?>
<?php include_partial('popup_actions' , array('pager' => $pager, 'filters' => $filters, "control_name"=>$control_name)) ?>
</div>

<div id="sf_admin_bar" style="padding-top: 15px;">
<?php include_partial('filters_popup', array('filters' => $filters,"valor_sel"=>$valor_sel, "control_name"=>$control_name)) ?>
</div>

</div>

<script type="text/javascript">
  function cerrarVentana(control_name){
      control_name = replaceAll(control_name,'[','_');
      control_name = replaceAll(control_name,']','');
      tags = getElementsByClassName(this.document,"input","checkbox_seleccionable");
      for (i=0;i<tags.length;i++){
        if (tags[i].checked) {
          parent.document.getElementById(control_name).value=tags[i].value;
          parent.document.getElementById(control_name+"_name").value=tags[i].name;
          break;
        }
      }
      
      parent.myLightWindow.deactivate();
      return false;
  }
  
  function desquitar(f){
      tags = getElementsByClassName(this.document,"input","checkbox_seleccionable");
      for (i=0;i<tags.length;i++){
        if (tags[i] != f){
          tags[i].checked=false;
        }
      }
  }
</script>