<?php

/**
 * Subclass for representing a row from the 'item_base' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ItemBase extends BaseItemBase
{

public function delete(PropelPDO $con = null, $definitivo = false)
  {
    if ($definitivo){
      parent::delete();
    }
    else {
      $this->setBorrado(true);
      $this->setEsInconsistente(true);
      $this->save();
    }
  }
  
  public function swapWith($item)
  {
    $con = Propel::getConnection(ItemBasePeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
  
      $orden = $this->getOrden();  
      $this->setOrden($item->getOrden());
      $this->save();
      $item->setOrden($orden);
      $item->save();
    
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }

  public function getEstilo(){
     $texto_auxiliar = parent::getAyuda();

     $estilo = "";
     $pos = strpos($texto_auxiliar, "##");
     if (!($pos === false)) {
        $estilo = "style=\"";

        $texto_auxiliar = substr($texto_auxiliar, $pos+2);

        $pos2 = strpos($texto_auxiliar, "##");
        if (!($pos === false)) {
               $texto_auxiliar = substr($texto_auxiliar,0,$pos2);
        }

        $estilo .= $texto_auxiliar."\"";
     }

     return $estilo;
  }

 public function getSoloEstilo(){
     $texto_auxiliar = parent::getAyuda();

     $estilo = "";
     $pos = strpos($texto_auxiliar, "##");
     if (!($pos === false)) {


        $texto_auxiliar = substr($texto_auxiliar, $pos+2);

        $pos2 = strpos($texto_auxiliar, "##");
        if (!($pos === false)) {
               $texto_auxiliar = substr($texto_auxiliar,0,$pos2);
        }

        $estilo .= $texto_auxiliar;
     }

     return $estilo;
  }

  public function getPadreAyuda(){
    return parent::getAyuda();
  }

  public function getAyuda(){
    $estilo = $this->getSoloEstilo();
    $ayuda = parent::getAyuda();

    if ($estilo != ""){
       $ayuda = str_replace("##".$estilo."##", "", $ayuda);
    }
    
    return $ayuda;
  }

  public static function ItemBaseToTexto($item , $campo)
  {
    //use_helper('Number');
    if (!$item)
    {
      return null;
    }
    if (!$item->getPrimaryKey())
    {
      return null;
    }
    if (!$campo)
    {
      $campo = $item->getCampo();
    }
    
    $value = null;
    if ($campo->esTipoLista())
    {
      if ($campo->esListaTipoRangos())
      {
        //lista de rangos
        $desde = null;
        $hasta = null;

        $unidad = CampoPeer::getHtmlTipoUnidad($campo->getUnidadRangos());
        $unidad = $unidad ? " ".$unidad : '';
        if ($item->getNumeroInferior() && ($item->getNumeroInferior() != '') )
        {
          $desde = $item->getNumeroInferior().$unidad;
        }
        if ($item->getNumeroSuperior() && ($item->getNumeroSuperior() != '') )
        {
          $hasta = $item->getNumeroSuperior().$unidad;
        }
        
        if ($desde && $hasta)
        {
          //$value = __('desde %1% hasta %2%' , array('%1%' => $desde , '%2%' => $hasta));
          $value = sprintf('desde %s hasta %s' , $desde , $hasta);
        }
        else if ($desde)
        {
          //$value = __('más de %1%' , array('%1%' => $desde));
          $value = sprintf('mas de %s' , $desde );
        }
        elseif ($hasta)
        {
          //$value = __('menos de %2%' , array('%2%' => $hasta));
          $value = sprintf('menos de %s' , $hasta );
        }
        else
        {
          $value = null;
        }
      }
      else
      {
        $value = $item->getTexto();
      }
    }
    return $value;
  }
  
}
