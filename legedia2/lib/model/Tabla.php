<?php

/**
 * Subclass for representing a row from the 'tabla' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Tabla extends BaseTabla
{
 public function __toString(){
    return $this->getNombre();
  }
  /**
  * Devuelve el nombre de la fuente de datos y el de la empresa a la que pertenece.
  * @return string, nombre de la fuente de datos y el de la empresa.
  * @version 20-04-09
  * @author Ana Martín
  */
  public function getNombreyEmpresa() {
      $empresa = EmpresaPeer::retrieveByPK($this->getIdEmpresa());
      return $empresa->__toString()." - ".$this->__toString();
  }
  
  public function delete(PropelPDO $con = null, $definitivo = false){
    if ($definitivo) parent::delete();
  	else {
  		$this->setBorrado(true);
  		$this->save();
  	}
  }
  
  public function getCamposFormularioOrdenados($solo_en_lista = false)
  {
    $c = new Criteria();
    
    $cr1 = $c->getNewCriterion(CampoPeer::ES_GENERAL , null , Criteria::ISNULL);
    $cr2 = $c->getNewCriterion(CampoPeer::ES_GENERAL , false);
    $cr1->addOr($cr2);
    $c->add($cr1);
    $c->addJoin(CampoPeer::ID_CAMPO , RelCampoTablaPeer::ID_CAMPO);
    $c->addAnd(RelCampoTablaPeer::ID_TABLA , $this->getPrimaryKey());
    if ($solo_en_lista) $c->addAnd(CampoPeer::EN_LISTA , true, Criteria::EQUAL);
    $c->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $campos = CampoPeer::doSelect($c);
    return $campos;
  }
  
  public function getCamposFormularioEmpresaTabla($solo_en_lista = false)
  {
    $c = new Criteria();
    $c->addJoin(CampoPeer::ID_CAMPO , RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
    $c->addJoin(RelCampoTablaPeer::ID_TABLA , TablaPeer::ID_TABLA, Criteria::JOIN);
    $cr1 = $c->getNewCriterion(TablaPeer::ID_EMPRESA , $this->getIdEmpresa(), Criteria::EQUAL);
    $cr2 = $c->getNewCriterion(CampoPeer::ES_GENERAL , true, Criteria::EQUAL);
    $cr1->addAnd($cr2);
    $c->addOr($cr1);
    
    $c->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $campos_generales_empresa = CampoPeer::doSelect($c);
    
    $cb = new Criteria();
    $cb->addJoin(CampoPeer::ID_CAMPO , RelCampoTablaPeer::ID_CAMPO);
    $cb->add(RelCampoTablaPeer::ID_TABLA , $this->getIdTabla());
    if ($solo_en_lista) $c->addAnd(CampoPeer::EN_LISTA , true, Criteria::EQUAL);
    $cb->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $campos_tabla = CampoPeer::doSelect($cb);
    
    $campos = array_merge($campos_generales_empresa, $campos_tabla);
    
    return $campos;
  }
  
  public function getFormulario(){
    $lista = $this->getFormularios();
    $formulario = new Formulario();
    if ($this->getIdTabla())
    {
      $formulario->setIdTabla($this->getIdTabla());
    }
    if (count($lista) > 0)
    {
      $formulario = $lista[0];
      if (!$formulario->getIdTabla())
      {
        $formulario->setIdTabla($this->getIdTabla());
      }
    }
    return $formulario;
  }
  
  public function getItemsFormularios()
  {
    $c = new Criteria();
    $c->addJoin(ItemPeer::ID_FORMULARIO , FormularioPeer::ID_FORMULARIO);
    $c->addJoin(FormularioPeer::ID_TABLA , TablaPeer::ID_TABLA);
    $c->add(TablaPeer::ID_TABLA , $this->getIdTabla());
    $items = ItemPeer::doSelect($c);
    return $items;
  }
  
  public function swapWith($tabla)
  {
    $con = Propel::getConnection(TablaPeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
  
      $orden = $this->getOrden();  
      $this->setOrden($tabla->getOrden());
      $this->save();
      $tabla->setOrden($orden);
      $tabla->save();
    
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
}