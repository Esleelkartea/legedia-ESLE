<?php

/**
 * empresas actions.
 *
 * @package    NeoCRM
 * @subpackage empresas
 * @author     Ana Martín
 * @version    10-02-09
 */
class empresasActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    //Ana: 20-04-09 Obligo a recargar los filtros.
    $this->getContext()->getInstance()->getUser()->setAttribute('updated' , false , 'alcance');
    return $this->forward('empresas', 'list');
  }
  
  public function executeShow()
  {
    //Ana: 20-04-09 Obligo a recargar los filtros.
    $this->getContext()->getInstance()->getUser()->setAttribute('updated' , false , 'alcance');
    $c = $this->getCriterio();
    $c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter('id_empresa'));
    $this->empresa = EmpresaPeer::doSelectOne($c);
    $this->forward404Unless($this->empresa);
    $this->labels = $this->getLabels();
  }

  public function executeList()
  {
    //Ana: 20-04-09 Obligo a recargar los filtros.    
    $this->getContext()->getInstance()->getUser()->setAttribute('updated' , false , 'alcance');

    $this->processFilters();

    // pager
    $this->pager = new sfPropelPager('Empresa', sfConfig::get('app_listas_default'));
    $c = $this->getCriterio();
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executeCreate()
  {
    return $this->forward('empresas', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('empresas', 'edit');
  }

  public function executeEdit()
  {
    //Ana: 20-04-09 Obligo a recargar los filtros.
    $this->getContext()->getInstance()->getUser()->setAttribute('updated' , false , 'alcance');

    $this->empresa = $this->getEmpresaOrCreate();   

  
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateEmpresaFromRequest();
      
      $this->saveEmpresa($this->empresa);


      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('empresas/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('empresas/list');
      }
      else
      {
        return $this->redirect('empresas/edit?id_empresa='.$this->empresa->getIdEmpresa());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function executeDuplicate()
  {
    $empresa = $this->getEmpresaOrCreate();
    
    //DUPLICAR LA EMPRESA
    $miempresa = new Empresa();
    $empresa->copyInto($miempresa);
    $miempresa->setNombre("Copia de ".$empresa->getNombre());
    $miempresa->save();
    
    $tablas_equiv=array();
    $campos_cambiar=array();
    
    //DUPLICAMOS TABLAS
    $tablas = $empresa->getTablas();
    foreach ($tablas as $tabla){
      $mitabla = new Tabla();
      $tabla->copyInto($mitabla);
      $mitabla->setIdEmpresa($miempresa->getIdEmpresa());
      $mitabla->save();
      
      //GUARDAMOS LAS EQUIVALENCIAS DE LAS TABLAS PARA LUEGO CAMBIAR LAS RELACIONES
      $tablas_equiv [$tabla->getIdtabla()] = $mitabla->getIdTabla();
      
      $campos = $tabla->getRelCampoTablasJoinCampo();
      
      foreach ($campos as $camp){
        $campo = $camp->getCampo();
        $items = $campo->getItemBases();
        
        $micampo = new Campo();
        $campo->copyInto($micampo);
        $micampo->setIdEmpresa($miempresa->getIdEmpresa());
        $micampo->save();
        
        if ($micampo->getTipo() == CampoPeer::ID_TABLA) $campos_cambiar[]=$micampo->getIdCampo(); 
        
        //DUPLICAMOS ITEMS
        foreach ($items as $item){
          $miitem = new ItemBase();
          $item->copyInto($miitem);
          $miitem->setIdCampo($micampo->getIdCampo());
          $miitem->save();
        }
        
        $micamp = new RelCampoTabla();
        $micamp->setIdCampo($micampo->getIdCampo());
        $micamp->setIdTabla($mitabla->getIdTabla());
        $micamp->save();
      }
    }
    
    //AHORA CAMBIAMOS LOS ENLACES A LAS TABLAS
    foreach ($campos_cambiar as $camp){
      $campo = CampoPeer::retrieveByPk($camp);
      $campo->setValorTabla($tablas_equiv[$campo->getValorTabla()]);
      $campo->save();
    }
    
    return $this->redirect('tablas/list');
  }

  public function executeDelete()
  {
    $c = $this->getCriterio();
    $c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter('id_empresa'));
    $this->empresa = EmpresaPeer::doSelectOne($c);
    $this->forward404Unless($this->empresa);

    try
    {
      $this->deleteEmpresa($this->empresa);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse la empresa. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('empresas', 'list');
    }

    return $this->redirect('empresas/list');
  }
  
  public function executeUpdate_select_tablas()
  {
    $include_blank = ($this->getRequestParameter('include_blank') == 'true') ? true : false;
    $c = $this->getCriterio();
    $id_empresa = $this->getRequestParameter('id_empresa');
    $empresa = null;
    if ($id_empresa)
    {
      $c->addAnd(EmpresaPeer::ID_EMPRESA , $id_empresa);
      $empresa = EmpresaPeer::doSelectOne($c);
      $this->forward404Unless($empresa);
    }
    
    if ($empresa instanceof Empresa)
    {
      $this->tablas = $empresa->getTablas();
    }
    else
    {
      $c1 = TablaPeer::getCriterioAlcance();
      $this->tablas = TablaPeer::doSelect($c1);
    }
    
    $this->control_name = $this->getRequestParameter('control_name' , 'tabla[id_tabla]');
    $this->include_blank = $include_blank;// ? true : false;
  }
  
  
  public function executeUpdate_select_tablas2()
  {
    $include_blank = ($this->getRequestParameter('include_blank') == 'true') ? true : false;
    $c = $this->getCriterio();
    $id_empresa = $this->getRequestParameter('id_empresa');
    $empresa = null;
    if ($id_empresa)
    {
      $c->addAnd(EmpresaPeer::ID_EMPRESA , $id_empresa);
      $empresa = EmpresaPeer::doSelectOne($c);
      $this->forward404Unless($empresa);
    }
    
    $c1 = TablaPeer::getCriterioAlcance();
    if ($empresa instanceof Empresa)
    {
      $this->tablas = $empresa->getTablas($c1);
    }
    else
    {
      $this->tablas = TablaPeer::doSelect($c1);
    }
    
    //$this->control_name = $this->getRequestParameter('control_name' , 'tabla[id_tabla]');
    //$this->include_blank = $include_blank;// ? true : false;
  }
  
  
  
  public function executeUpload_logo()
  {
    $this->empresa = $this->getEmpresaOrCreate();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $fileName = $this->getRequest()->getFileName('imagen');
      if (isset($fileName) && $fileName!='')
      {
        $filePath = $this->getRequest()->getFilePath('imagen');
        $fileSize  = $this->getRequest()->getFileSize('imagen');
        $fileExtension = $this->getRequest()->getFileExtension('imagen');
        $fileType  = $this->getRequest()->getFileType('imagen');
        $fileError = $this->getRequest()->hasFileError('imagen');
        
 
        $filename_min = md5(uniqid("logo")).$fileExtension;
        $width_min = sfConfig::get('app_logos_min_size_width');
        $height_min = sfConfig::get('app_logos_min_size_height');
        $thumbnail_min = new sfThumbnail($width_min, $height_min);
        $thumbnail_min->loadFile($filePath);
        $thumbnail_min->save(sfConfig::get('app_directorio_logos').$filename_min, $fileType);
        
        $filename_med = md5(uniqid("foto")).$fileExtension;
        $width_med = sfConfig::get('app_logos_med_size_width');
        $height_med = sfConfig::get('app_logos_med_size_height');
        $thumbnail_med = new sfThumbnail($width_med, $height_med);
        $thumbnail_med->loadFile($filePath);
        $thumbnail_med->save(sfConfig::get('app_directorio_logos').$filename_med, $fileType);
        
        $filename_max = md5(uniqid("foto")).$fileExtension;
        $width_max = sfConfig::get('app_logos_max_size_width');
        $height_max = sfConfig::get('app_logos_max_size_height');
        $thumbnail_max = new sfThumbnail($width_max, $height_max);
        $thumbnail_max->loadFile($filePath);
        $thumbnail_max->save(sfConfig::get('app_directorio_logos').$filename_max, $fileType);

        $old_logo_min = $this->empresa->getUrlLogoMin() ? $this->empresa->getUrlLogoMin() : null;
        $old_logo_med = $this->empresa->getUrlLogoMed() ? $this->empresa->getUrlLogoMed() : null;
        $old_logo_max = $this->empresa->getUrlLogoMax() ? $this->empresa->getUrlLogoMax() : null;
        
        $this->empresa->setLogoMin($filename_min);
        $this->empresa->setLogoMed($filename_med);
        $this->empresa->setLogoMax($filename_max);
        $this->saveEmpresa($this->empresa);
        
        /*Ana:20-04-09 Creo que no deberia hacer esto. 
        //Recargar la empresa predeterminada de la sesión (solo si es la misma)
        $usuario_actual = Usuario::getUsuarioActual();
        $empresa_sesion = $usuario_actual->getEmpresaSesion();
        if (isset($empresa_sesion) && ($empresa_sesion->getPrimaryKey()==$this->empresa->getPrimaryKey()))
        {
          $usuario_actual->setEmpresaSesionNull();
          $usuario_actual->setEmpresaSesion($this->empresa);
        }
        */
        if (isset($old_logo_min))
        {
          @unlink(sfConfig::get('sf_web_dir').$old_logo_min);
        }
        if (isset($old_logo_med))
        {
          @unlink(sfConfig::get('sf_web_dir').$old_logo_med);
        }
        if (isset($old_logo_max))
        {
          @unlink(sfConfig::get('sf_web_dir').$old_logo_max);
        }
        $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      }

      
      if ($this->getRequestParameter('save_and_show'))
      {
        return $this->redirect('empresas/show?id_empresa='.$this->empresa->getPrimaryKey());
      }
      else if ($this->getRequestParameter('save_and_edit'))
      {
        return $this->redirect('empresas/edit?id_empresa='.$this->empresa->getPrimaryKey());
      }
      else
      {
        
        return sfView::NONE;
      }
    }
    else
    {
      $this->labels = $this->getLabels();
      return sfView::NONE;
    }
  }


  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->empresa = $this->getEmpresaOrCreate();
    $this->updateEmpresaFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }
  
  public function executeCambiar()
  {

    sfContext::getInstance()->getUser()->setAttribute('idempresa',$this->getRequestParameter('id_empresa'));
    
    $mmodule = $this->getRequestParameter('mmodule','panel');
    if ($mmodule == "formulario_modelo") $mmodule = 'tablas';
    elseif ($mmodule == "formularios") $mmodule = 'panel';
    
    return $this->redirect($mmodule."/index");
  }
  
  public function executeEdit_email()
  {
    $this->empresa = $this->getEmpresaOr404();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateEmpresaFromRequest();
      $this->saveEmpresa($this->empresa);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_show'))
      {
        return $this->redirect('empresas/show?id_empresa='.$this->empresa->getIdEmpresa());
      }
      else
      {
        return $this->redirect('empresas/edit_email?id_empresa='.$this->empresa->getIdEmpresa());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  

  protected function saveEmpresa($empresa)
  {
   
   
    $empresa->save();
      print_r($empresa);
  }

  protected function deleteEmpresa($empresa)
  {
    $empresa->delete();
  }

  protected function updateEmpresaFromRequest()
  {
    $empresa = $this->getRequestParameter('empresa');

    if (isset($empresa['id_provincia']))
    {
      $this->empresa->setIdProvincia($empresa['id_provincia'] ? $empresa['id_provincia'] : null);
    }
    if (isset($empresa['id_usuario']))
    {
      $this->empresa->setIdUsuario($empresa['id_usuario'] ? $empresa['id_usuario'] : null);
    }
    if (isset($empresa['nombre']))
    {
      $this->empresa->setNombre($empresa['nombre']);
    }
    if (isset($empresa['id_actividad']))
    {
      $this->empresa->setIdActividad($empresa['id_actividad'] ? $empresa['id_actividad'] : null);
    }
    if (isset($empresa['telefono']))
    {
      $this->empresa->setTelefono($empresa['telefono']);
    }
    if (isset($empresa['fax']))
    {
      $this->empresa->setFax($empresa['fax']);
    }
    if (isset($empresa['email']))
    {
      $this->empresa->setEmail($empresa['email']);
    }
    if (isset($empresa['domicilio']))
    {
      $this->empresa->setDomicilio($empresa['domicilio']);
    }
    if (isset($empresa['poblacion']))
    {
      $this->empresa->setPoblacion($empresa['poblacion']);
    }
    if (isset($empresa['codigo_postal']))
    {
      $this->empresa->setCodigoPostal($empresa['codigo_postal']);
    }

    
    //SMTP
    if (isset($empresa['smtp_server']))
    {
      $this->empresa->setSmtpServer($empresa['smtp_server']);
    }
    if (isset($empresa['smtp_user']))
    {
      $this->empresa->setSmtpUser($empresa['smtp_user']);
    }
    if (isset($empresa['smtp_port']))
    {
      $this->empresa->setSmtpPort($empresa['smtp_port']);
    }
    if (isset($empresa['change_smtp_password']))
    {
      if (isset($empresa['smtp_password']))
      {
        $this->empresa->setSmtpPassword($empresa['smtp_password']);
      }
    }
    
    
    //SENDER
    if (isset($empresa['sender_address']))
    {
      $this->empresa->setSenderAddress($empresa['sender_address']);
    }
    if (isset($empresa['sender_name']))
    {
      $this->empresa->setSenderName($empresa['sender_name']);
    }
    
    $filePath = $this->getRequest()->getFilePath('empresa[imagen]');
    $fileSize  = $this->getRequest()->getFileSize('empresa[imagen]');
    $fileExtension = $this->getRequest()->getFileExtension('empresa[imagen]');
    $fileType  = $this->getRequest()->getFileType('empresa[imagen]');
    $fileError = $this->getRequest()->hasFileError('empresa[imagen]');
    $nombre_foto = $this->getRequest()->getFileName('empresa[imagen]');
    
    if ($nombre_foto != '') { 
        $filename_min = md5(uniqid("logo")).$fileExtension;
        $width_min = sfConfig::get('app_logos_min_size_width');
        $height_min = sfConfig::get('app_logos_min_size_height');
        $thumbnail_min = new sfThumbnail($width_min, $height_min);
        $thumbnail_min->loadFile($filePath);
        $thumbnail_min->save(sfConfig::get('app_directorio_logos').$filename_min, $fileType);
        
        $filename_med = md5(uniqid("foto")).$fileExtension;
        $width_med = sfConfig::get('app_logos_med_size_width');
        $height_med = sfConfig::get('app_logos_med_size_height');
        $thumbnail_med = new sfThumbnail($width_med, $height_med);
        $thumbnail_med->loadFile($filePath);
        $thumbnail_med->save(sfConfig::get('app_directorio_logos').$filename_med, $fileType);
        
        $filename_max = md5(uniqid("foto")).$fileExtension;
        $width_max = sfConfig::get('app_logos_max_size_width');
        $height_max = sfConfig::get('app_logos_max_size_height');
        $thumbnail_max = new sfThumbnail($width_max, $height_max);
        $thumbnail_max->loadFile($filePath);
        $thumbnail_max->save(sfConfig::get('app_directorio_logos').$filename_max, $fileType);
    
        $old_logo_min = $this->empresa->getUrlLogoMin() ? $this->empresa->getUrlLogoMin() : null;
        $old_logo_med = $this->empresa->getUrlLogoMed() ? $this->empresa->getUrlLogoMed() : null;
        $old_logo_max = $this->empresa->getUrlLogoMax() ? $this->empresa->getUrlLogoMax() : null;
        
        $this->empresa->setLogoMin($filename_min);
        $this->empresa->setLogoMed($filename_med);
        $this->empresa->setLogoMax($filename_max);    
    }
    

    //SMS
    if (isset($empresa['sms_user']))
    {
      $this->empresa->setSmsUser($empresa['sms_user']);
    }
    if (isset($empresa['change_sms_password']))
    {
      if (isset($empresa['sms_password']))
      {
        $this->empresa->setSmsPass($empresa['sms_password']);
      }
    }
    if (isset($empresa['sms_num_dias']))
    {
      $this->empresa->setSmsNumDias($empresa['sms_num_dias']);
    }

    //COLORES
    if (isset($empresa['color1']))
    {
      $this->empresa->setColor1($empresa['color1']);
    }
    if (isset($empresa['color2']))
    {
      $this->empresa->setColor2($empresa['color2']);
    }
    if (isset($empresa['color3']))
    {
      $this->empresa->setColor3($empresa['color3']);
    }
    if (isset($empresa['color4']))
    {
      $this->empresa->setColor4($empresa['color4']);
    }
    if (isset($empresa['colorletra1']))
    {
      $this->empresa->setColorLetra1($empresa['colorletra1']);
    }
    if (isset($empresa['colorletra2']))
    {
      $this->empresa->setColorLetra2($empresa['colorletra2']);
    }
    if (isset($empresa['colorletra3']))
    {
      $this->empresa->setColorLetra3($empresa['colorletra3']);
    }
    if (isset($empresa['colorletra4']))
    {
      $this->empresa->setColorLetra4($empresa['colorletra4']);
    }

  }

  protected function getEmpresaOrCreate($id_empresa = 'id_empresa')
  {

   
    if (!$this->getRequestParameter($id_empresa))
    {
      $empresa = new Empresa();

    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter($id_empresa));
      $empresa = EmpresaPeer::doSelectOne($c);

      $this->forward404Unless($empresa);
    }
 

    return $empresa;
  }
  
  protected function getEmpresaOr404($id_empresa = 'id_empresa')
  {
    if (!$this->getRequestParameter($id_empresa))
    {
      return $this->forward404();
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter($id_empresa));
      $empresa = EmpresaPeer::doSelectOne($c);
      $this->forward404Unless($empresa);
      return $empresa;
    }
  }

  protected function processFilters()
  {
  }

  protected function addFiltersCriteria($c)
  {
  }
  
  
  protected function getCriterio()
  {
    $c = EmpresaPeer::getCriterioAlcance();
    return $c;
  }

  protected function getLabels()
  {
    return array(
      'empresa{id_empresa}' => 'Id',
      'empresa{id_provincia}' => 'provincia',
      'empresa{id_usuario}' => 'usuario',
      'empresa{nombre}' => 'Nombre',
      'empresa{id_actividad}' => 'Actividad',
      'empresa{telefono}' => 'Teléfono',
      'empresa{fax}' => 'Fax',
      'empresa{email}' => 'Correo Electrónico',
      'empresa{domicilio}' => 'Domicilio',
      'empresa{poblacion}' => 'Población',
      'empresa{codigo_postal}' => 'Código postal',
      'empresa{created_at}' => 'Creación',
      'empresa{updated_at}' => 'Actualización',
      'empresa{borrado}' => 'Borrado',
      'empresa{imagen}' => 'Imagen',
      'empresa{smtp_server}' => 'Servidor',
      'empresa{smtp_user}' => 'Usuario',
      'empresa{smtp_password}' => 'Clave',
      'empresa{smtp_port}' => 'Puerto',
      'empresa{sender_address}' => 'Dirección de emisor',
      'empresa{sender_name}' => 'Nombre de emisor',
      'empresa{to_marketing}' => 'Marketing',
      'empresa{to_telemarketing}' => 'Telemarketing',
      'empresa{change_smtp_password}' => 'Cambiar clave',

      'empresa{color1}' => 'Color Fondo',
      'empresa{color2}' => 'Color Primario',
      'empresa{color3}' => 'Color Secudario',
      'empresa{color4}' => 'Color Fondo Tablas',
      'empresa{colorletra1}' => 'Color Letra 1',
      'empresa{colorletra2}' => 'Color Letra 2',
      'empresa{colorletra3}' => 'Color Letra 3',
      'empresa{colorletra4}' => 'Color Letra 4',
    );
  }

}
