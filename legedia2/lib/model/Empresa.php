<?php

/**
 * Subclass for representing a row from the 'empresa' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Empresa extends BaseEmpresa
{
 public function __toString(){
    return $this->getNombre();
  }
  
  public function getSmtpPasswordClean()
  {
    return $this->getSmtpPassword();
  }
  
  public function delete(PropelPDO $con = null, $definitivo = false)
  {
    if ($definitivo) parent::delete();
    else {
      $this->setBorrado(true);
      $this->save();
    }
  }
  
  public function getPais(){
    $provincia = $this->getProvincia();
    if ($provincia){
      return $provincia->getPais();
    }else{
      return "";
    }
  }
  
  public function getPosicionSiguienteCampo()
  {
    $campos = $this->getCamposFormularioOrdenados();
    $posicion = 1;
    
    foreach($campos as $campo)//se podría mejorar.
    {
      if ($campo->getOrden() >= $posicion)
      {
        $posicion = $campo->getOrden() + 1;
      }
    }
    return $posicion;
  }
  
  public function getCamposFormularioOrdenadosAlcancetablas($id_tabla = null, $solo_en_lista = false)
  {
    $c = new Criteria();
    $c->addJoin(CampoPeer::ID_CAMPO, RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
    $c->addJoin(RelCampoTablaPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);
    $c->addAnd(TablaPeer::ID_EMPRESA , $this->getIdEmpresa(), Criteria::EQUAL);
    //$c->addAnd(CampoPeer::ES_GENERAL , true);
    $c->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $c->setDistinct();
    $campos = CampoPeer::doSelect($c);
    
    //el siguiente ódigo es bastante ineficiente. Podría conseguirse una SQL que obtuviera todos los campos accesibles de la promotra
    $tablaes = TablaPeer::doSelect(TablaPeer::getCriterioAlcance());
    $accesible = array();
    foreach ($tablaes as $tab) $accesible[$tab->getIdTabla()] = 1;

    if ($id_tabla != null){
      if (isset($accesible[$id_tabla])){
        //Si viene que solo queremos los datos de una tabla y esta es accesible => solo obtenemos los campos de esa tabla.
        unset ($accesible);
        $accesible[$id_tabla] = 1;
      }else{
        //la tabla no es accesible => devolver que no tiene campos
        return array();    
      }
    }
    
    $resultado = array();
    foreach($campos as $campo)
    {
      if (!$campo->getEsGeneral())
      {
        $rels = $campo->getRelCampoTablas();
        //print_r($rels);
        foreach($rels as $rel)
        {
          if (isset($accesible[$rel->getIdTabla()]))
          {
            if ($solo_en_lista){
              if ($campo->getEnLista()) $resultado[] = $campo;
            }
            else 
              $resultado[] = $campo;
              
            break; //sale del if o del for?
          }
        }
      }
      else
      {
        $resultado[] = $campo;
      }
    }
    return $resultado;
  }
  
  public function getCamposFormularioOrdenados($c = null)
  {
    if ($c == null) $c = new Criteria();
    $c->addJoin(CampoPeer::ID_CAMPO, RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
    $c->addJoin(RelCampoTablaPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);
    $c->addAnd(TablaPeer::ID_EMPRESA , $this->getIdEmpresa(), Criteria::EQUAL);
    $c->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $campos = CampoPeer::doSelect($c);
    return $campos;
  }
  
  public function getCamposFormularioOrdenadosGenerales()
  {
    $c = new Criteria();
    $c->addJoin(CampoPeer::ID_CAMPO, RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
    $c->addJoin(RelCampoTablaPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);
    $c->addAnd(TablaPeer::ID_EMPRESA , $this->getIdEmpresa(), Criteria::EQUAL);
    $c->addAnd(CampoPeer::ES_GENERAL , true);
    $c->addAscendingOrderByColumn(CampoPeer::ORDEN);
    $campos = CampoPeer::doSelect($c);
    return $campos;
  }
  
  public function ordenarCamposFormulario()
  {
    $campos = $this->getCamposFormularioOrdenados();
    $orden = 1;
    foreach($campos as $campo)
    {
      $campo->setOrden($orden);
      $campo->save();
      $orden++;
    }
  }
  
  public static function getListaEmpresas(){
   $array_empresas = array();
   //$c=new Criteria();
   $c = EmpresaPeer::getCriterioAlcance();
   $lista_empresas=EmpresaPeer::doSelect($c);

   foreach ($lista_empresas as $empresa){
     $array_empresas[$empresa->getIdEmpresa()]=$empresa->getNombre();
   }
   return $array_empresas;
  }
  
  /* LOGO */
  public function getUrlLogoMin()
  {
    if (!$this->getLogoMin())
    {
      return sfConfig::get('app_logos_default_min');
    }
    else
    {
      return $this->getUrlLogo($this->getLogoMin());
    }
  }
  
  public function getUrlLogoMed()
  {
    if (!$this->getLogoMed())
    {
      return sfConfig::get('app_logos_default_med');
    }
    else
    {
      return $this->getUrlLogo($this->getLogoMed());
    }
  }
  
  public function getUrlLogoMax()
  {
    if (!$this->getLogoMax())
    {
      return sfConfig::get('app_logos_default_max');
    }
    else
    {
      return $this->getUrlLogo($this->getLogoMax());
    }
  }
  /**
  * Función que devuelve el directorio parcial en el que se encuentra el logo.
  * @return string, directorio parcial
  * @param image_filename nombre de la imagen. Si vacío devuelve solo el directorio.
  * @version 10-02-09
  */
  protected function getUrlLogo($image_filename = '')
  {
    $resultado = null;
    if ($image_filename)
    {
      $directorio = "/images/logos/";
      $resultado = $directorio.$image_filename;
    }
    return $resultado;
  }

}
