<?php

/**
 * NeoDate class
 * Completa las funcionalidades de las fechas.
 * 
 * @version 0.1
 * @author Neofis Nuevas Tecnologias.
 */
class NeoDate
 {
    
   /**
   * Función que dada una fecha en formato inglés te devuelve el timesamp.
   * @param date, fecha en formato ingles (Y-m-d H:i:s) o ('Y-m-d')
   * @return integer, timestamp de la fecha
   * @version 25-03-09
   * @author Ana Martín.
   */ 
   public function getTimeStamp($fecha) {
   
     $array_fecha_hora = explode(' ', $fecha);
     $array_fecha = explode('-', $array_fecha_hora[0]);
     $anio = $array_fecha[0];
     $mes = $array_fecha[1];
     $dia = $array_fecha[2];
     
     if (isset($array_fecha_hora[1])) {    
       $array_hora = explode(':', $array_fecha_hora[1]);
       $hora = $array_hora[0];
       $minuto = $array_hora[1];
       $segundo = $array_hora[2];
     }
     else {
       $hora = 0;
       $minuto = 0;
       $segundo = 0;
     }

     
     
     $fecha_time = mktime($hora, $minuto, $segundo, $mes, $dia, $anio); 
   
     return $fecha_time;
   }  



   /**
   * Devuelve la diferencia en dias entre dos fechas
   * @param fecha_inicial, fecha inicial en formato ingles (Y-m-d H:i:s) o ('Y-m-d')
   * @param fecha_final, fecha final en formato ingles (Y-m-d H:i:s) o ('Y-m-d')
   * @return integer, número de dias de diferencia entre las dos fechas
   * @version 25-03-09
   * @author Ana Martín.
   */    
   public function getDiferenciaDias($fecha_inicial, $fecha_final) {
       
     $fecha_inicial_time = $this->getTimeStamp($fecha_inicial);     
   
     $fecha_final_time = $this->getTimeStamp($fecha_final);
     
     $diferencia = $fecha_final_time - $fecha_inicial_time;
     
     $dias = floor($diferencia / 86400); 
     
     return $dias;
   
   
   }


  /**
  * Suma a la fecha el número de dias, meses, años, horas, minutos y segundos que se le indican.
  * @param fecha, fecha inicial en formato ingles (Y-m-d H:i:s) o (Y-m-d)
  * @param num_dias, número de dias que se le suma a la fecha, 0 si no se desean sumar días.
  * @param num_meses, número de meses que se le suma a la fecha, 0 si no se desean sumar meses.
  * @param num_year, número de años que se le suma a la fecha, 0 si no se desean sumar años.
  * @param num_horas, número de horas que se le suma a la fecha, 0 si no se desean sumar horas.
  * @param num_minutos, número de minutso que se le suma a la fecha, 0 si no se desean sumar minutos.
  * @param num_segundos, número de segundos que se le suma a la fecha, 0 si no se desean sumar segundos.
  * @return date, fecha final en formato timestamp
  * @version 06-04-09
  * @author Ana Martín
  */
  public function getFechaTotal($fecha, $num_dias, $num_meses = 0, $num_year = 0, $num_horas = 0, $num_minutos = 0, $num_segundos = 0) {

     $array_fecha_hora = explode(' ', $fecha);
     $array_fecha = explode('-', $array_fecha_hora[0]);
     $anio = $array_fecha[0];
     $mes = $array_fecha[1];
     $dia = $array_fecha[2];
     
     if (isset($array_fecha_hora[1])) {    
       $array_hora = explode(':', $array_fecha_hora[1]);
       $hora = $array_hora[0];
       $minuto = $array_hora[1];
       $segundo = $array_hora[2];
     }
     else {
       $hora = 0;
       $minuto = 0;
       $segundo = 0;
     }

     
     
     $fecha_time = mktime($hora + $num_horas, $minuto+$num_minutos, $segundo+$num_segundos, $mes+$num_meses, $dia + $num_dias, $anio + $num_year); 

     return $fecha_time;

  }
   
 }

?>
