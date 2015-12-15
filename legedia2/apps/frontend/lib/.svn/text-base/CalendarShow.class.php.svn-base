<?php

// PHP Calendar Class Version 1.4 (5th March 2001)
//  
// Copyright David Wilkinson 2000 - 2001. All Rights reserved.
// 
// This software may be used, modified and distributed freely
// providing this copyright notice remains intact at the head 
// of the file.
//
// This software is freeware. The author accepts no liability for
// any loss or damages whatsoever incurred directly or indirectly 
// from the use of this script. The author of this software makes 
// no claims as to its fitness for any purpose whatsoever. If you 
// wish to use this software you should first satisfy yourself that 
// it meets your requirements.
//
// URL:   http://www.cascade.org.uk/software/php/calendar/
// Email: davidw@cascade.org.uk


class CalendarShow
{
    /*
        Constructor for the Calendar class
    */
    function CalendarShow()
    {
    }
    
    
    /*
        Get the array of strings used to label the days of the week. This array contains seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function getDayNames()
    {
        return $this->dayNames;
    }
    

    /*
        Set the array of strings used to label the days of the week. This array must contain seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function setDayNames($names)
    {
        $this->dayNames = $names;
    }
    
    /*
        Get the array of strings used to label the months of the year. This array contains twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function getMonthNames()
    {
        return $this->monthNames;
    }
    
    /*
        Set the array of strings used to label the months of the year. This array must contain twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }
    
    function getDaysInColor()
    {
        return $this->daysInColor;
    }
    
    function setDaysInColor($dIc)
    {
        $this->daysInColor = $dIc;
    }
    
    function getDaysFree()
    {
        return $this->daysFree;
    }
    
    function setDaysFree($df)
    {
        $this->daysFree = $df;
    }
    
    function getTxtSummary()
    {
        return $this->txtSummary;
    }
    
    function setTxtSummary($txtS)
    {
        $this->txtSummary = $txtS;
    }
    
    /* 
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
      function getStartDay()
    {
        return $this->startDay;
    }
    
    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    function setStartDay($day)
    {
        $this->startDay = $day;
    }
    
    
    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function getStartMonth()
    {
        return $this->startMonth;
    }
    
    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }
    
    
    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */
    function getCalendarLink($month, $year)
    {
        return "";
    }
	
	
    
    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */
    /*Ana: Cambio la funcion para que me devuelva el link*/
    function getDateLink($day, $month, $year)
    {
    
   	if ($day < 10 and substr($day, 0,1) != "0") $day = "0".$day;   
   	if ($month < 10 and substr($month, 0,1) != "0") $month = "0".$month;   
    	if (isset($this->daysLinks[$year."-".$month."-".$day])) return $this->daysLinks[$year."-".$month."-".$day];
      else return "";
      
     
    }
    
 	/*Ana: Añado el método setDateLink para que devuelva el link de un día determinado.*/
 	function setDateLink($fecha, $link){
		$this->daysLinks[$fecha] = $link;			
 	}    

    /*
        Return the HTML for the current month
    */
    function getCurrentMonthView()
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"]);
    }
    

    /*
        Return the HTML for the current year
    */
    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"]);
    }
    
    
    /*
        Return the HTML for a specified month
    */
    function getMonthView($month, $year)
    {
	    $s = $this->getMonthHTML($month, $year);
	    $s .= "<script lang=\"Javascript\">";
			$s .= "function enviarFecha(fechahoy, fechamanana,mes,year) {";
			$ruta = UsuarioPeer::getRuta();
			$s .= "document.location.href = '".$ruta."/tareas/list?mes='+mes+'&year='+year+'&filters[fecha_inicio][from]='+fechahoy+'&filters[fecha_inicio][to]='+fechamanana+'&filter=filtrar';";
			$s .= "}";
			$s .= "</script>";
		 return $s;
    }
    
    /*Ana: Función que devuelve el mes actual y los meses anterior y posterior.*/
    function getThreeMonthView($month, $year)
    {
        return $this->getThreeMonthHTML($month, $year);
    }
    

    /*
        Return the HTML for a specified year
    */
    function getYearView($year)
    {
        return $this->getYearHTML($year);
    }
    
    
    
    /********************************************************************************
    
        The rest are private methods. No user-servicable parts inside.
        
        You shouldn't need to call any of these functions directly.
        
    *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12)
        {
            return 0;
        }
   
        $d = $this->daysInMonth[$month - 1];
   
        if ($month == 2)
        {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...
        
            if ($year%4 == 0)
            {
                if ($year%100 == 0)
                {
                    if ($year%400 == 0)
                    {
                        $d = 29;
                    }
                }
                else
                {
                    $d = 29;
                }
            }
        }
    
        return $d;
    }


    /*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $showYear = 1)
    {
        $s = "";
        
        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];        
        
    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));
    	
    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	
    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);
    	
    	if ($showYear == 1)
    	{
    	    $prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	    $nextMonth = $this->getCalendarLink($next[0], $next[1]);
    	}
    	else
    	{
    	    $prevMonth = "";
    	    $nextMonth = "";
    	  
    	}
    	
      $showDates = (sizeof($this->daysInColor)>0);
      $showDatesFree = (sizeof($this->daysFree)>0);
      if (strlen($month)==1) $mmonth = "0" . $month; else $mmonth = $month;
      
    	$header = $monthName . (($showYear > 0) ? " " . $year : "");
    	    	
    	$s .= "<table class=\"calendario\" >\n";
    	$s .= "<tr>\n";
    	$s .= "<td align=\"center\" valign=\"top\">". (($prevMonth == "") ? "&nbsp;" : "<a href=\"$prevMonth\">&lt;&lt;</a>")  . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeaderMonth\" colspan=\"5\">$header</td>\n"; 
    	$s .= "<td align=\"center\" valign=\"top\">" . (($nextMonth == "") ? "&nbsp;" : "<a href=\"$nextMonth\">&gt;&gt;</a>")  . "</td>\n";
    	$s .= "</tr>\n";
    	
    	$s .= "<tr>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+1)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+2)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+3)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+4)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+5)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\">" . $this->dayNames[($this->startDay+6)%7] . "</td>\n";
    	$s .= "</tr>\n";
    	
    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;
    	while ($d > 1)
    	{
    	    $d -= 7;
    	}

        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());
    	
    	$s1 = "";
    	$algun_sumario = false;
    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<tr>\n";       
    	    
    	    for ($i = 0; $i < 7; $i++)
    	    {
    	    	/* Ana: Quito esto porque los pasteleros no tienen ningún día festivo
    	       if (in_array($i,$this->weekDayFree))  $class = "weekDayFree";
    	       else{*/
    	        if (strlen(strval($d))==1) $dd= "0" . strval($d); else $dd = $d;
    	        $fecha = $year."-".$mmonth."-".$dd;
              
                //if ($fecha == date("Y-m-d")){
                   //$s1 .= "<tr>\n<td valign=\"top\" colspan=\"2\" class=\"hoy\" style=\"background-color: #CCCCCC\" align=\"right\">HOY EN ADELANTE</td></tr>\n";
                //}
                
    	        $fechahoy = date('d/m/Y', mktime(0,0,0, $month, $d, $year));
		$fechamanana =  date('d/m/Y', mktime(0,0,0, $month, $d+1, $year));  
						    
    	        if ($showDatesFree){
                if (isset($this->daysFree[$fecha])){
                  if ($fecha == date("Y-m-d")) $class = "hoy";
                  else $class = "summaryNumber2";
                  //$s1 .= "<tr>\n<td valign=\"top\" class=\"".$class."\"><a href=\"#\" onclick=\"enviarFecha('".$fechahoy."','".$fechamanana."','".$month."','".$year."')\" >".$dd."</a></td><td>".$this->daysFree[$fecha]."</td></tr>\n";
                  $s1 .= "<tr>\n<td valign=\"top\" style=\"padding-top: 7px; border: 0px; border-bottom: 0px; font-size: 12px;\"><span style=\"font-weight: bold; text-decoration: underline;\"><span class=\"".$class."\"><a href=\"#\" onclick=\"enviarFecha('".$fechahoy."','".$fechamanana."','".$month."','".$year."')\" style=\"text-decoration:none\">".$dd."</a></span> ".strtoupper($header).":</span> ".$this->daysFree[$fecha]."</td></tr>\n";
                  $algun_sumario = true;
                }
              }
              
    	        if ($showDates && !isset($this->daysFree[$fecha])){
    	          if (isset($this->daysInColor[$fecha])){
                  if ($fecha == date("Y-m-d")) $class = "hoy";
                  else $class = "summaryNumber";
    	            
                  if (!is_array($this->daysInColor[$fecha])) $this->daysInColor[$fecha] = array($this->daysInColor[$fecha]);
    	           
    	           //$s1 .= "<tr>\n<td rowspan=\"".sizeof($this->daysInColor[$fecha])."\" valign=\"top\" class=\"".$class."\"><a href=\"#\" onclick=\"enviarFecha('".$fechahoy."','".$fechamanana."','".$month."','".$year."')\" >".$dd."</a></td>\n";
    	           $isFirst = true;
    	           foreach ($this->daysInColor[$fecha] as $label) {
                    $s1 .= "<tr>\n<td valign=\"top\" style=\"padding-top: 7px; border: 0px; font-size: 12px;\"><span style=\"font-weight: bold; text-decoration: underline;\"><span class=\"".$class."\"><a href=\"#\" onclick=\"enviarFecha('".$fechahoy."','".$fechamanana."','".$month."','".$year."')\" style=\"text-decoration:none\">".$dd."</a></span> ".strtoupper($header).":</span> ".$label."</td></tr>\n";
    	            //if (!$isFirst) $s1 .= "<tr>\n";
                  //$s1 .= "<td class=\"summaryLabel\" ></td>\n</tr>\n";
                  $isFirst = false;
                 }
    	           //$s1 .= "</tr>\n";
    	           $algun_sumario = true;
    	           
    	           $class = "calendarShow";
    	          } else $class = "calendarDay";
              }
    	        elseif (!isset($this->daysFree[$fecha])) $class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarioToday" : "calendarDay";
    	      /* Fin Ana.    }   */
    	       
    	        $s .= "<td class=\"$class\" align=\"right\" valign=\"top\">";       
    	        if ($d > 0 && $d <= $daysInMonth)
    	        {
    	          $link = $this->getDateLink($d, $month, $year);
    	           /*Ana: Añado un link de filtro por día.*/
                    if ($link == 1) $s.= "<a href=\"#\" onclick=\"enviarFecha('".$fechahoy."','".$fechamanana."','".$month."','".$year."')\" >$d</a>";
                    else if ($link != "") $s .= "<a href=\"$link\">$d</a>";
                    else $s .= $d; 
    	        }
    	        else
    	        {
    	            $s .= "&nbsp;";
    	        }
      	        $s .= "</td>\n";       
        	    $d++;
    	    }
    	    $s .= "</tr>\n";    
    	}
    	
    	$s .= "</table>\n";
    	
    	if ($algun_sumario) {
        $this->txtSummary .= "<table class=\"summary\" style=\"border: 0px; background-color: white; width: 85%\" \border=\"0\" cellpadding=\"0\" cellspaccing=\"0\">\n";
        //$this->txtSummary .= "<td valign=\"top\" class=\"summaryHeader\" colspan=\"5\">$header</td>\n";
        $this->txtSummary .= $s1;
        $this->txtSummary .= "</table>\n"; 
      }
    	return $s;  	
    }

	 /*Ana: Función que muestra 3 meses. El anterior y el posterior al mes dado como inicio.*/    
    function getThreeMonthHTML ($m, $year) {
    	  
    	  $s = "";
    	  $anterior = $m-1;  $posterior = $m+1;
        $yearAnterior = $year; $yearPosterior = $year;
        if ($m==1) {
				$anterior = 12; $yearAnterior = $year-1;        
        }
        else if ($m == 12) {
				$posterior = 1; $yearPosterior = $year+1;        
        }
    	  
    	  $s .= "<table class=\"calendario\" cellspacing=\"0\" style=\"border:0px !important;\">\n";
        $s .= "<tr  >";
        
        $web = UsuarioPeer::getRuta();/*sfContext::getInstance()->getUser()->getAttribute('ruta');*/
        $ruta = $web."/tareas"; 
    	  
    	  $s .= "<td class=\"calendarHeaderYear\" align=\"center\" rowspan=\"2\" >&nbsp;<a href='".$ruta."/list?mes=".$anterior."&year=".$yearAnterior."'><img  src='".dirname($web)."/images/icons/previous.png' alt='anterior' title='anterior'></a>&nbsp;&nbsp;&nbsp;</td>\n";
    	  $s .= "<td class=\"calendarHeaderYear\"><a href='".$ruta."/list?mes=".date('m')."&year=".date('Y')."'><img  src='".dirname($web)."/images/icons/calendar_view_day.png' alt='hoy' title='hoy'></a></td>";
        $s .= "<td class=\"calendarHeaderYear\" valign=\"top\" align=\"center\">" . $year ."</td>\n";
        $s .= "<td class=\"calendarHeaderYear\">&nbsp;</td>";
    	  $s .= "<td class=\"calendarHeaderYear\" align=\"center\" rowspan=\"2\" >&nbsp;&nbsp;&nbsp;<a href='".$ruta."/list?mes=".$posterior."&year=".$yearPosterior."'><img  src='".dirname($web)."/images/icons/next.png' alt='siguiente' title='siguiente'></a></td>\n";
    	  
    	   	  
    	  
        $s .= "</tr>\n";
        $s .= "<tr>";   
           
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML($anterior, $yearAnterior, 0) ."</td>\n";
        $this->lookSummary();        
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML($m, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML($posterior, $yearPosterior, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "</tr>\n";        
        $s .= "</table>\n";        
      
				$s .= "<script lang=\"Javascript\">";
				$s .= "function enviarFecha(fechahoy, fechamanana,mes,year) {";
				$s .= "	document.getElementById(\"filters_fecha_inicio_from\").value= fechahoy;";
				$s .= "	document.getElementById(\"filters_fecha_inicio_to\").value= fechamanana;";
				$s .= "	document.getElementById(\"filtro_calendario\").value= 1;";
				$s .= "	document.getElementById(\"mes\").value= mes;";
				$s .= "	document.getElementById(\"year\").value= year;";
				$s .= "	document.form_filtros.submit();";
				$s .= "}";
				$s .= "</script>";
				
        return $s;
    }
    
    /*
        Generate the HTML for a given year
    */
    function getYearHTML($year)
    {
      global $ind,$tamSummary;
      
        $s = "";
    	  $prev = $this->getCalendarLink(0, $year - 1);
    	  $next = $this->getCalendarLink(0, $year + 1);
        
        $tamSummary = strlen($this->txtSummary);
        $ind = 0;
        $this->txtSummary .= "<table border=\"0\" width=\"100%\"><tr><td valign=\"top\">\n";
        
        $s .= "<table class=\"calendario\" border=\"0\">\n";
        $s .= "<tr>";
    	  $s .= "<td align=\"center\" valign=\"top\" align=\"left\">" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\">&lt;&lt;</a>")  . "</td>\n";
        $s .= "<td class=\"calendarHeaderYear\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $year . " - " . ($year + 1) : $year) ."</td>\n";
    	  $s .= "<td align=\"center\" valign=\"top\" align=\"right\">" . (($next == "") ? "&nbsp;" : "<a href=\"$next\">&gt;&gt;</a>")  . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "<td class=\"month\" valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, 0) ."</td>\n";
        $this->lookSummary();
        $s .= "</tr>\n";
        $s .= "</table>\n";
        
        $this->txtSummary .= "</td></tr></table>";
        return $s;
    }

    function lookSummary(){
      global $ind,$tamSummary;
      
      if ($tamSummary != strlen($this->txtSummary)){
        $ind++;
        $this->txtSummary .= "</td>";
        if (($ind % 2 == 0) && ($ind != 0)) $this->txtSummary .= "</tr><tr>";
        $this->txtSummary .= "<td valign=\"top\">";
        $tamSummary = strlen($this->txtSummary);
      }
    }
    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */
    function adjustDate($month, $year)
    {
        $a = array();  
        $a[0] = $month;
        $a[1] = $year;
        
        while ($a[0] > 12)
        {
            $a[0] -= 12;
            $a[1]++;
        }
        
        while ($a[0] <= 0)
        {
            $a[0] += 12;
            $a[1]--;
        }
        
        return $a;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    var $startDay = 1;

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */
    var $startMonth = 1;

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */
    var $dayNames = array("D", "L", "M", "X", "J", "V", "S");
    
    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */
    var $monthNames = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                            
                            
    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
    var $daysInColor = array();
    
    var $weekDayFree = array(5,6);
    
    var $daysFree = array();
      
    var $txtSummary = "";
}

?>

