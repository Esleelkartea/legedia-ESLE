<?php
 use_helper('MisObjetos');
// auto-generated by sfAdvancedAdmin
// date: 2008/01/10 11:37:55
?>
    <td>&nbsp;<?php echo $log_sesion->getIdLog() ?></td>
      <td>&nbsp;<?php echo $log_sesion->getIdSesion() ?></td>
      <td>&nbsp;<?php echo ($log_sesion->getFecha() !== null && $log_sesion->getFecha() !== '') ? format_date($log_sesion->getFecha(), "dd/MM/yyyy HH:mm") : '' ?></td>
      <td>&nbsp;<?php echo $log_sesion->getModulo() ?></td>
      <td>&nbsp;<?php echo $log_sesion->getAccion() ?></td>
      <td>&nbsp;
			 <?php 
   
		$log_sesion->cadena2array();   
   	foreach ($log_sesion->getParamsarray() as $tclave=>$tvalor) : ?>
            
				<?if ($tvalor!="" && $tvalor!="Array") : ?>
				<font style="font-weight:bold;"><?php echo strtoupper(str_replace('_',' ',$tclave)) ?></font>: <?php echo $tvalor ?><br/>
				<?php endif; ?>
			<?php endforeach; ?>      
      
      </td>
      <td>&nbsp;<?php echo image_ok(($log_sesion->getFirma() != "")); ?></td>
  
