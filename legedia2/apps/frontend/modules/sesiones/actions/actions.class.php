<?php

/**
 * sesiones actions.
 *
 * @package    NeoCRM
 * @subpackage sesiones
 * @author     Ana Martín
 * @version    10-02-09
 */
class sesionesActions extends sfActions
{
  public function executeIndex()
  {
     Usuario::usuarioActualPermisos($this,'sesiones','index', false, sfRequest::GET);
    return $this->forward('sesiones', 'list');
  }

  public function executeList()
  {
     Usuario::usuarioActualPermisos($this,'sesiones','list', false, sfRequest::GET);
     
	 $this->labels = $this->getLabels();     
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/sesion/filters');

    // pager
    $this->pager = new sfPropelPager('Sesion',  sfConfig::get('app_listas_default'));
    $c = new Criteria();   
    if (!$this->getRequestParameter('sort')) $c->addDescendingOrderByColumn(SesionPeer::ID_SESION);
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }


  public function executeDelete()
  {
     Usuario::usuarioActualPermisos($this,'sesiones','delete', false, sfRequest::GET);
    $this->sesion = SesionPeer::retrieveByPk($this->getRequestParameter('idsesion'));
    $this->forward404Unless($this->sesion);

    try
    {
      $this->deleteSesion($this->sesion);
		$c= new Criteria();
		$c->add(SesionLogPeer::ID_SESION, $this->getRequestParameter('idsesion'));
		SesionLogPeer::doDelete($c);      
      
      
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Sesion. Make sure it does not have any associated items.');
      return $this->forward('sesiones', 'list');
    }
    
    switch ($this->getActionName()) {
      case 'create':
        break;
      case 'edit':
        break;
    }
    

    return $this->redirect('sesiones/list');
  }

  public function handlePost()
  {
    $this->updateSesionFromRequest();

    $this->saveSesion($this->sesion);

    $this->getUser()->setFlash('notice', 'Your modifications have been saved');

    if ($this->getRequestParameter('save_and_add'))
    {
      return $this->redirect('sesiones/create');
    }
    else if ($this->getRequestParameter('save_and_list'))
    {
      return $this->redirect('sesiones/list');
    }
    else
    {
      return $this->redirect('sesiones/edit?idsesion='.$this->sesion->getIdsesion());
    }
  }
   protected function deleteSesion($sesion)
  {
    $sesion->delete();
  }
 
  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
    
		$filters = $this->getRequestParameter('filters');
      if (isset($filters['fecha']['from']) && $filters['fecha']['from'] !== '')
      {
        $filters['fecha']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['fecha']['to']) && $filters['fecha']['to'] !== '')
      {
        $filters['fecha']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha']['to'], $this->getUser()->getCulture());
      }    
    

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sesion/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/sesion/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/sesion/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/sesion/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/sesion/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_sesion_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionPeer::ID_SESION, '');
      $criterion->addOr($c->getNewCriterion(SesionPeer::ID_SESION, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_sesion']) && $this->filters['id_sesion'] !== '')
    {
      $c->add(SesionPeer::ID_SESION, $this->filters['id_sesion']);
    }
    if (isset($this->filters['id_usuario_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionPeer::ID_USUARIO, '');
      $criterion->addOr($c->getNewCriterion(SesionPeer::ID_USUARIO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_usuario']) && $this->filters['id_usuario'] !== '')
    {
      $c->add(SesionPeer::ID_USUARIO, $this->filters['id_usuario']);
    }
    if (isset($this->filters['sesion_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionPeer::SESION, '');
      $criterion->addOr($c->getNewCriterion(SesionPeer::SESION, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['sesion']) && $this->filters['sesion'] !== '')
    {
      $c->add(SesionPeer::SESION, strtr($this->filters['sesion'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['ip_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionPeer::IP, '');
      $criterion->addOr($c->getNewCriterion(SesionPeer::IP, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['ip']) && $this->filters['ip'] !== '')
    {
      $c->add(SesionPeer::IP, $this->filters['ip']);
    }
    
    if (isset ($this->filters['modulo']) && $this->filters['modulo'] != '') {
      $c->setDistinct();
    	$c->addJoin(SesionLogPeer::ID_SESION, SesionPeer::ID_SESION);
    	$c->add(SesionLogPeer::MODULO, $this->filters['modulo']);
		    
    }
    
     if (isset($this->filters['fecha']['from']) && $this->filters['fecha']['from'] !== '')
      {
        $c->setDistinct();
    	  $c->addJoin(SesionLogPeer::ID_SESION, SesionPeer::ID_SESION);
        $criterion = $c->getNewCriterion(SesionLogPeer::FECHA, $this->filters['fecha']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecha']['to']) && $this->filters['fecha']['to'] !== '')
      {
         $c->setDistinct();
    		$c->addJoin(SesionLogPeer::ID_SESION, SesionPeer::ID_SESION);
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(SesionLogPeer::FECHA, $this->filters['fecha']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(SesionLogPeer::FECHA, $this->filters['fecha']['to'], Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      {
        $c->add($criterion);
      }
    
    
    
    
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/sesion/sort'))
    {
      $sort_column = SesionPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/sesion/sort') == 'asc')
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
          'sesion{idsesion}' => 'Sesión',
          'sesion{idusuario}' => 'Usuario',
          'sesion{sesion}' => 'Sesión',
          'sesion{ip}' => 'Ip',
          
			 'sesion{desde}' => 'Desde',
			 'sesion{hasta}' => 'Hasta',
			 'sesion{acciones}' => 'Nº de acciones realizadas',          
          'sesion{modulo}' => 'Módulo',
          'sesion{fecha}' => 'Fecha',
        );
    
   
  }
}
