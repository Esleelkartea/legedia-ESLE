<?php

/**
 * documentos actions, importado desde Gestpro
 *
 * @package    ingema
 * @subpackage documentos
 * @author     Neofis
 * @version    SVN: $Id$
 */
class documentosActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('documentos', 'list');
  }

  public function executeList()
  { 
    $this->processSort();
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/documento/filters');
    
    if (isset($this->filters['id_proyecto']) && $this->filters['id_proyecto'] != 0) 
    {
      $this->fases = FasePeer::getFasesEmpresaProyecto($this->filters['id_proyecto']);
      if (isset($this->filters['id_fase']) && $this->filters['id_fase'] != 0) 
      {
        $this->reuniones = ReunionPeer::getListaReuniones ($this->filters['id_proyecto'], $this->filters['id_fase']);
      }
      else 
      {
        $this->reuniones = array();
      }
    }
    else 
    {
      $this->fases = array();
      $this->reuniones = array();    
    }
    
    $this->pager = new sfPropelPager('Documento', 20);
    
    // Rober 25-nov-2009: si es administrador, que pueda ver todos los documentos.
    $this->es_administrador = false;
    $usuario = Usuario::getUsuarioActual();
    if ($usuario && $usuario->getEsAdministrador())
    {
      $c = new Criteria();
      $this->es_administrador = true;
    }
    else
    {
      //Ana: 04-11-09. Filtro por empresa y trabajador.
      $c = DocumentoPeer::getAlcance(); 
    }
    
    
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeShow()
  {
    $this->documento = $this->getDocumentoOrCreate();
    if ($this->documento->isNew()) 
    {
    	return $this->forward('documentos', 'create');
    }
    $this->labels = $this->getLabels();
    
     // pager
    $this->pager = new sfPropelPager('HistoricoDocumento', 10);
    $c = new Criteria();
    $c->add(HistoricoDocumentoPeer::ID_DOCUMENTO, $this->documento->getPrimaryKey());
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeCreate()
  {
    return $this->forward('documentos', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('documentos', 'edit');
   
  }

  public function executeSubir_temporal()
  {
    $upload_name  = "resume_file";
	  $temp_file    = $this->getRequest()->getFilePath($upload_name);
	  $tempname     = $this->getRequest()->getFileName($upload_name);
		$todir        = sfConfig::get('sf_web_dir')."/temp/";
				
		if (!file_exists ($todir))
		{
      @mkdir($todir);
      @chmod($todir, 0777);
    }
    
    if (is_uploaded_file($temp_file))
    {
  		@copy($temp_file, $todir.$tempname);
  		@chmod($todir.$tempname, 0777);
  		
  		echo $tempname;
		}
		
		return sfView::NONE;
  }
  
  public function executeEdit()
  {
    $this->documento = $this->getDocumentoOrCreate();
    $fromWiki = $this->getRequestParameter('fromWiki',0);
    if ($fromWiki == 1){
      //SI VIENE DE WIKI, TENEMOS QUE COGER EL PROYECTO DE LA VARIABLE DE SESSION QUE HE GUARDADO EN executeWiki de proyectos
      $id_proyecto = $this->getUser()->getAttribute('wiki_proyecto', 0);
    }else {
      $id_proyecto = $this->getRequestParameter('id_proyecto');
    }
    
    $id_fase = $this->getRequestParameter('id_fase');
    if ($id_proyecto)
    {
      $this->documento->setIdProyecto($id_proyecto);
    }
    if ($id_fase)
    {
      $this->documento->setIdFase($id_fase);
    }

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateDocumentoFromRequest();
      $this->saveDocumento($this->documento);
      
      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('documentos/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('documentos/list');
      }
      else
      {
        return $this->redirect('documentos/edit?id_documento='.$this->documento->getPrimaryKey());
      }
    }
    else
    {

      $this->labels = $this->getLabels();
      $this->pager = new sfPropelPager('HistoricoDocumento', 10);
      $c = new Criteria();
      $c->add(HistoricoDocumentoPeer::ID_DOCUMENTO, $this->documento->getPrimaryKey());
      //$this->addSortCriteria_fases($c);
      //$this->addFiltersCriteria($c);
      $this->pager->setCriteria($c);
      $this->pager->setPage($this->getRequestParameter('page', 1));
      $this->pager->init();
    }
  }

  public function executeDelete()
  {
    $this->documento = $this->getDocumentoOr404();
    $vuelta = $this->getRequestParameter('vuelta');

    try
    {
      $this->deleteDocumento($this->documento);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el objeto seleccionado.');
      return $this->forward('documentos', 'list');
    }
    $dir_referida = $this->dirReferida();
    return $this->redirect($dir_referida);//Si venimos de edit(documento), nos dará error!
  }
  
  public function executeElegirproyecto()
  {
    $this->proyecto = ProyectoPeer::retrieveByPK($this->getRequestParameter('id_proyecto'));
    $this->fases = FasePeer::getFasesEmpresaProyecto($this->getRequestParameter('id_proyecto'));
  }
  
  public function executeElegirfase()
  {
    $this->reuniones = ReunionPeer::getReunionesEmpresaProyectoFase(
      $this->getRequestParameter('id_proyecto'), $this->getRequestParameter('id_fase')
    );
  }
  
  public function executeElegirproyectofilters()
  {
    $this->proyecto = ProyectoPeer::retrieveByPK($this->getRequestParameter('id_proyecto'));
    $this->fases = FasePeer::getFasesEmpresaProyecto($this->getRequestParameter('id_proyecto'));
  }
  
  public function executeElegirfasefilters()
  {
    $this->reuniones = ReunionPeer::getReunionesEmpresaProyectoFase(
      $this->getRequestParameter('id_proyecto'),$this->getRequestParameter('id_fase')
    );
  }
  
  //Rober 27-nov-2009: el ajax, cuanto menos intrusivo mejor.
  public function executeAjaxfasesdeproyecto()
  {
    $this->proyecto = ProyectoPeer::retrieveByPK($this->getRequestParameter('id_proyecto'));
    $this->fases    = $this->proyecto ? $this->proyecto->getFasesByNombre() : array();
    $this->id_fase  = $this->getRequestParameter('id_fase');
    $this->options  = array();
    if ($this->getRequestParameter('include_blank'))
    {
      $this->options['include_blank'] = true;
    }
    elseif ($this->getRequestParameter('include_custom'))
    {
      $this->options['include_custom'] = $this->getRequestParameter('include_custom');
    }
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->documento = $this->getDocumentoOrCreate();
    $this->updateDocumentoFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveDocumento($documento)
  { 
  
    //Ana: 03-11-09 Por defecto se añaden al documento los usuarios que pertenecen al proyecto que tiene asignado el documento.
    if ($documento->isNew()) $nuevo = 1;
    $documento->save();
    
    if (
      isset($_FILES["resume_degraded"]) && 
      is_uploaded_file($_FILES["resume_degraded"]["tmp_name"]) && 
      ($_FILES["resume_degraded"]["error"] == 0)
    )
    {
        $fileName = $_FILES["resume_degraded"]["name"];
        $used_degraded = true;
    }
    
    if (isset($_REQUEST["hidFileID"]) && $_REQUEST["hidFileID"] != "" ) {
    	$fileName = $_REQUEST["hidFileID"];
    }
    
    if ($used_degraded){
      $fileSize       = $this->getRequest()->getFileSize($fileName);
      $fileType       = $this->getRequest()->getFileType($fileName);
    }else{
      $filePath       = sfConfig::get('sf_web_dir')."/temp/".$fileName;
      $fileSize       = filesize($filePath);
      $fileType       = mime_content_type($filePath);
    }
    
    //if ($_FILES['fichero']['error'] == 0)
    //{
      $usuario = Usuario::getUsuarioActual();
      $historico = new HistoricoDocumento();
      $historico->setIdEmpresa(   sfContext::getInstance()->getUser()->getAttribute('idempresa'));
      $historico->setIdDocumento( $documento->getIdDocumento());
      $historico->setVersion(     HistoricoDocumentoPeer::getUltimaVersion($this->documento->getPrimaryKey()));
      $historico->setFecha(       date('Y-m-d H:i:s'));
      $historico->setTamano(      $fileSize);
      $historico->setNombreFich(  $fileName);
      $historico->setMime(        $fileType);
      $historico->setIdUsuario(   $usuario ? $usuario->getPrimaryKey() : null);//Rober 28-dic-2009
      
      $nombre_base_nuevo = $this->renombrarDocumento($historico, $documento->getIdProyecto(), $documento->getIdFase());
      
      $historico->setNombreFich($nombre_base_nuevo);
      
      $historico->save();
      
      $cookie_cliente = sfContext::getInstance()->getUser()->getAttribute('empresa','','usuarios');
      if ($cookie_cliente != 0 && $cookie_cliente != '') 
      {
        $cliente = ClientePeer::retrieveByPk($cookie_cliente);
        //if ($cliente->getEmail() != '' && $cliente->getQuieremail())
        //{
          // Rober 23-oct-2009: la funcion de envío no está definida...
          //DocumentoPeer::mandarEmail($historico, $cliente->getEmail(), $cliente->getNombre());
        //}
      }
    //}
    
    
    if ($nuevo) 
    {
      // Ana: 03-11-09 Por defecto se añaden al documento los usuarios que 
      // pertenecen al proyecto que tiene asignado el documento.
      // Rober 26-abr-2010: código comentado.
      
      $fase = $documento->getFase();
      $trabajadores = ($fase instanceof Fase) ? $fase->getListaTrabajadores() : array();

      if (sizeof($trabajadores) == 0) {
        $c = new Criteria();
        $c->add(RelProyectoTrabajadorPeer::ID_PROYECTO, $documento->getIdProyecto()); 
        $trabajadores = RelProyectoTrabajadorPeer::doSelect($c);      
      }
      
      //Rober 26-abr-2010
      foreach ($trabajadores as $trabajador)
      {
        $c = new Criteria();
        $new_rpt = new RelDocumentoTrabajador();
        $new_rpt->setIdTrabajador($trabajador->getIdTrabajador());
        $documento->addRelDocumentoTrabajador($new_rpt);
      }
      
      $documento->save();
    } 
       
    //BORRAMOS EL FICHERO TEMPORAL SI EXISTE
    if (isset($filePath) && file_exists($filePath)){
      @unlink($filePath);
    }
  }

  protected function deleteDocumento($documento)
  {
    $documento->delete();
  }

  protected function updateDocumentoFromRequest()
  {
    $documento = $this->getRequestParameter('documento');

    if (isset($documento['id_proyecto']))
    {
      $this->documento->setIdProyecto($documento['id_proyecto'] ? $documento['id_proyecto'] : null);
    }
    if (isset($documento['id_fase']))
    {
      $this->documento->setIdFase($documento['id_fase'] ? $documento['id_fase'] : null);
    }
    if (isset($documento['id_reunion']))
    {
      $this->documento->setIdReunion($documento['id_reunion'] ? $documento['id_reunion'] : null);
    }
    if (isset($documento['id_categoria']))
    {
      $this->documento->setIdCategoria($documento['id_categoria'] ? $documento['id_categoria'] : null);
    }
    if (isset($documento['tamano']))
    {
      $this->documento->setTamano($documento['tamano']);
    }
    if (isset($documento['version']))
    {
      $this->documento->setVersion($documento['version']);
    }
    if (isset($documento['fecha']))
    {
      if ($documento['fecha'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
          if (!is_array($documento['fecha']))
          {
            $value = $dateFormat->format($documento['fecha'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $documento['fecha'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'];
            $value .= (isset($value_array['hour']) ? 
              ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : 
              '');
          }
          $this->documento->setFecha($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->documento->setFecha(null);
      }
    }
    $this->uploadArchivoFromRequest();
  }
  
  
  protected function uploadArchivoFromRequest()
  {
    $documento = $this->getRequestParameter('documento');
    // SUBIR FICHERO
    $used_degraded = false;
    $fileName = "";
    
    if (
      isset($_FILES["resume_degraded"]) && 
      is_uploaded_file($_FILES["resume_degraded"]["tmp_name"]) && 
      $_FILES["resume_degraded"]["error"] == 0)
    {
        $fileName = $_FILES["resume_degraded"]["name"];
        $used_degraded = true;
    }
    
    if (isset($_REQUEST["hidFileID"]) && $_REQUEST["hidFileID"] != "" ) {
    	$fileName = $_REQUEST["hidFileID"];
    }
    
    //$fileName = $this->getRequest()->getFileName("fichero");
    if (isset($fileName) && $fileName!='')
    {
      $ruta_destino = HistoricoDocumentoPeer::getUploadsDirectory(
        $this->documento->getIdProyecto(), $this->documento->getIdFase()
      );
      
      if ($used_degraded)
      {
        $fich_origen  = $this->getRequest()->getFilePath($fileName);
        $fileName     = $this->getRequest()->getFileName($fileName);
      }else{
        $fich_origen  = sfConfig::get('sf_web_dir')."/temp/".$fileName;
      }
      
      //$fich_origen  = $_FILES['fichero']['tmp_name'];
      
      $fich_destino = $ruta_destino;
      $fich_destino .= $fileName;
        
      if ((!$used_degraded && file_exists($fich_origen)) || ($used_degraded && is_uploaded_file($fich_origen)))
      {
        @copy ($fich_origen, $fich_destino);
        @chmod($fich_destino, 0777);
        //unlink($fich_origen);
      }
        
      if (isset($documento['nombre']) && ($documento['nombre'] != ''))
      {
        $this->documento->setNombre($documento['nombre']);
      }	
      else 
      {
        //QUITAMOS LA EXTESION PARA PONERLE EL NOMBRE
        $arr = pathinfo($fileName);
        if ($arr['extension'] != "")
          $mnombre = substr($arr['basename'], 0, (strlen($arr['basename']) - strlen($arr['extension']) - 1) );
        else $nnombre = $arr['basename'];
        $this->documento->setNombre($mnombre);
      }
    }
    else 
    {
      $this->documento->setNombre($documento['nombre']);
    }
   //Ana: 04-11-09 Necesito que no se haga aquí el save porque necesito 
   // saber cuando es nuevo el documento para asignarle por defecto los 
   // trabajadores del proyecto. El save se hace 
   // en el savedocumento. $this->documento->save();
  }

  protected function getDocumentoOrCreate($id_documento = 'id_documento')
  {
    $idd_documento = $this->getRequestParameter($id_documento, 0);
    
    //SI VIENE DE WIKI PUEDE QUE YA EXISTA EL DOCUMENTO, ASI QUE VAMOS A BUSCAR UNO CON EL MISMO NOMBRE DEL MISMO PROYECTO
    $fromWiki = $this->getRequestParameter('fromWiki',0);
    if ($fromWiki == 1){
      $arr = pathinfo($_REQUEST["hidFileID"]);
      if ($arr['extension'] != "")
        $mnombre = substr($arr['basename'], 0, (strlen($arr['basename']) - strlen($arr['extension']) - 1) );
      else $mnombre = $arr['basename'];
      
      $c = new Criteria();
      $c->addAnd(DocumentoPeer::ID_PROYECTO, $this->getUser()->getAttribute('wiki_proyecto', 0), Criteria::EQUAL);
      $c->addAnd(DocumentoPeer::NOMBRE, $mnombre, Criteria::LIKE);
      $documento = DocumentoPeer::doSelectOne($c);

      if ($documento != null){
        $idd_documento = $documento->getIdDocumento();
        $this->forward404Unless($documento);
        return $documento;
      }
    }
    
    if ($idd_documento != 0)
    {
      $documento = DocumentoPeer::retrieveByPk($idd_documento);
      $this->forward404Unless($documento);
    }
    else
    {
      $documento = new Documento();
      $documento->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
      if ($id_fase = $this->getRequestParameter('id_fase'))
      {
        $documento->setIdFase($id_fase);
      }
      if ($id_reunion = $this->getRequestParameter('id_reunion'))
      {
        $documento->setIdReunion($id_reunion);
      }
    }

    return $documento;
  }
  
  protected function getDocumentoOr404($id_documento = 'id_documento')
  {
    if (!$this->getRequestParameter($id_documento))
    {
      $this->forward404();
    }
    else
    {
      $documento = DocumentoPeer::retrieveByPk($this->getRequestParameter($id_documento));
      $this->forward404Unless($documento);
    }

    return $documento;
  }
  

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/documento/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/documento/filters');
    }    
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/documento/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/documento/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/documento/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['id_proyecto_is_empty']))
    {
      $criterion = $c->getNewCriterion(DocumentoPeer::ID_PROYECTO, '');
      $criterion->addOr($c->getNewCriterion(DocumentoPeer::ID_PROYECTO, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['id_proyecto']) && $this->filters['id_proyecto'] !== '')
    {
      $c->add(DocumentoPeer::ID_PROYECTO, $this->filters['id_proyecto']);
    }  

    if (isset($this->filters['id_fase']) && $this->filters['id_fase'] !== '')
    {
      $c->add(DocumentoPeer::ID_FASE, $this->filters['id_fase']);
    } 
    
    //Es este filtro necesario?
    if (isset($this->filters['id_reunion']) && $this->filters['id_reunion'] !== '')
    {
      $c->add(DocumentoPeer::ID_REUNION, $this->filters['id_reunion']);
    }
    
    if (isset($this->filters['id_categoria']) && $this->filters['id_categoria'] !== '')
    {
      $c->add(DocumentoPeer::ID_CATEGORIA, $this->filters['id_categoria']);
    }
    
    if (isset($this->filters['nombre']) && $this->filters['nombre'] !== '')
    {
      $c->add(DocumentoPeer::NOMBRE, strtr($this->filters['nombre'], '*', '%'), Criteria::LIKE);
    } 
    if (isset($this->filters['tipo']) && $this->filters['tipo'] !== '')
    {
      if ($this->filters['tipo'] == 1)
      {
        $criterion = $c->getNewCriterion(DocumentoPeer::ID_ENTREGABLE, NULL, Criteria::ISNOTNULL);
        $criterion->addOr($c->getNewCriterion(DocumentoPeer::ID_ENTREGABLE, 0, Criteria::NOT_EQUAL));
      }
      else
      {
        $criterion = $c->getNewCriterion(DocumentoPeer::ID_ENTREGABLE, NULL, Criteria::ISNULL);
        $criterion->addOr($c->getNewCriterion(DocumentoPeer::ID_ENTREGABLE, 0));
      }
      $c->addAnd($criterion);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/documento/sort'))
    {
      if ($sort_column == 'tipo')
      {
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/documento/sort') == 'asc')
        {
          $c->addAscendingOrderByColumn(DocumentoPeer::ID_REUNION);
          $c->addDescendingOrderByColumn(DocumentoPeer::ID_ENTREGABLE);
        }
        else
        {
          $c->addAscendingOrderByColumn(DocumentoPeer::ID_ENTREGABLE);
          $c->addDescendingOrderByColumn(DocumentoPeer::ID_REUNION);
        }
      }
      elseif ($sort_column == 'ntipo')
      {
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/documento/sort') == 'asc')
        {
          $c->addJoin(DocumentoPeer::ID_ENTREGABLE, EntregablePeer::ID_ENTREGABLE, Criteria::LEFT_JOIN);
          $c->addAscendingOrderByColumn(EntregablePeer::NOMBRE);
          $c->addJoin(DocumentoPeer::ID_REUNION, ReunionPeer::ID_REUNION, Criteria::LEFT_JOIN);
          $c->addDescendingOrderByColumn(ReunionPeer::NOMBRE);
        }
        else
        {
          $c->addJoin(DocumentoPeer::ID_REUNION, ReunionPeer::ID_REUNION, Criteria::LEFT_JOIN);
          $c->addAscendingOrderByColumn(ReunionPeer::NOMBRE);
          $c->addJoin(DocumentoPeer::ID_ENTREGABLE, EntregablePeer::ID_ENTREGABLE, Criteria::LEFT_JOIN);
          $c->addDescendingOrderByColumn(EntregablePeer::NOMBRE);
        }
      }
      elseif ($sort_column == 'categoria')
      {
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/documento/sort') == 'asc')
        {
          $c->addJoin(DocumentoPeer::ID_CATEGORIA, ParametroPeer::ID_PARAMETRO, Criteria::LEFT_JOIN);
          $c->addAscendingOrderByColumn(ParametroPeer::NOMBRE);
        }
        else
        {
          $c->addJoin(DocumentoPeer::ID_CATEGORIA, ParametroPeer::ID_PARAMETRO, Criteria::LEFT_JOIN);
          $c->addDescendingOrderByColumn(ParametroPeer::NOMBRE);
        }
      }
      else
      {
        $sort_column = DocumentoPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
        if ($this->getUser()->getAttribute('type', null, 'sf_admin/documento/sort') == 'asc')
        {
          $c->addAscendingOrderByColumn($sort_column);
        }
        else
        {
          $c->addDescendingOrderByColumn($sort_column);
        }
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'documento{id_documento}' => 'Documento:',
      'documento{id_proyecto}' => 'Proyecto:',
      'documento{id_fase}' => 'Fase:',
      'documento{id_reunion}' => 'Reunion:',
      'documento{fichero}' => 'Subir fichero:',
      'documento{nombre}' => 'Nombre:',
      'documento{id_entregable}' => 'Entregable:',
      'documento{id_categoria}' => 'Categoría:',
      'documento{tipo}' => 'Tipo:',
      'entregable{id_entregable}' => 'Entregable:',
      'entregable{id_trabajador}' => 'Trabajador:',
      
    );
  }
  
  protected function renombrarDocumento($historico, $id_proyecto = 0, $id_fase = 0) 
  {
    //inicialmente se guarda con el nombre real. Despues hay que cambiarselo
    // añadiendo el id_proyecyo y la version.
    $directorio = HistoricoDocumentoPeer::getUploadsDirectory($id_proyecto, $id_fase);
    $nombre_anterior = $directorio;
    $nombre_anterior .= $historico->getNombreFich();
    
    $nombre_nuevo = $directorio;
    $nombre_base_nuevo = HistoricoDocumentoPeer::getNombreArchivo(
      $this->documento->getIdDocumento(), $historico->getVersion(), $historico->getNombreFich()
    );
    
    @rename($nombre_anterior, $nombre_nuevo.$nombre_base_nuevo);
    @chmod($nombre_nuevo.$nombre_base_nuevo, 0777);
    
    return $nombre_base_nuevo;
  }
  
  protected function dirReferida () 
  {
    $dir_anterior = $_SERVER['HTTP_REFERER'];
    $dir = strstr($dir_anterior, 'php/');
    $dir = substr($dir, 4);
    
    return $this->uriToUrl($dir);
  }
  
  protected function uriToUrl ($uri) 
  {
    $partes = explode('/', $uri);
    
    $modulo = array_shift($partes);
    $accion = array_shift($partes);
    
    $dir = $modulo.'/'.$accion;
    $i = 0;
    foreach ($partes as $parte) 
    {
       if ($i % 2 == 0) 
       {  // si es par osea que es una variable ...
         if ($i == 0) 
         { // si es el primero ... meto el ?
           $dir .='?'.$parte;
         }
         else 
         {
           $dir .='&'.$parte;         
         }
       }
       else 
       {
         $dir .= '='.$parte;
       }
       $i++;   
    }  
    return $dir;
  }
  
  /**
  * Añade trabajadores al documento actual.
  * @version 03-11-09
  * @author Ana Martín
  */
  public function executeTrabajadores()
  {
    $this->documento = $this->getDocumentoOr404();
      
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $flash_type = "notice";
      $flash_text = "La asociación de trabajadores con el documento se ha realizado correctamente";
      try
      {
        $this->updateRelsDocumentoTrabajadorFromRequest();
      }
      catch (Exception $e)
      {
        $flash_type = "error";
        $flash_text = "La asociación de trabajadores con el documento ha fallado: ".$e->getMessage();
      }
      $this->getUser()->setFlash($flash_type, $flash_text);
      
      return $this->redirect('documentos/edit?id_documento='.$this->documento->getIdDocumento());
    }
    else
    {
      return $this->redirect('documentos/edit?id_documento='.$this->documento->getPrimaryKey());
    }
  }
  
  /**
  * Añade trabajadores al documento actual.
  * @version 03-11-09
  * @author Ana Martín
  */
  protected function updateRelsDocumentoTrabajadorFromRequest()
  {
    $ids_trabajador = $this->getRequestParameter('documento[id_trabajador]');

    $con = Propel::getConnection(ProyectoPeer::DATABASE_NAME);
    try
    {
      $con->beginTransaction();
      
      $rels = $this->documento->getRelDocumentoTrabajadors();
      foreach ($rels as $rel)
      {
        $rel->delete($con);//OJO CON ESTO!!! BORRA TODOS!!!
      }
      foreach ($ids_trabajador as $id_trabajador=>$item)
      {
        $new_rpt = new RelDocumentoTrabajador();
        $new_rpt->setIdTrabajador($id_trabajador);
        $this->documento->addRelDocumentoTrabajador($new_rpt);
      }
      $this->documento->save($con);
      
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
  
  public function executeEnviar_aviso()
  {
    $documento = $this->getDocumentoOr404();
    
    $flash_type = "notice";
    $flash_text = "El aviso se ha enviado correctamente";
    $recipients = array();
    try
    {
      $respuesta = $this->enviarAvisoRelDocumentoTrabajadores($documento);
      /*
      if (!$respuesta)
      {
        $flash_type = "error";
        $flash_text = "Error desconocido";
      }
      elseif (!$respuesta['cod'] != 'OK')
      {
        $flash_type = "error";
        $flash_text = "Ha ocurrido un error: ".$respuesta['msg'];
      }
      */
    }
    catch (Exception $e)
    {
      $flash_type = "error";
      $flash_text = "Ha ocurrido un error al enviar el aviso: ".$e->getMessage();
    }
    
    $this->getUser()->setFlash($flash_type, $flash_text);
    
    return $this->redirect('documentos/show?id_documento='.$documento->getPrimaryKey());
  }
  
  
  
  protected function enviarAvisoRelDocumentoTrabajadores($documento = null)
  {
    //Enviar mensaje a los trabajadores relacionados con el documento.
    if (!$documento instanceof Documento)
    {
      throw new Exception("No ha facilitado un documento");
    }
    //Para crear enlaces:
    $params_show = "documentos/show?id_documento=".$documento->getPrimaryKey();
    $params_download = "historico_documentos/descargar";
    $params_download .= "?id_documento=".$documento->getPrimaryKey();
    $params_download .= "&version=".$documento->getUltimaVersion();
    $url_show = $this->getController()->genUrl($params_show, true);
    $url_download = $this->getController()->genUrl($params_download, true);
    $link_show = "<a href=\"".$url_show."\">pulse aquí</a>";
    $link_download = "<a href=\"".$url_download."\">pulse aquí</a>";
    
    $proyecto = $documento->getProyecto();
    $fase     = $documento->getFase();
    $nombre_proyecto = $proyecto ? $proyecto->__toString() : "Sin definir";
    $nombre_fase = $fase ? $fase->__toString() : "Sin definir";
    
    $parametros = array(
      'nombre'        => $documento->__toString(),
      'version'       => $documento->getUltimaVersion(),
      'link_show'     => $link_show,
      'link_download' => $link_download,
      'proyecto'      => $nombre_proyecto,
      'fase'          => $nombre_fase,
    );
    
    $rels_documento_trabajador = $documento->getRelDocumentoTrabajadorsJoinTrabajador();
    $destinatarios = array();
    foreach ($rels_documento_trabajador as $rel)
    {
      $trabajador = $rel->getTrabajador();
      $usuario = $trabajador ? $trabajador->getUsuario() : null;
      if ($usuario instanceof Usuario)
      {
        $destinatarios[] = $usuario->getPrimaryKey();
      }
    }
    
    $resultado = MensajePeer::enviarMensajeAvisarRelDocumentoTrabajadores($parametros, $destinatarios,
      array('enviar_email' => true)
    );
    
    return $resultado;
  }
  
}
