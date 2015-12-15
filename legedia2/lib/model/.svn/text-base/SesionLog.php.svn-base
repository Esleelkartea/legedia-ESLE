<?php

/**
 * Subclass for representing a row from the 'sesion_log' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SesionLog extends BaseSesionLog
{
protected $parametrosArray=array();
	
	
  /**
   * Devuelve el array de parametros
   *
   */
	public function getParamsarray()
	{
		return $this->parametrosArray;
	}
	
	
  /**
   * Ajusta el array de parametros
   *
   */
	public function setParamsarray($array)
	{
		$this->parametrosArray=$array;
	}
	
	public function verFecha()
	{
		$lafecha=new Date();
		$lafecha->fromDatetime($this->getFecha());
		return $lafecha->toString(FMT_DATETIMEESGSS);
	}
  
  /**
   * Busca el parametro dado en el array de parametros. Si se da un valor busca el parametro con ese nombre y/o ese valor
   * Si encuentra el parametro o el valor devuelve el array, si no, devuelve el array vacio.
   *
   */
    function estaParametro($param = '', $valor = '')
    {
		$arrayacoger = $this -> getParamsarray();
		while (list ($clave, $val) = each ($arrayacoger)) {
			if (($clave == $param) && ($valor == ''))
			{
				return array($clave => $val);
				break;
			}
			if (($param == '') && ($val == $valor))
			{
				return array($clave => $val);
				break;
			}
			elseif (($clave == $param) && ($val == $valor)) {
				return array($clave => $val);
				break;
			} 
		} 
        return array();
	}
	

  /**
   * Si el array de parametros esta vacio carga los datos de la cadena de parametros en dicha array
   *
   */  
    function cadena2array($param='')
	{
		if ($param=='') $param=$this->getParametros();
		
		$parametrosArray=array();
		
		$lista_parametros = explode("&", $param);
		for ($i = 0;$i < sizeof($lista_parametros);$i++) 
		{
			$partes = explode("=", $lista_parametros[$i]);
			if (sizeof($partes)==2)
				$parametrosArray[$partes[0]] = $partes[1];
		}
		$this->setParamsarray($parametrosArray);
	}
	
  /**
   * Si la cadena de parametros esta vacia carga los datos del array de parametros en dicha cadena
   *
   */
    function array2cadena($param=array())
	{
		if (sizeof($param)==0) {
			$param=$this->getParamsarray();
			
			$this->setModulo($param["module"]);
			$this->setAccion($param["action"]);
		}

		$quitar_parametros=array("module","action","modulo","accion","auto_complete","_","commit_x","commit_y");
		$parametros="";
		
		while (list ($clave, $val) = each ($param)) 
		{
			if (!in_array($clave, $quitar_parametros))
				$parametros .= $clave . "=" . $val . "&";
		} 
        $parametros = substr($parametros, 0, strlen($parametros)-1);
		$this->setParametros($parametros);
		
	}
	   
  /**
   * Coge los valores POST Y GET y crea la cadenade parametros a partir de este 
   *
   */    
	public function autoCargarParams()
	{
		$this->setParamsarray(sfContext::getInstance()->getRequest()->getParameterHolder()->getAll());
		$this->array2cadena();	
		
		$this->setUrl(getenv("PHP_SELF"));
	}
	
  /**
   * Si se la pasa que auto-cargue los parametros, lo hace. Si no, simplemente salva los datos
   *
   */
	public function save(PropelPDO $con = null, $auto_cargar_params=false)
	{
		if ($auto_cargar_params)
		{
			$this->autoCargarParams();
		}

		if ($this->getSesion()->getIdusuario()!=1) //El usuario invitado es el 1
  			parent::save($con);
	}
}
