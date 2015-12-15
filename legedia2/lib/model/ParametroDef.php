<?php

/**
 * Subclass for representing a row from the 'parametro_def' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ParametroDef extends BaseParametroDef
{
  public function __toString()
  {
    return $this->getNombre();
  }
  
  public function getParametroUnicoOrCreate()
  {
    if (!$this->getPrimaryKey()) return null;
    
    $c = new Criteria();
    $c->setLimit(1);
    $parametros = $this->getParametros($c);
    if (isset($parametros[0]))
    {
      $parametro = $parametros[0];
    }
    else
    {
      $parametro = new Parametro();
      $parametro->setTipoParametro($this->getPrimaryKey());
    }
    
    return $parametro;
  }
  
  public function getParametrosByOrden()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return $this->getParametros($c);
  }
  
  public function getArrayCamposActivosParameter()
  {
    $resul = array();
    if ($this->getCampoNombre())      $resul[ParametroPeer::NOMBRE] = $this->getCampoNombre();
    if ($this->getCampoNumero())      $resul[ParametroPeer::NUMERO] = $this->getCampoNumero();
    if ($this->getCampoNumero2())     $resul[ParametroPeer::NUMERO2] = $this->getCampoNumero2();
    if ($this->getCampoCadena())      $resul[ParametroPeer::CADENA] = $this->getCampoCadena();
    if ($this->getCampoCadena1())     $resul[ParametroPeer::CADENA1] = $this->getCampoCadena1();
    //if ($this->getCampoCadenaMultiIdioma()) $resul[ParametroPeer::CAMPOCADENAMULTIIDIOMA] = $this->getCampoCadenaMultiIdioma();
    if ($this->getCampoOtroObjeto())  $resul[ParametroPeer::OTROOBJETO] = $this->getCampoOtroObjeto();
    if ($this->getCampoSiNo())        $resul[ParametroPeer::SI_NO] = $this->getCampoSiNo();
    if ($this->getCampoFecha())       $resul[ParametroPeer::FECHA] = $this->getCampoFecha();
    if ($this->getCampoFichero())     $resul[ParametroPeer::NOMBREFICHERO] = $this->getCampoFichero();
    
    return $resul;
  }
  
  public function reorderParametrosByColumn($column = ParametroPeer::NOMBRE, $type = "asc")
  {
    $c = new Criteria();
    if ($type == "asc")
    {
      $c->addAscendingOrderByColumn($column);
    }
    else
    {
      $c->addDescendingOrderByColumn($column);
    }
    
    $parametros = $this->getParametros($c);
    try
    {
      $con = Propel::getConnection(ParametroPeer::DATABASE_NAME);
      $con->beginTransaction();
      $orden = 1;
      foreach ($parametros as $parametro)
      {
        $parametro->setOrden($orden);
        $parametro->save($con);
        $orden++;
      }
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
    
    return true;
  }
}
