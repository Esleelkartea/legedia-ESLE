<?php

/**
 * Subclass for performing query and update operations on the 'tarea' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TareaPeer extends BaseTareaPeer
{
  const ID_ESTADO_TAREA_PLANEADO = 60;
  const ID_ESTADO_TAREA_COMPLETADA = 63;
  const ID_ESTADO_EVENTO_PLANEADO = 64;
  const ID_ESTADO_EVENTO_REALIZADO = 66;
  
  /**
  * Función que devuelve una lista con los estados de las tareas que no son eventos.
  * @return array, lista de objetos de tipo parametro
  * @version 10-02-09
  * @author Ana Martín
  */
  public static function getAllEstadosTareas() {
    $c = new Criteria();
    $c->add(ParametroPeer::TIPOPARAMETRO, '_ESTADO_TAREA_');
    $c->add(ParametroPeer::SI_NO, 0);
    $c->addAscendingOrderByColumn(ParametroPeer::NUMERO);
    $c->addAscendingOrderByColumn(ParametroPeer::NOMBRE);
    $lista = ParametroPeer::doSelect($c);
    
    return $lista;
  
  }
  
   /**
  * Función que devuelve una lista con los estados de las tareas que son eventos.
  * @return array, lista de objetos de tipo parametro
  * @version 10-02-09
  * @author Ana Martín
  */
  public static function getAllEstadosEventos() {
    $c = new Criteria();
    $c->add(ParametroPeer::TIPOPARAMETRO, '_ESTADO_TAREA_');
    $c->add(ParametroPeer::SI_NO, 1);
    $c->addAscendingOrderByColumn(ParametroPeer::NUMERO);
    $c->addAscendingOrderByColumn(ParametroPeer::NOMBRE);
    $lista = ParametroPeer::doSelect($c);
    
    return $lista;
  }
  
  public static function getCriterioAlcance()
  {
    $c_base = sfContext::getInstance()->getUser()->getAttribute('tareas',Tarea::getCriterioAlcanceVacio(),'alcance');
    $c = clone $c_base;
    return $c;
  }
  
  public static function getCriterioTareasPendientes()
  {
    $c = clone sfContext::getInstance()->getUser()->getAttribute('tareas',Tarea::getCriterioAlcanceVacio(),'alcance');
    $cr_1 = $c->getNewCriterion(TareaPeer::ES_EVENTO , null , Criteria::ISNULL);
    $cr_2 = $c->getNewCriterion(TareaPeer::ES_EVENTO , false);
    $cr_1->addOr($cr_2);
    $c->add($cr_1);
    $c->addAnd(self::getCriterionPendientes());
    return $c;
  }
  
  public static function getCriterioEventosPendientes()
  {
    $c = clone sfContext::getInstance()->getUser()->getAttribute('tareas',Tarea::getCriterioAlcanceVacio(),'alcance');
    $c->add(TareaPeer::ES_EVENTO , true);
    $c->addAnd(self::getCriterionPendientes());
    return $c;
  }

  public static function getCriterionPendientes()
  {
    //devuelve un CRITERION
    $hoy = new Date();
    $c = new Criteria();
    
    $cr1 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , null , Criteria::ISNOTNULL);
    $cr2 = $c->getNewCriterion(TareaPeer::FECHA_INICIO , $hoy->toString(FMT_DATETIMEMYSQL) , Criteria::LESS_EQUAL);
    $cr3 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , self::ID_ESTADO_TAREA_COMPLETADA, Criteria::NOT_EQUAL);
    $cr4 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , self::ID_ESTADO_EVENTO_REALIZADO, Criteria::NOT_EQUAL);
    $cr3->addAnd($cr4);
    $cr1->addAnd($cr3);
    $cr1->addAnd($cr2);
    
    return $cr1;
  }

  /*Ana: no tengo en cuenta si son los ya pasados.*/  
  public static function getCriterionPendientesConFuturo()
  {
    //devuelve un CRITERION
    $hoy = new Date();
    $c = new Criteria();
    
    $cr1 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , null , Criteria::ISNOTNULL);   
    $cr3 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , self::ID_ESTADO_TAREA_COMPLETADA, Criteria::NOT_EQUAL);
    $cr4 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , self::ID_ESTADO_EVENTO_REALIZADO, Criteria::NOT_EQUAL);
    $cr3->addAnd($cr4);
    $cr1->addAnd($cr3);
   
    
    return $cr1;
  }
 
  
  public static function countTareasPendientes()
  {
    $c = TareaPeer::getCriterioAlcance();
    $hoy = new Date();
    $hoy_str = $hoy->toString(FMT_DATEMYSQL);
    $c->addAnd(TareaPeer::FECHA_INICIO , $hoy_str , Criteria::LESS_EQUAL);
    $c->addAnd(TareaPeer::FECHA_VENCIMIENTO , $hoy_str , Criteria::GREATER_EQUAL);
    //$c->addAnd();//tomar en cuenta los estados?
    $cuantas = TareaPeer::doCount($c);//param 2: distinct.
    return $cuantas;
  }
  
  public static function getCriterionReunionesRealizadas()
  {
    $c = new Criteria();
    $cr1 = $c->getNewCriterion(TareaPeer::ID_TIPO_ACTIVIDAD , TipoActividadPeer::getIdTipoActividadReunion());
    $cr2 = $c->getNewCriterion(TareaPeer::ID_ESTADO_TAREA , self::ID_ESTADO_EVENTO_REALIZADO);
    $cr1->addAnd($cr2);
    return $cr1;
  }
  
  public static function createCalendarioMes($mes,$ano,$modo) {
 	 //include_once('CalendarShow.class.php');
   $cal = new CalendarShow;
		
	 $fecha = new Date();
	 $fecha->setDay(1); $fecha->setMonth($mes); $fecha->setYear($ano);
	 $fecha_uno = $fecha->toString(FMT_DATEMYSQL);
	 $fecha->addMonths(1); $fecha->addDays(-1);
	 $fecha_dos = $fecha->toString(FMT_DATEMYSQL);
	 
	 $diasEvento = array();
	 $diasTareas = array();    
    
	 $c1= TareaPeer::getCriterioAlcance();
  
   $crit0 = $c1->getNewCriterion(TareaPeer::FECHA_INICIO, $fecha_uno." 00:00:00", Criteria::GREATER_EQUAL);
   $crit1 = $c1->getNewCriterion(TareaPeer::FECHA_INICIO, $fecha_dos." 23:59:59", Criteria::LESS_EQUAL);
   $crit0->addAnd($crit1);
    
   $crit2 = $c1->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $fecha_uno." 00:00:00", Criteria::GREATER_EQUAL);
   $crit3 = $c1->getNewCriterion(TareaPeer::FECHA_VENCIMIENTO, $fecha_dos." 23:59:59", Criteria::LESS_EQUAL);
   $crit2->addAnd($crit3);

   $crit0->addOr($crit2);

   $c1->add($crit0);
	 
	 $c1->setDistinct();
	 
	 $dias = TareaPeer::doSelect($c1);
	
	 $ruta = UsuarioPeer::getRuta();
	 foreach ($dias as $dia) {
            $fecha_inicio = $dia->getFechaInicio('Y-m-d');
            $fecha_fin = $dia->getFechaVencimiento('Y-m-d');

            if ($fecha_inicio == $fecha_fin) {
                if ($dia->getEsEvento() == '1') {
                    if (!isset($diasEvento[$fecha_inicio])) $diasEvento[$fecha_inicio] = "";
                    //$diasEvento[$fecha_inicio] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_inicio] .= $dia->getResumen();
                }
                else {
                    if (!isset($diasTareas[$fecha_inicio])) $diasTareas[$fecha_inicio] = "";
                    //$diasTareas[$fecha_inicio] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_inicio] .= $dia->getResumen();
                }
            }
            else{
                if ($dia->getEsEvento() == '1') {
                    if (!isset($diasEvento[$fecha_inicio])) $diasEvento[$fecha_inicio] = "";
                    if (!isset($diasEvento[$fecha_fin])) $diasEvento[$fecha_fin] = "";

                    //$diasEvento[$fecha_inicio] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Inicio Evento: ".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_inicio] .= $dia->getResumen();
                    //$diasEvento[$fecha_fin] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Vencimiento Evento: ".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_fin] .= $dia->getResumen();
                }
                else {
                    if (!isset($diasTareas[$fecha_inicio])) $diasTareas[$fecha_inicio] = "";
                    if (!isset($diasTareas[$fecha_fin])) $diasTareas[$fecha_fin] = "";
                    
                    //$diasTareas[$fecha_inicio] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Inicio Tarea: ".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_inicio] .= $dia->getResumen();
                    //$diasTareas[$fecha_fin] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Vencimiento Tarea: ".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_fin] .= $dia->getResumen();
                }
            }
            
            /*
            if ($dia->getEsEvento() == '1') {
                if (isset($diasEvento[$fecha]))
                    $diasEvento[$fecha] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
                else
                    $diasEvento[$fecha] = "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";		 		
            }
            else {
		if (isset($diasTareas[$fecha]))
                    $diasTareas[$fecha] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
		else
		    $diasTareas[$fecha] = "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
            }
            */
            $filters = array();
	    $filters['fecha_inicio']['from'] = $dia->getFechaInicio('d/m/Y');
	    $filters['fecha_inicio']['to'] = $dia->getFechaVencimiento('d/m/Y');
		
	    if ($modo) {
                if ($fecha_inicio != $fecha_fin) {
                    $cal->setDateLink($fecha_inicio,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                    $cal->setDateLink($fecha_fin,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                }else{
                    $cal->setDateLink($fecha_inicio,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                }
            }
	    else {
                if ($fecha_inicio != $fecha_fin) {
                    $cal->setDateLink($fecha_inicio, "1");
                    $cal->setDateLink($fecha_fin, "1");
                }else{
                    $cal->setDateLink($fecha_inicio, "1");
                }
            }
	 }	 

	 $cal -> setDaysInColor ($diasEvento);
	 $cal -> setDaysFree ($diasTareas);   
  
  	return $cal;
  }
  
  /*Ana: creación del calendario. Devuelve el calendario. Faltaría asignarle la vista para que sea utilizable desde otros módulos*/
  public static function createCalendario($modo) {
 	 //include_once('CalendarShow.class.php');
   $cal = new CalendarShow;
		
	 $diasEvento = array();
	 $diasTareas = array();    
    
	 $c1= TareaPeer::getCriterioAlcance();
	 $c1->addAnd(TareaPeer::getCriterionPendientesConFuturo());
	 $dias = TareaPeer::doSelect($c1);
	
	 $ruta = UsuarioPeer::getRuta();
	 foreach ($dias as $dia) {
            $fecha_inicio = $dia->getFechaInicio('Y-m-d');
            $fecha_fin = $dia->getFechaVencimiento('Y-m-d');

            if ($fecha_inicio == $fecha_fin) {
                if ($dia->getEsEvento() == '1') {
                    if (!isset($diasEvento[$fecha_inicio])) $diasEvento[$fecha_inicio] = "";
                    //$diasEvento[$fecha_inicio] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_inicio] .= $dia->getResumen();
                }
                else {
                    if (!isset($diasTareas[$fecha_inicio])) $diasTareas[$fecha_inicio] = "";
                    //$diasTareas[$fecha_inicio] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_inicio] .= $dia->getResumen();
                }
            }
            else{
                if ($dia->getEsEvento() == '1') {
                    if (!isset($diasEvento[$fecha_inicio])) $diasEvento[$fecha_inicio] = "";
                    if (!isset($diasEvento[$fecha_fin])) $diasEvento[$fecha_fin] = "";

                    //$diasEvento[$fecha_inicio] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Inicio Evento: ".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_inicio] .= $dia->getResumen();
                    //$diasEvento[$fecha_fin] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Vencimiento Evento: ".$dia->getResumen()."</a></div>";
                    $diasEvento[$fecha_fin] .= $dia->getResumen();
                }
                else {
                    if (!isset($diasTareas[$fecha_inicio])) $diasTareas[$fecha_inicio] = "";
                    if (!isset($diasTareas[$fecha_fin])) $diasTareas[$fecha_fin] = "";

                    //$diasTareas[$fecha_inicio] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Inicio Tarea: ".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_inicio] .= $dia->getResumen();
                    //$diasTareas[$fecha_fin] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">Vencimiento Tarea: ".$dia->getResumen()."</a></div>";
                    $diasTareas[$fecha_fin] .= $dia->getResumen();
                }
            }
            /*
		 if ($dia->getEsEvento() == '1') {	 	
		 	
		 	if (isset($diasEvento[$fecha])) 
		 		$diasEvento[$fecha] .= "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
		 	else 
		 		$diasEvento[$fecha] = "<div style=\"background-color: #4078B5; color: #ffffff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";
		 		
		 }	
		 else { 	
		 
		 	if (isset($diasTareas[$fecha])) 
		 		$diasTareas[$fecha] .= "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";		 	
		 	else 
		 		$diasTareas[$fecha] = "<div style=\"background-color: #76BB5F; color: #fff;\"><a href=\"".$ruta."/tareas/show/?id_tarea=".$dia->getIdTarea()."\" style=\"color: #ffffff;\">".$dia->getResumen()."</a></div>";		 	
		 	
		 }
             */
		$filters = array();
		$filters['fecha_inicio']['from'] = $dia->getFechaInicio('d/m/Y');
		$filters['fecha_inicio']['to'] = $dia->getFechaInicio('d/m/Y');

	    if ($modo) {
                if ($fecha_inicio != $fecha_fin) {
                    $cal->setDateLink($fecha_inicio,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                    $cal->setDateLink($fecha_fin,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                }else{
                    $cal->setDateLink($fecha_inicio,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);
                }
            }
	    else {
                if ($fecha_inicio != $fecha_fin) {
                    $cal->setDateLink($fecha_inicio, "1");
                    $cal->setDateLink($fecha_fin, "1");
                }else{
                    $cal->setDateLink($fecha_inicio, "1");
                }
            }
            /*
		if ($modo) $cal->setDateLink($fecha,  "tareas/list?mes=".$dia->getFechaInicio('m')."&year=".$dia->getFechaInicio('Y')."&filters=".$filters);	 
		else $cal->setDateLink($fecha, "1");
             */
	 }	 
	
	 $cal -> setDaysInColor ($diasEvento);
	 $cal -> setDaysFree ($diasTareas);   
  
  	return $cal;
  }
}
