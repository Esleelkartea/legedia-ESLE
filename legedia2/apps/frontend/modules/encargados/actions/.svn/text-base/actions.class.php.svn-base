<?php

/**
 * encargados actions, importado desde GestPro
 *
 * @package    gestPro
 * @subpackage encargados
 * @author     Neofis
 * @version    SVN: $Id$
 */
class encargadosActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('encargados', 'list');
  }
  
  public function executeShow()
  {
    $this->cliente = $this->getEncargadoOr404();
    $this->labels = $this->getLabels();
  }

  public function executeList()
  {
    $this->processSort();
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/cliente/filters');
    // pager
    $this->pager = new sfPropelPager('Encargado', 10);
    $c = new Criteria();
    $c->add(EncargadoPeer::ID_EMPRESA, sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeCreate()
  {
    return $this->forward('encargados', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('encargados', 'edit');
  }

  public function executeEdit()
  {
    $this->cliente = $this->getEncargadoOrCreate();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateEncargadoFromRequest();
      $this->saveEncargado($this->cliente);
      $this->getUser()->setFlash('notice', 'Your modifications have been saved');
      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('encargados/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('encargados/list');
      }
      else
      {
        return $this->redirect('encargados/edit?id_cliente='.$this->cliente->getIdCliente());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->cliente = $this->getEncargadoOr404();
    try
    {
      $this->deleteEncargado($this->cliente);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 
        'Could not delete the selected Encargado. Make sure it does not have any associated items.');
      return $this->forward('encargados', 'list');
    }

    return $this->redirect('encargados/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->cliente = $this->getEncargadoOrCreate();
    $this->updateEncargadoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveEncargado($cliente)
  {
    $cliente->save();

  }

  protected function deleteEncargado($cliente)
  {
    $cliente->delete();
  }

  protected function updateEncargadoFromRequest()
  {
    $cliente = $this->getRequestParameter('cliente');

    if (isset($cliente['nombre']))
    {
      $this->cliente->setNombre($cliente['nombre']);
    }
    if (isset($cliente['razon_social']))
    {
      $this->cliente->setRazonSocial($cliente['razon_social']);
    }
    if (isset($cliente['cif']))
    {
      $this->cliente->setCif($cliente['cif']);
    }
    if (isset($cliente['contacto']))
    {
      $this->cliente->setContacto($cliente['contacto']);
    }
    if (isset($cliente['telefono']))
    {
      $this->cliente->setTelefono($cliente['telefono']);
    }
    if (isset($cliente['movil']))
    {
      $this->cliente->setMovil($cliente['movil']);
    }
    if (isset($cliente['fax']))
    {
      $this->cliente->setFax($cliente['fax']);
    }
    if (isset($cliente['domicilio']))
    {
      $this->cliente->setDomicilio($cliente['domicilio']);
    }
    if (isset($cliente['poblacion']))
    {
      $this->cliente->setPoblacion($cliente['poblacion']);
    }
    if (isset($cliente['codigo_postal']))
    {
      $this->cliente->setCodigoPostal($cliente['codigo_postal']);
    }
    if (isset($cliente['provincia']))
    {
      $this->cliente->setProvincia($cliente['provincia']);
    }
  }

  protected function getEncargadoOrCreate($id_cliente = 'id_cliente')
  {
    if (!$this->getRequestParameter($id_cliente))
    {
      $cliente = new Encargado();
      $cliente->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    }
    else
    {
      $cliente = EncargadoPeer::retrieveByPk($this->getRequestParameter($id_cliente));
      $this->forward404Unless($cliente);
    }

    return $cliente;
  }
  
  protected function getEncargadoOr404($id_cliente = 'id_cliente')
  {
    if (!$this->getRequestParameter($id_cliente))
    {
      $this->forward404();
    }
    else
    {
      $cliente = EncargadoPeer::retrieveByPk($this->getRequestParameter($id_cliente));
      $this->forward404Unless($cliente);
    }

    return $cliente;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/cliente/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/cliente/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/cliente/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/cliente/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/cliente/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_cliente_is_empty']))
    {
      $criterion = $c->getNewCriterion(EncargadoPeer::ID_CLIENTE, '');
      $criterion->addOr($c->getNewCriterion(EncargadoPeer::ID_CLIENTE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_cliente']) && $this->filters['id_cliente'] !== '')
    {
      $c->add(EncargadoPeer::ID_CLIENTE, $this->filters['id_cliente']);
    }
    if (isset($this->filters['nombre_is_empty']))
    {
      $criterion = $c->getNewCriterion(EncargadoPeer::NOMBRE, '');
      $criterion->addOr($c->getNewCriterion(EncargadoPeer::NOMBRE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['nombre']) && $this->filters['nombre'] !== '')
    {
      $c->add(EncargadoPeer::NOMBRE, strtr($this->filters['nombre'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['razon_social_is_empty']))
    {
      $criterion = $c->getNewCriterion(EncargadoPeer::RAZON_SOCIAL, '');
      $criterion->addOr($c->getNewCriterion(EncargadoPeer::RAZON_SOCIAL, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['razon_social']) && $this->filters['razon_social'] !== '')
    {
      $c->add(EncargadoPeer::RAZON_SOCIAL, strtr($this->filters['razon_social'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['cif_is_empty']))
    {
      $criterion = $c->getNewCriterion(EncargadoPeer::CIF, '');
      $criterion->addOr($c->getNewCriterion(EncargadoPeer::CIF, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['cif']) && $this->filters['cif'] !== '')
    {
      $c->add(EncargadoPeer::CIF, strtr($this->filters['cif'], '*', '%'), Criteria::LIKE);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/cliente/sort'))
    {
      $sort_column = EncargadoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/cliente/sort') == 'asc')
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
      'cliente{nombre}' => 'Nombre:',
      'cliente{razon_social}' => 'Razón social:',
      'cliente{cif}' => 'Cif:',
      'cliente{contacto}' => 'Contacto:',
      'cliente{telefono}' => 'Teléfono:',
      'cliente{movil}' => 'Móvil:',
      'cliente{fax}' => 'Fax:',
      'cliente{domicilio}' => 'Dirección:',
      'cliente{poblacion}' => 'Localidad:',
      'cliente{codigo_postal}' => 'Código postal:',
      'cliente{provincia}' => 'Provincia:'
    );
  }
  
}
