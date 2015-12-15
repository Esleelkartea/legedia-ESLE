<?php

/**
 * Subclass for performing query and update operations on the 'campo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CampoPeer extends BaseCampoPeer
{
 //tipos de campos
  const ID_TEXTO_CORTO = 1;
  const ID_TEXTO_LARGO = 2;
  const ID_BOOLEANO = 3;
  const ID_LISTA = 4;
  const ID_SELECT_PERIODO = 5;
  const ID_TABLA = 6;
  const ID_OBJETO = 7;
  const ID_NUMERO = 8;
  const ID_FECHA = 9;
  const ID_DOCUMENTO = 10;

  const NAME_TEXTO_CORTO = "texto corto";
  const NAME_TEXTO_LARGO = "texto largo";
  const NAME_BOOLEANO = "booleano";
  const NAME_LISTA = "lista";
  const NAME_SELECT_PERIODO = "selección de periodo";
  const NAME_TABLA = "valor de otra tabla";
  const NAME_OBJETO = "valor de otro objeto";
  const NAME_NUMERO = "numero";
  const NAME_FECHA = "fecha";
  const NAME_DOCUMENTO = "documento";
  
  public static function getTiposCampos()
  {
    $lista = array(
      self::ID_TEXTO_CORTO => self::NAME_TEXTO_CORTO , 
      self::ID_TEXTO_LARGO => self::NAME_TEXTO_LARGO ,
      self::ID_NUMERO => self::NAME_NUMERO,
      self::ID_FECHA => self::NAME_FECHA, 
      self::ID_BOOLEANO => self::NAME_BOOLEANO ,
      self::ID_DOCUMENTO => self::NAME_DOCUMENTO,
      self::ID_LISTA => self::NAME_LISTA ,  
      self::ID_SELECT_PERIODO => self::NAME_SELECT_PERIODO,
      self::ID_TABLA => self::NAME_TABLA,
      self::ID_OBJETO => self::NAME_OBJETO,
    );
    return $lista;
  }
  
  public static function getDefaultId()
  {
    return self::ID_TEXTO_CORTO;
  }
  
  public static function getNombreTipo($tipo = '')
  {
    $lista = self::getTiposCampos();
    return isset($lista[$tipo]) ? $lista[$tipo] : '';
  }
  
  public static function esTipoTextoCorto($tipo = '')
  {
    return self::ID_TEXTO_CORTO == $tipo;
  }
  
  public static function esTipoTextoLargo($tipo = '')
  {
    return self::ID_TEXTO_LARGO == $tipo;
  }
  
  public static function esTipoNumero($tipo = '')
  {
    return self::ID_NUMERO == $tipo;
  }
  
  public static function esTipoFecha($tipo = '')
  {
    return self::ID_FECHA == $tipo;
  }
  
  public static function esTipoBooleano($tipo = '')
  {
    return (self::ID_BOOLEANO == $tipo);
  }
  
  public static function esTipoSelectPeriodo($tipo = '')
  {
    return self::ID_SELECT_PERIODO == $tipo;
  }
  
  public static function esTipoLista($tipo = '')
  {
    return ($tipo == self::ID_LISTA);
  }
  
  public static function esTipoTabla($tipo = '')
  {
    return ($tipo == self::ID_TABLA);
  }
  
  public static function esTipoObjeto($tipo = '')
  {
    return ($tipo == self::ID_OBJETO);
  }

  public static function esTipoDocumento($tipo = '')
  {
    return ($tipo == self::ID_DOCUMENTO);
  }

  //tipos de items
  const ID_TIPO_TEXTO = 1;
  const ID_TIPO_RANGOS = 2;
  const NAME_TIPO_TEXTO = "texto";
  const NAME_TIPO_RANGOS = "rangos de valores";
  
  public static function getTiposItems()
  {
    $lista = array(
      self::ID_TIPO_TEXTO => self::NAME_TIPO_TEXTO,
      self::ID_TIPO_RANGOS => self::NAME_TIPO_RANGOS,
    );
    return $lista;
  }
  
  public static function getDefaultIdTipoItems()
  {
    return self::ID_TIPO_TEXTO;
  }
  
  public static function getNombreTipoItem($tipo = '')
  {
    $lista = self::getTiposItems();
    return isset($lista[$tipo]) ? $lista[$tipo] : '';
  }
  
  public static function esTipoItemTexto($tipo = '')
  {
    return self::ID_TIPO_TEXTO == $tipo;
  }
  
  public static function esTipoItemRangos($tipo = '')
  {
    return self::ID_TIPO_RANGOS == $tipo;
  }
  
  public static function esListaTipoRangos($tipo = '')
  {
    return self::ID_TIPO_RANGOS == $tipo;
  }
  
  
  
  
  //tipos de unidades para campos con lista de rangos
  public static function getTiposUnidades()
  {
    $c = new Criteria();
    $c->addAnd(ParametroPeer::TIPOPARAMETRO, "_TIPO_UNIDAD_", Criteria::EQUAL);
    $unidades = ParametroPeer::doSelect($c);
    
    $lista = array();
    foreach ($unidades as $unidad){
      $lista[$unidad->getIdParametro()] = $unidad->getNombre();
    }

    return $lista;
  }
  
  public static function getTiposUnidadesHtml()
  {
    $c = new Criteria();
    $c->addAnd(ParametroPeer::TIPOPARAMETRO, "_TIPO_UNIDAD_", Criteria::EQUAL);
    $unidades = ParametroPeer::doSelect($c);
    
    $lista = array();
    foreach ($unidades as $unidad){
      $lista[$unidad->getIdParametro()] = $unidad->getNombre();
    }
    
    return $lista;
  }
  
  public static function getNombreTipoUnidad($tipo = '')
  {
    $lista = self::getTiposUnidades();
    return isset($lista[$tipo]) ? $lista[$tipo] : '';
  }
    
  public static function getHtmlTipoUnidad($tipo = '')
  {
    $lista = self::getTiposUnidadesHtml();
    return isset($lista[$tipo]) ? $lista[$tipo] : '';
  }
  
  
  
  //tipos de periodos
  const ID_MES = 1;
  const ID_BIMESTRE = 2;
  const ID_TRIMESTRE = 3;
  const ID_CUATRIMESTRE = 4;
  const ID_SEMESTRE = 6;
  const ID_ANUAL = 7;
  const ID_BIENAL = 8;
  const NAME_MES = "mes";
  const NAME_BIMESTRE = "bimestre";
  const NAME_TRIMESTRE = "trimestre";
  const NAME_CUATRIMESTRE = "cuatrimestre";
  const NAME_SEMESTRE = "semestre";
  const NAME_ANUAL = "anual";
  const NAME_BIENAL = "bienal";
  
  public static function getTiposPeriodo()
  {
    $lista = array(
      self::ID_MES => self::NAME_MES,
      self::ID_BIMESTRE => self::NAME_BIMESTRE,
      self::ID_TRIMESTRE => self::NAME_TRIMESTRE,
      self::ID_CUATRIMESTRE => self::NAME_CUATRIMESTRE,
      self::ID_SEMESTRE => self::NAME_SEMESTRE,
      //self::ID_ANUAL => self::NAME_ANUAL,
      //self::ID_BIENAL => self::NAME_BIENAL,
    );
    return $lista;
  }
  
  public static function getCampoCodAgencia(){
    $c = TablaPeer::getCriterioAlcance();
    $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',0);
    $c->AddJoin(CampoPeer::ID_CAMPO, RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
    $c->AddJoin(RelCampoTablaPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);
    $c->addAnd(TablaPeer::ID_EMPRESA, $id_empresa,Criteria::EQUAL);
    $c->addAnd(TablaPeer::ES_FICHEROS, true,Criteria::EQUAL);
    $c->addAnd(CampoPeer::ES_COD_AGENCIA, true,Criteria::EQUAL);
    $campo = CampoPeer::doSelectOne($c);
    
    if ($campo instanceof Campo) return $campo->getIdCampo();
    else return 0; 
  }
}
