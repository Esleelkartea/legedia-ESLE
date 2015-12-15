<?php

/**
 * mensajes actions.
 *
 * @package    NeoCRM
 * @subpackage mensajes
 * @author     Roberto Martín Huelmo
 * @version    10-02-09
 */
class mensajesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('mensajes', 'entrada');
  }
  
  
  public function executeCreate()
  {
    return $this->forward('mensajes', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('mensajes', 'edit');
  }
  
  public function executeEdit()
  {
    $this->mensaje = $this->getMensajeOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateMensajeFromRequest();

      $this->saveMensaje($this->mensaje);

      $this->getUser()->setFlash('notice', 'El mensaje se ha enviado');

      if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('mensajes/salida');
      }
      elseif ($this->getRequestParameter('save_and_edit'))
      {
        return $this->redirect('mensajes/edit?id_mensaje='.$this->mensaje->getPrimaryKey());
      }
      else
      {
        return $this->redirect('mensajes/salida');
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  
  //solo los receptores del mensaje?
  public function executeLeer()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    //$c = $this->getCriterioLeer();
    $this->mensaje = MensajePeer::retrieveByPk($this->getRequestParameter('id_mensaje'));
    $this->forward404Unless($this->mensaje);
    if ($this->mensaje->getIdUsuario() == $usuario_actual->getPrimaryKey())
    {
      $mensaje_destino = MensajeDestinoPeer::retrieveByPk($this->mensaje->getPrimaryKey() , $usuario_actual->getPrimaryKey());
      if ($mensaje_destino)
      {
        $mensaje_destino->setLeido(true);//marcarlo como leido
        $mensaje_destino->save();
      }
    }
    else
    {
      $mensaje_destino = MensajeDestinoPeer::retrieveByPk($this->mensaje->getPrimaryKey() , $usuario_actual->getPrimaryKey());
      $this->forward404Unless($mensaje_destino);
      $mensaje_destino->setLeido(true);//marcarlo como leido
      $mensaje_destino->save();
    }
    $this->labels = $this->getLabels();
  }
  
  
  public function executeDelete_salida()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    //$c = $this->getCriterioLeer();
    $this->mensaje = MensajePeer::retrieveByPk($this->getRequestParameter('id_mensaje'));
    $this->forward404Unless($this->mensaje);
    if ($this->mensaje->getIdUsuario() == $usuario_actual->getPrimaryKey())
    {
      $this->deleteMensaje($this->mensaje);
      $this->getUser()->setFlash('notice', 'El mensaje se ha borrado correctamente');
    }
    else
    {
      $this->forward404();
    }

    return $this->redirect('mensajes/salida');
  }
  
  
  public function executeDelete_entrada()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    //$c = $this->getCriterioLeer();
    $this->mensaje_destino = MensajeDestinoPeer::retrieveByPk($this->getRequestParameter('id_mensaje') , $usuario_actual->getPrimaryKey());
    $this->forward404Unless($this->mensaje_destino);
    $this->deleteMensajeDestino($this->mensaje_destino);
    $this->getUser()->setFlash('notice', 'El mensaje se ha borrado correctamente');
    return $this->redirect('mensajes/entrada');
  }
  
  
  
  
  public function executeEntrada()
  {
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/mensaje/filters');
    
    $this->pager = new sfPropelPager('MensajeDestino', sfConfig::get('app_listas_mensajes'));
    $c = $this->getCriterioEntrada();
    $this->addFiltersCriteriaEntrada($c);
    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
    
    $this->labels = $this->getLabels();
  }
  
  
  
  public function executeSalida()
  {
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/mensaje/filters');
    
    $this->pager = new sfPropelPager('Mensaje', sfConfig::get('app_listas_mensajes'));
    $c = $this->getCriterioSalida();
    $this->addFiltersCriteriaSalida($c);
    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
    
    $this->labels = $this->getLabels();
  }
  
  
  
  //public function executePapelera()
  //{
    //ojo con esta acción. ¿Es necesaria?
  //}
  
  
  
  
  
  public function updateMensajeFromRequest()
  {
    $mensaje = $this->getRequestParameter('mensaje');

    if (isset($mensaje['asunto']))
    {
      $this->mensaje->setAsunto($mensaje['asunto'] ? $mensaje['asunto'] : null);
    }
    if (isset($mensaje['cuerpo']))
    {
      $this->mensaje->setCuerpo($mensaje['cuerpo'] ? $mensaje['cuerpo'] : null);
    }
    if (isset($mensaje['es_programado']))
    {
      if (isset($mensaje['fecha']['date']))
      {
        if ($mensaje['fecha']['date'])
        {
          try
          {
            $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($mensaje['fecha']['date'], $this->getUser()->getCulture());
            $mi_date = new Date($value);
            $mi_date->setHours(isset($mensaje['fecha']['hour']) ? $mensaje['fecha']['hour'] : 0);
            $mi_date->setMinutes(isset($mensaje['fecha']['minute']) ? $mensaje['fecha']['minute'] : 0);
            $this->mensaje->setFecha($mi_date->getTimestamp());
          }
          catch (sfException $e)
          {
            // not a date
          }
        }
        else
        {
          $this->mensaje->setFecha(time());
        }
      }
    }
    else
    {
       $this->mensaje->setFecha(time());
    }
  }
  
  
  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
      
      //fecha que el remitente envió el mensaje
      if (isset($filters['entrada_fecha']['from']) && $filters['entrada_fecha']['from'] !== '')
      {
        $filters['entrada_fecha']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['entrada_fecha']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['entrada_fecha']['to']) && $filters['entrada_fecha']['to'] !== '')
      {
        $filters['entrada_fecha']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['entrada_fecha']['to'], $this->getUser()->getCulture());
      }
      
      //fecha en la que el usuario actual ha enviado sus mensajes
      if (isset($filters['salida_fecha']['from']) && $filters['salida_fecha']['from'] !== '')
      {
        $filters['salida_fecha']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['salida_fecha']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['salida_fecha']['to']) && $filters['salida_fecha']['to'] !== '')
      {
        $filters['salida_fecha']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['salida_fecha']['to'], $this->getUser()->getCulture());
      }
      
      
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/mensaje/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/mensaje/filters');
    }
    else{
      $filters = array();
      //$filters['entrada_leido'] = 0;//ver los no leidos
      //$filters['entrada_fecha'] = array('from' => null , 'to' => time());
      //$filters['salida_fecha'] = array('from' => null , 'to' => time());
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/mensaje/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/mensaje/filters');
    }
  }
  
  protected function addFiltersCriteriaEntrada($c)
  {
    if (isset($this->filters['entrada_fecha']))
    {
      if (isset($this->filters['entrada_fecha']['from']) && $this->filters['entrada_fecha']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(MensajePeer::FECHA, $this->filters['entrada_fecha']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['entrada_fecha']['to']) && $this->filters['entrada_fecha']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(MensajePeer::FECHA, $this->filters['entrada_fecha']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(MensajePeer::FECHA, $this->filters['entrada_fecha']['to'], Criteria::LESS_EQUAL);
        }
      }
      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    
    if (isset($this->filters['entrada_leido']) && $this->filters['entrada_leido'] !== '')
    {
      if ($this->filters['entrada_leido'])
      {
        $c->add($c->getNewCriterion(MensajeDestinoPeer::LEIDO , true));
      }
      else
      {
        $cr1 = $c->getNewCriterion(MensajeDestinoPeer::LEIDO , null ,Criteria::ISNULL);
        $cr2 = $c->getNewCriterion(MensajeDestinoPeer::LEIDO , false);
        $cr1->addOr($cr2);
        $c->add($cr1);
      }
      
    }
    //remitente
    if (isset($this->filters['entrada_id_usuario']) && $this->filters['entrada_id_usuario'] !== '')
    {
      $c->add(MensajePeer::ID_USUARIO , $this->filters['entrada_id_usuario']);
    }
    //asunto
    if (isset($this->filters['entrada_asunto']) && $this->filters['entrada_asunto'] !== '')
    {
      $c->add(MensajePeer::ASUNTO, strtr($this->filters['entrada_asunto'], '*', '%') , Criteria::LIKE);
    }
  }
  
  
  protected function addFiltersCriteriaSalida($c)
  {
    if (isset($this->filters['salida_fecha']))
    {
      if (isset($this->filters['salida_fecha']['from']) && $this->filters['salida_fecha']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(MensajePeer::FECHA, $this->filters['salida_fecha']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['salida_fecha']['to']) && $this->filters['salida_fecha']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(MensajePeer::FECHA, $this->filters['salida_fecha']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(MensajePeer::FECHA, $this->filters['salida_fecha']['to'], Criteria::LESS_EQUAL);
        }
      }
      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    
    //quien lo recibe
    if (isset($this->filters['salida_id_usuario']) && $this->filters['salida_id_usuario'] !== '')
    {
      $c->addJoin(MensajePeer::ID_MENSAJE , MensajeDestinoPeer::ID_MENSAJE);
      $c->add(MensajeDestinoPeer::ID_USUARIO , $this->filters['salida_id_usuario']);
    }
    //asunto
    if (isset($this->filters['salida_asunto']) && $this->filters['salida_asunto'] !== '')
    {
      $c->add(MensajePeer::ASUNTO, strtr($this->filters['salida_asunto'], '*', '%') , Criteria::LIKE);
    }
    
  }
  
  
  
  
  protected function saveMensaje($mensaje)
  {
    $mensaje->save();
    
    // Update many-to-many for "mensaje_destino"
    $c = new Criteria();
    $c->add(MensajeDestinoPeer::ID_MENSAJE, $mensaje->getPrimaryKey());
    MensajeDestinoPeer::doDelete($c);

    $ids = $this->getRequestParameter('associated_mensaje_destinos');
    if (is_array($ids))
    {
      foreach ($ids as $id)
      {
        $mensajeDestino = new MensajeDestino();
        $mensajeDestino->setIdMensaje($mensaje->getPrimaryKey());
        $mensajeDestino->setIdUsuario($id);
        $mensajeDestino->save();
      }
    }
  }
  
  
  protected function deleteMensaje($mensaje)
  {
    $mensaje->delete();
  }
  
  protected function deleteMensajeDestino($mensaje_destino)
  {
    $mensaje_destino->delete();
  }
  
  
  protected function getMensajeOrCreate($id_mensaje = 'id_mensaje')
  {
    $usuario_actual = Usuario::getUsuarioActual();
    if (!$this->getRequestParameter($id_mensaje))
    {
      $mensaje = new Mensaje();
      $mensaje->setIdUsuario($usuario_actual->getPrimaryKey());
    }
    else
    {
      $c = new Criteria();
      $c->add(MensajePeer::ID_MENSAJE , $this->getRequestParameter($id_mensaje));
      $c->addAnd(MensajePeer::ID_USUARIO , $usuario_actual->getPrimaryKey());
      $mensaje = MensajePeer::doSelectOne($c);
      $this->forward404Unless($mensaje);
    }
    return $mensaje;
  }
  
  
  
  
  
  protected function getCriterioLeer()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    $c = new Criteria();
    $c->addJoin(MensajePeer::ID_MENSAJE , MensajeDestinoPeer::ID_MENSAJE);
    $c->add(MensajeDestinoPeer::ID_USUARIO , $usuario_actual->getPrimarykey());
    return $c;
  }
  
  protected function getCriterioEntrada()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    $c = new Criteria();
    $c->addJoin(MensajeDestinoPeer::ID_MENSAJE , MensajePeer::ID_MENSAJE);
    $c->add(MensajeDestinoPeer::ID_USUARIO , $usuario_actual->getPrimaryKey());
    
    //solo puedo leer los mensajes que NO haya borrado el remitente!
    $criterion1 = $c->getNewCriterion(MensajePeer::BORRADO , null , Criteria::ISNULL);
    $criterion2 = $c->getNewCriterion(MensajePeer::BORRADO , false);
    $criterion1->addOr($criterion2);
    $c->addAnd($criterion1);
    $mi_date = new Date();
    $c->addAnd(MensajePeer::FECHA , $mi_date->toString(FMT_DATETIMEMYSQL) , Criteria::LESS_EQUAL);
    $c->addDescendingOrderByColumn(MensajePeer::FECHA);
    return $c;
  }
  
  protected function getCriterioSalida()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    $c = new Criteria();
    $c->add(MensajePeer::ID_USUARIO , $usuario_actual->getPrimaryKey());
    //$c->addAnd(MensajePeer::ENVIADO , true);
    $criterion1 = $c->getNewCriterion(MensajePeer::BORRADO , null , Criteria::ISNULL);
    $criterion2 = $c->getNewCriterion(MensajePeer::BORRADO , false);
    $criterion1->addOr($criterion2);
    $c->addAnd($criterion1);
    $c->addDescendingOrderByColumn(MensajePeer::FECHA);
    return $c;
  }
  
  protected function getCriterioPapelera()
  {
    $usuario_actual = Usuario::getUsuarioActual();
    $c = new Criteria();
    $c->add(MensajePeer::ID_USUARIO , $usuario_actual->getPrimaryKey());
    $c->addAnd(MensajePeer::BORRADO , true);
    $c->addDescendingOrderByColumn(MensajePeer::FECHA);
    return $c;
  }
  
  
  protected function getLabels()
  {
    return array(
      'mensaje{id_usuario}' => 'remitente',
      'mensaje{asunto}' => 'asunto',
      'mensaje{cuerpo}' => 'cuerpo',
      'mensaje{es_programado}' => 'programar',
      'mensaje{fecha}' => 'fecha',
      'mensaje{por_email}' => 'avisar por correo electrónico',
      'mensaje{enviado}' => 'enviado',
      'mensaje{borrado}' => 'borrado',
      'mensaje{created_at}' => 'fecha creación',
      'mensaje{updated_at}' => 'fecha actualización',
      'mensaje{destinatarios}' => 'destinatarios',
      
      'mensaje_destino{id_mensaje}' => 'mensaje',
      'mensaje_destino{id_usuario}' => 'destinatario',
      'mensaje_destino{leido}' => 'leido',
      'mensaje_destino{created_at}' => 'fecha creación',
      'mensaje_destino{updated_at}' => 'fecha actualización',
      
    );
  }
  
  
}
