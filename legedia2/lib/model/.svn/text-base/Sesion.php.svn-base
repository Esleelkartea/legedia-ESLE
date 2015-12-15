<?php

/**
 * Subclass for representing a row from the 'sesion' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Sesion extends BaseSesion
{
public function getNombreUsuario () {
  
   $auxObj = UsuarioPeer::retrieveByPk($this->getIdUsuario());
    if ($auxObj instanceof Usuario)
      return $auxObj->getNombreCompleto();
    else return __('---');
  
  }


  /**
   * Añade una visita a la sesion actual
   *
   */
  public function guardarVisita($mensaje='')
  {
  	global $PHP_SELF;
  	
  	$visita=new SesionLog();
  	$visita->setMensaje($mensaje);
  	$visita->setFecha(Date::format(FMT_DATETIMEMYSQL));
  	$visita->setUrl($PHP_SELF);
  	$visita->setSesion($this);
  	$visita->autoCargarParams();

        if (isset($_SERVER['SSL_CLIENT_CERT'])){
            $visita->setPublicKey($_SERVER['SSL_CLIENT_CERT']);
        }
        
        $get_params = $visita->getParamsarray();
        if (strtolower($visita->getModulo()) == "usuarios" && strtolower($visita->getAccion()) == "delete"){
            $afirmar = $visita->getModulo()." - ".$visita->getAccion()." - ".$_REQUEST['id_usuario'];
            $visita->setFirma(UsuarioPeer::getFirma($afirmar));
        }elseif (strtolower($visita->getModulo()) == "usuarios" && strtolower($visita->getAccion()) == "edit" && isset($get_params['id_usuario']) && $get_params['id_usuario'] == ""){
            $afirmar = $visita->getModulo()." - ".$visita->getAccion()." - ".$_REQUEST['usuario']['nombre'];
            $visita->setFirma(UsuarioPeer::getFirma($afirmar));
        }

  	$visita->save();
  }
  
  /**
   * Calcula la IP actual en base a constantes predefinidas en PHP
   *
   */
  public function calcular_IP()
  { 
	if ((getenv( "REMOTE_ADDR" )) && (getenv( "REMOTE_ADDR" ) != "")){
		$this->setIp(getenv( "REMOTE_ADDR" ));
	}
	if ((getenv( "HTTP_X_FORWARDED_FOR" )) && (getenv( "HTTP_X_FORWARDED_FOR" ) != "")){
		$this->setIp(getenv( "HTTP_X_FORWARDED_FOR" ));
	}
	if (( getenv( "HTTP_CLIENT_IP" )) && ( getenv( "HTTP_CLIENT_IP" ) != "")){
		$this->setIp( getenv( "HTTP_CLIENT_IP" ));
	}
  }
  
  /**
   * Guarda la clase pero autoobteniendo la IP y la sesion
   *
   */
  public function save(PropelPDO $con = null)
  {
  	if ($this->getIp()=="") $this->calcular_IP();
  	if (session_id()=="") session_start();
  	if ($this->getSesion()=="") $this->setSesion(session_id());

	if ($this->getIdusuario()!=1) //El usuario invitado no quedar registrada la sesion
  		parent::save($con);
  }
  
  public function getPrimerSuceso(){
		$sucesos=$this->getSesionLogs();
		$lafecha=new Date();
		if ($sucesos) {
		$lafecha->fromDatetime($sucesos[0]->getFecha());
		return $lafecha->toString(FMT_DATETIMEESGSS);
		} 
		else return "--";
  }
  
  public function getUltimoSuceso(){
		$sucesos=$this->getSesionLogs();
		$lafecha=new Date();
		if ($sucesos) {
		$lafecha->fromDatetime($sucesos[sizeof($sucesos)-1]->getFecha());
		return $lafecha->toString(FMT_DATETIMEESGSS);
		}
		else return "--";
  }
}

