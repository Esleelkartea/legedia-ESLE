<?php

/**
 * panel actions.
 *
 * @package    NeoCRM
 * @subpackage panel
 * @author     Ana Martín
 * @version    10-02-09
 */
class panelActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->mensajes = new sfPropelPager('MensajeDestino', sfConfig::get('app_listas_panel'));
    $c_mensajes = $this->getCriteriaMensajesEntrada();
    $this->mensajes->setCriteria($c_mensajes);
    $this->mensajes->setPeerMethod('doSelectJoinAll');
    $this->mensajes->setPage(1);
    $this->mensajes->init();
    
    $this->labels = $this->getLabels();
    
    $this->labels = $this->getLabels();
    
     /*Ana: Código para que se vea el calendario.*/	    
   	//include_once('CalendarShow.class.php');
    $cal = TareaPeer::createCalendarioMes(date('m'),date('Y'),0);     
    $this->calendarMes = $cal->getMonthView(date('m'),date('Y'));
    $this->sumario = $cal->getTxtSummary();
  }
  
  public function executeEmpresa_sesion()
  {
    $this->empresa = $this->getEmpresaOr404();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      //Usuario::logAjax(__FILE__ , __CLASS__ , __FUNCTION__ , print_r("es POST", true));
      $usuario_actual = Usuario::getUsuarioActual();
      $algo = $usuario_actual->setEmpresaSesion($this->empresa);
      //sfContext::getInstance()->getUser()->setAttribute('empresa_sesion' , $empresa , 'sesion')
      //Usuario::logAjax(__FILE__ , __CLASS__ , __FUNCTION__ , print_r($algo, true));
      $this->getUser()->setFlash('notice', 'La empresa se ha seleccionado correctamente');
      
      return $this->redirect('panel/index');
    }
    else
    {
      return $this->redirect('panel/index');
    }
  }
  
  
  protected function getEmpresaOr404($id_empresa = 'id_empresa')
  {
    if (!$this->getRequestParameter($id_empresa))
    {
      return $this->forward404();
    }
    else
    {
      //$c = $this->getCriteriaEmpresas();
      //$c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter($id_empresa));
      $empresa = EmpresaPeer::retrieveByPk($this->getRequestParameter($id_empresa));
      $this->forward404Unless($empresa);
      return $empresa;
    }
  }
  
  
  protected function getCriteriaMensajesEntrada()
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
  
  protected function getCriteriaEmpresas()
  {
    $c = EmpresaPeer::getCriterioAlcance();
    return $c;
  }

  
  protected function getLabels()
  {
    return array(
      'mensaje{id_usuario}' => 'enviado por',
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
      
    );
  }
 
  function executeCambiarcalendario() {
  
 
	$mes = $this->getRequestParameter('mes');
	$year = $this->getRequestParameter("year");
	
   //include_once('CalendarShow.class.php');
   $cal = TareaPeer::createCalendarioMes($mes,$year,0);     
  
   $this->calendarioMes = $cal->getMonthView($mes,$year);
   $this->sumario = $cal->getTxtSummary();
   $this->mes = $mes;
   $this->year = $year;
  
  } 
}
