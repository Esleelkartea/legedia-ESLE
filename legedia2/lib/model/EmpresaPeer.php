<?php

/**
 * Subclass for performing query and update operations on the 'empresa' table.
 *
 * 
 *
 * @package lib.model
 */ 
class EmpresaPeer extends BaseEmpresaPeer
{
 public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
	  $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
	  $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',null);
	  $estamosEmpresa = (sfContext::getInstance()->getModuleName() == "empresas");
	  
	  if ($id_empresa != null && !$estamosEmpresa && !$todas_empresas ){
      $criteria->addAnd(EmpresaPeer::ID_EMPRESA, $id_empresa ,Criteria::EQUAL);
    }
    
    $c1 = $criteria->getNewCriterion(EmpresaPeer::BORRADO, null , Criteria::ISNULL);
	  $c2 = $criteria->getNewCriterion(EmpresaPeer::BORRADO, false ,Criteria::EQUAL);
	  $c1->addOr($c2);
	  $criteria->addAnd($c1);
	  
		return parent::doSelectStmt($criteria, $con);
  }
  
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{
	 $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',false);
	 sfContext::getInstance()->getUser()->setAttribute('todas_empresas',true);
	 
	 $valor = parent::retrieveByPK($pk, $con);
	 
	 sfContext::getInstance()->getUser()->setAttribute('todas_empresas',$todas_empresas);
	 
	 return $valor;
	}
	
  public static function getCriterioAlcanceVacio(){
    $c = new Criteria();
    $c->add(EmpresaPeer::ID_EMPRESA , 0);
    return $c;
  }
  
  public static function getCriterioAlcance(){
    $c_base = sfContext::getInstance()->getUser()->getAttribute('empresas',self::getCriterioAlcanceVacio(),'alcance');

    return clone $c_base;
  }
  
}
