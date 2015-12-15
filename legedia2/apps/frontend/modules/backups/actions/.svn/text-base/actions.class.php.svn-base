<?php

/**
 * backups actions.
 *
 * @package    frutaspilar
 * @subpackage backups
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class backupsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
   Usuario::usuarioActualPermisos($this,'backups','index', false, sfRequest::GET);
    return $this->forward('backups', 'list');
  }
  
  public function executeList()
  {
    Usuario::usuarioActualPermisos($this,'backups','list', false, sfRequest::GET);
    //crear una lista con los archivos del directorio /web/uploads/backup.
    
    /*$this->processSort();

    $this->processFilters();

  */
    // pager
//    $this->pager = new sfPropelPager('Backup', sfConfig::get('app_listas_default'));
 //   $c = new Criteria();
  //  $this->addSortCriteria($c);
  //  $this->addFiltersCriteria($c);
 //   $this->pager->setCriteria($c);
  //  $this->pager->setPage($this->getRequestParameter('page', 1));
  //  $this->pager->init();
  
   
   
    
    $directorio = sfConfig::get('app_directorio_backups');
	//Ana, si no existe el directorio que lo cree.
    if (!file_exists($directorio)) 
   	 	mkdir($directorio,0700);    
    
    $listaBackups = array();
    
    if ($gd = opendir($directorio)) {
      
      while (($archivo = readdir($gd)) !== false) {
        if(!is_dir($archivo)){
          //es archivo, añadirlo a la lista.
          $estadisticas = stat($directorio."/".$archivo);
          $miDate = new Date($estadisticas['mtime']);
          
          //este tipo de ordenación no es muy fiable
          $listaBackups[$miDate->toString(FMT_DATETIMEMYSQL)] = array('nombre' => $archivo , 
                                  'fecha' =>  $miDate->toString(FMT_DATETIMEMYSQL) , 
                                  'tamano' => $estadisticas['size']);
        }
      }
      closedir($gd);
    }
    krsort($listaBackups);

    $this->listaBackups = $listaBackups;
    
    return sfView::SUCCESS;    
    
  }
  
  /*Crea una copia de seguridad*/
   public function executeGenerar(){
    Usuario::usuarioActualPermisos($this , 'backups' , 'generar' , false , sfRequest::GET);
    
    //include_once(dirname(__FILE__)."/../lib/BackupsLib.class.php");
    
    $miDate = new Date();
    
    //Problemas en windows con el directorio del archivos. Fichero app.yml de backend/config
    $directorio = sfConfig::get('app_directorio_backups');

	 /*Problemas en windows con el nombre del archivo    
    $lista = explode(" " , $miDate->toString(FMT_DATETIMEMYSQL));
    $listaHora = explode (":",$lista[1]);
    $nombreArchivo = $lista[0]."_".$listaHora[0]."-".$listaHora[1].".sql";
    $nombreArchivo = $lista[0]."_".$lista[1].".sql";
    */
    $nombreArchivo = tempnam($directorio,"BACKUP-");
   
    $direccionCompleta = $nombreArchivo;
    
    $backup = new BackupsLib();
     
    $resultado = $backup->backup_database($direccionCompleta);
    
    if (!$resultado) {
    		$this->getUser()->setFlash('notice_error', 'No se ha generado correctame el fichero');
    	   return $this->redirect('backups/list');
    }
    
    $nombre = "";
    $tamaño = 0;
    $fecha = "";
    $elBackup = array();
    if (file_exists($direccionCompleta) ){
      $nombre = $nombreArchivo;
      $tamaño = filesize($direccionCompleta);
      $miDate = new Date( filemtime($direccionCompleta) );
      $fecha = $miDate->toString(FMT_DATETIMEMYSQL);
      $elBackup = array('nombre' => $nombre , 
                      'fecha' => $fecha , 
                      'tamano' => $tamaño);
    }
   
    if (count($elBackup) == 0) $this->getUser()->setFlash('notice_error', 'No se ha generado correctame el fichero');
    
    $this->backup = $elBackup;
    
    return $this->redirect('backups/list');
  }
  
  /*Restaura una copia de seguridad*/
  public function executeRestaurar(){
   Usuario::usuarioActualPermisos($this , 'backups' , 'restaurar' , false , sfRequest::POST);
    
    
    // Necesitaria borrar el contenido actual de la BD?
    $nombreArchivo = $this->getRequestParameter('archivo');
    $directorio = sfConfig::get('app_directorio_backups');
    $rutaCompleta = $directorio.$nombreArchivo;
    
    $backup = new BackupsLib();
    $resultado = $backup->restore_database($rutaCompleta);
    
    if (!$resultado) { $this->getUser()->setFlash('notice_error', 'Ha ocurrido un error durante la restauración de la BD. Por favor vuelva a intentarlo');
    }
    else $this->getUser()->setFlash('notice', 'La BD se ha restaurado correctamente');
    
    return $this->redirect('backups/list');
  }
  
  
  public function executeBorrar(){
  /*Borra una copia de seguridad*/
    Usuario::usuarioActualPermisos($this , 'backups' , 'borrar' , false , sfRequest::GET);
    
    $archivo = $this->getRequestParameter('archivo');
    $directorio = sfConfig::get('app_directorio_backups');
    $rutaCompleta = $directorio.$archivo;
    if (file_exists($rutaCompleta) ){
      if (unlink($rutaCompleta)){
        $this->getUser()->setFlash('notice', 'El archivo se ha borrado correctamente');
      }
    }
    else $this->getUser()->setFlash('notice_error', 'No se ha podido borra el archivo');
     return $this->redirect('backups/list');
  }
  
  
  public function executeSubir(){
  /*Guarda un archivo en la carpeta web/upload/backups */
    Usuario::usuarioActualPermisos($this , 'backups' , 'subir' , true , sfRequest::POST);
    
    $nombreRecibido = $this->getRequestParameter('archivo_subir');
    $archivoSubir = $this->getRequest()->getFile('archivo_subir');

    
    $directorio = sfConfig::get('app_directorio_backups');
    $backup = array();
    if ($archivoSubir = $this->getRequest()->getFile('archivo_subir')){
      if(!empty($archivoSubir)) {
        $this->getRequest()->moveFile('archivo_subir', $directorio.$archivoSubir['name'], 0664, true, 0775);
        
        $minombre = $directorio.$archivoSubir['name'];
        $mi_archivo = fopen ($minombre , "r");
        if (!$mi_archivo) {
          $this->getUser()->setFlash('notice_error', 'No se ha subido correctamente el fichero');
        }
        $contenido = '';
        while (!feof ($mi_archivo)) {
          $linea = fgets ($mi_archivo, 1024);
          $contenido = $contenido.$linea;
        }
        fclose($mi_archivo);
        
        $miDate = new Date();
        
        $backup = array('nombre' => $archivoSubir['name'] , 
                        'fecha' => $miDate->toString(FMT_DATETIMEMYSQL) , 
                        'tamano' => $archivoSubir['size']);
        return $this->redirect('backups/index');
      }//if
    }//if
    return $this->redirect('backups/index');
  }//executeSubir();
  
  
  
  
}
