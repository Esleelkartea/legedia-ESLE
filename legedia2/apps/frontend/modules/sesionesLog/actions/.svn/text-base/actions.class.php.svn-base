<?php

/**
 * SesionesLog actions.
 *
 * @package    NeoCRM
 * @subpackage SesionesLog
 * @author     Ana Martín
 * @version    10-02-09
 */
class SesionesLogActions extends sfActions
{
  public function executeIndex()
  {
    Usuario::usuarioActualPermisos($this,'SesionesLog','index', false, sfRequest::GET);
    return $this->forward('SesionesLog', 'list');
  }

  public function executeList()
  {
     Usuario::usuarioActualPermisos($this,'SesionesLog','list', false, sfRequest::GET);
    
    $this->labels = $this->getLabels();

    $id_sesion = $this->getRequestParameter('idsesion');
    $this->id_sesion = $id_sesion;
    
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/log_sesion/filters');
    if ($id_sesion != '') $this->filters['id_sesion'] =  $id_sesion;
    // pager
    $this->pager = new sfPropelPager('SesionLog', sfConfig::get('app_listas_default'));
   
    if ($id_sesion != '') { 
    	$c= new Criteria();
    	$c ->add(SesionLogPeer::ID_SESION, $id_sesion);
    	
    }
    else $c = new Criteria(); 
    if (!$this->getRequestParameter('sort')) $c->addAscendingOrderByColumn(SesionLogPeer::ID_LOG);   
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeShow()
  {
     Usuario::usuarioActualPermisos($this,'SesionesLog','show', false, sfRequest::GET);
    $this->log_sesion = $this->getSesionLogOrCreate();
    if ($this->log_sesion->isNew()) {
    	return $this->forward('SesionesLog', 'create');
    }
    $this->labels = $this->getLabels();
  }

/*
  public function executeCreate()
  {
    return $this->forward('SesionesLog', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('SesionesLog', 'edit');
  }

  public function executeEdit()
  {
    $this->log_sesion = $this->getSesionLogOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      return $this->handlePost();
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
*/
  public function executeDelete()
  {
     Usuario::usuarioActualPermisos($this,'SesionesLog','delete', false, sfRequest::GET);
    $this->log_sesion = SesionLogPeer::retrieveByPk($this->getRequestParameter('idlog'));
    $this->forward404Unless($this->log_sesion);

    try
    {
      $this->deleteSesionLog($this->log_sesion);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Log sesion. Make sure it does not have any associated items.');
      return $this->forward('SesionesLog', 'list');
    }
    
    switch ($this->getActionName()) {
      case 'create':
        break;
      case 'edit':
        break;
    }

    return $this->redirect('SesionesLog/list');
  }
/*
  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->log_sesion = $this->getSesionLogOrCreate();
    $this->updateSesionLogFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }
*/
  public function handlePost()
  {
    $this->updateSesionLogFromRequest();

    $this->saveSesionLog($this->log_sesion);

    $this->getUser()->setFlash('notice', 'Your modifications have been saved');

    if ($this->getRequestParameter('save_and_add'))
    {
      return $this->redirect('SesionesLog/create');
    }
    else if ($this->getRequestParameter('save_and_list'))
    {
      return $this->redirect('SesionesLog/list');
    }
    else
    {
      return $this->redirect('SesionesLog/edit?idlog='.$this->log_sesion->getIdlog());
    }
  }
  
  protected function deleteSesionLog($log_sesion)
  {
    $log_sesion->delete();
  }
  
  /*
  protected function saveSesionLog($log_sesion)
  {
    $log_sesion->save();

    switch ($this->getActionName()) {
      case 'create':
        break;
      case 'edit':
        break;
    }
  }


  protected function updateSesionLogFromRequest()
  {
    $log_sesion = $this->getRequestParameter('log_sesion');

    switch ($this->getActionName()) {
      case 'create':
        if (isset($log_sesion['idsesion']))
        {
          $this->log_sesion->setIdsesion($log_sesion['idsesion'] ? $log_sesion['idsesion'] : null);
        }
        if (isset($log_sesion['fecha']))
        {
          if ($log_sesion['fecha'])
          {
            try
            {
              $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                                  if (!is_array($log_sesion['fecha']))
              {
                $value = $dateFormat->format($log_sesion['fecha'], 'I', $dateFormat->getInputPattern('g'));
              }
              else
              {
                $value_array = $log_sesion['fecha'];
                $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
              }
              $this->log_sesion->setFecha($value);
            }
            catch (sfException $e)
            {
              // not a date
            }
          }
          else
          {
            $this->log_sesion->setFecha(null);
          }
        }
        if (isset($log_sesion['url']))
        {
          $this->log_sesion->setUrl($log_sesion['url']);
        }
        if (isset($log_sesion['modulo']))
        {
          $this->log_sesion->setModulo($log_sesion['modulo']);
        }
        if (isset($log_sesion['accion']))
        {
          $this->log_sesion->setAccion($log_sesion['accion']);
        }
        if (isset($log_sesion['parametros']))
        {
          $this->log_sesion->setParametros($log_sesion['parametros']);
        }
        if (isset($log_sesion['mensaje']))
        {
          $this->log_sesion->setMensaje($log_sesion['mensaje']);
        }
      break;
      case 'edit':
        if (isset($log_sesion['idsesion']))
        {
          $this->log_sesion->setIdsesion($log_sesion['idsesion'] ? $log_sesion['idsesion'] : null);
        }
        if (isset($log_sesion['fecha']))
        {
          if ($log_sesion['fecha'])
          {
            try
            {
              $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                                  if (!is_array($log_sesion['fecha']))
              {
                $value = $dateFormat->format($log_sesion['fecha'], 'I', $dateFormat->getInputPattern('g'));
              }
              else
              {
                $value_array = $log_sesion['fecha'];
                $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
              }
              $this->log_sesion->setFecha($value);
            }
            catch (sfException $e)
            {
              // not a date
            }
          }
          else
          {
            $this->log_sesion->setFecha(null);
          }
        }
        if (isset($log_sesion['url']))
        {
          $this->log_sesion->setUrl($log_sesion['url']);
        }
        if (isset($log_sesion['modulo']))
        {
          $this->log_sesion->setModulo($log_sesion['modulo']);
        }
        if (isset($log_sesion['accion']))
        {
          $this->log_sesion->setAccion($log_sesion['accion']);
        }
        if (isset($log_sesion['parametros']))
        {
          $this->log_sesion->setParametros($log_sesion['parametros']);
        }
        if (isset($log_sesion['mensaje']))
        {
          $this->log_sesion->setMensaje($log_sesion['mensaje']);
        }
      break;
    }
  }
*/
  protected function getSesionLogOrCreate($idlog = 'idlog')
  {
    if (!$this->getRequestParameter($idlog))
    {
      $log_sesion = new SesionLog();
    }
    else
    {
      $log_sesion = SesionLogPeer::retrieveByPk($this->getRequestParameter($idlog));

      $this->forward404Unless($log_sesion);
    }

    return $log_sesion;
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

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/log_sesion/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/log_sesion/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/log_sesion/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/log_sesion/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/log_sesion/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_log_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionLogPeer::ID_LOG, '');
      $criterion->addOr($c->getNewCriterion(SesionLogPeer::ID_LOG, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_log']) && $this->filters['id_log'] !== '')
    {
      $c->add(SesionLogPeer::ID_LOG, $this->filters['id_log']);
    }
    if (isset($this->filters['id_sesion_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionLogPeer::ID_SESION, '');
      $criterion->addOr($c->getNewCriterion(SesionLogPeer::ID_SESION, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_sesion']) && $this->filters['id_sesion'] !== '')
    {
      $c->add(SesionLogPeer::ID_SESION, $this->filters['id_sesion']);
    }
    if (isset($this->filters['fecha_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionLogPeer::FECHA, '');
      $criterion->addOr($c->getNewCriterion(SesionLogPeer::FECHA, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['fecha']))
    {
      if (isset($this->filters['fecha']['from']) && $this->filters['fecha']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(SesionLogPeer::FECHA, $this->filters['fecha']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecha']['to']) && $this->filters['fecha']['to'] !== '')
      {
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
    if (isset($this->filters['modulo_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionLogPeer::MODULO, '');
      $criterion->addOr($c->getNewCriterion(SesionLogPeer::MODULO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['modulo']) && $this->filters['modulo'] !== '')
    {
      $c->add(SesionLogPeer::MODULO, strtr($this->filters['modulo'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['accion_is_empty']))
    {
      $criterion = $c->getNewCriterion(SesionLogPeer::ACCION, '');
      $criterion->addOr($c->getNewCriterion(SesionLogPeer::ACCION, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['accion']) && $this->filters['accion'] !== '')
    {
      $c->add(SesionLogPeer::ACCION, strtr($this->filters['accion'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/log_sesion/sort'))
    {
      $sort_column = SesionLogPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/log_sesion/sort') == 'asc')
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
          'log{id_log}' => 'Log',
          'log{id_sesion}' => 'Sesión',
          'log{fecha}' => 'Fecha',
          'log{url}' => 'Url',
          'log{modulo}' => 'Módulo',
          'log{accion}' => 'Acción',
          'log{parametros}' => 'Parametros',
          'log{mensaje}' => 'Mensaje',
        );
   
  }
}
