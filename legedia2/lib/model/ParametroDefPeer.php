<?php

/**
 * Subclass for performing query and update operations on the 'parametro_def' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ParametroDefPeer extends BaseParametroDefPeer
{
  public static function getAllByNombre()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ParametroDefPeer::NOMBRE);
    
    return self::doSelect($c);
  }
}
