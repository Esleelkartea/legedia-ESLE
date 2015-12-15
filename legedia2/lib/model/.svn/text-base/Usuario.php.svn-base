<?php

/**
 * Subclass for representing a row from the 'usuario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Usuario extends BaseUsuario
{

  protected $claveLimpia = "";
  protected $sesion = null;
  protected $grupos = array();
  
  protected $empresa_sesion = null;
  protected $empresas_sesion = array();
  
  public function __toString(){
    if (trim($this->getNombre()." ".$this->getApellido1()) == "")
      return $this->getUsuario();
    else return trim($this->getNombre()." ".$this->getApellido1());
  }
  
  public function getGrupos()
  {
    $c = new Criteria();
    $c->addJoin(GrupoPeer::ID_GRUPO , UsuarioGrupoPeer::ID_GRUPO);
    $c->add(UsuarioGrupoPeer::ID_USUARIO, $this->getPrimaryKey());
    $grupos = GrupoPeer::doSelect($c);
    return $grupos;
  }
  
  
  
  public function delete(PropelPDO $con = null, $definitivo = false){
    if ($definitivo) parent::delete();
    else 
  	{
  		$this->setFechaBorrado(date('Y-m-d H:i:s'));
  		$this->save();
  	}
  }
  
  public function getNombreCompleto(){
    $apellido1 = $this->getApellido1() ? $this->getApellido1() : "";
    $apellido2 = $this->getApellido2() ? $this->getApellido2() : "";
    $nombre = $this->getNombre() ? $this->getNombre() : "";
    
    $value = $apellido1;
    if ($apellido2 != ""){
      $value .= ($value != "") ? " ".$apellido2 : $apellido2;
    }
    if ($nombre != ""){
      $value .= ($value != "") ? ", ".$nombre : $nombre;
    }
    if ($value == ""){$value = $this->getUsuario();}
    return $value;
  }
  
  //########## Permisos ####################
  //no se utiliza, ya que esta misma operacion se realiza en el filtro permisosFilter
  public static function usuarioActualPermisos($accionObj, $modulo, $accion, $esAjax, $metodo){
  	 $usuario_actual=sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');
  	 if ($usuario_actual==null){
	     $usuario_actual=UsuarioPeer::retrieveByPk(1);
	     $usuario_actual->cargarOtrosDatos();
	     //$usuario_actual->registrarVisita();//rober
	     sfContext::getInstance()->getUser()->setAttribute('usuario',$usuario_actual,'usuarios');
  	 }
	
  	 //$usuario_actual->guardarVisita();//rober
  	 if (!$usuario_actual->tienePermiso($modulo,$accion)){	
  	 	sfContext::getInstance()->getUser()->setAttribute('sinPermisos',true,'fallos');
  	 	sfContext::getInstance()->getUser()->setAttribute('modulo',$modulo,'fallos');
  	 	sfContext::getInstance()->getUser()->setAttribute('accion',$accion,'fallos');
  	 	$accionObj->forward("login","index");
  	 }
  }
  
  public static function tienePermisos($modulo,$accion){
       
  	 $usuario_actual=sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');
         
  	 if ($usuario_actual==null) return false;         
  	 else return $usuario_actual->tienePermiso($modulo,$accion);
  }
  
  /**
	* Devuelve si el usuario tiene permiso para el modulo y acción
	*
	*/
	public function tienePermiso($modulo,$accion)
	{
            if (sizeof($this->grupos) == 0) {
                die("EL USUARIO NO TIENE ASIGNADO <strong>NINGUN GRUPO</strong>.<br />Pongase en contacto con el administrador del sistema para solucionar este problema.");
            }

            for ($i=0;$i<sizeof($this->grupos);$i++){
                if ($this->grupos[$i]->tienePermiso($modulo,$accion)) return true;
            }

            return false;
	}
	
	
	/**
	* Comprueba que el usuario y el password coinciden con los de la BD y si es asi, carga los datos
	*
	*/
	public function validateLogin($username,$password)
	{
		$con = Propel::getConnection();
		$query = "SELECT %s as id_usuario, %s as clave FROM %s WHERE %s = '".$username."' AND (%s IS null OR %s  != '0000-00-00 00:00:00')";

		$query = sprintf($query,
		 UsuarioPeer::ID_USUARIO,
		 UsuarioPeer::CLAVE,
		 UsuarioPeer::TABLE_NAME,
		 UsuarioPeer::USUARIO,
		 UsuarioPeer::FECHA_BORRADO,
		 UsuarioPeer::FECHA_BORRADO
		);
  		
		$stmt = $con->prepare($query);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{
			$claveUsuario=$this->limpiarClave($row['clave']);
		
			if ($claveUsuario==$password){
			 
				$usuario = UsuarioPeer::retrieveByPk($row['id_usuario']);

				$usuario->cargarOtrosDatos();
				 
				$usuario->registrarVisita();
				
				return $usuario;
			}
		}
		return null;
	}

	public function validateDni($dni)
	{
		$con = Propel::getConnection();
		$query = "SELECT %s as id_usuario, %s as clave FROM %s WHERE %s = '".$dni."' AND (%s IS null OR %s  != '0000-00-00 00:00:00')";

		$query = sprintf($query,
		 UsuarioPeer::ID_USUARIO,
		 UsuarioPeer::CLAVE,
		 UsuarioPeer::TABLE_NAME,
		 UsuarioPeer::DNI,
		 UsuarioPeer::FECHA_BORRADO,
		 UsuarioPeer::FECHA_BORRADO
		);

		$stmt = $con->prepare($query);
		$stmt->execute();
		if ($row = $stmt->fetch())
		{

                    $usuario = UsuarioPeer::retrieveByPk($row['id_usuario']);

		    $usuario->cargarOtrosDatos();

                    $usuario->registrarVisita();

                    return $usuario;
		}
		return null;
	}

	 /**
   * Cargamos otros datos del usuario que no son de la BD como la clave limpia y los grupos
   *
   */
	public function cargarOtrosDatos($cargar_idioma=true)
	{
		//Cargamos los grupos del usuario
		$this->cargarGrupos();
		//$this->limpiarClave();//rober
		
		$idioma = $this->getCatalogue();
		if ($idioma) {
		  if ($cargar_idioma) sfContext::getInstance()->getUser()->setCulture($idioma->getTargetLang());
		}
		else sfContext::getInstance()->getUser()->setCulture(UsuarioPeer::IDIOMA_DEFAULT);
	}
	
	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Carga todos los grupos
	* 
	*/
	public function cargarGrupos(){
		$gruposUsuarios=$this->getUsuarioGrupos();
		$this->grupos=array();
		
		for ($i=0;$i<sizeof($gruposUsuarios);$i++)
		{
		  $this->_anadirGrupo($gruposUsuarios[$i]->getIdGrupo(),false);
		}
	}
  
  
   /**
   * Pasa de la clave cifrada a una clave de texto plano
   *
   */
	public function limpiarClave($clave='')
	{
		$crypt=new Crypter(sfConfig::get('app_general_cifrado_usuario'));
		if ($clave!=""){
			$otra_clave=$crypt->decrypt($clave);
		}
		else {
			$otra_clave=$crypt->decrypt($this->getClave());
			$this->setClavelimpia($otra_clave);
		}
		return $otra_clave;
	}
  
   /**
   * Pasa de la clave de texto plano a una clave cifrada para guardar en la BD
   *
   */
	public function ensuciarClave($clave = '')
	{
		$crypt=new Crypter(sfConfig::get('app_general_cifrado_usuario'));
		if ($clave!=""){
			$this->setClavelimpia($clave);
			$otra_clave=$crypt->encrypt($clave);
			$this->setClave($otra_clave);
		}
		else {
			$otra_clave=$crypt->encrypt($this->getClavelimpia());
			$this->setClave($otra_clave);
		}
      
		return $otra_clave;
	}
  
  /**
   * Devuelve la clave en texto plano
   *
   */
  public function getClavelimpia(){
    return $this->claveLimpia;
  }

  /**
   * Asigna la clave en texto plano
   *
   */
  public function setClavelimpia($clave){
    $this->claveLimpia=$clave;
	}
	
	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Dado un grupo lo añade al array
	* 
	*/
	protected function _anadirGrupo($id_grupo,$comprobar){
		if ($comprobar){
			if ($this->_estaGrupo($id_grupo)) return false;
		}

		$grupo=GrupoPeer::retrieveByPk($id_grupo);
		$grupo->cargarOtrosDatos();
		
		if (!empty($grupo)) {
			$this->grupos[]=$grupo;
			return true;
		}
		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Borra un grupo del array
	* 
	*/
	protected function _borrarGrupo($id_grupo){
		for ($i=0;$i<sizeof($this->grupos);$i++){
			if ($this->grupos[$i]->getIdGrupo()==$id_grupo)
			{
				unset($this->grupos[$i]);
				return true;
			}
		}
		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Devuelve si un grupo esta en el array de los grupos del usuario
	* 
	*/
	protected function _estaGrupo($id_grupo){
		for ($i=0;$i<sizeof($this->grupos);$i++){
			if ($this->grupos[$i]->getIdGrupo()==$id_grupo) return true;
		}
		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Guarda un grupo o un array de grupos en el array de grupos del usuario y los guarda en la BD
	* 
	*/
	public function anadirGrupo($grupo_s,$cargarArrayGrupo=true)
	{
		if (!is_array($grupo_s)) $mis_grupos=array($grupo_s);
		else $mis_grupos=$grupo_s;
		
		for ($i=0;$i<sizeof($mis_grupos);$i++)
		{
			if (!$this->_estaGrupo($mis_grupos[$i])){
				if ($cargarArrayGrupo) $this->_anadirGrupo($mis_grupos[$i],false);
				
				$migrupoUsuario=new UsuarioGrupo();
				$migrupoUsuario->setIdGrupo($mis_grupos[$i]);
				$migrupoUsuario->setUsuario($this);
				
				$migrupoUsuario->save();
			}
		}
	}

	/**
	* Operaciones de carga y busqueda de los grupos a los que pertenece el usuario
	* Borra un grupo o un array de grupos del array de grupos del usuario y lo borra tambien de la BD
	* 
	*/
	public function borrarGrupo($grupo_s,$borrarArrayGrupo=true)
	{
		if (!is_array($grupo_s)) $mis_grupos=array($grupo_s);
		else $mis_grupos=$grupo_s;
		
		for ($i=0;$i<sizeof($mis_grupos);$i++)
		{
			if ($this->_estaGrupo($mis_grupos[$i])){
				if ($borrarArrayGrupo) $this->_borrarGrupo($mis_grupos[$i]);
				
				$migrupoUsuario=UsuarioGrupoPeer::RetrieveByPk($this->getIdUsuario(),$mis_grupos[$i]);
				$migrupoUsuario->delete();
			}
		}
	}
	
	public static function getUsuarioActual()
	{
          //Ana: 14-04-09 Atención!! Puede ser que alguno de los atributos del usuario actual, se hayan modificado, por lo tanto, lo que hago es recargarlo.
    $usuario_viejo = sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');          
	  return UsuarioPeer::retrievebypk($usuario_viejo->getPrimaryKey()); 
	}
	
	
	
	//Crear objeto "sesion" y descomentar el codigo de abajo.
	function registrarVisita()
	{
		//Guardamos en la tabla usuarios que ha sido la ultima 
		$this->setUltimaVisita(Date::format(FMT_DATETIMEMYSQL));
		$this->save();

		//Guardamos la sesion actual
		$sesion = new Sesion();
		$sesion->setUsuario($this); 
		$sesion->save();
		
		$this->sesion=$sesion;
	}
	
	public function guardarVisita($mensaje='')
	{
		$this->sesion->guardarVisita($mensaje);
	}
	
	public function getUsuariosAccesibles()
	{
	  $c_usuarios = UsuarioPeer::getCriteriaUsuariosAccesibles();
	  $usuarios = UsuarioPeer::doSelect($c_usuarios);
	  return $usuarios;
	}
	
	
	
	
	
	
	public function getEmpresaSesion()
	{
	  $empresa = null;
	  if (!sfContext::getInstance()->getUser()->isAuthenticated())
	  {
	    $this->setEmpresaSesionNull();

	  
	  }
	  else
	  {
	    $empresa = sfContext::getInstance()->getUser()->getAttribute('empresa_sesion' , null , 'sesion');
	 
	    if (!isset($empresa))
	    {
	      $empresas = EmpresaPeer::doSelect(EmpresaPeer::getCriterioAlcance());
	      $empresa = isset($empresas[0]) ? $empresas[0] : null;
	      sfContext::getInstance()->getUser()->setAttribute('empresa_sesion' , $empresa , 'sesion');
	      sfContext::getInstance()->getUser()->setAttribute('empresas_sesion' , $empresas , 'sesion');
	   
	    }
	  }
	  return $empresa;
	}
	
	public function getListaEmpresasSesion()
	{
	  
	  $lista = sfContext::getInstance()->getUser()->getAttribute('empresas_sesion' , array() , 'sesion');

	  return $lista;
	}
	
	public function isMultiplesEmpresasSesion()
	{
	  $empresas = sfContext::getInstance()->getUser()->getAttribute('empresas_sesion' , array() , 'sesion');
	  $cuantas = sizeof($empresas);
	  
	  return $cuantas > 1;
	}
	
	public function setEmpresaSesionNull()
	{
	  sfContext::getInstance()->getUser()->setAttribute('empresa_sesion' , null , 'sesion');
	  sfContext::getInstance()->getUser()->setAttribute('empresas_sesion' , array() , 'sesion');

	}
	
	public function setEmpresaSesion($empresa = null)
	{
	  if (!$empresa || (!sfContext::getInstance()->getUser()->isAuthenticated()) )
	  {
	    $this->setEmpresaSesionNull();
	    return false;
	  }
	  
	  $c = clone EmpresaPeer::getCriterioAlcance();
	  $empresas = EmpresaPeer::doSelect($c);
	  
	  $comprobacion = true;
	 
	  $resultado = false;
	  
	  if ($comprobacion)
	  {
	    sfContext::getInstance()->getUser()->setAttribute('empresa_sesion' , $empresa , 'sesion');
	    sfContext::getInstance()->getUser()->setAttribute('empresas_sesion' , $empresas , 'sesion');
	    
	  
	    $resultado = true;
	  }
	  else
	  {
	    $this->setEmpresaSesionNull();
	  }
	  return $resultado;
	}
	
	
	

	/**
	* Guarda en un fichero el mensaje que reciba
	*
	*/
	public static function logAjax($fichero,$clase,$function,$mensaje)
	{
		$usuario_actual=sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');
  	if ($usuario_actual) $fp=fopen(SF_ROOT_DIR."/log/logAjax".$usuario_actual->getUsuario().".log","a");
	 	else $fp=fopen(SF_ROOT_DIR."/log/logAjax.log","a");
		fwrite($fp,"[".Date::format(FMT_DATETIMEMYSQL)."]::".basename($fichero)."::".$clase."::".$function."\n".$mensaje."\n");
		fclose($fp);	
	}
	
	  /**
  * Function que devuelve true en caso de que el USUARIO sea Borrable o false en otro caso.
  * @return boolean, true si el usuario es borrable, false en otro caso.
  * @version 28-01-09
  * @author Ana Martín
  */  
  public function getIsBorrable() {  
    return !(in_array($this->getPrimaryKey(), UsuarioPeer::getAllUsuariosNoBorrables()));  
  }

  
  /**
  * Función que devuelve true si el usuario es 'admin' o pertenece al grupo de administradores.
  * @return boolean, true si 'admin' o si pertenece al grupo de administradores.
  * @version 13-02-09
  * @author Ana Martín.
  */	
	public function getEsAdministrador() {
    	    
	  if ($this->getIdUsuario() == UsuarioPeer::getIdUsuarioAdministrador()) {
	      return true;
	  }  
	  else {
	      $grupos = $this->getGrupos(); 
			  foreach ($grupos as $grupo ) {
            if ($grupo->getEsGrupoAdministrador()) {
              return true;            
            }            		  
			  }
			  return false;
	  }
	}
	
	  /**
  * Función que devuelve true si el usuario es 'invitado' 
  * @return boolean, true si 'invitado' 
  * @version 13-02-09
  * @author Ana Martín.
  */	
	public function getEsInvitado() {
    	    
	  if ($this->getIdUsuario() == UsuarioPeer::getIdUsuarioInvitado()) {
	      return true;
	  }  
	  else {	     
			  return false;
	  }
	}
	
	/**
	* Función que devuelve la lista de usuarios del mismo grupo que el usuario actual. Se incluye el usuario actual en la lista.
	* 1. No tiene en cuenta los grupos (administradores, invitados, delegados o telemarketing)
	* @return array, lista de objetos de tipo usuario
	* @version 17-02-09
	**/
	public function getAllUsuariosMismoGrupo() {
	
    $lista_grupos = $this->getGrupos();
    $lista_usuarios = array();
    foreach ($lista_grupos  as $grupo) {
      $id_grupo = $grupo ->getIdGrupo();
      if (($id_grupo != GrupoPeer::getIdGrupoAdministradores()) and ($id_grupo != GrupoPeer::getIdGrupoInvitados()) and
          ($id_grupo != GrupoPeer::getIdGrupoTelemarketing()) and  ($id_grupo != GrupoPeer::getIdGrupoDelegados())
         ) 
      {
          $lista = $grupo->getUsuarioGrupos();
          foreach ($lista as $usuario_grupo) { 
            $usuario = UsuarioPeer::retrievebypk($usuario_grupo ->getIdUsuario());
            if ($usuario) {         
              $lista_usuarios[] = $usuario; 
            }     
          }  
      }
          
          
    }	
	  return $lista_usuarios;
	}


/**
  * Función que devuelve true si el usuario es 'telemarketing' o pertenece al grupo de telemarketing.
  * @return boolean, true si 'telemarketing' o si pertenece al grupo de telemarketing.
  * @version 02-04-09
  * @author Ana Martín.
  */    
  public function getEsTelemarketing() {
            
    if ($this->getIdUsuario() == UsuarioPeer::getIdUsuarioTelemarketing()) {
      return true;
    }  
    else {
      $grupos = $this->getGrupos(); 
      foreach ($grupos as $grupo ) {
        if ($grupo->getEsGrupoTelemarketing()) {
              return true;            
        }                             
       }
       return false;
    }
  }

  /**
  * Función que devuelve true si el usuario  pertenece al grupo de delegados.
  * @return boolean, true si pertenece al grupo de delegados.
  * @version 06-04-09
  * @author Ana Martín.
  */    
  public function getEsDelegado() {
            
    $grupos = $this->getGrupos(); 
    
    foreach ($grupos as $grupo ) {
        if ($grupo->getEsGrupoDelegados()) {
              return true;            
        }                             
    }
    
    return false;
    
  }

  /**
  * Devuelve la dirección del usuario en formato:
  * C/Paseo Arriola n15
  * 20006 Donosti (Guipuzcoa)
  * @return string, string con la dirección en el formato arriba indicado
  * @version 06-04-09
  * @author Ana Martin
  */
  public function getDireccionFormato()
  {
    $resultado = "&nbsp;";
    $resultado .= $this->getDomicilio()."<br />";
    $resultado .= trim($this->getCP())." ";
    $resultado .= trim($this->getPoblacion())." ";
    $prov = $this->getProvincia();
    if ($prov)
    {
      $resultado .= "(".$prov.")";
    }

    return $resultado;
  }


  /**
  * Devuelve el idioma actual del usuario
  * @return string, nombre del idioma
  * @version 06-04-09
  * @author Ana Martín
  */
  public function getIdioma() {
      
    return $this->getCatalogue();

  }

}
