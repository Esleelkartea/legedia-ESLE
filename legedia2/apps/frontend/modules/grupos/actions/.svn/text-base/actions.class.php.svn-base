<?php

/**
 * grupos actions.
 *
 * @package    NeoCRM
 * @subpackage grupos
 * @author     Ana Martín
 * @version    10-02-09
 */
class gruposActions extends sfActions
{
  public function executeIndex()  {	
  
    return $this->forward('grupos', 'list');
  }
  public function executeShow () {
  
   
  	 $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('id_grupo'));
  	 $this->grupo->cargarOtrosDatos();
  	 $this->labels = $this->getLabels();

    
  }
  public function executeList()
  {

    $this->labels = $this->getLabels();
    $this->processSort();

    $this->processFilters();


    // pager
    $this->pager = new sfPropelPager('Grupo', sfConfig::get('app_listas_default'));
    $c = new Criteria();
     if (!$this->getRequestParameter('sort')) $c->addAscendingOrderByColumn(GrupoPeer::NOMBRE);
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
	
	 //Ana:
	 $this->grupos=Grupo::arbolGrupos(false);
  
  }

  public function executeCreate()
  {
  
    return $this->forward('grupos', 'edit');
  }

  public function executeSave()
  {
    //Obligo a recargar los filtros.
   // $this->getContext()->getInstance()->getUser()->setAttribute('updated' , false , 'alcance');
    return $this->forward('grupos', 'edit');
  }

  public function executeEdit()
  {

    $this->grupo = $this->getGrupoOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateGrupoFromRequest();

      $this->saveGrupo($this->grupo);

      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('grupos/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('grupos/list');
      }
      else
      {
        return $this->redirect('grupos/edit?id_grupo='.$this->grupo->getIdGrupo());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
  
    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('id_grupo'));
    $this->forward404Unless($this->grupo);

    try
    {
      $this->deleteGrupo($this->grupo);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Grupo. Make sure it does not have any associated items.');
      return $this->forward('grupos', 'list');
    }

    return $this->redirect('grupos/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->grupo = $this->getGrupoOrCreate();
    $this->updateGrupoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveGrupo($grupo)
  {    
    $grupo->save();
   // sfContext::getInstance()->getUser()->setAttribute('updated' , false , 'alcance'); 

  }

  protected function deleteGrupo($grupo)
  {
  	 //Ana:
  	 $grupo->vaciarPermisos();
    $grupo->moverHijosYUsuarios();
    $grupo->delete();
  }

  protected function updateGrupoFromRequest()
  {
    $grupo = $this->getRequestParameter('grupo');

    if (isset($grupo['nombre']))
    {
      $this->grupo->setNombre($grupo['nombre']);
    }
    if (isset($grupo['padre']))
    {
      $this->grupo->setPadre($grupo['padre']);
    }
      $this->grupo->vaciarPermisos();
    
    $modulo = $this->getRequestParameter('modulo' , array());
    $accion = $this->getRequestParameter('accion' , array());
    $heredado = $this->getRequestParameter('heredado' , array());
    $seleccionado = $this->getRequestParameter('seleccionado' , array());
    
    for($i=0; $i < sizeof($modulo); $i++)
    {
      $valor = isset($seleccionado[$i]) ? "1" : "0";
      if (($heredado[$i]==1 || $heredado[$i]==0)&&($valor=="1"))      
       	 $this->grupo->anadirPermiso($modulo[$i],$accion[$i]);
     
    }
  }
  
  //Ana:
  protected function updatePermisosFromRequest()
  {
    //$this->grupo->cargarOtrosDatos();
    $this->grupo->vaciarPermisos();
    
    $modulo = $this->getRequestParameter('modulo' , array());
    $accion = $this->getRequestParameter('accion' , array());
    $heredado = $this->getRequestParameter('heredado' , array());
    $seleccionado = $this->getRequestParameter('seleccionado' , array());
    
    for($i=0; $i < sizeof($modulo); $i++)
    {
      $valor = isset($seleccionado[$i]) ? "1" : "0";
      if (($heredado[$i]==1 || $heredado[$i]==0)&&($valor=="1"))
      {
        $this->grupo->anadirPermiso($modulo[$i],$accion[$i]);
      }
    }
    //como se tratan los checkboxes:
    //$this->promotora->setBorrado(isset($promotora['borrado']) ? $promotora['borrado'] : 0);
  }

  protected function getGrupoOrCreate($id_grupo = 'id_grupo')
  {
    if (!$this->getRequestParameter($id_grupo))
    {
      $grupo = new Grupo();
    }
    else
    {
      $grupo = GrupoPeer::retrieveByPk($this->getRequestParameter($id_grupo));
      //Ana:
		$grupo->cargarOtrosDatos();
		//$padres=Grupo::arbolGrupos(true);
		
      $this->forward404Unless($grupo);
    }
    return $grupo;
  }

  protected function processFilters()
  {
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/grupo/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/grupo/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/grupo/sort'))
    {
      $this->getUser()->setAttribute('sort', 'id_grupo', 'sf_admin/grupo/sort');
      $this->getUser()->setAttribute('type', 'asc', 'sf_admin/grupo/sort');
    }
  }

  protected function addFiltersCriteria($c)
  {
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/grupo/sort'))
    {
      $sort_column = GrupoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/grupo/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'grupo{id_grupo}' => 'Grupo',
      'grupo{nombre}' => 'Nombre',
      'grupo{padre}' => 'Padre',
    );
  }
}
