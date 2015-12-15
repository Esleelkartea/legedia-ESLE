    <td><?php echo link_to($usuario->getIdUsuario() ? $usuario->getIdUsuario() : '-', 'usuarios/show?id_usuario='.$usuario->getIdUsuario()) ?></td>
    <td><?php echo link_to($usuario->getUsuario()? $usuario->getUsuario() : '-', 'usuarios/show?id_usuario='.$usuario->getIdUsuario()) ?></td>
    <td><?php echo $usuario->getNombreCompleto() ?></td>
    <td><?php echo $usuario->getEmail() ?></td>
    <td><?php echo ($usuario->getUltimaVisita() !== null && $usuario->getUltimaVisita() !== '') ? format_date($usuario->getUltimaVisita(), "f") : '' ?></td>  
