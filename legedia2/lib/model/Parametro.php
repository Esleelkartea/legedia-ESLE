<?php

/**
 * Subclass for representing a row from the 'parametro' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Parametro extends BaseParametro
{
  public function __toString()
  {
    return $this->getNombre();
  }
	 
	public function delete(PropelPDO $con = null, $definitivo = false)
 	{
		if ($definitivo)
		{
		  $fichero = null;
		  if ($this->getFichero())
		  {
		    $fichero = sfConfig::get('sf_upload_dir')."/".$this->getFichero();
		  }
		  $con = $con ? $con : Propel::getConnection(ParametroPeer::DATABASE_NAME);
      try
      {
        $con->beginTransaction();
        // decrementar el orden de aquellos con el misma tipoParametro y orden mayor.
        $sql  = "UPDATE ".ParametroPeer::TABLE_NAME;
        $sql .= " SET ".ParametroPeer::ORDEN." = ".ParametroPeer::ORDEN." - 1";
        $sql .= " WHERE ".ParametroPeer::ORDEN." > ".$this->getOrden();
        $sql .= " AND ".ParametroPeer::TIPOPARAMETRO." = '".$this->getTipoParametro()."'";
        
        $stmt = $con->prepare($sql);
        $stmt->execute();
        // delete the item
        parent::delete();
        $con->commit();
      }
      catch (Exception $e)
      {
        $con->rollBack();
        throw $e;
      }
      //Borrar archivo relacionado (si lo tiene)
      if ($fichero && file_exists($fichero))
      {
        @unlink($fichero);
      }
		}
		else 
		{
			$this->setFechaBorrado(date('Y-m-d H:i:s'));
			$this->save();
		}
	}
	
  
  public function swapWith($parametro)
  {
    if ($parametro->getTipoParametro() != $this->getTipoParametro()) return null;
    $con = Propel::getConnection(ParametroPeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
      $orden = $this->getOrden();  
      $this->setOrden($parametro->getOrden());
      $this->save();
      $parametro->setOrden($orden);
      $parametro->save();
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  } 
  
  
  public function save(PropelPDO $con = null)
  {
    // New records need to be initialized with orden = maxOrden +1
    if(!$this->getPrimaryKey())
    {
      $con = $con ? $con : Propel::getConnection(ParametroPeer::DATABASE_NAME);
      try
      {
        $con->beginTransaction();
        $this->setOrden(ParametroPeer::getMaxOrden($this->getTipoParametro()) + 1);
        parent::save();
        $con->commit();
      }
      catch (Exception $e)
      {
        $con->rollback();
        throw $e;
      }
    }
    else
    {
      parent::save(); 
    }
  }
  
  
  public function getNombreLista()
	{
		eval("\$txt=".$this->getParametroDef()->getCamposLista().";");
		return $txt;
	}
	
	function getFormatedFileSizeFichero()
  {
    $unidades = array("B" , "KB" , "MB" , "GB");
    $unid = 0;
    $fin = false;
    $file_size = $this->getTamano();
    while(!$fin)
    {
      if ( ($file_size > 1024) && ($unid <sizeof($unidades)))
      {
        $file_size = $file_size/1024;
        $unid++;
      }
      else
      {
        $fin = true;
      }
    }
    $resultado = round($file_size , 2)." ".$unidades[$unid];
    return $resultado;
  }
}
