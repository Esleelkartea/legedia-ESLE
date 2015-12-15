<?php

/**
 * historico_documentos actions, importado desde GestPro
 *
 * @package    ingema
 * @subpackage historico_documentos
 * @author     Neofis
 * @version    SVN: $Id$
 */
class historico_documentosActions extends sfActions
{
  public function executeDescargar()
  {    
    if (!$this->getRequestParameter('id_documento') || !$this->getRequestParameter('version')) 
    {
      $this->getUser()->setFlash('error_notice', 'No se ha podido descargar el fichero');
      return $this->forward('historico_documentos', 'list');
    }
    else 
    {
      $historico = $this->getHistoricoDocumentoOr404();
      $this->fichero = $historico->getRutaArchivo();
      $this->nombre_fichero_original  = $historico->getNombreFich();
      $this->mime                     = $historico->getMime();
    }
  }

  public function executeIndex()
  {
    return $this->forward('historico_documentos', 'list');
  }

  public function executeList()
  {
    $this->processSort();
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/historico_documento/filters');
    
    // pager
    $this->pager = new sfPropelPager('HistoricoDocumento', 10);
    $c = new Criteria();
    $c->add(HistoricoDocumentoPeer::ID_EMPRESA,sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    $c->addJoin(RelDocumentoTrabajadorPeer::ID_DOCUMENTO, HistoricoDocumentoPeer::ID_DOCUMENTO); //Ana: 4-11-09 
    $c->add(RelDocumentoTrabajadorPeer::ID_TRABAJADOR, TrabajadorPeer::getIdTrabajadorActual()); //Ana: 4-11-09
    $c->addAscendingOrderByColumn(HistoricoDocumentoPeer::ID_DOCUMENTO);
    $c->addAscendingOrderByColumn(HistoricoDocumentoPeer::VERSION);
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeShow()
  {
    $this->historico_documento = $this->getHistoricoDocumentoOrCreate();
    if ($this->historico_documento->isNew()) {
    	return $this->forward('historico_documentos', 'create');
    }
    $this->labels = $this->getLabels();
  }

  public function executeCreate()
  {
    $this->historico_documento = new HistoricoDocumento();
    $this->historico_documento->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      return $this->handlePost();
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeSave()
  {
    return $this->forward('historico_documentos', 'edit');
  }

  public function executeEdit()
  {
    $this->historico_documento = $this->getHistoricoDocumentoOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      return $this->handlePost();
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->historico_documento = $this->getHistoricoDocumentoOr404();
    $documento = $this->historico_documento->getDocumento();
    try
    {
      $this->deleteHistoricoDocumento($this->historico_documento);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el objeto seleccionado.');
      return $this->forward('historico_documentos', 'list');
    }
    
    $restantes = $documento->getHistoricoDocumentos();
    if (sizeof($restantes)<=0)
    {
      $id_proyecto = $documento->getIdProyecto();
      $documento->delete();
      return $this->redirect('proyectos/edit?id_proyecto='.$id_proyecto);
    }    
    
    switch ($this->getActionName()) 
    {
      case 'create':
        break;
      case 'edit':
        break;
    }
    
    return $this->redirect('documentos/edit?id_documento='.$this->historico_documento->getIddocumento());
  }

  public function executeDelete_from_documentos()
  {
    $this->historico_documento = $this->getHistoricoDocumentoOr404();
    
    $documento = $this->historico_documento->getDocumento();
    $id_documento = $documento ? $documento->getPrimaryKey() : "";
    $id_fase = $documento ? $documento->getIdFase() : "";
    try
    {
      $this->deleteHistoricoDocumento($this->historico_documento);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el objeto seleccionado.');
      return $this->redirect('documentos/edit?id_documento='.$this->historico_documento->getIdDocumento());
    }
    
    $my_redirect = 'documentos/edit?id_documento='.$id_documento;
    $back = $this->getRequestParameter('back');
    
    if (($back == "fases_show") && $id_fase)
    {
      $my_redirect = 'fases/show?id_fase='.$id_fase;
    }
    elseif ($id_documento)
    {
     $my_redirect = 'documentos/edit?id_documento='.$id_documento;
    }
    else
    {
      $my_redirect = 'documentos/list';
    }
    
    $restantes = $documento->getHistoricoDocumentos();
    if (sizeof($restantes) <= 0)
    {
      $documento->delete();
      $my_redirect = 'documentos/list';
    }    
    
    return $this->redirect($my_redirect);
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->historico_documento = $this->getHistoricoDocumentoOrCreate();
    $this->updateHistoricoDocumentoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  public function handleErrorCreate()
  {
    $this->preExecute();
    $this->historico_documento = $this->getHistoricoDocumentoOrCreate();
    $this->updateHistoricoDocumentoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  public function handlePost()
  {
    $this->updateHistoricoDocumentoFromRequest();
    $this->saveHistoricoDocumento($this->historico_documento);
    $this->getUser()->setFlash('notice', 'Your modifications have been saved');
    if ($this->getRequestParameter('save_and_add'))
    {
      return $this->redirect('historico_documentos/create');
    }
    else if ($this->getRequestParameter('save_and_list'))
    {
      return $this->redirect('historico_documentos/list');
    }
    else
    {
      $parametros  = "?id_documento=".$this->historico_documento->getIdDocumento();
      $parametros .= '&version='.$this->historico_documento->getVersion();
      
      return $this->redirect('historico_documentos/edit'.$parametros);
    }
  }
  
  protected function saveHistoricoDocumento($historico_documento)
  { 
    $historico_documento->save();
    
    switch ($this->getActionName()) 
    {
      case 'create':
        break;
      case 'edit':
        break;
    }
  }

  protected function deleteHistoricoDocumento($historico_documento)
  {
    $historico_documento->delete();
  }

  protected function updateHistoricoDocumentoFromRequest()
  {
    $historico_documento = $this->getRequestParameter('historico_documento');

    switch ($this->getActionName()) 
    {
      case 'create':
        if (isset($historico_documento['nombre_fich']))
        {
          $this->historico_documento->setNombreFich($historico_documento['nombre_fich']);
        }
        break;
      case 'edit':
        // si cambio la version borro la anterior y creo una nueva
        if ($this->historio_documento != $historico_documento['version'])
        {
          $iddocumento = $this->historico_documento->getIdDocumento();
          $copia = $this->historico_documento->copy();
          $this->historico_documento->delete();
          $this->historico_documento = $copia;
          $this->historico_documento->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
          $this->historico_documento->setIddocumento($iddocumento);
          $this->historico_documento->setVersion($historico_documento['version']);
        }

        if (isset($historico_documento['nombre_fich']))
        {
          $this->historico_documento->setNombreFich($historico_documento['nombre_fich']);
        }
        break;
    }

  }

  protected function getHistoricoDocumentoOrCreate($iddocumento = 'id_documento', $version = 'version')
  {
    if (!$this->getRequestParameter($iddocumento)
     || !$this->getRequestParameter($version))
    {
      $historico_documento = new HistoricoDocumento();
      $historico_documento->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    }
    else
    {
      $c = new Criteria();
      $c->add(HistoricoDocumentoPeer::ID_DOCUMENTO, $this->getRequestParameter('id_documento'));
      $c->add(HistoricoDocumentoPeer::VERSION, $this->getRequestParameter('version'), Criteria::LIKE);
      $historico_documento = HistoricoDocumentoPeer::doSelectOne($c);

      $this->forward404Unless($historico_documento);
    }

    return $historico_documento;
  }
  
  protected function getHistoricoDocumentoOr404($iddocumento = 'id_documento', $version = 'version')
  {
    if (!$this->getRequestParameter($iddocumento)
     || !$this->getRequestParameter($version))
    {
      $this->forward404();
    }
    else
    {
      $c = new Criteria();
      $c->add(HistoricoDocumentoPeer::ID_DOCUMENTO, $this->getRequestParameter('id_documento'));
      $c->add(HistoricoDocumentoPeer::VERSION, $this->getRequestParameter('version'), Criteria::LIKE);
      $historico_documento = HistoricoDocumentoPeer::doSelectOne($c);
      $this->forward404Unless($historico_documento);
    }
    
    return $historico_documento;
  }
  
  protected function getDocumentoOr404($iddocumento = 'id_documento')
  {
    if (!$this->getRequestParameter($iddocumento))
    {
      $this->forward404();
    }
    else
    {
      $documento = DocumentoPeer::retrieveByPk($this->getRequestParameter($iddocumento));
      $this->forward404Unless($documento);
    }
    
    return $documento;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
      
      if (isset($filters['fecha']['from']) && $filters['fecha']['from'] !== '')
      {
        $filters['fecha']['from'] = 
          $this->getContext()->getI18N()->getTimestampForCulture(
            $filters['fecha']['from'], 
            $this->getUser()->getCulture()
          );
      }
      if (isset($filters['fecha']['to']) && $filters['fecha']['to'] !== '')
      {
        $filters['fecha']['to'] = 
          $this->getContext()->getI18N()->getTimestampForCulture(
            $filters['fecha']['to'], 
            $this->getUser()->getCulture()
          );
      }

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/historico_documento/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/historico_documento/filters');
    }     
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/historico_documento/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/historico_documento/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/historico_documento/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_documento_is_empty']))
    {
      $criterion = $c->getNewCriterion(HistoricoDocumentoPeer::ID_DOCUMENTO, '');
      $criterion->addOr($c->getNewCriterion(HistoricoDocumentoPeer::ID_DOCUMENTO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_documento']) && $this->filters['id_documento'] !== '')
    {
      $c->add(HistoricoDocumentoPeer::ID_DOCUMENTO, $this->filters['id_documento']);
    }  	   
    
    if (isset($this->filters['fecha_is_empty']))
    {
      $criterion = $c->getNewCriterion(HistoricoDocumentoPeer::FECHA, '');
      $criterion->addOr($c->getNewCriterion(HistoricoDocumentoPeer::FECHA, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['fecha']))
    {
      if (isset($this->filters['fecha']['from']) && $this->filters['fecha']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(HistoricoDocumentoPeer::FECHA, $this->filters['fecha']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecha']['to']) && $this->filters['fecha']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(HistoricoDocumentoPeer::FECHA, $this->filters['fecha']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(HistoricoDocumentoPeer::FECHA, $this->filters['fecha']['to'], Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      { 
        $criterion->addOr($c->getNewCriterion(HistoricoDocumentoPeer::FECHA, "", Criteria::EQUAL));
        $criterion->addOr($c->getNewCriterion(HistoricoDocumentoPeer::FECHA, null, Criteria::EQUAL));
        $c->add($criterion);
      }
    }  
  
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/historico_documento/sort'))
    {
      if ($sort_column == 'usuario')
      {
        $c->addJoin(HistoricoDocumentoPeer::ID_USUARIO, UsuarioPeer::ID_USUARIO, Criteria::LEFT_JOIN);
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/historico_documento/sort') == 'asc')
        {
          $c->addAscendingOrderByColumn(UsuarioPeer::NOMBRE);
        }
        else
        {
          $c->addDescendingOrderByColumn(UsuarioPeer::NOMBRE);
        }
      }
      else
      {
        $sort_column = HistoricoDocumentoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/historico_documento/sort') == 'asc')
        {
          $c->addAscendingOrderByColumn($sort_column);
        }
        else
        {
          $c->addDescendingOrderByColumn($sort_column);
        }
      }
      
    }
  }

  protected function getLabels()
  {
    switch ($this->getActionName()) {
      case 'create':
        return $this->getDefaultLabels();
        break;
      case 'edit':
        return $this->getDefaultLabels();
        break;
      case 'show':
        return $this->getDefaultLabels();
        break;
    }
  }
  
  protected function getDefaultLabels()
  {
    return array(
      'historico_documento{id_documento}' => 'Documento:',
      'historico_documento{version}' => 'Versión del documento:',
      'historico_documento{nombre_fich}' => 'Nombre del fichero:',
      'historico_documento{tamano}' => 'Tamano:',
      'historico_documento{fecha}' => 'Fecha de subida:',
      'historico_documento{id_usuario}' => 'Subido por:',
    );
  }
}

?>
