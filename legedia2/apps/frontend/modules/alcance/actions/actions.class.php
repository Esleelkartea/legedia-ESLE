<?php

/**
 * alcance actions. El alcance hace referencia al conjunto de filas "alcance" que PERTENECEN A UN USUARIO.
 *
 * @package    NeoCRM
 * @subpackage alcance
 * @author     Roberto Martín Huelmo
 * @version    10-02-09
 */
class alcanceActions extends sfActions
{

  
  public function executeList()
  {
 
    
    $this->usuario = $this->getUsuarioOrError();
    $this->pager = new sfPropelPager('Alcance', sfConfig::get('app_listas_default'));
    $c = new Criteria();
    $c->add(AlcancePeer::ID_USUARIO , $this->usuario->getIdUsuario());
    $this->pager->setCriteria($c);   
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
    
    $this->labels = $this->getLabels();
  }
  
  public function executeCreate()
  {
    return $this->forward('alcance', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('alcance', 'edit');
  }
  
  
  public function executeEdit()
  {
    $this->alcance = $this->getAlcanceOrCreate();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateAlcanceFromRequest();
      $this->saveAlcance($this->alcance);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('alcance/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('alcance/list');
      }
      else
      {
        $parametros = "?id_alcance=".$this->alcance->getIdAlcance();
        $parametros .= "&id_usuario=".$this->alcance->getIdUsuario();
        return $this->redirect('alcance/edit'.$parametros);
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->alcance = $this->getAlcanceOrCreate();
    $this->updateAlcanceFromRequest();

    $this->labels = $this->getLabels();
    
    return sfView::SUCCESS;
  }
  
  
  
  public function executeDelete()
  {
    $this->alcance = AlcancePeer::retrieveByPk($this->getRequestParameter('id_alcance') , $this->getRequestParameter('id_usuario'));
    $this->forward404Unless($this->alcance);

    try
    {
      $this->deleteAlcance($this->alcance);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el alcance. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('alcance', 'list');
    }

    return $this->redirect('alcance/list?id_usuario='.$this->getRequestParameter('id_usuario'));
  }
  
  public function executeUpdate_selects()
  {
    //me interesa obtener todos los datos del formulario, pero sin que sea llamando a un form.
    $id_empresa = $this->getRequestParameter('id_empresa' , '');
    $id_tabla = $this->getRequestParameter('id_tabla' , '');
 
    
    $this->alcance = new Alcance();//no es necesario instanciar el objeto real con el que se está trabajando.
    $this->alcance->setIdEmpresa($id_empresa);
    $this->alcance->setIdTabla($id_tabla);
 
    
    $this->labels = $this->getLabels();
  }
  
    
  protected function saveAlcance($alcance)
  {
    sfContext::getInstance()->getUser()->setAttribute('updated',false,'alcance');
    $alcance->save();
  }

  protected function deleteAlcance($alcance)
  {
    sfContext::getInstance()->getUser()->setAttribute('updated',false,'alcance');
    $alcance->delete();
  }
  
  protected function updateAlcanceFromRequest()
  {
    $alcance = $this->getRequestParameter('alcance');
    //titulo, descripción
    if (isset($alcance['titulo']))
    {
      $this->alcance->setTitulo($alcance['titulo'] ? $alcance['titulo'] : null);
    }
    if (isset($alcance['descripcion']))
    {
      $this->alcance->setDescripcion($alcance['descripcion'] ? $alcance['descripcion'] : null);
    }
    if (isset($alcance['id_empresa']))
    {
      $this->alcance->setIdEmpresa($alcance['id_empresa'] ? $alcance['id_empresa'] : null);
    }
    if (isset($alcance['id_tabla']))
    {
      $this->alcance->setIdTabla($alcance['id_tabla'] ? $alcance['id_tabla'] : null);
    }
    
    $this->alcance->setVerTodosRegistros(isset($alcance['ver_todos_registros']) ? true : false);
    
  }
  
  protected function getAlcanceOrCreate($id_alcance = 'id_alcance')
  {
    $usuario = $this->getUsuarioOrError();
    if (!$this->getRequestParameter($id_alcance) )
    {
      $alcance = new Alcance();
      $alcance->setIdUsuario($usuario->getPrimaryKey());
    }
    else
    {
      $alcance = AlcancePeer::retrieveByPk($this->getRequestParameter($id_alcance) , $usuario->getPrimaryKey());

      $this->forward404Unless($alcance);
    }
    return $alcance;
  }
  
  
  protected function getUsuarioOrError($id_usuario = 'id_usuario')
  {
    if (!$this->getRequestParameter($id_usuario) )
    {
      $this->forward404();
    }
    else
    {
      $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter($id_usuario));

      $this->forward404Unless($usuario);
    }
    
    return $usuario;
  }
  
  
  protected function getLabels()
  {
    return array(
      'alcance{id_alcance}' => 'id',
      'alcance{id_usuario}' => 'usuario',
      'alcance{id_grupo}' => 'grupo',
      'alcance{id_empresa}' => 'empresa',
      'alcance{id_tabla}' => 'tablas',    
      'alcance{titulo}' => 'título',
      'alcance{descripcion}' => 'descripción',
      'alcance{ver_todos_registros}' => 'ver todos los registros',      
      'usuario{nombre}' => 'nombre',
      'Actions' => 'Actions',
    );
  }
  
  
}
