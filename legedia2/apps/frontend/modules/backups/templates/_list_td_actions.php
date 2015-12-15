<?php use_helper('Javascript')?>
<?php 
  $nombreLinea = "linea_".$backup['nombre']; 
  $parametros = "?archivo=".$backup['nombre'];
?>
 <td align="center">
    <?php if (Usuario::tienePermisos('backups' , 'restaurar')) : ?>
    <?php 
      echo link_to_remote(image_tag('/images/icons/database_connect.png') , 
                          array('url' => 'backups/restaurar'.$parametros , 
                                'update' => 'actualizable' , 
                                'confirm' => __('¿Realmente desea recuperar la base de datos con la información de este archivo?') , 
                                'loading' => visual_effect("toggle_appear" , "indicador") , 
                                'complete' => "Element.hide('indicador'); this.document.location.reload(true);" , 
                                //'success' => "Element.remove('".$nombreLinea."');"
                                ) );
    ?>
    <?php else : ?>
      -
    <?php endif ; ?>

    <?php if (Usuario::tienePermisos('backups' , 'borrar')) : ?>
    <?php 
      echo link_to_remote(image_tag('/images/icons/database_delete.png') , 
                          array('url' => 'backups/borrar'.$parametros , 
                                'update' => 'actualizable' , 
                                'confirm' => __("Realmente desea borrar esta copia de seguridad?") , 
                                'loading' => visual_effect("toggle_appear" , "indicador") , 
                                'complete' => "Element.hide('indicador'); this.document.location.reload(true);" , 
                                //'success' => "Element.remove('".$nombreLinea."');"
                                ) );
    ?>
    <?php else : ?>
      -
    <?php endif ; ?>
  </td>