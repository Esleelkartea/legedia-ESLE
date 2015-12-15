<?php

/**
 * Subclass for performing query and update operations on the 'usuario' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UsuarioPeer extends BaseUsuarioPeer
{
  const ID_USUARIO_INVITADO = 1;
  const ID_USUARIO_ADMINISTRADOR = 2;
  const ID_USUARIO_TELEMARKETING = 12;
  
  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $c1 = $criteria->getNewCriterion(UsuarioPeer::FECHA_BORRADO, null , Criteria::ISNULL);
	  $c2 = $criteria->getNewCriterion(UsuarioPeer::FECHA_BORRADO, false ,Criteria::EQUAL);
	  $c1->addOr($c2);
	  $criteria->addAnd($c1);
		return parent::doSelectStmt($criteria , $con);
  }
  
  
  public static function getCriteriaUsuariosAccesiblesVacio()
  {
    $usuario = Usuario::getUsuarioActual();
    $c = new Criteria();
    $c->add(UsuarioPeer::ID_USUARIO , $usuario->getPrimaryKey());
    return $c;
  }
  
  public static function getCriteriaUsuariosAccesibles()
  {
    $c = clone sfContext::getInstance()->getUser()->getAttribute('usuarios',self::getCriteriaUsuariosAccesiblesVacio(),'alcance');
    return $c;
  }
  
  
  //Categorias de informes:
  public static function getCriteriaUsuarioActualAlcanceCategoriasInformes()
	{
	  $usuario = Usuario::getUsuarioActual();
	  $rels = $usuario->getRelUsuarioCategoriaInformes(new Criteria());
	  $c = new Criteria();
	  if (!sizeof($rels))
	  {
	    $c->add(CategoriaInformePeer::ID_CATEGORIA_INFORME , 0);
	  }
	  else
	  {
	    foreach($rels as $rel)
	    {
	      $cr_aux = $c->getNewCriterion(CategoriaInformePeer::ID_CATEGORIA_INFORME , $rel->getIdCategoriaInforme());
	      $c->addOr($cr_aux);
	    }
	  }
	  $c->setDistinct();
	  return $c;
	}
	
	public static function getCriterioNoBorrado($atributo){
    	$c=new Criteria();
    	$c->add($atributo, null ,Criteria::ISNULL);
		  $c->addOr($atributo, '0000-00-00 00:00:00' ,Criteria::EQUAL);
    
    	return $c;
	}
  


  /**
  * Función que devuelve el identificador del usuario invitado.
  * @return integer, id_usuario invitado
  * @version 04-02-09
  * @author Ana Martín 
  */   
  public static function getIdUsuarioInvitado() {
      return self::ID_USUARIO_INVITADO;  
  }
  
  /**
  * Función que devuelve el identificador del usuario administrador
  * @return integer, id_usuario adminsitrador
  * @version 04-02-09
  * @author Ana Martín 
  */ 
  public static function getIdUsuarioAdministrador() {
      return self::ID_USUARIO_ADMINISTRADOR;  
  }

  /**
  * Función que devuelve el identificador del usuario telemearketing
  * @return integer, id_usuario telemarketing
  * @version 02-04-09
  * @author Ana Martín 
  */ 
  public static function getIdUsuarioTelemarketing() {
      return self::ID_USUARIO_TELEMARKETING;  
  }

  /**
  * Función que devuelve una lista con los identificadores de los usuarios no borrables.
  * @return lista de identificadores de usuarios
  * @version 04-02-09
  * @author Ana Martín
  */
  public static function getAllUsuariosNoBorrables() {
    $lista = array(self::ID_USUARIO_ADMINISTRADOR, self::ID_USUARIO_INVITADO);
   
    return $lista;
  
  }
  
  
  const IDIOMA_DEFAULT = 1; //Idioma por defecto el castellano.

  /**
  * Función que devuelve el idioma del usuario actual.
  * @return string, idioma del usuario actual
  * @version 16-02-09
  * @author Ana Martín
  */
  public static function getIdiomaUsuarioActual(){
    

  	  $cultura = sfContext::getInstance()->getUser()->getCulture();  	
  		
  		$c = new Criteria();
  		$c->add(CataloguePeer::TARGET_LANG, $cultura);
  		$idioma = CataloguePeer::doSelectOne($c);

  		if ($idioma) return $idioma->getCatId();
  		else return self::IDIOMA_DEFAULT;    

     /* Ana: 12-11-2008 El idioma por defecto del usuario actual solo se tiene en cuenta la primera vez que entras. 
     Las siguientes tiene que coger la cultura que exista.*/ 

  }

  /**
  * Devuelve la lista de emails de los administradores.
  * @return array, lista de emails.
  * @version 25-02-09
  * @author Ana Martín.
  */
  public static function getAllEmailsAdministradores() {
    $lista_administradores = GrupoPeer::getAllAdministradores();   
    $lista_emails = array();
    foreach ($lista_administradores as $administrador) {
      //Enviar mensaje. 
      $lista_emails[]= $administrador->getEmail();   
    }  
    
    return $lista_emails;
  
  }
  
  public static function getRuta(){
  	$resto_ruta = "";

    //RUTA
		$dir_web = "web";
		$dirs = explode("/",dirname($_SERVER["SCRIPT_NAME"]));
		$encontrado = false; $ruta = "";
		foreach ($dirs as $dir){
			if (!$encontrado && trim($dir)!="") $resto_ruta .= "/" . $dir; 
			if (strtolower(trim($dir)) == $dir_web)	{$encontrado = true; break;}
		}
		//SI NO SE HA ENCONTRADO EN LA RUTA LA CARPETA WEB ES QUE ESTAMOS ACCEDIENDO DEL MODO CORTO
		//Y ENTONCES LA RUTA ES IGUAL AL DOMINIO SI NO YA HEMOS CALCULADO LA RUTA
		if ($_SERVER['SERVER_PORT'] != "80") $port = ":".$_SERVER['SERVER_PORT'];
		else $port = "";

                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] = "on"){
                    $txt_empieza = "https://";
                }else {
                    $txt_empieza = "http://";
                }

		if (!$encontrado) {
                    $ruta = $txt_empieza . $_SERVER['SERVER_NAME'] . $port;
                }
		else {
                    $ruta = $txt_empieza . $_SERVER['SERVER_NAME'] . $port . $resto_ruta;
                }
    
		//FICHERO
		$dirs = explode("/",$_SERVER["SCRIPT_NAME"]);
		$encontrado = false;
		foreach ($dirs as $dir){
			if ($encontrado) {$fichero = $dir; break;}
			if (strtolower(trim($dir)) == $dir_web)	$encontrado = true;
		}
		//COGEMOS ENTONCES EL FICHERO
		if (!$encontrado) $fichero = $dirs[1];
		
		$ruta = $ruta."/".$fichero;
		
		return $ruta;
  }

  public static function getDniFromCard(){
    $dn_piece=split('/',$_SERVER['SSL_CLIENT_S_DN']);
    foreach($dn_piece as $x => $tkv){
        list($key,$value)=split('=',$tkv);
        if($key=="serialNumber")
            return $value;
    }
    return null;
  }

  public static function getFirma($string){
      $dni = self::getDniFromCard();
      $firma = $string;

      return $firma;
  }

  public static function OCSPCheck(){
    //Escribir certificado del emisor
    $issuercertfilename = tempnam(dirname(__FILE__), "issuer");
    $issuercerthandler = fopen($issuercertfilename, "w");
    fwrite($issuercerthandler,$_SERVER["SSL_CLIENT_CERT_CHAIN_0"]);
    fclose($issuercerthandler);

    //Escribir el asunto del certificado
    $subjectcertfilename= tempnam(dirname(__FILE__), "subject");
    $subjectcerthandler = fopen($subjectcertfilename, "w");
    fwrite($subjectcerthandler,$_SERVER["SSL_CLIENT_CERT"]);
    fclose($subjectcerthandler);

    //Realizar una consulta OCSP (Varía según emisor del certificado)
    $ocsphandler=popen("openssl ocsp -issuer ".$issuercertfilename." -cert".$subjectcertfilename." -url http://ocsp.dnielectronico.es","r");
    list($filename,$result)=fscanf($ocsphandler,"%s %s");
    fclose($ocsphandler);

    //borrar archivos auxiliares
    unlink($issuercertfilename);
    unlink($subjectcertfilename);
    return ($result=="good")?True:False;
    }
}
