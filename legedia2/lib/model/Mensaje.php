<?php

/**
 * Subclass for representing a row from the 'mensaje' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Mensaje extends BaseMensaje
{
 public function delete(PropelPDO $con = null, $definitivo = false)
  {
    if ($definitivo){
      $this->initMensajeDestinos();
      parent::delete();
    }
  	else {
  		$this->setBorrado(true);
  		$this->save();
  	}
  }
}

