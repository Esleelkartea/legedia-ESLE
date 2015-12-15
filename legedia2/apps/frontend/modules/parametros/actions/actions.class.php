<?php

/**
 * parametros actions, Reescrito
 *
 * @package    Ingema
 * @subpackage parametros
 * @author     Neofis
 * @version    1.0
 */
class parametrosActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('parametros', 'list');
  }
  
  public function executeList()
  {
    $this->processSort();
    $this->pager = new sfPropelPager('ParametroDef', 10);
    $c = $this->getCriteriaParametroDef();
    
    $this->addSortCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
    
    $this->labels = $this->getLabels();
  }
  
  public function executeShow()
  {
    $this->parametro_def = $this->getParametroDefOr404();
    if ($this->parametro_def->getEsLista())
    {
      $this->parametro = $this->getParametroOrCreate();
    }
    else
    {
      $this->parametro = $this->parametro_def->getParametroUnicoOrCreate();
    }
    
    $this->labels = $this->getLabels();
  }
  
  public function executeCreate_item()
  {
    return $this->forward('parametros', 'edit_item');
  }
  
  public function executeShow_item()
  {
    $this->parametro = $this->getParametroOr404();
    $this->parametro_def = $this->parametro->getParametroDef();
    $this->labels = $this->getLabels();
  }
  
  public function executeEdit_item()
  {
    $this->parametro = $this->getParametroOrCreate();
    $this->parametro_def = $this->parametro->getParametroDef();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateParametroFromRequest();
      
      if ($this->parametro->getPrimaryKey() && $this->getRequestParameter('save_as_new'))
      {
        $this->parametro = $this->parametro->copy();
      }
      
      $this->saveParametro($this->parametro);
      try
      {
        if ($this->parametro_def->getCampoFichero())
        {
          $this->uploadArchivoFromRequest('parametro[fichero]');
        }
      }
      catch (Exception $e)
      {
        //error al subir el archivo
      }
      
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('parametros/create_item?id='.$this->parametro_def->getPrimaryKey());
      }
      else
      {
        return $this->redirect('parametros/show?id='.$this->parametro_def->getPrimaryKey());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function executeDelete_item()
  {
    $this->parametro = $this->getParametroOr404();
    $id_parametro_def = $this->parametro->getTipoParametro();
    try
    {
      $this->deleteParametro($this->parametro, true);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No se ha podido borrar el elemento');
      return $this->forward('parametros', 'show?id='.$id_parametro_def);
    }
    $this->getUser()->setFlash('notice', 'El elemento se ha borrado correctamente');

    return $this->redirect('parametros/show?id='.$id_parametro_def);
  }
  
  public function executeDownload()
  {
    $parametro = $this->getParametroOr404();
    $parametro_def = $parametro->getParametroDef();
    if (!$parametro_def->getCampoFichero())
    {
      $this->setFlash('error', 'El parametro no tiene elementos del tipo archivo');
      return sfView::ERROR;
    }
     
    $archivo = sfConfig::get('sf_upload_dir')."/".$parametro->getFichero();
    $nombre_archivo = $parametro->getNombreFichero();

    if (!file_exists($archivo))
    {
      $this->setFlash('error', 'El archivo no existe');
      return sfView::ERROR;
    }
    
    header('Content-type: '.$parametro->getTipo());
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '"');
    header('Content-Length: '.filesize($archivo));
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    
	  readfile($archivo);
	  exit();
  }
  
  public function executeOrder_item()
  {
    $parametro = $this->getParametroOr404();
    $parametro_def = $parametro->getParametroDef();
    if (!$parametro_def->getEsLista())
    {
      $this->getUser()->setFlash('error', 'El parametro no puede ordenarse, no es de tipo Lista');
      $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
    }
    
    $op = $this->getRequestParameter('op');
    if (!$op || ($op != "up" && $op != "down"))
    {
       $this->getUser()->setFlash('error', 'Operación incorrecta');
       return $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
    }
    if ($op == "up")
    {
      $previous = ParametroPeer::retrieveByOrden($parametro->getOrden() - 1, $parametro_def->getPrimaryKey());
      $this->forward404Unless($previous);
      $parametro->swapWith($previous);
    }
    else
    {
      $next = ParametroPeer::retrieveByOrden($parametro->getOrden() + 1, $parametro_def->getPrimaryKey());
      $this->forward404Unless($next);
      $parametro->swapWith($next);
    }
    $this->getUser()->setFlash('notice', 'El elemento se ha desplazado correctamente');
    
    return $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
  }
  
  public function executeReorder_items()
  {
    $parametro_def = $this->getParametroDefOr404();
    if (!$parametro_def->getEsLista())
    {
      $this->getUser()->setFlash('error', 'El parametro no puede ordenarse, no es de tipo Lista');
      $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
    }
    $order_by = $this->getRequestParameter('order_by', ParametroPeer::NOMBRE);
    $order_type = $this->getRequestParameter('order_type', "asc");
    try
    {
      $parametro_def->reorderParametrosByColumn($order_by, $order_type);
    }
    catch (Exception $e)
    {
      $this->getUser()->setFlash('error', $e->getMessage());
      
      return $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
    }
    $this->getUser()->setFlash('notice', 'Los elementos del parámetro se han reordenado correctamente');
    
    return $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
  }
  
  
  public function executeEnable_item()
  {
    $parametro = $this->getParametroOr404();
    $parametro_def = $parametro->getParametroDef();
    if (!$parametro_def->getEsLista())
    {
      $this->getUser()->setFlash('error', 'El parametro no puede activarse/desactivarse, no es de tipo Lista');
      $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
    }
    
    if (!$parametro->getFechaBorrado())
    {
      $this->deleteParametro($parametro);
      $mensaje = "El elemento se ha desactivado correctamente";
    }
    else
    {
      $this->undeleteParametro($parametro);
      $mensaje = "El elemento se reactivado correctamente";
    }
    $this->getUser()->setFlash('notice', $mensaje);
    
    return $this->redirect("parametros/show?id=".$parametro_def->getPrimaryKey());
  }
  
  
  public function handleErrorEdit_item()
  {
    $this->preExecute();
    $this->parametro = $this->getParametroOrCreate();
    $this->parametro_def = $this->parametro->getParametroDef();
    $this->updateParametroFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }
  
  
  protected function updateParametroFromRequest()
  {
    $parametro = $this->getRequestParameter('parametro');
    
    if (isset($parametro['nombre']) && $parametro['nombre'])
    {
      $this->parametro->setNombre($parametro['nombre']);
    }
    if (isset($parametro['numero']) && $parametro['numero'] != '')
    {
      $this->parametro->setNumero($parametro['numero']);
    }
    if (isset($parametro['numero2']) && $parametro['numero2'])
    {
      $this->parametro->setNumero2($parametro['numero2']);
    }
    if (isset($parametro['cadena']) && $parametro['cadena'])
    {
      $this->parametro->setCadena($parametro['cadena']);
    }
    if (isset($parametro['cadena1']) && $parametro['cadena1'])
    {
      $this->parametro->setCadena1($parametro['cadena1']);
    }
    if (isset($parametro['si_no']))
    {
      $this->parametro->setSiNo($parametro['si_no'] ? 1 : 0);
    }
    else
    {
      $this->parametro->setSiNo(null);
    }
    if (isset($parametro['fecha']))
    {
      if ($parametro['fecha'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
          if (!is_array($parametro['fecha']))
          {
            $value = $dateFormat->format($parametro['fecha'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $parametro['fecha'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'];
            $value .= (isset($value_array['hour']) ? 
              ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : 
              '');
          }
          $this->parametro->setFecha($value);
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
  }
  
  protected function uploadArchivoFromRequest($campo = "parametro")
  {
    $fileName = $this->getRequest()->getFileName($campo);
    if (isset($fileName) && $fileName!='')
    {
      $filePath       = $this->getRequest()->getFilePath($campo);
      $fileSize       = $this->getRequest()->getFileSize($campo);
      $fileExtension  = $this->getRequest()->getFileExtension($campo);
      $fileType       = $this->getRequest()->getFileType($campo);
      $fileError      = $this->getRequest()->hasFileError($campo);
      
      $nombre_final = "param_".$this->parametro->getPrimaryKey()."_";
      $nombre_final .= md5(uniqid("param")).$fileExtension;
      $fich_destino = sfConfig::get('sf_upload_dir')."/".$nombre_final;
      
      if (is_uploaded_file($filePath))
      {
        copy ($filePath, $fich_destino);
      }
      
      $old_nombre_fichero = $this->parametro->getFichero();
      
      $this->parametro->setFichero($nombre_final);//Nombre real (en el directorio uploads)
      $this->parametro->setNombreFichero($fileName);//Nombre que se ve
      $this->parametro->setTamano($fileSize);
      $this->parametro->setTipo($fileType);
      $this->parametro->save();
      
      // Eliminar el archivo viejo (si lo hay).
      if (isset($old_nombre_fichero) && file_exists(sfConfig::get('sf_upload_dir')."/".$old_nombre_fichero))
      {
        @unlink(sfConfig::get('sf_upload_dir')."/".$old_nombre_fichero);
      }
    }
    else 
    {
      //nada?
    }
  }
  
  protected function saveParametro($parametro)
  {
    $parametro->save();
  }
  
  protected function deleteParametro($parametro, $definitivo = false)
  {
    $parametro->delete(null, $definitivo);
  }
  
  protected function undeleteParametro($parametro)
  {
    $parametro->setFechaBorrado(null);
    $parametro->save();
  }
  
  
  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/parametros/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/parametros/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/parametros/sort'))
    {
      $this->getUser()->setAttribute('sort', 'nombre', 'sf_admin/parametros/sort');
      $this->getUser()->setAttribute('type', 'asc', 'sf_admin/parametros/sort');
    }
  }
  
  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/parametros/sort'))
    {
      $sort_column = ParametroDefPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/parametros/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }
  
  
  
  protected function getParametroDefOr404($id = 'id')
  {
    if (!$this->getRequestParameter($id))
    {
      $this->forward404();
    }
    else
    {
      $parametro_def = ParametroDefPeer::retrieveByPk($this->getRequestParameter($id));
      $this->forward404Unless($parametro_def);
    }
    
    return $parametro_def;
  }
  
  protected function getParametroOrCreate($id_parametro = 'item', $id_parametro_def = "id")
  {
    if (!$this->getRequestParameter($id_parametro))
    {
      $parametro = new Parametro();
      $parametro->setTipoParametro($this->getRequestParameter($id_parametro_def));
    }
    else
    {
      $parametro = ParametroPeer::retrieveByPk($this->getRequestParameter($id_parametro));
      $this->forward404Unless($parametro);
    }
    
    return $parametro;
  }
  
  protected function getParametroOr404($id_parametro = 'item')
  {
    if (!$this->getRequestParameter($id_parametro))
    {
      $this->forward404();
    }
    else
    {
      $parametro = ParametroPeer::retrieveByPk($this->getRequestParameter($id_parametro));
      $this->forward404Unless($parametro);
    }
    
    return $parametro;
  }
  
  protected function getCriteriaParametroDef()
  {
    return new Criteria();
  }
  
  protected function getLabels()
  {
    return array(
      'parametro_def{tipoparametro}' => 'id',
      'parametro_def{id}' => 'id',
      'parametro_def{nombre}' => 'nombre',
      'parametro_def{descripcion}' => 'descripción',
      'parametro_def{eslista}' => 'lista',
      'parametro_def{eseditable}' => 'puede editarse',
      'parametro_def{esborrable}' => 'puede borrarse',
    );
  }
  
  
}

?>
