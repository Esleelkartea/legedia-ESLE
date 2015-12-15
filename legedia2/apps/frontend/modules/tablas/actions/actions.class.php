<?php

/**
 * tablas actions.
 *
 * @package    NeoCRM
 * @subpackage tablas
 * @author     Roberto Martín Huelmo
 * @version    10-02-09
 */
class tablasActions extends sfActions
{
  
  public function executeIndex()
  {
    return $this->forward('tablas', 'list');
  }

  public function executeShow()
  {
    $this->labels = $this->getLabels();
    $this->tabla = TablaPeer::retrieveByPk($this->getRequestParameter('id_tabla'));
    $this->forward404Unless($this->tabla);
  }
  
  

  public function executeList()
  {      
    // pager
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/tabla/filters');

    $this->pager = new sfPropelPager('Tabla', sfConfig::get('app_listas_tablas'));
    $c = $this->getCriterio();
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeCreate()
  {
    return $this->forward('tablas', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('tablas', 'edit');
  }

  public function executeEdit()
  {
    $this->tabla = $this->getTablaOrCreate();
    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateTablaFromRequest();
      $this->saveTabla($this->tabla);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('tablas/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('tablas/list');
      }
      else
      {
        return $this->redirect('tablas/edit?id_tabla='.$this->tabla->getIdTabla());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDuplicate()
  {
    $tabla = $this->getTablaOrCreate();
    
    //DUPLICAR LA TABLA
    $mitabla = new Tabla();
    $tabla->copyInto($mitabla);
    $mitabla->setNombre("Copia de ".$tabla->getNombre());
    $mitabla->save();
        
    //DUPLICAMOS CAMPOS
    $campos = $tabla->getRelCampoTablasJoinCampo();
    foreach ($campos as $camp){
      $campo = $camp->getCampo();
      $items = $campo->getItemBases();
      
      $micampo = new Campo();
      $campo->copyInto($micampo);
      $micampo->save();
      
      //DUPLICAMOS ITEMS
      foreach ($items as $item){
        $miitem = new ItemBase();
        $item->copyInto($miitem);
        $miitem->setIdCampo($micampo->getIdCampo());
        $miitem->save();
      }
      
      $micamp = new RelCampoTabla();
      $micamp->setIdCampo($micampo->getIdCampo());
      $micamp->setIdTabla($mitabla->getIdTabla());
      $micamp->save();
    }
    
    return $this->redirect('tablas/list');
  }
  
  public function executeDelete()
  {
    $c = $this->getCriterio();
    $c->addAnd(TablaPeer::ID_TABLA , $this->getRequestParameter('id_tabla'));
    $this->tabla = TablaPeer::doSelectOne($c);
    $this->forward404Unless($this->tabla);

    try
    {
      $this->deleteTabla($this->tabla);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse la fuente de datos. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('tablas', 'list');
    }

    return $this->redirect('tablas/list');
  }
  
 public function executeBajar() {
        $id_tabla = $this->getRequestParameter('id_tabla');
  
        $c = new Criteria();
        $c->addAscendingOrderByColumn(TablaPeer::ORDEN);
        $tablas = TablaPeer::doSelect($c);
        
        //Restableciendo el orden
        for($i=0; $i< sizeof($tablas);$i++){
          $tablas[$i]->setOrden($i);
          $tablas[$i]->save();
        }
        
        for($i=0; $i< sizeof($tablas);$i++)
        {
          $tabla = $tablas[$i];
          if ($tabla->getIdTabla() == $id_tabla)
          {
            if (isset($tablas[$i+1]))
            {
              $tabla_down = $tablas[$i+1];
              $tabla->swapWith($tabla_down);
              break;
            }
          }
        }
          
        return $this->redirect('tablas/list');
  }
  
  public function executeSubir() {
        $id_tabla = $this->getRequestParameter('id_tabla');
        
        $c = new Criteria();
        $c->addAscendingOrderByColumn(TablaPeer::ORDEN);
        $tablas = TablaPeer::doSelect($c);
        
        //Restableciendo el orden
        for($i=0; $i< sizeof($tablas);$i++){
          $tablas[$i]->setOrden($i);
          $tablas[$i]->save();
        }
        
        for($i=0; $i< sizeof($tablas);$i++)
        {
          $tabla = $tablas[$i];
          if ($tabla->getIdTabla() == $id_tabla)
          {
            if (isset($tablas[$i-1]))
            {
              $tabla_down = $tablas[$i-1];
              $tabla->swapWith($tabla_down);
              break;
            }
          }
        }
          
        return $this->redirect('tablas/list');
  
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->tabla = $this->getTablaOrCreate();
    $this->updateTablaFromRequest();

    $this->labels = $this->getLabels();
    
    return sfView::SUCCESS;
  }

  protected function saveTabla($tabla)
  {
    $tabla->save();
  }

  protected function deleteTabla($tabla)
  {
    $tabla->delete();
  }

  protected function updateTablaFromRequest()
  {
    $tabla = $this->getRequestParameter('tabla');

    if (isset($tabla['id_empresa']))
    {
      $this->tabla->setIdEmpresa($tabla['id_empresa'] ? $tabla['id_empresa'] : null);
    }
    if (isset($tabla['id_usuario']))
    {
      $this->tabla->setIdUsuario($tabla['id_usuario'] ? $tabla['id_usuario'] : null);
    }

    if (isset($tabla['id_categoria']))
    {
      $this->tabla->setIdCategoria($tabla['id_categoria'] ? $tabla['id_categoria'] : null);
    }

    if (isset($tabla['nombre']))
    {
      $this->tabla->setNombre($tabla['nombre']);
    }
    
    $this->tabla->setMostrarEnLista(isset($tabla['mostrar_en_lista']) ? true : false);
    
    if (isset($tabla['orden']))
    {
      $this->tabla->setOrden($tabla['orden']);
    }
  }

  protected function getTablaOrCreate($idtabla = 'id_tabla')
  {
    if (!$this->getRequestParameter($idtabla))
    {
      $tabla = new Tabla();
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(TablaPeer::ID_TABLA , $this->getRequestParameter($idtabla));
      $tabla = TablaPeer::doSelectOne($c);

      $this->forward404Unless($tabla);
    }

    return $tabla;
  }
  
  protected function getCriterio()
  {
    $c = TablaPeer::getCriterioAlcance();
    return $c;
  }
  
  protected function getLabels()
  {
    return array(
      'tabla{id_tabla}' => 'id',
      'tabla{id_empresa}' => 'Empresa',
      'tabla{id_categoria}' => 'Categoría',
      'tabla{id_usuario}' => 'Usuario',
      'tabla{nombre}' => 'Nombre',
      'tabla{orden}' => 'Orden',
      'tabla{mostrar_en_lista}' => 'Mostrar en lista',            
    );
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
      
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/tabla/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/tabla/filters');
    }else{
        $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
        $filters = array();
        $filters['id_empresa'] = $id_empresa;
        
       $this->getUser()->getAttributeHolder()->removeNamespace('sf/tabla/filters');
       $this->getUser()->getAttributeHolder()->add($filters, 'sf/tabla/filters');
    }
  }

   protected function addFiltersCriteria($c)
  {
    //id_empresa
    if (isset($this->filters['id_empresa']) && $this->filters['id_empresa'] !== '')
    {
      $c->add(TablaPeer::ID_EMPRESA , $this->filters['id_empresa'] );
    }
   
  }
  
}
