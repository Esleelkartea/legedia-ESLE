<?php

/**
 * Subclass for performing query and update operations on the 'provincia' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ProvinciaPeer extends BaseProvinciaPeer
{
  public static function getProvinciasOrdenadas($pais = 'ES')
  {
    $c = new Criteria();
    $c->add($c->getNewCriterion(ProvinciaPeer::PAIS, $pais, Criteria::EQUAL));
    $c->addAscendingOrderByColumn(ProvinciaPeer::NOMBRE);
    return ProvinciaPeer::doSelect($c);
  }
}
