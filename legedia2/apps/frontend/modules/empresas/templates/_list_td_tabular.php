<td>
  <?php
      if ($empresa->getLogoMin()) {
          echo image_tag($empresa->getUrlLogoMin() , array('alt' => __('Logotipo') , 'title' => __('Logotipo') , ));
      }
      
  ?>
</td>
<td><?php echo link_to($empresa->getIdEmpresa() ? $empresa->getIdEmpresa() : '-', 'empresas/show?id_empresa='.$empresa->getIdEmpresa()) ?></td>
<td><?php echo link_to($empresa->__toString() ? $empresa->__toString() : '-', 'empresas/show?id_empresa='.$empresa->getIdEmpresa()) ?></td>
<td><?php echo $empresa->getDomicilio() ?></td>
<td><?php echo $empresa->getPoblacion() ?></td>
<td><?php echo $empresa->getCodigoPostal() ?></td>
<td><?php echo $empresa->getProvincia() ? $empresa->getProvincia()->__toString() : '-' ?></td>
<td><?php $usuario = $empresa->getUsuario(); echo $usuario ? $usuario->getNombreCompleto() : '-'; ?></td>
