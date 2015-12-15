<?php

/**
 * preferencias actions.
 *
 * @package    NeoCRM
 * @subpackage preferencias
 * @author     Ana Martin
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class preferenciasActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('preferencias', 'show');
  }

  /**
  * Muestra los datos visibles del usuario actual.
  * @version 15-04-09
  */
  public function executeShow()
  {
    $this->labels = $this->getLabels();
    $usuario_actual = Usuario::getUsuarioActual();
    $this->usuario = UsuarioPeer::retrieveByPk($usuario_actual->getPrimaryKey());
    $this->forward404Unless($this->usuario);
  }

  /**
  * Edita los datos actualizables del usuario actual.
  * @version 15-04-09
  */
  public function executeEdit()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    $this->usuario = UsuarioPeer::retrieveByPk($usuario_actual->getPrimaryKey());
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateUsuarioFromRequest();
      $this->saveUsuario($this->usuario);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      if ($this->getRequestParameter('save_and_show'))
      {
        return $this->redirect('preferencias/show');
      }
      else
      {
        return $this->redirect('preferencias/edit');
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  /**
  * Guarda los datos editados del usuario actual
  * @version 15-04-09
  */
  public function executeSave()
  {
    return $this->forward('preferencias', 'edit');
  }

  protected function saveUsuario($usuario)
  {
    $usuario->save();
         
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
    if (isset($usuario['provincia']))
    {
      $this->usuario->setProvincia($usuario['provincia']);
    }
    if (isset($usuario['pais']))
    {
      $this->usuario->setPais($usuario['pais']);
    }
    if (isset($usuario['movil']))
    {
      $this->usuario->setMovil($usuario['movil']);
    }
      
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
      'usuario{dni}' => 'DNI/CIF:',
      'usuario{domicilio}' => 'Domicilio:',
      'usuario{poblacion}' => 'Poblacion:',
      'usuario{cp}' => 'Cp:',
      'usuario{provincia}' => 'Provincia:',
      'usuario{pais}' => 'País:',
      'usuario{movil}' => 'Móvil:',
      'usuario{alerta_email}' => 'Alerta email:',
    );
  }
}
