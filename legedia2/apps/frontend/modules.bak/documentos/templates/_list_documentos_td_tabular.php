<td><?php 
  $parametros = "?id_documento=".$historico_documento->getIdDocumento();
  $parametros .= '&version='.$historico_documento->getVersion();
  $documento = $historico_documento->getDocumento();
  $value = $documento ? $documento->getNombre() : "";
  echo link_to_if($documento instanceof Documento, $value ? $value : "&mdash;", 
    'historico_documentos/show'.$parametros
  );
?></td>
<td align="right"><?php 
  echo link_to($historico_documento->getVersion() ? 
    $historico_documento->getVersion() : __('-'), 
    'historico_documentos/show'.$parametros);
?></td>
<td><?php echo $historico_documento->getNombreFich() ?></td>
<td align="right"><?php echo $historico_documento->getTamanoFormateado(); ?></td>
<td><?php echo $historico_documento->getFecha() ? 
  format_date($historico_documento->getFecha(), "g") : '';
?></td>
<td><?php
  $usuario = $historico_documento->getUsuario();
  $nombre = $usuario ? $usuario->__toString() : "- ".__('Sin definir')." -";
  echo $nombre ? $nombre : "&mdash;";
?></td>
