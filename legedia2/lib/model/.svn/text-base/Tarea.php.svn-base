<?php

/**
 * Subclass for representing a row from the 'tarea' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Tarea extends BaseTarea
{
  
  public static function getCriterioAlcanceVacio()
  {
    $c = new Criteria();
    $c->add(TareaPeer::ID_TAREA , 0);
    return $c;
  }
  

  /**
  * Función que devuelve el estado de la tarea.
  * @return string
  * @version 10-02-09
  * @author Ana Martín
  */
  public function getEstadoTarea() {
      $objeto = ParametroPeer::retrievebypk($this->getIdEstadoTarea());
      
      if ($objeto instanceof Parametro) {
         return $objeto->getNombre();                   
      }
      else {
         return '--';      
      }
  
  }

}
