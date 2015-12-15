<?php

/**
 * Subclass for performing query and update operations on the 'tabla' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TablaPeer extends BaseTablaPeer
{

 public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		$c1 = $criteria->getNewCriterion(TablaPeer::BORRADO, null , Criteria::ISNULL);
	  $c2 = $criteria->getNewCriterion(TablaPeer::BORRADO, false ,Criteria::EQUAL);
	  $c1->addOr($c2);
	  $criteria->addAnd($c1);
		return parent::doSelectStmt($criteria , $con);
	}
	
	public static function getCriterioAlcanceVacio(){
    $c = new Criteria();
    $c->add(TablaPeer::ID_TABLA , 0);
    return $c;
  }
  
  public static function getCriterioAlcance($esLista = false)
  {
    $c_base = sfContext::getInstance()->getUser()->getAttribute('tablas',self::getCriterioAlcanceVacio(),'alcance');
    $cr = clone $c_base;
    if ($esLista) $cr->addAnd(TablaPeer::MOSTRAR_EN_LISTA,true,Criteria::EQUAL);
    $cr->addAscendingOrderByColumn(TablaPeer::ID_EMPRESA);
    $cr->addAscendingOrderByColumn(TablaPeer::ID_CATEGORIA);
    $cr->addAscendingOrderByColumn(TablaPeer::ORDEN);
    return $cr;
  }
  
  public static function getMiSQL($criteria)
  {
    if (!isset($criteria)){
      return null;
    }
    
    if (!$criteria->getSelectColumns())
    {
			$criteria = clone $criteria;
			self::addSelectColumns($criteria);
		}
    $criteria->setDbName(self::DATABASE_NAME);
    
    $con = Propel::getConnection($criteria->getDbName());
    
    $params = array();
    $sql = BasePeer::createSelectSql($criteria, $params);
    
    $stmt = null;
    $stmt = $con->prepare($sql);
    $stmt->setLimit($criteria->getLimit());
    $stmt->setOffset($criteria->getOffset());
    return $stmt;
    
  }


  /**
  * Función que devuelve el criterio para que solo se vean las fuentes de datos que se corresponden con la empresa que se pasa como parametro.
  * @param id_empresa, identificador de la empresa.
  * @return criteria, objecto de tipo criteria.
  * @version 20-04-09
  * @author Ana Martín.
  */
  public static function getCriteriaByEmpresa($id_empresa) {
      $c = new Criteria();
      $c->add(TablaPeer::ID_EMPRESA, $id_empresa);

      return $c;
  }
  
  public static function getTablaFicheros(){
    $c = TablaPeer::getCriterioAlcance();
    $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',0);
    $c->addAnd(TablaPeer::ID_EMPRESA, $id_empresa,Criteria::EQUAL);
    $c->addAnd(TablaPeer::ES_FICHEROS, true,Criteria::EQUAL);
    $t = TablaPeer::doSelectOne($c);
    if ($t instanceof Tabla)return $t->getIdTabla(); 
    else return 0;
  }
}
