<?php use_helper('Date')?>

     <td align="center">
    <?php echo $backup['nombre']; ?>
  </td>
  <td align="center">
    <?php echo format_date($backup['fecha'] , 'F'); ?>
  </td>
  <td align="center">
    <?php 
    $tamano = $backup['tamano'];
    $unidades = array("B" , "KB" , "MB");
    $unid = 0;
    $fin = false;
    while(!$fin){
      if ( ($tamano > 1024) && ($unid <2)){
        $tamano = $tamano/1024;
        $unid++;
      }else{
        $fin = true;
      }
    }
    echo round($tamano , 2)." ".$unidades[$unid]; ?>
  </td>
  
 
  