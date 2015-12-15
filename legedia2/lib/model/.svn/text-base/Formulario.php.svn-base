<?php

/**
 * Subclass for representing a row from the 'formulario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Formulario extends BaseFormulario
{
  public function __toString(){
    if ($this->getIdFormulario() == 0) return "";

    $nombre = "";
    $items_formulario = $this->getArrayItemsCampo();
    $lista_campos_extra = $this->getTabla()->getCamposFormularioOrdenados();
    foreach ($lista_campos_extra as $campo) {
      if ($campo->getEsNombre()){
        $item = isset($items_formulario[$campo->getIdCampo()]) ? $items_formulario[$campo->getIdCampo()] : null;
        if ($item != null){
          if ($nombre != "") $nombre .= " - ";
          $nombre .= /*$campo->getNombre() .": ".*/$item->__toString();
        }
      }
    }
    
    return $nombre;
  }
  
  public function delete(PropelPDO $con = null)
  {
      $tareas = $this->getTareas();
      foreach ($tareas as $t){
          $t->delete();
      }

      $items = $this->getItems();
      foreach ($items as $item){
          $item->delete();
          if ($item->getTextoCorto() != ""){
            if (file_exists(sfConfig::get('app_directorio_upload').'/docs/'.$item->getTextoCorto())){
                @unlink(sfConfig::get('app_directorio_upload').'/docs/'.$item->getTextoCorto());
            }
          }
      }

      parent::delete();
  }

  public function getArrayItems()
  {
    $lista = array();
    $items = $this->getItems();
    foreach($items as $item)
    {
      $lista[$item->getIdItemBase()] = $item;
    }
    return $lista;
  }
  
  public function getArrayItemsCampo()
  {
    $lista = array();
    $items = $this->getItemsJoinItemBase();
    foreach($items as $item)
    {
      $lista[$item->getItemBase()->getIdCampo()] = $item;
    }
    return $lista;
  }
  
  public function getEmpresa()
  {
    $tabla = $this->getTabla();
    if (!$tabla) return null;
    return $tabla->getEmpresa();
  }
}
