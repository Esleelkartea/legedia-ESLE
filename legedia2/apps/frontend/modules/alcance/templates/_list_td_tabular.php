<?php 
  $parametros = "?id_usuario=".$alcance->getIdUsuario()."&id_alcance=".$alcance->getIdAlcance();
  $empresa = $alcance->getIdEmpresa() ? $alcance->getEmpresa() : null;
  $tabla = $alcance->getIdTabla() ? $alcance->getTabla() : null;
  $todas = " - ".__('todas')." - ";
?>
<td><?php echo link_to($alcance->getIdAlcance() ? $alcance->getIdAlcance() : '-', 'alcance/edit'.$parametros) ?></td>
<td><?php echo $alcance->getTitulo() ?></td>
<td><?php echo $empresa ? $empresa->__toString() : $todas ?></td>
<td><?php echo $tabla ? $tabla->__toString() : $todas ?></td>

<td>
</td>