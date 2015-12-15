<?php

/**
 * tareas actions.
 *
 * @package    neoCRM
 * @subpackage tareas
 * @author     Neofis nuevas tecnologías, S.L.
 * @version    10-02-09
 */
class tareasActions extends sfActions
{

  public function executeEnviar_alarmas()
  {
    set_time_limit(0);

    $fecha = new Date();
    $fecha_uno = $fecha->toString(FMT_DATEMYSQL);

    $c1 = new Criteria();
    
    $crit0 = $c1->getNewCriterion(TareaPeer::FECHA_INICIO, $fecha_uno." 00:00:00", Criteria::GREATER_EQUAL);
    $crit1 = $c1->getNewCriterion(TareaPeer::FECHA_INICIO, $fecha_uno." 23:59:59", Criteria::LESS_EQUAL);
    $crit4 = $c1->getNewCriterion(TareaPeer::AVISAR_EMAIL, true, Criteria::EQUAL);
    $crit0->addAnd($crit1);
    $crit0->addAnd($crit4);

    $crit2 = $c1->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $fecha_uno." 00:00:00", Criteria::GREATER_EQUAL);
    $crit3 = $c1->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $fecha_uno." 23:59:59", Criteria::LESS_EQUAL);
    $crit5 = $c1->getNewCriterion(TareaPeer::AVISAR_EMAIL_FIN, true, Criteria::EQUAL);
    $crit2->addAnd($crit3);
    $crit2->addAnd($crit5);

    $crit0->addOr($crit2);

    $c1->add($crit0);

    $c1->setDistinct();

    $tareas_hoy = TareaPeer::doSelect($c1);

    foreach ($tareas_hoy as $tarea){
        $asunto = $tarea->getResumen();

        $fecha_uno = $tarea->getFechaInicio('d/m/Y');
        $fecha_dos = $tarea->getFechaVencimiento('d/m/Y');
        if ($fecha_uno != $fecha_dos && $fecha_uno == date('d/m/Y')){
            $cuerpo .= "<strong>Legedia</strong> - Inicio de ";
            $cuerpo .= ($tarea->getEsEvento()) ? "evento: " : "tarea: ";
        }elseif ($fecha_uno != $fecha_dos && $fecha_dos == date('d/m/Y')){
            $cuerpo = "<strong>Legedia</strong> - Vencimiento de ";
            $cuerpo .= ($tarea->getEsEvento()) ? "evento: " : "tarea: ";
        }else {
            $cuerpo = "<strong>Legedia</strong> - ".($tarea->getEsEvento()) ? "Evento:" : "Tarea: ";
        }

        $cuerpo .= $tarea->getResumen()."<br />";
        $cuerpo .= "Inicio: ".$fecha_uno."<br />";
        $cuerpo .= "Fin: ".$fecha_dos."<br />";
        $cuerpo .= $tarea->getDescripcion();
        if ($tarea->getIdFormulario() != 0) {
          $form = FormularioPeer::retrieveByPK($tarea->getIdFormulario());
          if ($form instanceof Formulario) {
            $cuerpo .= "Objeto relacionado: <a href=\"".UsuarioPeer::getRuta()."formularios/edit?id_formulario=".$tarea->getIdFormulario()."\">".$form->__toString()."</a>";
          }
        }

        $cuerpo .= "<br /><br />Muchas gracias<br /><br />Un Saludo<br />Administrador <strong>LEGEDIA</strong>\n";
        $mens = new Mensaje();
        $mens->setAsunto($asunto);
        $mens->setCuerpo($cuerpo);
        $mens->setEmail(true);
        $mens->setFecha(time());
        $mens->save();

        $c = new Criteria();
        $c->addAnd(MensajeDestinoPeer::ID_MENSAJE, $mens->getPrimaryKey());
        MensajeDestinoPeer::doDelete($c);

        $mensajeDestino = new MensajeDestino();
        $mensajeDestino->setIdMensaje($mens->getPrimaryKey());
        $mensajeDestino->setIdUsuario($tarea->getUsuario()->getIdUsuario());
        $mensajeDestino->save();

        echo $tarea->getUsuario()->getEmail()."::".$asunto."<br />".$cuerpo."<br /><br />";
        if (trim($tarea->getUsuario()->getEmail()) != ""){
            $enviado = MensajePeer::enviarEmailDefault($tarea->getIdEmpresa(), $asunto, $cuerpo, array($tarea->getUsuario()->getEmail()));
        }
    }

    echo "ENVIADOS: ".$enviado;
    return sfView::NONE;
  }
  
  public function executeIndex()
  {
    $this->forward('tareas', 'list');
  }
  
  public function executeShow()
  {
    $this->labels = $this->getLabels();
    $c = $this->getCriterio();
    $c->addAnd(TareaPeer::ID_TAREA , $this->getRequestParameter('id_tarea'));
    $this->tarea = TareaPeer::doSelectOne($c);
    $this->forward404Unless($this->tarea);
  
    $this->num_llam = $this->getRequestParameter('num_llam');
    $this->numero_total = $this->getRequestParameter('numero_total');
  }
  
  public function executeList()
  {
    
    //$todo = $this->getRequest()->getParameterHolder()->getAll();
    //print_r($todo);
    $this->processSort();
      
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/tarea/filters');
    
 
    
    $this->pager = new sfPropelPager('Tarea', sfConfig::get('app_listas_tareas'));
    $c = $this->getCriterio();
    $this->addFiltersCriteria($c);
    $this->addSortCriteria($c);
    $this->pager->setCriteria($c);
    //$this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/tareas')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/tareas');
    }
    
	 /*Ana: Código para que se vea el calendario*/	    
     $cal = TareaPeer::createCalendario(0);     

    /*Ana: 30-03-09 Anges GetThreeMonthView*/
    if ($this->getRequestParameter("mes")) {
    	$this->calendarMes = $cal->getThreeMonthView($this->getRequestParameter("mes"),$this->getRequestParameter("year"));   
        $this->mes = $this->getRequestParameter('mes');
    }
    else 
    	$this->calendarMes = $cal->getThreeMonthView(date('m'),date('Y'));   
    /* Fin Ana.*/

   $this->labels = $this->getLabels();
    
  }
  
  public function executeCreate()
  {
    return $this->forward('tareas', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('tareas', 'edit');
  }
  
  public function executeEdit()
  {
    $this->tarea = $this->getTareaOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateTareaFromRequest();
      
      $this->saveTarea($this->tarea);

      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('tareas/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('tareas/list');
      }
      elseif ($this->getRequestParameter('save_and_show'))
      {
        return $this->redirect('tareas/show?id_tarea='.$this->tarea->getIdTarea());
      }
      else
      {
        return $this->redirect('tareas/edit?id_tarea='.$this->tarea->getIdTarea());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  
  public function executeDelete()
  {
    $c = $this->getCriterio();
    $c->addAnd(TareaPeer::ID_TAREA , $this->getRequestParameter('id_tarea'));
    $this->tarea = TareaPeer::doSelectOne($c);
    $this->forward404Unless($this->tarea);

    try
    {
      $this->deleteTarea($this->tarea);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse la tarea. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('tareas', 'list');
    }
    return $this->redirect('tareas/list');
  }
  
  public function executeCambiar_estado()
  {
    $tarea = $this->getTareaOr404();
    $id_estado = $this->getRequestParameter('id_estado');
    
  }


  /**
  * Muestra la llamada pendiente en función del num_llamada.
  * No cambia la situación de la llamada.
  * @version 02-04-09
  * @author Ana Martín
  */
  public function executeMostrarLlamada() {
    $num_llamada = $this->getRequestParameter('num_llam');
  
    $this->mostrarLlamada($num_llamada);

  }

  /**
  * Para modo telemarketing directo. Muestra la llamada solicitada, para la campaña actual.
  * Es un bucle infinito, a no ser que se acaben todas las llamadas, pendientes.
  * @version 02-04-09
  * @author Ana Martín
  */
  public function mostrarLlamada($num_llamada) {
  
    /*  Para calcular el número total de llamadas que le quedan. */
    $c = $this->getCriterio();
    $c->add(TareaPeer::ID_ESTADO_TAREA, TareaPeer::ID_ESTADO_EVENTO_PLANEADO);
    $c->add(TareaPeer::FECHA_INICIO, date('Y-m-d H:i:s'), Criteria::LESS_EQUAL);
    $numero_total = TareaPeer::doCount($c);
    /*Fin para*/

    $c = $this->getCriterio();
    $c->add(TareaPeer::ID_ESTADO_TAREA, TareaPeer::ID_ESTADO_EVENTO_PLANEADO);
    $c->add(TareaPeer::FECHA_INICIO, date('Y-m-d H:i:s'), Criteria::LESS_EQUAL);
    $c->addDescendingOrderByColumn(TareaPeer::FECHA_INICIO);
    $c->setOffset($num_llamada);    
    $tarea = TareaPeer::doSelectOne($c);
    
    
    if ($tarea) {
      return $this->redirect('tareas/show?id_tarea='.$tarea->getPrimaryKey().'&num_llam='.$num_llamada.'&numero_total='.$numero_total);
    }
    else if ($num_llamada != 0) {
        $this->mostrarLlamada(0);
    }
    else {
      $this->getUser()->setFlash('notice_error', 'No hay llamadas pendientes aún, para esta campaña. Intentelo más tarde o pruebe con otra campaña');
      return $this->redirect('tareas/telemarketingDirecto');
    }
      
  }

  


  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->tarea = $this->getTareaOrCreate();
    $this->updateTareaFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveTarea($tarea)
  {
    $tarea->save();
  }

  protected function deleteTarea($tarea)
  {
    $tarea->delete();
  }
  
  //filtros
  protected function processFilters()
  {
    $this->getUser()->getAttributeHolder()->removeNamespace('sf/tarea/filters');
    /*Ana: Añado el or para que funcione el filtro del calendario.*/
    if ($this->getRequest()->hasParameter('filter') or $this->getRequestParameter('filtro_calendario') == '1')
    {
      $filters = $this->getRequestParameter('filters');
      
      //fecha_inicio
      if (isset($filters['fecha_inicio']['from']) && $filters['fecha_inicio']['from'] !== '')
      {
        $filters['fecha_inicio']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha_inicio']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['fecha_inicio']['to']) && $filters['fecha_inicio']['to'] !== '')
      {
        $filters['fecha_inicio']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha_inicio']['to'], $this->getUser()->getCulture());
      }
      
      //fecha_vencimiento
      if (isset($filters['fecha_vencimiento']['from']) && $filters['fecha_vencimiento']['from'] !== '')
      {
        $filters['fecha_vencimiento']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha_vencimiento']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['fecha_vencimiento']['to']) && $filters['fecha_vencimiento']['to'] !== '')
      {
        $filters['fecha_vencimiento']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['fecha_vencimiento']['to'], $this->getUser()->getCulture());
      }
      
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/tarea/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/tarea/filters');
    }
    else //para definir filtros activos por defecto.
    {
       $filters = array();

      //Ana: 01-04-09. Para activar los filtros especiales    
      if ($this->getRequestParameter('pendientes') && $this->getRequestParameter('pendientes') == 1 ) {
          $filters['fecha_inicio']['to'] = mktime(23,59,59, date('m'), date('d'), date('Y'));
          //$filters['es_evento'] =  1;
          $this->pendientes = $this->getRequestParameter('pendientes');
         
      }
      else if ($this->getRequestParameter('pendientes') && $this->getRequestParameter('pendientes') == 2 ) {
          $filters['fecha_inicio']['from'] = mktime(0,0,0, date('m'), date('d'), date('Y'));
          $filters['fecha_inicio']['to'] = mktime(23,59,59, date('m'), date('d'), date('Y'));
          //$filters['es_evento'] =  1;
          $this->pendientes = $this->getRequestParameter('pendientes');
         
      } 
    
      $hoy = new Date();
     
      if ($this->getRequestParameter('es_evento') && $this->getRequestParameter('es_evento') != '')
      {
        $filters['es_evento'] = ($this->getRequestParameter('es_evento')=='true') ? 1 : 0;
      }
      
      //Ana 26-02-09: Por defecto que solo se muestren las tareas que están sin realizar.
       $lista_tareas = TareaPeer::getAllEstadosTareas();
       foreach ($lista_tareas  as $tarea) {
         if ($tarea->getPrimaryKey() != TareaPeer::ID_ESTADO_TAREA_COMPLETADA) {
            $filters['estado_'.$tarea->getPrimaryKey()] = '1'; 
         }
       }
       $lista_eventos = TareaPeer::getAllEstadosEventos();
       foreach ($lista_eventos  as $evento) {
         if ($evento->getPrimaryKey() != TareaPeer::ID_ESTADO_EVENTO_REALIZADO) {
            $filters['estado_'.$evento->getPrimaryKey()] = '1'; 
         }
       } 
      
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/tarea/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/tarea/filters');
      
    }
  }
  
  protected function addFiltersCriteria($c)
  {
    //fecha_inicio
    if (isset($this->filters['fecha_inicio']))
    {
      if (isset($this->filters['fecha_inicio']['from']) && $this->filters['fecha_inicio']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(TareaPeer::FECHA_INICIO, $this->filters['fecha_inicio']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecha_inicio']['to']) && $this->filters['fecha_inicio']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(TareaPeer::FECHA_INICIO, $this->filters['fecha_inicio']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(TareaPeer::FECHA_INICIO, $this->filters['fecha_inicio']['to'], Criteria::LESS_EQUAL);
        }
      }
      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    
    //fecha_vencimiento
    if (isset($this->filters['fecha_vencimiento']))
    {
      if (isset($this->filters['fecha_vencimiento']['from']) && $this->filters['fecha_vencimiento']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $this->filters['fecha_vencimiento']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['fecha_vencimiento']['to']) && $this->filters['fecha_vencimiento']['to'] !== '')
      {
        
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $this->filters['fecha_vencimiento']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $this->filters['fecha_vencimiento']['to'], Criteria::LESS_EQUAL);
        }
      }
      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    
    
    $es_evento = null;
    if (isset($this->filters['es_evento']) && $this->filters['es_evento'] !== '')
    {
      $es_evento = $this->filters['es_evento'] ? true : false;
      if ($es_evento)
      {
        $c->add($c->getNewCriterion(TareaPeer::ES_EVENTO , true));
      }
      else
      {
        $criterion1 = $c->getNewCriterion(TareaPeer::ES_EVENTO , null , Criteria::ISNULL);
        $criterion2 = $c->getNewCriterion(TareaPeer::ES_EVENTO , false);
        $criterion1->addOr($criterion2);
        $c->add($criterion1);
      }
    }
    
    
    $criterion_tareas = $c->getNewCriterion(TareaPeer::ES_EVENTO , null , Criteria::ISNULL);
    $criterion_tareas_2 = $c->getNewCriterion(TareaPeer::ES_EVENTO , false);
    $criterion_tareas->addOr($criterion_tareas_2);
    $crt_aux = null;
    $estados = TareaPeer::getAllEstadosTareas();
    foreach($estados as $estado)
    {
      $campo = "estado_".$estado->getPrimaryKey();
      if (isset($this->filters[$campo]) && $this->filters[$campo] !== '')
      {
        if (!isset($crt_aux)) $crt_aux = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , $estado->getPrimaryKey());
        else $crt_aux->addOr($c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , $estado->getPrimaryKey()));
      }
    }
    if (isset($crt_aux)) $criterion_tareas->addAnd($crt_aux);
    
    $criterion_eventos = $c->getNewCriterion(TareaPeer::ES_EVENTO , true);
    $estados = TareaPeer::getAllEstadosEventos();
    $crt_aux = null;
    foreach($estados as $estado)
    {
      $campo = "estado_".$estado->getPrimaryKey();
      if (isset($this->filters[$campo]) && $this->filters[$campo] !== '')
      {
        if (!isset($crt_aux)) $crt_aux = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , $estado->getPrimaryKey());
        else $crt_aux->addOr($c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , $estado->getPrimaryKey()));
      }
    }
    if (isset($crt_aux)) $criterion_eventos->addAnd($crt_aux);
    
    if (isset($es_evento))
    {
      //una de las dos: tarea o evento
      if ($es_evento)
      {
        $c->add($criterion_eventos);
      }
      else
      {
        $c->add($criterion_tareas);
      }
    }
    else
    {
      $c->addOr($criterion_tareas);
      $c->addOr($criterion_eventos);
    }
    
  }
  
  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/tareas/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/tareas/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/tareas/sort'))
    {
      $this->getUser()->setAttribute('sort', 'fecha_inicio', 'sf_admin/tareas/sort');
      $this->getUser()->setAttribute('type', 'desc', 'sf_admin/tareas/sort');
    }
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/tareas/sort'))
    {
      $sort_column = TareaPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/tareas/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }
  
  protected function updateTareaFromRequest()
  {
    $tarea = $this->getRequestParameter('tarea');

    $this->tarea->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
    
    if (isset($tarea['id_usuario']))
    {
      $this->tarea->setIdUsuario($tarea['id_usuario'] ? $tarea['id_usuario'] : null);
    }
    
    if (isset($tarea['estado']))
    {
      $this->tarea->setEstado($tarea['estado']);
    }
    if (isset($tarea['resumen']))
    {
      $this->tarea->setResumen($tarea['resumen']);
    }
    if (isset($tarea['descripcion']))
    {
      $this->tarea->setDescripcion($tarea['descripcion']);
    }
    
    if (isset($tarea['fecha_inicio']['date']))
    {
      if ($tarea['fecha_inicio']['date'])
      {
        try
        {
          //rober
          $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($tarea['fecha_inicio']['date'], $this->getUser()->getCulture());
          $mi_date = new Date($value);
          $mi_date->setHours(0);
          $mi_date->setMinutes(0);
          $this->tarea->setFechaInicio($mi_date->getTimestamp());
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->tarea->setFechaInicio(null);
      }
    }
    
    if (isset($tarea['fecha_vencimiento']['date']))
    {
      if ($tarea['fecha_vencimiento']['date'])
      {
        try
        {
          //rober
          $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($tarea['fecha_vencimiento']['date'], $this->getUser()->getCulture());
          $mi_date = new Date($value);
          $mi_date->setHours("23");
          $mi_date->setMinutes("59");
          $this->tarea->setFechaVencimiento($mi_date->getTimestamp());
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->tarea->setFechaVencimiento(null);
      }
    }

    $this->tarea->setAvisarEmail(isset($tarea['avisar_email']) ? $tarea['avisar_email'] : null);
    $this->tarea->setAvisarEmailFin(isset($tarea['avisar_email_fin']) ? $tarea['avisar_email_fin'] : null);

    $this->tarea->setEsEvento(isset($tarea['es_evento']) ? $tarea['es_evento'] : null);

    if ($this->tarea->getEsEvento())
    {
      if (isset($tarea['id_estado_evento']))
      {
        $this->tarea->setIdEstadoTarea($tarea['id_estado_evento'] ? $tarea['id_estado_evento'] : null);
      }
    }
    else
    {
      if (isset($tarea['id_estado_tarea']))
      {
        $this->tarea->setIdEstadoTarea($tarea['id_estado_tarea'] ? $tarea['id_estado_tarea'] : null);
      }
    }
    
  }
  
  /**
  * Duplica la llamada con los parametros comunes.
  * @author Ana Martín
  * @version 26-02-09
  */  
  protected function duplicarTarea($tarea) {
  
      $nueva_tarea = new Tarea();
      $nueva_tarea->setIdEmpresa($tarea->getIdEmpresa());
      $nueva_tarea->setResumen($tarea->getResumen());         
      $nueva_tarea->setIdEstadoTarea(TareaPeer::ID_ESTADO_EVENTO_PLANEADO);    
      $nueva_tarea->setEsEvento(1); 
      
      return $nueva_tarea;
  }
  
  /**
  * Actualiza los datos de la tarea duplicada.
  * @version 26-02-09
  * @author Ana Martín
  */
  protected function updateDuplicarTareaFromRequest()
  {
    $tarea = $this->getRequestParameter('tarea');       
         
    $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($tarea['fecha_inicio']['date'], $this->getUser()->getCulture());
    $mi_date = new Date($value);
    $mi_date->setHours(isset($tarea['fecha_inicio']['hour']) ? $tarea['fecha_inicio']['hour'] : 0);
    $mi_date->setMinutes(isset($tarea['fecha_inicio']['minute']) ? $tarea['fecha_inicio']['minute'] : 0);
    $this->nueva_tarea->setFechaInicio($mi_date->getTimestamp());          
    
    if (isset($tarea['fecha_vencimiento'])) {
                   
      $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($tarea['fecha_vencimiento']['date'], $this->getUser()->getCulture());
      $mi_date = new Date($value);
      $mi_date->setHours(isset($tarea['fecha_vencimiento']['hour']) ? $tarea['fecha_vencimiento']['hour'] : 0);
      $mi_date->setMinutes(isset($tarea['fecha_vencimiento']['minute']) ? $tarea['fecha_vencimiento']['minute'] : 0);
      $this->nueva_tarea->setFechaVencimiento($mi_date->getTimestamp());   
    }
    else if (isset($tarea['duracion'])) {
      $duracion_minutos = $tarea['duracion'];
          
      $fecha_vencimiento = mktime( $mi_date->getHours(), $mi_date->getMinutes() + $duracion_minutos, 0, $mi_date->getMonth(), $mi_date->getDay(), $mi_date->getYear());

      $this->nueva_tarea->setFechaVencimiento(date('Y-m-d H:i', $fecha_vencimiento));
    }
    else {
      $this->nueva_tarea->setFechaVencimiento($mi_date->getTimestamp());
    }
   
        
    if (isset($tarea['id_usuario']))
    {
      $this->nueva_tarea->setIdUsuario($tarea['id_usuario']);
    }
    
  }


  
  
  protected function getTareaOrCreate($idtarea = 'id_tarea')
  {
    if (!$this->getRequestParameter($idtarea))
    {
      $tarea = new Tarea();
      $usuario_actual = Usuario::getUsuarioActual();
      if ($usuario_actual)
      {
        $tarea->setIdUsuario($usuario_actual->getIdUsuario());
      }
      
      if ($this->getRequestParameter('evento'))
      {
        $tarea->setEsEvento(true);
      }
    }
    else
    {
      $c = $this->getCriterio();
      $c->add(TareaPeer::ID_TAREA , $this->getRequestParameter($idtarea));
      $tareas = TareaPeer::doSelect($c);
      $tarea = isset($tareas[0]) ? $tareas[0] : null;
      $this->forward404Unless($tarea);
    }
    return $tarea;
  }
  
  protected function getTareaOr404($idtarea = 'id_tarea')
  {
    if (!$this->getRequestParameter($idtarea))
    {
      $this->forward404();
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(TareaPeer::ID_TAREA , $this->getRequestParameter($idtarea));
      $tarea = TareaPeer::doSelectOne($c);
      $this->forward404Unless($tarea);
    }
    return $tarea;
  }
  
  protected function getClienteOrNull($id_cliente = 'id_cliente')
  {
    if (!$this->getRequestParameter($id_cliente) || $this->getRequestParameter($id_cliente)=='')
    {
      $cliente = null;
    }
    else
    {
      $c = Cliente::getCriterioAlcance();
      $c->add($c->getNewCriterion(ClientePeer::ID_CLIENTE , $this->getRequestParameter($id_cliente)) );
      $cliente = ClientePeer::doSelectOne($c);
    }
    return $cliente;
  }
  
  protected function getFuenteDatosOrNull($id_fuente_datos = 'id_fuente_datos')
  {
    if (!$this->getRequestParameter($id_fuente_datos) || $this->getRequestParameter($id_fuente_datos)=='')
    {
      $fuente_datos = null;
    }
    else
    {
      $c = FuenteDatosPeer::getCriterioAlcance();
      $c->add($c->getNewCriterion(FuenteDatosPeer::ID_FUENTE_DATOS , $this->getRequestParameter($id_fuente_datos)) );
      $fuente_datos = FuenteDatosPeer::doSelectOne($c);
    }
    return $fuente_datos;
  }
  
  protected function getCriterio()
  {
    return TareaPeer::getCriterioAlcance();
  }
  
  
  protected function getLabels()
  {
    return array(
      'tarea{id_tarea}' => 'id',
      'tarea{id_usuario}' => 'usuario',
      'tarea{id_fuente_datos}' => 'fuente de datos',
      'tarea{id_cliente}' => 'cliente',
      'tarea{id_estado_tarea}' => 'estado tarea',
      'tarea{id_estado_evento}' => 'estado evento',
      'tarea{resumen}' => 'resumen',
      'tarea{descripcion}' => 'descripción',
      'tarea{fecha_inicio}' => 'Inicio',
      'tarea{fecha_vencimiento}' => 'Vencimiento',
      'tarea{es_evento}'    => 'es evento',
      'tarea{id_tipo_actividad}'    => 'tipo de actividad',
      'tarea{tipo_tarea}'    => 'tipo',
      'tarea{duracion}' => 'duración',
      'tarea{relacionado_con}' => 'Relacionado con',
      'tarea{id_campania}' => 'Campaña',
      'tarea{id_estado}' => 'Estado',
      'tarea{avisar_email}' => 'Avisar por email del inicio',
      'tarea{avisar_email_fin}' => 'Avisar por email del vencimiento',
      'tarea{objeto_relacionado}' => 'Relacionado Con',

      'campania{nombre}' => 'Nombre',
      'campania{descripcion}' => 'Descripción', 
      'campania{id_empresa}' => 'Empresa',
      
      'cliente{nombre}' => 'Nombre',
      'cliente{apellido1}' => 'Primer apellido',
      'cliente{apellido2}' => 'Segundo apellido',
      'cliente{direccion}' => 'Dirección',
      'cliente{poblacion}' => 'Población',
      'cliente{codigo_postal}' => 'Código postal',
      'cliente{telefono_fijo}' => 'Teléfono fijo',
      'cliente{telefono_movil}' => 'Teléfono móvil', 
      'cliente{email}' => 'e-mail',   
      'cliente{id_provincia}' => 'Provincia', 
    );
  }
  

}
