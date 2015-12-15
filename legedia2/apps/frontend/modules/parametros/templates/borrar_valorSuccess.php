<?php
if (isset($DefParametro)) {
	 echo include_partial('parametros/datos_edit',array('parametro'=>$parametro,'DefParametro'=>$DefParametro,'nuevo'=>$nuevo,'idiomas'=>$idiomas));
	}
else echo include_partial('parametros/mensajes'); 
	 
	  ?>
