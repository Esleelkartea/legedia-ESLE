<?php

/**
 * Subclass for performing query and update operations on the 'parametro' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ParametroPeer extends BaseParametroPeer
{
	// ORDEN #####################################################################
  static function retrieveByOrden($orden = 1 , $tipo = null)
  {
    if (!isset($tipo)) return null;
    $c = new Criteria;
    $c->add(self::ORDEN, $orden);
    $c->add(self::TIPOPARAMETRO , $tipo);
    
    return self::doSelectOne($c); 
  }
  
  
  static function getMaxOrden($tipo = null)
  {
    if (!isset($tipo)) return 0;
    
    $con = Propel::getConnection(self::DATABASE_NAME);
    $sql = "SELECT MAX(".self::ORDEN.") AS max FROM ".self::TABLE_NAME;
    $sql .= " WHERE ".self::TIPOPARAMETRO." = '".$tipo."'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    
    return $row['max'];
  }
	// FIN ORDEN #################################################################
	
	
	
	//public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	//{
	//	$c1 = $criteria->getNewCriterion(ParametroPeer::FECHABORRADO, null , Criteria::ISNULL);
	//  $c2 = $criteria->getNewCriterion(ParametroPeer::FECHABORRADO, "0000-00-00 00:00:00" ,Criteria::EQUAL);
	//  $c1->addOr($c2);
	//  $criteria->addAnd($c1);
	//  
	//	return parent::doSelectStmt($criteria , $con);
	//}
	
	
	
	//### _ESTADOPROYECTO_ #######################################################
	public static function getEstadosProyecto()
	{
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_ESTADOPROYECTO_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }

  public static function getCategorias()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_CATEGORIA_TABLA_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);

    return ParametroPeer::doSelect($c);
  }
	//aritz funcion para obtener el estado que define que un proyecto esta en marcha para la empresa actual
  //si no esta definido devuelve 0, asi que hay que comprobar siempre lo que devuelve
  public static function getEstadoEnMarcha($id = true)
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, '_ESTADOPROYECTO_');
    $c->add(ParametroPeer::SI_NO, 1);
    $parametro = ParametroPeer::doSelectOne($c);
    if ($parametro instanceof Parametro)
    {
      return ($id) ? $parametro->getIdParametro() : $parametro;
    }
    else
    {
      return null;
    }
  }
  
  public static function getEstadoProyectoSinComenzar($id = true)
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, '_ESTADOPROYECTO_');
    //$c->add(ParametroPeer::SI_NO, 1);
    $c->addAnd(ParametroPeer::ID_PARAMETRO, 22);
    $parametro = ParametroPeer::doSelectOne($c);
    if ($parametro instanceof Parametro)
    {
      return ($id) ? $parametro->getIdParametro() : $parametro;
    }
    else
    {
      return null;
    }
  }
  
  public static function getEstadoProyectoTerminado($id = true)
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, '_ESTADOPROYECTO_');
    $c->addAnd(ParametroPeer::ID_PARAMETRO, 25);
    $parametro = ParametroPeer::doSelectOne($c);
    if ($parametro instanceof Parametro)
    {
      return ($id) ? $parametro->getIdParametro() : $parametro;
    }
    else
    {
      return null;
    }
  }
  
  //### _ESTADOASIGNACION_ #####################################################
  public static function getEstadosAsignacion()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_ESTADOASIGNACION_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _LINEATRABAJO_ #########################################################
  public static function getLineasTrabajo()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_LINEATRABAJO_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _FORMADEPAGO_ ##########################################################
  public static function getFormasDePago()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_FORMADEPAGO_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _FORMADECOBRO_ #########################################################
  public static function getFormasDeCobro()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_FORMADECOBRO_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _ESTADOCOMPRA_ #########################################################
  public static function getEstadosCompra()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_ESTADOCOMPRA_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _CATEGORIA_PROFESIONAL_ ################################################
  public static function getCategoriasProfesionales()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_CATEGORIA_PROFESIONAL_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::NUMERO);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _AREA_PROFESIONAL_ #####################################################
  public static function getAreasProfesionales()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_AREA_PROFESIONAL_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::ORDEN);
    
    return ParametroPeer::doSelect($c);
  }
  
  //### _CATEGORIA_DOCUMENTOS_ ################################################
  public static function getCategoriasDocumentos()
  {
    $c = UsuarioPeer::getCriterioNoBorrado(ParametroPeer::FECHABORRADO);
    $c->add(ParametroPeer::TIPOPARAMETRO, "_CATEGORIA_DOCUMENTOS_", Criteria::EQUAL);
    $c->addAscendingOrderByColumn(ParametroPeer::NUMERO);
    
    return ParametroPeer::doSelect($c);
  }
}
