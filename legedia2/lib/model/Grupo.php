<?php

/**
 * Subclass for representing a row from the 'grupo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Grupo extends BaseGrupo
{
  public function __toString()
  {
    return $this->getNombre();
  }
  //desde MIXER:
  
  protected $mi_padre=null;
	protected $permisos=array();
	
	public function getMiPadre()
	{
		return $this->mi_padre;
	}
	
	/**
	* O
	* 
	*/
	public function setMiPadre($padre)
	{
		$this->mi_padre=$padre;
	}
	
	/**
	* Cargamos otros datos del grupo como los padres y los permisos
	* 
	*/
	public function cargarOtrosDatos()
	{
		if ($this->getPadre()!=0)
		{
			$grupo_padre=GrupoPeer::retrieveByPk($this->getPadre());
			$grupo_padre->cargarOtrosDatos();
			
			$this->setMiPadre($grupo_padre);
		}
		
		$this->cargarPermisos();
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Carga todos los permisos
	* 
	*/
	public function cargarPermisos()
	{
		$this->permisos=$this->getGrupoModulos();
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Borra todos los permisos del grupo
	* 
	*/
	public function vaciarPermisos(){
		$con = Propel::getConnection();
		$query = "DELETE  FROM %s WHERE %s = '".$this->getIdGrupo()."'";

		$query = sprintf($query,
		 GrupoModuloPeer::TABLE_NAME,
		 GrupoModuloPeer::ID_GRUPO
		);
  		
		$stmt = $con->prepare($query);
		$stmt->execute();
		
		$this->permisos=array();
	}
	
	public function moverHijosYUsuarios(){
	   //Moviendo Hijos
		$con = Propel::getConnection();
		$query = "UPDATE %s  set %s = '".$this->getPadre()."' WHERE %s = '".$this->getIdGrupo()."' ";

		$query = sprintf($query,
		 GrupoPeer::TABLE_NAME,
		 GrupoPeer::PADRE,
		 GrupoPeer::PADRE
		);
  		
		$stmt = $con->prepare($query);
		$stmt->execute(); 
	   
	   //Moviendo Usuarios
		$con = Propel::getConnection();
		$query = "UPDATE %s set %s = '".$this->getPadre()."' WHERE %s = '".$this->getIdGrupo()."'";

		$query = sprintf($query,
		 UsuarioGrupoPeer::TABLE_NAME,
		 UsuarioGrupoPeer::ID_GRUPO,
		 UsuarioGrupoPeer::ID_GRUPO
		);
  		
		$stmt = $con->prepare($query);
		$stmt->execute();
  }
  
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Dado un modulo/accion lo añade al array
	* 
	*/
	protected function _anadirPermiso($permiso,$comprobar){
		if ($comprobar){
			if ($this->_estaPermiso($permiso->getModulo(),$permiso->getAccion())) return false;
		}
			
		if (!empty($permiso)) {
			$this->permisos[]=$permiso;
			return true;
		}

		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Borra un modulo/accion del array
	* 
	*/
	protected function _borrarPermiso($modulo,$accion){
		for ($i=0;$i<sizeof($this->permisos);$i++){
			if (($this->permisos[$i]->getModulo()==$modulo) && ($this->permisos[$i]->getAccion()==$accion))
			{
				unset($this->permisos[$i]);
				return true;
			}
		}
		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Devuelve si un modulo/accion esta en el array de los permisos del grupo
	* 
	*/
	protected function _estaPermiso($modulo,$accion){
		for ($i=0;$i<sizeof($this->permisos);$i++){
			if ((strtolower($this->permisos[$i]->getModulo()) == strtolower($modulo)) && (strtolower($this->permisos[$i]->getAccion()) == strtolower($accion)))
				return true;
		}
		return false;
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Devuelve un modulo/accion
	* 
	*/
	protected function _devolverPermiso($modulo,$accion){
		for ($i=0;$i<sizeof($this->permisos);$i++){
			if (($this->permisos[$i]->getModulo()==$modulo) && ($this->permisos[$i]->getAccion()==$accion))
				return $this->permisos[$i];

		}
		return null;
	}
	
	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Guarda un modulo/accion en el array de permisos del grupo y los guarda en la BD
	* 
	*/
	public function anadirPermiso($modulo,$accion,$cargarArray=true)
	{
			if (!$this->_estaPermiso($modulo,$accion)){
				$mi_permiso=new GrupoModulo();
				$mi_permiso->setModulo($modulo);
				$mi_permiso->setAccion($accion);
				$mi_permiso->setGrupo($this);
				$mi_permiso->setPermiso(TRUE);
				
				$mi_permiso->save();
				
				if ($cargarArray) $this->_anadirPermiso($mi_permiso,false);
			}
	}

	/**
	* Operaciones de carga y busqueda de los permisos de los que dispone el grupo
	* Borra un modulo/accion de permisos del grupo y lo borra tambien de la BD
	* 
	*/
	public function borrarPermiso($modulo,$accion,$borrarArray=true)
	{
		if ($this->_estaPermiso($modulo,$accion))
		{
			if ($borrarArray) $this->_borrarPermiso($modulo,$accion);
			$this->_devolverPermiso($modulo,$accion)->delete();
		}
	}
	
	/**
	* Devuelve si el grupo tiene permiso para el modulo y acción
	*
	*/
	public function tienePermiso($modulo,$accion)
	{
		if ($this->_estaPermiso($modulo,$accion)) return true;
		elseif ($this->getMiPadre()!=null) return $this->getMiPadre()->tienePermiso($modulo,$accion);
		else return false;
	}
	
	/**
	* Devuelve si el grupo tiene permiso para el modulo y acció. Si devuelve 0 no tiene permisos. Si es 1 es permios directo. Si es 2 es permiso heredado
	*
	*/
	public function tienePermisoNivel($modulo,$accion,$inicial=false)
	{
		if ($this->_estaPermiso($modulo,$accion)) {if ($inicial) return 2; else return 1;}
		elseif ($this->getMiPadre()!=null) {
			if ($this->getMiPadre()->tienePermiso($modulo,$accion)) return 2; 
		}
		
		return 0;
	}
	
	//rober. ¿Se utiliza esto?
	/*
	public function deQueTipo($tipo=0){
	//0: admin, 1: empleado, 2: cliente
	
	  if ($tipo==1) $grupoTipo=sfConfig::get('app_general_grupoEmpleados');
	  elseif ($tipo==2) $grupoTipo=sfConfig::get('app_general_grupoClientes');
	  else $grupoTipo=sfConfig::get('app_general_grupoAdministradores');
	  
    if ($this->getIdGrupo()==$grupoTipo) return true;
		elseif ($this->getMiPadre()!=null) {
			return $this->getMiPadre()->deQueTipo($tipo); 
		}
		else return false;
  }
  */
  	
	/**
	* Devuelve todos los permisos de la aplicacion en un array
	*
	*/
	public function obtenerTodosPermisos($inicial=false)
	{
		$todos_permisos=array();
    $directorio=SF_ROOT_DIR."/apps/".SF_APP."/modules/";
    if ($dir = opendir($directorio)) 
    {
      while ($file = readdir($dir)) 
      {
        if ((substr($file,0,1) != ".") && (is_dir($directorio.$file)))
        {//Directorio de modulo
          $modulo=strtolower($file);
          $todos_permisos[$modulo]=array();
    		  if ($dir_modulo = opendir($directorio.$file."/actions/")) 
    		  {
    			  while ($action_file = readdir($dir_modulo)) 
    			  {
    				  $posicion = strpos($action_file, "Action.class.php");
    				  if ($action_file=="actions.class.php")
    				  {//Es el fichero actions.class.php. Cogemos los metodos
    				  	include_once($directorio.$file."/actions/".$action_file);
    				  	$class_methods=get_class_methods($modulo."Actions");
    				  	foreach ($class_methods as $method_name) 
    				  	{//funciones del objeto. Miramos las que empiecen por execute
    				  		if (substr($method_name,0,7)=="execute")
    				  		{
    				  			$accion=strtolower(substr($method_name,7));
    				  			if (trim($accion)!=""){
    				  				$todos_permisos[$modulo][$accion]=$this->tienePermisoNivel($modulo,$accion,$inicial);
    				  			}
    				  		}
    				  	}
    				  }
    				  elseif (!($posicion === false))
    				  {//Es un fichero con una sola accion
    				  	$accion=strtolower(substr($action_file,0,$posicion));
    				  	if (trim($accion)!=""){
    				  		$todos_permisos[$modulo][$accion]=$this->tienePermisoNivel($modulo,$accion,$inicial);
    				  	}
    				  }
    			  }
    			  closedir($dir_modulo);
    		  }
		    }
	    }
		  closedir($dir);
		}
		ksort ($todos_permisos);
		return $todos_permisos;
	}
	
	/**
	* Devuelve un array ordenado del arbol de grupos
	*
	*/
	static public function arbolGrupos($conraiz=true,$padre=0,$nivel=0)
	{
		$con = Propel::getConnection();
		$query = "SELECT %s as Nombre, %s as IdGrupo FROM %s WHERE %s = ".$padre." ORDER BY %s";

		$query = sprintf($query,
		 GrupoPeer::NOMBRE,
		 GrupoPeer::ID_GRUPO,
		 GrupoPeer::TABLE_NAME,
		 GrupoPeer::PADRE,
		 GrupoPeer::ID_GRUPO
		);
		$stmt = $con->prepare($query);		
		$stmt->execute();
		
		$mishijos=array();
		
		$espaciado="";
		if ($conraiz) $inicial=0; else $inicial=1;
		for ($i=$inicial;$i<$nivel;$i++) $espaciado.="--";
		
		while($row = $stmt->fetch())
		//while ($rs->next())
		{
			  if (($padre!=0)||($padre==0 && $conraiz)) {$mishijos[$row['IdGrupo']]=$espaciado." ".$row['Nombre'];}
				$mishijos_temp=self::arbolGrupos($conraiz,$row['IdGrupo'],$nivel+1);
				//array merge casero porque el normal me falla
				foreach ($mishijos_temp as $key=>$value) $mishijos[$key]=$value;
		}
		return $mishijos;
  }
  
  public function obtenerHijos(){
		$con = Propel::getConnection();
		$query = "SELECT %s as IdGrupo FROM %s WHERE %s = ".$this->getIdGrupo()." ORDER BY %s";

		$query = sprintf($query,
		 GrupoPeer::ID_GRUPO,
		 GrupoPeer::TABLE_NAME,
		 GrupoPeer::PADRE,
		 GrupoPeer::ID_GRUPO
		);
		$stmt = $con->prepare($query);
		$stmt->execute();
		
		$mishijos=array();
		
		while($row = $stmt->fetch()) 
		//while ($rs->next())
		{
		  $mishijos[]=$row['IdGrupo'];
			$hijo_temp=GrupoPeer::retrieveByPk($row['IdGrupo']);
			$mishijos_temp=$hijo_temp->obtenerHijos();
			//array merge casero porque el normal me falla
			foreach ($mishijos_temp as $value) $mishijos[]=$value;
		}
		return $mishijos;
  }
  
  /**
  * Function que devuelve true en caso de que el grupo sea Borrable o false en otro caso.
  * @return true si el grupo es borrable, false en otro caso.
  * @version 28-01-09
  * @author Ana Martín
  */  
  public function getIsBorrable() {  
    return !(in_array($this->getPrimaryKey(), GrupoPeer::getAllGruposNoBorrables()));  
  }
  
  /**
  * Functión que devuelve true si el grupo es administrador, false en otro caso.
  * @return boolean
  * @version 13-02-09
  * @author Ana Martín.
  */
  public function getEsGrupoAdministrador() {
    return ($this->getIdGrupo() == GrupoPeer::getIdGrupoAdministradores());  
  }

  /**
  * Functión que devuelve true si el grupo es telemarketing, false en otro caso.
  * @return boolean
  * @version 02-04-09
  * @author Ana Martín.
  */
  public function getEsGrupoTelemarketing() {
    return ($this->getIdGrupo() == GrupoPeer::getIdGrupoTelemarketing());  
  }

  /**
  * Functión que devuelve true si el grupo es delegados, false en otro caso.
  * @return boolean
  * @version 06-04-09
  * @author Ana Martín.
  */
  public function getEsGrupoDelegados() {
    return ($this->getIdGrupo() == GrupoPeer::getIdGrupoDelegados());  
  }
}
