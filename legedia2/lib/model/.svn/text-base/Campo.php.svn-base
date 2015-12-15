<?php

/**
 * Subclass for representing a row from the 'campo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Campo extends BaseCampo
{
public function __toString()
  {
    return $this->getNombre();
  }
  
  public function delete(PropelPDO $con = null, $definitivo = false)
  {
    if ($definitivo){
      $this->initItemBases();
      $this->deleteItemsFormularios();
      $relTablas = $this->getRelCampoTablas();
      
      foreach ($relTablas as $rt) $rt->delete();
      
      parent::delete();
    }
    else {
      $this->setBorrado(true);
      $this->setEsInconsistente(true);
      $this->save();
    }
  }
  
  public function undelete(){
      $this->setBorrado(false);
      $this->setEsInconsistente(false);
      $this->save();
  }
  
  public function deleteItemsFormularios()
  {
    $c = new Criteria();
    $c->addJoin(ItemPeer::ID_ITEM_BASE , ItemBasePeer::ID_ITEM_BASE);
    $c->add(ItemBasePeer::ID_CAMPO , $this->getIdCampo() , Criteria::EQUAL);
    ItemPeer::doDelete($c);
  }
  
  
  public function esTipoTextoCorto()
  {
    return CampoPeer::esTipoTextoCorto($this->getTipo());
  }
  
  public function esTipoTextoLargo()
  {
    return CampoPeer::esTipoTextoLargo($this->getTipo());
  }

  public function esTipoNumero()
  {
    return CampoPeer::esTipoNumero($this->getTipo());
  }
  
  public function esTipoFecha()
  {
    return CampoPeer::esTipoFecha($this->getTipo());
  }
    
  public function esTipoBooleano()
  {
    return CampoPeer::esTipoBooleano($this->getTipo());
  }
  
  public function esTipoLista()
  {
    return CampoPeer::esTipoLista($this->getTipo());
  }
  
  public function esTipoSelectPeriodo()
  {
    return CampoPeer::esTipoSelectPeriodo($this->getTipo());
  }
  
  public function esTipoTabla()
  {
    return CampoPeer::esTipoTabla($this->getTipo());
  }
  
  public function esTipoObjeto()
  {
    return CampoPeer::esTipoObjeto($this->getTipo());
  }

  public function esTipoDocumento()
  {
    return CampoPeer::esTipoDocumento($this->getTipo());
  }

  public function getElementoUnico()
  {
    if (!$this->getPrimaryKey()) return null;
    //if (!$this->esTipoLista())
    //{
      $lista = $this->getItemBases();
      //en realidad debería haber solamente uno. Si no existe, crearlo!.
      if (!sizeof($lista))
      {
        $item_base = new ItemBase();
        $item_base->setIdCampo($this->getPrimaryKey());
      }
      else
      {
        $item_base = $lista[0];
      }
      return $item_base;
    //}
    //else
    //{ 
    //  return null;
    //}
  }
  
  public function getItemsBaseOrdenados()
  {
    if (!$this->getPrimaryKey()) return null;
    if ($this->esTipoLista())
    {
      $c = new Criteria();
      $c->add(ItemBasePeer::ID_CAMPO , $this->getIdCampo());
      $c->addAscendingOrderByColumn(ItemBasePeer::ORDEN);
      $items = ItemBasePeer::doSelect($c);
      return $items;
    }
    else
    {
      return null;
    }
  }
  
  public function getArrayItemsBaseOrdenados()
  {
    $items = getItemsBaseOrdenados();
    $resultado = array();
    foreach($items as $item)
    {
      $resultado[$item->getIdItemBase()] = $item;
    }
    return $resultado;
  }
  
  public function swapWith($campo)
  {
    $con = Propel::getConnection(CampoPeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
  
      $orden = $this->getOrden();  
      $this->setOrden($campo->getOrden());
      $this->save();
      $campo->setOrden($orden);
      $campo->save();
    
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
  
  
  public function ordenarItemsBase()
  {
    $items = $this->getItemsBaseOrdenados();
    $orden = 1;
    $con = Propel::getConnection(ItemPeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
      foreach($items as $item)
      {
        $item->setOrden($orden);
        $item->save();
        $orden++;
      }
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
  
  public function getPosicionSiguienteItem()
  {
    $items = $this->getItemsBaseOrdenados();
    $posicion = 1;
    
    foreach($items as $item)//se podría mejorar.
    {
      if ($item->getOrden() >= $posicion)
      {
        $posicion = $item->getOrden() + 1;
      }
    }
    return $posicion;
  }
  
  public function getHtmlTipoUnidad()
  {
    return CampoPeer::getHtmlTipoUnidad($this->getUnidadRangos());
  }
  
  public function esListaTipoRangos()
  {
    return CampoPeer::esListaTipoRangos($this->getTipoItems());
  }
}
