<?php
/**
 * filtros class
 * facilita el filtrado de formularios según los parametros recibidos
 * 
 */

class Filtros
{
  protected $campos;  
  protected $filters;
  protected $criteria;
  
  function __construct($campos = array() , $filters = array() )
  {
    $this->campos = $campos;
    $this->filters = $filters;
    $this->criteria = new Criteria();
  }
  
  public function getCriteria()
  {
    return $this->criteria;
  }
  
  public function updateCriteria(Criteria $criteria)
  {
    $this->criteria = $criteria;
    //Ana: 16-04-09
        
    $this->criteria->addJoin(TablaPeer::ID_TABLA, FormularioPeer::ID_TABLA, Criteria::JOIN);
    
    foreach($this->campos as $campo)
    {
      
      if (!$campo->esTipoLista())
      {
        if ($campo->esTipoBooleano())
        {
          $this->addCriterionBooleano($campo);
        }
        elseif ($campo->esTipoTextoLargo())
        {
          $this->addCriterionTextoLargo($campo);
        }
        elseif ($campo->esTipoTextoCorto())
        { 
          $this->addCriterionTextoCorto($campo);
        }
        elseif ($campo->esTipoNumero())
        { 
          $this->addCriterionNumero($campo);
        }
        elseif ($campo->esTipoFecha())
        { 
          $this->addCriterionFecha($campo);
        }
        elseif($campo->esTipoSelectPeriodo())
        {
          $this->addCriterionSelectPeriodo($campo);
        }
        elseif($campo->esTipoTabla())
        {
          $this->addCriterionTabla($campo);
        }
        elseif($campo->esTipoObjeto())
        {
          $this->addCriterionObjeto($campo);
        }
      }
      else
      {
        if ($campo->esListaTipoRangos())
        {
          $this->addCriterionListaRangos($campo);
        }
        else
        {
          if ($campo->getSeleccionMultiple())
          {
            $this->addCriterionListaMultiple($campo);
          }
          else
          {
            $this->addCriterionListaSimple($campo);
          }
        }
      }
    }
   // exit();
    $criteria = $this->criteria;
  }
  
  
  
  function addCriterionListaSimple($campo)
  {
    //es lo mismo que la lista multiple.
    $this->addCriterionListaMultiple($campo);
  }
  
  
  function addCriterionListaMultiple($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $recibido = (isset($this->filters[$nombre_campo]) && $this->filters[$nombre_campo] !== '') ? $this->filters[$nombre_campo] : array();
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    foreach($recibido as $i=>$id_item_base)
    {
      if (isset($id_item_base) && ($id_item_base != ''))
      {
        $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
        $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
        
        $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $id_item_base);
        $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , true));
        
        if (isset($criterion))
        {
          $criterion->addOr($cr_aux);
        }
        else
        { 
          $criterion = $cr_aux;
        }
      }
    }
    
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionListaRangos($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $recibido = (isset($this->filters[$nombre_campo]) && $this->filters[$nombre_campo] !== '') ? $this->filters[$nombre_campo] : array();
    
    $items_base = $campo->getItemsBaseOrdenados();
    
    $from = isset($recibido['from']) ? $recibido['from'] : null;
    $to = isset($recibido['to']) ? $recibido['to'] : null;
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($from) || isset($to))
    {
      foreach($items_base as $item_base)
      {
        $limite_inferior = $item_base->getNumeroInferior() ? $item_base->getNumeroInferior() : 0;
        $limite_superior = $item_base->getNumeroSuperior() ? $item_base->getNumeroSuperior() : 0;
        
        if ($from != '' && $to != '')
        {
          if  (
            ($from >= $limite_inferior && (($to <= $limite_superior && ($limite_superior != 0)) || ($limite_superior == 0))) 
            || ($from >= $limite_inferior && (($from <= $limite_superior && ($limite_superior != 0)) || ($limite_superior == 0))) 
            || ($to >= $limite_inferior && (($to <= $limite_superior && ($limite_superior != 0)) || ($limite_superior == 0))) 
            || ($to >= $limite_inferior && (($to <= $limite_superior && ($limite_superior != 0)) || ($limite_superior == 0))) 
            || ($from <= $limite_inferior && (($to >= $limite_superior && ($limite_superior != 0)) ) ) //|| ($limite_superior == 0)
          )
          {
            $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
            $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
            
            $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
            $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , true));
            
            if (isset($criterion))
            {
              $criterion->addOr($cr_aux);
            }
            else
            {
              $criterion = $cr_aux;
            }
          }
        }
        elseif($from != '')
        {
          if (
            ($from >= $limite_inferior && (($from <= $limite_superior && $limite_superior!=0) || $limite_superior == 0)) || 
            ($from <= $limite_inferior)
          )
          {
            $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
            $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
            
            $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
            $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , true));
            
            if (isset($criterion))
            {
              $criterion->addOr($cr_aux);
            }
            else
            {
              $criterion = $cr_aux;
            }
          }
        }
        elseif($to != '')
        {
          if (
            ($to >= $limite_inferior && ( ($to <= $limite_superior && $limite_superior != 0) || $limite_superior == 0) ) || 
            ($to >= $limite_superior && $limite_superior != 0)
          )
          {
            $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
            $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
            
            $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
            $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , true));
            
            if (isset($criterion))
            {
              $criterion->addOr($cr_aux);
            }
            else
            {
              $criterion = $cr_aux;
            }
          }
        }
        
      }
    }
    
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
    
  }
  
  function addCriterionTextoCorto($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";

    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
     
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $texto = $this->filters[$nombre_campo][$nombre_item_base];
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::TEXTO_CORTO) , strtr($texto, '*', '%') , Criteria::LIKE));
      
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionTextoLargo($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
       
      $texto = $this->filters[$nombre_campo][$nombre_item_base];
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::TEXTO_LARGO) , strtr($texto, '*', '%') , Criteria::LIKE));
      
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionNumero($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
  
      if (isset($this->filters[$nombre_campo][$nombre_item_base]['great']) && $this->filters[$nombre_campo][$nombre_item_base]['great'] !== '')
      {
        $mayorque = $this->filters[$nombre_campo][$nombre_item_base]['great'];
        $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::NUMERO) , $mayorque , Criteria::GREATER_EQUAL));
      }
      if (isset($this->filters[$nombre_campo][$nombre_item_base]['less']) && $this->filters[$nombre_campo][$nombre_item_base]['less'] !== '')
      {
        $menorque = $this->filters[$nombre_campo][$nombre_item_base]['less'];
        $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::NUMERO) , $menorque , Criteria::LESS_EQUAL));
      }
    }
    
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }

  function addCriterionFecha($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
  
      if (isset($this->filters[$nombre_campo][$nombre_item_base]['from']) && $this->filters[$nombre_campo][$nombre_item_base]['from'] !== '')
      {
        $from = $this->filters[$nombre_campo][$nombre_item_base]['from'];
        $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::FECHA) , $from , Criteria::GREATER_EQUAL));
      }
      if (isset($this->filters[$nombre_campo][$nombre_item_base]['to']) && $this->filters[$nombre_campo][$nombre_item_base]['to'] !== '')
      {
        $to = $this->filters[$nombre_campo][$nombre_item_base]['to'];
        $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::FECHA) , $to , Criteria::LESS_EQUAL));
      }
    }
    
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }  

  function addCriterionTabla($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
       
      $id_item_tabla = $this->filters[$nombre_campo][$nombre_item_base];
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_TABLA) , $id_item_tabla , Criteria::EQUAL));
      
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionObjeto($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
       
      $id_objeto = $this->filters[$nombre_campo][$nombre_item_base];
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_OBJETO) , $id_objeto , Criteria::EQUAL));
      
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionBooleano($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $nombre_item_base = "item_base";
    
    $criterion = null;
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($this->filters[$nombre_campo][$nombre_item_base]) && $this->filters[$nombre_campo][$nombre_item_base] !== '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      
      $buscar = $this->filters[$nombre_campo][$nombre_item_base] ? true : false;
      if ($buscar)
      {
        $criterion->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , true));
      }
      else
      {
        $cr_1 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , null , Criteria::ISNULL);
        $cr_2 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::SI_NO) , false);
        $cr_1->addOr($cr_2);
        $criterion->addAnd($cr_1);
      }
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
  }
  
  function addCriterionSelectPeriodo($campo)
  {
    $nombre_campo = "campo_".$campo->getIdCampo()."";
    $item_base = $campo->getElementoUnico();
    $recibido = (isset($this->filters[$nombre_campo]) && $this->filters[$nombre_campo] !== '') ? $this->filters[$nombre_campo] : array();
    
    $from_periodo = isset($recibido['from']['periodo']) ? $recibido['from']['periodo'] : null;
    $from_year = isset($recibido['from']['year']) ? $recibido['from']['year'] : null;
    
    $to_periodo = isset($recibido['to']['periodo']) ? $recibido['to']['periodo'] : null;
    $to_year = isset($recibido['to']['year']) ? $recibido['to']['year'] : null;
    
    $alias = "i".$campo->getIdCampo();//ALIAS. Arreglado
    
    if (isset($from_year) && $from_year != '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      
      if (isset($from_periodo) && $from_periodo != '')
      {
        $cr_aux_1 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $from_year);
        $cr_aux_1->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::NUMERO) , $from_periodo , Criteria::GREATER_EQUAL));
        $cr_aux_2 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $from_year , Criteria::GREATER_THAN);
        $cr_aux_1->addOr($cr_aux_2);
        $cr_aux->addAnd($cr_aux_1);
      }
      else
      {
        $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $from_year , Criteria::GREATER_EQUAL) );
      }
      
      $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , null , Criteria::ISNOTNULL);
      $criterion->addAnd($cr_aux);
    }
    
    if (isset($to_year) && $to_year != '')
    {
      $this->criteria->addAlias($alias , ItemPeer::TABLE_NAME);
      $this->criteria->addJoin(FormularioPeer::ID_FORMULARIO,  ItemPeer::alias($alias,  ItemPeer::ID_FORMULARIO), Criteria::JOIN);
      
      $cr_aux = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ID_ITEM_BASE) , $item_base->getPrimaryKey());
      
      if (isset($to_periodo) && $to_periodo != '')
      {
        $cr_aux_1 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $to_year);
        $cr_aux_1->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::NUMERO) , $to_periodo , Criteria::LESS_EQUAL));
        $cr_aux_2 = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $to_year , Criteria::LESS_THAN);
        $cr_aux_1->addOr($cr_aux_2);
        $cr_aux->addAnd($cr_aux_1);
      }
      else
      {
        $cr_aux->addAnd($this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , $to_year , Criteria::LESS_EQUAL) );
      }
      
      if (isset($criterion))
      {
        $criterion->addAnd($cr_aux);
      }
      else
      {
        $criterion = $this->criteria->getNewCriterion(ItemPeer::alias($alias,  ItemPeer::ANIO) , null , Criteria::ISNOTNULL);
        $criterion->addAnd($cr_aux);
      }
    }
    if (isset($criterion))
    {
      $this->criteria->addAnd($criterion);
    }
    
  }
  
}
