<?php

/**
 * login actions.
 *
 * @package    legedia
 * @subpackage login
 * @author     Ana Martín
 * @version    10-02-09
 */
class loginActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  
    $this->sinPermisos = $this->getUser()->getAttribute('sinPermisos', false, 'fallos');
    $this->modulo = $this->getUser()->getAttribute('modulo', 'panel', 'fallos');
    $this->accion = $this->getUser()->getAttribute('accion', 'index', 'fallos');
    $this->getUser()->getAttributeHolder()->removeNamespace('fallos');
    

    
    return sfView::SUCCESS;
  }
  
  
  /**
   * Executes login action
   *
   */
  public function executeLogin()
  { 
    $usuario = new Usuario();
    
    $this->modulo   = $this->getRequestParameter('modulo');
    $this->accion   = $this->getRequestParameter('accion','index');
    $this->nusuario = $this->getRequestParameter('usuario','');
    
    $login = $this->getRequestParameter('login');
    $username = isset($login['username']) ? $login['username'] : '';
    $password = isset($login['password']) ? $login['password'] : '';
    $usuario = $usuario->validateLogin($username , $password);
    if (!$usuario){
      return sfView::ERROR;
    }
    
    $this->getUser()->setAttribute('usuario', $usuario, 'usuarios');
    $this->getUser()->setAuthenticated(true);   

    if ($this->getRequestParameter('error')) {
      $error = "Usted no tiene permisos ";
      if ($this->getRequestParameter('modulo') or $this->getRequestParameter('accion')) {
             $error .= " para ".$this->getRequestParameter('modulo')." ".$this->getRequestParameter('accion');
      }    
      $this->getUser()->setFlash('notice_error', $error); 
    }

    //EJECUTO DE NUEVO LOS FILTROS
    $alcance = new alcanceFilter(sfContext::getInstance());
    $alcance->execute(null);
    
    //OBTENGO TODAS LAS EMPRESAS => CON EL FILTRO DEL NUEVO USUARIO.
    $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',false);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',true);  
    $lista_empresas=Empresa::getListaEmpresas();
	   //CARGAMOS LA EMPRESA 
	  $id_empresa=sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
	  if ($id_empresa == null || $id_empresa == "" || $id_empresa == 0){
	     if (sizeof($lista_empresas) > 0){
	      foreach($lista_empresas as $id_empresa=>$empr){
          break;
        }
       }else {
	       $id_empresa=sfConfig::get("app_general_idempresa",null);
	     }
	  }
	   
	  sfContext::getInstance()->getUser()->setAttribute('idempresa',$id_empresa);
    sfContext::getInstance()->getUser()->setAttribute('lista_empresas',$lista_empresas);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',$todas_empresas);
    
    if ($this->modulo != "") $this->redirect($this->modulo."/".$this->accion); 
    else $this->redirect('panel/index');
  }

    public function executeLoginDni()
  {
    $usuario = new Usuario();

    $this->modulo   = $this->getRequestParameter('modulo');
    $this->accion   = $this->getRequestParameter('accion','index');
    $this->nusuario = $this->getRequestParameter('usuario','');

    $dni = UsuarioPeer::getDniFromCard();
    $usuario = $usuario->validateDni($dni);
    if (!$usuario /*|| !UsuarioPeer::OCSPCheck()*/){
      return sfView::ERROR;
    }

    if (isset($_SERVER['SSL_CLIENT_CERT'])){
        $usuario->setPublicKey($_SERVER['SSL_CLIENT_CERT']);
        $usuario->save();
    }
    
    $this->getUser()->setAttribute('usuario', $usuario, 'usuarios');
    $this->getUser()->setAuthenticated(true);

    if ($this->getRequestParameter('error')) {
      $error = "Usted no tiene permisos ";
      if ($this->getRequestParameter('modulo') or $this->getRequestParameter('accion')) {
             $error .= " para ".$this->getRequestParameter('modulo')." ".$this->getRequestParameter('accion');
      }
      $this->getUser()->setFlash('notice_error', $error);
    }

    //EJECUTO DE NUEVO LOS FILTROS
    $alcance = new alcanceFilter(sfContext::getInstance());
    $alcance->execute(null);

    //OBTENGO TODAS LAS EMPRESAS => CON EL FILTRO DEL NUEVO USUARIO.
    $todas_empresas = sfContext::getInstance()->getUser()->getAttribute('todas_empresas',false);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',true);
    $lista_empresas=Empresa::getListaEmpresas();
	   //CARGAMOS LA EMPRESA
	  $id_empresa=sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
	  if ($id_empresa == null || $id_empresa == "" || $id_empresa == 0){
	     if (sizeof($lista_empresas) > 0){
	      foreach($lista_empresas as $id_empresa=>$empr){
          break;
        }
       }else {
	       $id_empresa=sfConfig::get("app_general_idempresa",null);
	     }
	  }

    sfContext::getInstance()->getUser()->setAttribute('idempresa',$id_empresa);
    sfContext::getInstance()->getUser()->setAttribute('lista_empresas',$lista_empresas);
    sfContext::getInstance()->getUser()->setAttribute('todas_empresas',$todas_empresas);

    if ($this->modulo != "") $this->redirect($this->modulo."/".$this->accion);
    else $this->redirect('panel/index');

    //if ($this->modulo != "") {
    //    header("location: ".str_replace("https","http://",UsuarioPeer::getRuta())."/".$this->modulo."/".$this->accion);
    //}
    //else header("location: ".str_replace("https","http://",UsuarioPeer::getRuta())."/panel/index");

    //exit();
  }
  
  /**
   * Executes logout action
   *
   */
  public function executeLogout()
  {
       
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->clearCredentials();

    //COGEMOS ID_EMPRESA PARA LIMPIAR TODAS Y LUEGO VOLVER A ESCRIBIRLA
    $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',0);
    $this->getUser()->getAttributeHolder()->clear();
    sfContext::getInstance()->getUser()->setAttribute('idempresa',$id_empresa);
    //$this->getUser()->getAttributeHolder()->removeNamespace('fallos');
    //$this->getUser()->getAttributeHolder()->removeNamespace('usuarios');
    //$this->getUser()->getAttributeHolder()->removeNamespace('alcance');
    //$this->getUser()->removeAttribute('todas_empresas');
    //$this->getUser()->removeAttribute('lista_empresas');
  
    $this->getUser()->setFlash('logout', 'Ha salido correctamente del sistema');    

    $this->redirect('login/index');
  }
  
}
