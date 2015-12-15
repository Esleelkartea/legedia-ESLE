<?php

class EncargadoPeer extends BaseEncargadoPeer
{
  public static function getEncargadosEmpresa()
  {
    $c = new Criteria();
    $c->add(self::ID_EMPRESA, sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    $c->addAscendingOrderByColumn(self::NOMBRE);
    
    return self::doSelect($c);
  }
  
  /**
  * Devuelve un listado con todos los clientes
  * @return array, lista de objetos de tipo clientes. Ordenados por nombre
  * @version 18-05-09
  * @author Ana Martín
  */  
  public static function getAllEncargados() {
    return self::getEncargadosEmpresa();
  }
}
