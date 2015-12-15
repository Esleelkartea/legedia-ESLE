<?php

/**
 * usuarios actions.
 *
 * @package    NeoCRM
 * @subpackage usuarios
 * @author     Roberto Martín Huelmo
 * @version    10-02-09
 */
class usuariosActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('usuarios', 'list');
  }
  
  public function executeShow()
  {
    $this->labels = $this->getLabels();
    $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('id_usuario'));
    $this->forward404Unless($this->usuario);
  }
  
  public function executeList()
  {      
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/usuario/filters');
    
    $this->pager = new sfPropelPager('Usuario', sfConfig::get('app_listas_default') );//
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }
  
  public function executeCreate()
  {
    return $this->forward('usuarios', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('usuarios', 'edit');
  }
  
  public function executeEdit()
  {
    $this->usuario = $this->getUsuarioOrCreate();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateUsuarioFromRequest();
      $this->saveUsuario($this->usuario);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('usuarios/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('usuarios/list');
      }
      else
      {
        return $this->redirect('usuarios/edit?id_usuario='.$this->usuario->getIdUsuario());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function executeDelete()
  {
    $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('id_usuario'));
    $this->forward404Unless($this->usuario);
    try
    {
      $this->deleteUsuario($this->usuario);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el usuario. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('usuarios', 'list');
    }
    return $this->redirect('usuarios/list');
  }
  
  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->usuario = $this->getUsuarioOrCreate();
    $this->updateUsuarioFromRequest();

    $this->labels = $this->getLabels();
    
    return sfView::SUCCESS;
  }
  
  protected function saveUsuario($usuario)
  {
    $usuario->save();
    
    // Update many-to-many for "grupos"
    $c = new Criteria();
    $c->add(UsuarioGrupoPeer::ID_USUARIO, $usuario->getPrimaryKey());
    UsuarioGrupoPeer::doDelete($c);

    $ids = $this->getRequestParameter('associated_grupos');
    if (is_array($ids))
    {
      foreach ($ids as $id)
      {
        $UsuarioGrupo = new UsuarioGrupo();
        $UsuarioGrupo->setIdUsuario($usuario->getPrimaryKey());
        $UsuarioGrupo->setIdGrupo($id);
        $UsuarioGrupo->save();
      }
    }
    
  }
  

  protected function deleteUsuario($usuario)
  {
    $usuario->delete();
  }
  
  
   protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
      if (isset($filters['updated_at']['from']) && $filters['updated_at']['from'] !== '')
      {
        $filters['updated_at']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['updated_at']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['updated_at']['to']) && $filters['updated_at']['to'] !== '')
      {
        $filters['updated_at']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['updated_at']['to'], $this->getUser()->getCulture());
      }

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/usuario');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/usuario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/usuario/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/usuario/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/usuario/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/usuario/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_usuario_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::ID_USUARIO, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::ID_USUARIO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_usuario']) && $this->filters['id_usuario'] !== '')
    {
      $c->add(UsuarioPeer::ID_USUARIO, $this->filters['id_usuario']);
    }
    if (isset($this->filters['usuario_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::USUARIO, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::USUARIO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['usuario']) && $this->filters['usuario'] !== '')
    {
      $c->add(UsuarioPeer::USUARIO, strtr($this->filters['usuario'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['apellido1_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDO1, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::APELLIDO1, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['apellido1']) && $this->filters['apellido1'] !== '')
    {
      $c->add(UsuarioPeer::APELLIDO1, strtr($this->filters['apellido1'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['email_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::EMAIL, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['email']) && $this->filters['email'] !== '')
    {
      $c->add(UsuarioPeer::EMAIL, strtr($this->filters['email'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['updated_at_is_empty']))
    {
      $criterion = $c->getNewCriterion(UsuarioPeer::UPDATED_AT, '');
      $criterion->addOr($c->getNewCriterion(UsuarioPeer::UPDATED_AT, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['updated_at']))
    {
      if (isset($this->filters['updated_at']['from']) && $this->filters['updated_at']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::UPDATED_AT, $this->filters['updated_at']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['updated_at']['to']) && $this->filters['updated_at']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(UsuarioPeer::UPDATED_AT, $this->filters['updated_at']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(UsuarioPeer::UPDATED_AT, $this->filters['updated_at']['to'], Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/usuario/sort'))
    {
      $sort_column = UsuarioPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/usuario/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }
  
  
  protected function updateUsuarioFromRequest()
  {
    $usuario = $this->getRequestParameter('usuario');
    if (isset($usuario['usuario']))
    {
      $this->usuario->setUsuario($usuario['usuario']);
    }
    if (isset($usuario['newpassword']) and $usuario['newpassword']!='')
    {   
     $this->usuario->ensuciarClave($usuario['newpassword']);
    }
    if (isset($usuario['nombre']))
    {
      $this->usuario->setNombre($usuario['nombre']);
    }
    if (isset($usuario['apellido1']))
    {
      $this->usuario->setApellido1($usuario['apellido1']);
    }
    if (isset($usuario['apellido2']))
    {
      $this->usuario->setApellido2($usuario['apellido2']);
    }
    if (isset($usuario['email']))
    {
      $this->usuario->setEmail($usuario['email']);
    }
    if (isset($usuario['id_idioma']))
    {
      $this->usuario->setIdIdioma($usuario['id_idioma']);
    }
    if (isset($usuario['dni']))
    {
      $this->usuario->setDni($usuario['dni']);
    }
    if (isset($usuario['domicilio']))
    {
      $this->usuario->setDomicilio($usuario['domicilio']);
    }
    if (isset($usuario['poblacion']))
    {
      $this->usuario->setPoblacion($usuario['poblacion']);
    }
    if (isset($usuario['cp']))
    {
      $this->usuario->setCp($usuario['cp']);
    }
    if (isset($usuario['id_provincia']))
    {
      $this->usuario->setIdProvincia($usuario['id_provincia']);
    }
    if (isset($usuario['movil']))
    {
      $this->usuario->setMovil($usuario['movil']);
    }
    if (isset($usuario['fax']))
    {
      $this->usuario->setFax($usuario['fax']);
    }
    if (isset($usuario['telefono']))
    {
      $this->usuario->setTelefono($usuario['telefono']);
    }

    $this->usuario->setAlertaEmail(isset($usuario['alerta_email']) ? $usuario['alerta_email'] : 0);    
  }
  
  protected function getUsuarioOrCreate($idusuario = 'id_usuario')
  {
    if (!$this->getRequestParameter($idusuario))
    {
      $usuario = new Usuario();
    }
    else
    {
      $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter($idusuario));

      $this->forward404Unless($usuario);
    }
    return $usuario;
  }

  protected function getLabels()
  {
    return array(
      'usuario{id_usuario}' => 'id',
      'usuario{usuario}' => 'usuario',
      'usuario{clave}' => 'contraseña',
      'usuario{newpassword}' => 'contraseña',
      'usuario{nombre}' => 'nombre',
      'usuario{nombre_completo}' => 'nombre completo',
      'usuario{apellido1}' => 'primer apellido',
      'usuario{apellido2}' => 'segundo apellido',
      'usuario{email}' => 'e-mail',
      'usuario{grupos}' => 'grupos',
      'usuario{categorias_informes}' => 'categorias de informes',
      'usuario{id_idioma}' => 'Idioma',
      'usuario{dni}' => 'DNI:',
      'usuario{domicilio}' => 'Domicilio:',
      'usuario{poblacion}' => 'Poblacion:',
      'usuario{cp}' => 'Cp:',
      'usuario{id_provincia}' => 'Provincia:',
      'usuario{movil}' => 'Móvil:',
      'usuario{telefono}' => 'Teléfono:',
      'usuario{fax}' => 'Fax:',
    );
  }

}
