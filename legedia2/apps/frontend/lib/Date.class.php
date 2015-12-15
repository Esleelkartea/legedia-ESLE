<?php
/**
 * Date class
 * provides an object oriented way to manipulate date and time
 * 
 * @BUGS As Date class uses Unix timetamp underlyingly, Date is only functionning on period :
 * 01 Jan 1970 00:00:00 +0000 to 19 Jan 2038 03:14:07 +0000
 * @version 0.5
 */

define('FMT_DATEES', '%d/%m/%Y');
define('FMT_DATEESG', '%d-%m-%Y');
define('FMT_DATETIMEES', '%d/%m/%Y %H:%M:%S');
define('FMT_DATETIMEESG', '%d-%m-%Y %H:%M:%S');
define('FMT_DATETIMEESGSS', '%d-%m-%Y %H:%M');
define('FMT_DATEUS', '%m/%d/%Y');
define('FMT_DATEISO', '%Y%m%dT%H%M%S');
define('FMT_DATELDAP', '%Y%m%d%H%M%SZ');
define('FMT_DATETIMEMYSQL', '%Y-%m-%d %H:%M:%S');
define('FMT_DATEMYSQL', '%Y-%m-%d');
define('FMT_DATEENAVISION', '%d%m%Y');
define('FMT_DATERFC822', '%a, %d %b %Y %H:%M:%S');
define('FMT_TIME', '%H:%M');
define('FMT_MYTIME', '%H:%M:%S');//AÑADIDO!
define('WDAY_SUNDAY', 0);
define('WDAY_MONDAY', 1);
define('WDAY_TUESDAY', 2);
define('WDAY_WENESDAY', 3);
define('WDAY_THURSDAY', 4);
define('WDAY_FRIDAY', 5);
define('WDAY_SATURDAY', 6);
define('SEC_MINUTE', 60);
define('SEC_HOUR', 3600);
define('SEC_DAY', 86400);

class Date
 {
    /**
     * unix timestamp
     */
     protected $ts;
     protected $Y;
     protected $M;
     protected $D;
     protected $h;
     protected $m;
     protected $s;
    /**
     * 
     * @scope protected
     */
     protected $change = 0; // 1 if date needs recalculation
    
     function __construct($ts = "")
    
    
    {
         if ($ts) {
            $this -> setTimestamp($ts);
             } else {
            $this -> setTimestamp(time());
             } 
        } 
         
    function fromSpanishDatetime($datetime)
    {
        
         if (! preg_match("/^(\d{2})-?(\d{2})-?(\d{4}) ?(\d{2}):?(\d{2}):?(\d{2})(.?)$/", $datetime, $a))
             {
            if (! preg_match("/^(\d{2})\/?(\d{2})\/?(\d{4}) ?(\d{2}):?(\d{2}):?(\d{2})(.?)$/", $datetime, $a)) return null;
             } 
        // $obj = new Date();
        $this -> setDate($a[3], $a[2], $a[1]);
         $this -> setTime($a[4], $a[5], $a[6]);
        
        
        
         } 
    
    function fromSpanishDatetimeWS($datetime)
    
    
    {
        
         if (! preg_match("/^(\d{2})-?(\d{2})-?(\d{4}) ?(\d{2}):?(\d{2})(.?)$/", $datetime, $a))
             {
            if (! preg_match("/^(\d{2})\/?(\d{2})\/?(\d{4}) ?(\d{2}):?(\d{2})(.?)$/", $datetime, $a)) return null;
             } 
        // $obj = new Date();
        $this -> setDate($a[3], $a[2], $a[1]);
         $this -> setTime($a[4], $a[5], 00);
        
        
        
         } 
    
    function fromSpanishDate($date)
    
    
    {
        
         if (! preg_match("/^(\d{2})-?(\d{2})-?(\d{4})(.?)$/", $date, $a))
             {
            if (! preg_match("/^(\d{2})\/?(\d{2})\/?(\d{4})(.?)$/", $date, $a)) return null;
             } 
        // $obj = new Date();
        $this -> setDate($a[3], $a[2], $a[1]);
         $this -> setTime(0, 0, 0);
        
         } 
    

    function fromRareDate($date)
    
    
    {
        
         if (! preg_match("/^(\d{2})-?(\d{2})-?(\d{4})(.?)$/", $date, $a))
             {
            if (! preg_match("/^(\d{2})\/?(\d{2})\/?(\d{4})(.?)$/", $date, $a)) return null;
             } 
        // $obj = new Date();
        $this -> setDate($a[3], $a[1], $a[2]);
         $this -> setTime(0, 0, 0);
        
         } 
    
    function fromDate($date)
    {
        
         if (! preg_match("/^(\d{4})-?(\d{2})-?(\d{2})(.?)$/", $date, $a))
             {
           if (! preg_match("/^(\d{2})-?(\d{2})-?(\d{2})(.?)$/", $date, $a))
               {
            return null;
            }
             }
          
        // $obj = new Date();
        $this -> setDate($a[1], $a[2], $a[3]);
         $this -> setTime(0, 0, 0);
        
         } 
    /**
     * Build a date from an MYSQL datetime string
     * 
     * @params $datetime string the iso-X datetime with both date and time components
     * @static 
     * @factory 
     * @return a Date object if ok, NULL otherwise
     * 
     * tolerant: accepts format variants with or without separators: "-" for date and ":" for time
     * 	20010801123059 => OK
     * 	20010801 123059Z => OK
     * 	2001-08-01 12:30:59 => OK
     * 	20010801 12:30:59Z => OK
     * 2001-08-01 => error
     * 2001-08-01T01:30 => error
     * 2001-08-01T1:30:59 => error
     * 	timezone code is yet ignored ( not handled )
     */
    function fromDatetime($datetime, $vacio = false)
    
    
    {
         if (! preg_match("/^(\d{4})-?(\d{2})-?(\d{2}) ?(\d{2}):?(\d{2}):?(\d{2})(.?)$/", $datetime, $a))
             {
            if ($vacio) {
                $this -> setDate(0, 0, 0);
                 $this -> setTime(0, 0, 0);
                 } 
            return null;
             } 
        // $obj = new Date();
        $this -> setDate($a[1], $a[2], $a[3]);
         $this -> setTime($a[4], $a[5], $a[6]);
    } 
    
  static public function convert_format($dateformat="d/m/Y", $ret_fomat="Y-m-d", $date) {
    //Reglas de conversion de tipos
    $dateformat=trim($dateformat);
    $dateformat=str_replace ('\'','',$dateformat);
    $dateformat=str_replace ('dd','d',$dateformat);
    $dateformat=str_replace ('MM','m',$dateformat);
    $dateformat=str_replace ('mm','m',$dateformat);
    $dateformat=str_replace ('yyyy','Y',$dateformat);
    $dateformat=str_replace ('yy','y',$dateformat);

    $ret_fomat=trim($ret_fomat);
    $ret_fomat=str_replace ('\'','',$ret_fomat);
    $ret_fomat=str_replace ('dd','d',$ret_fomat);
    $ret_fomat=str_replace ('mm','m',$ret_fomat);
    $ret_fomat=str_replace ('MM','m',$ret_fomat);
    $ret_fomat=str_replace ('yyyy','Y',$ret_fomat);
    $ret_fomat=str_replace ('yy','y',$ret_fomat);
      
    // Ok, first split the format
    $ArrFormat = split('[^dmYyHis]+', $dateformat);
    $ArrValues = split('[^0-9]+', $date);

    // Sort out variables
    for( $x=0; $x < count($ArrFormat); $x++ ) {
        $DateElements[$ArrFormat[$x]] = $ArrValues[$x];
    }

    // Check for short Year
    if ((isset($DateElements['y'])) && (!isset($DateElements['Y']))) {
        if (strlen($DateElements['y'])==4) $DateElements['Y'] = $DateElements['y'];
        else {
          if ( $DateElements['y'] < 69 )
              $DateElements['Y'] = '20'.$DateElements['y'];
          else
              $DateElements['Y'] = '19'.$DateElements['y'];
        }
    }
    
    if (!isset($DateElements['H'])) $DateElements['H']=0;
    if (!isset($DateElements['i'])) $DateElements['i']=0;
    if (!isset($DateElements['s'])) $DateElements['s']=0;
    
    return date($ret_fomat, mktime(
        $DateElements['H'],
        $DateElements['i'],
        $DateElements['s'],
        $DateElements['m'],
        $DateElements['d'],
        $DateElements['Y']
    ));
  }
  
	static public function get ($in, $out, $date)
	{
    	// get('j-n-y','d-m-Y',4.5.75')=>'04-05-1975'
        // get('j-n-y','d-m-Y',4.5.75')=>'04-05-1975'
        //Reglas de conversion de tipos
        $in=strtolower(trim($in));
        $in=str_replace ('\'','',$in);
        $in=str_replace ('dd','d',$in);
        $in=str_replace ('mm','m',$in);
        $in=str_replace ('yyyy','Y',$in);
        $in=str_replace ('yy','y',$in);
        
        $out=strtolower(trim($out));
        $out=str_replace ('\'','',$out);
        $out=str_replace ('dd','d',$out);
        $out=str_replace ('mm','m',$out);
        $out=str_replace ('yyyy','Y',$out);
        $out=str_replace ('yy','y',$out);
        
          $reg = '^([-/\ \.Yymndj]{8,10})$';
          if (!ereg($reg, $in.$out))
            return 1;
      
          $date = ereg_replace('[/\ \.]', '-', $date);
          $_date = explode('-', $date);
          $date = sprintf('%02u', $_date[0])
            . sprintf('%02u', $_date[1])
            . sprintf('%02u', $_date[2]);
      
          $in = ereg_replace('[/\ \.-]', '', $in);
      
          for ($i=0; $i<strlen($in); $i++) {
            $v = $in[$i];
      
            if (ereg('[Y]', $v))
              $len = 4;
            elseif (ereg('[ymndj]', $v))
              $len = 2;
      
            $dt[$v] = substr($date, 0, $len);
            $date = substr($date, $len);
      
            if (ereg('[Yy]', $v))
              $v == 'y' ?
                $dt['Y'] = ($dt[$v] <= date($v) ? '20'.$dt[$v] : '19'.$dt[$v]) :
                $dt['y'] = substr($dt[$v], 2);
            elseif (ereg('[mn]', $v))
              $v == 'n' ?
                $dt['m'] = $dt[$v] :
                $dt['n'] = (int) $dt[$v];
            elseif (ereg('[dj]', $v))
              $v == 'j' ?
                $dt['d'] = $dt[$v] :
                $dt['j'] = (int) $dt[$v];
          }
      
          $j = 0; $o_dt = $sp = array();
          for ($i=0; $i<strlen($out); $i++) {
            $v = $out[$i];
      
            if (!ereg('[Yymndj]', $v))
              $sp[$j++] = $v;
            else
              $o_dt[] = $dt[$v];
          }
      
          $ret = $o_dt[0]
            . @$sp[0]
            . $o_dt[1]
            . @$sp[1]
            . $o_dt[2];
      

			return $ret;
	}
      
    function toString($format)
    {
         return strftime($format, $this -> getTimestamp());
         } 
    
    /**
     * can use as static form eg: Date::format( "%Y", $ts )
     * 
     * @static 
     */
    static public function format($format, $timestamp = "")
    {
    	if ($timestamp=="") $timestamp=time();
    	 
         return strftime($format, $timestamp);
         } 
    
    /**
     * *************************************************** GETTERS ***
     */
    
    function getYear()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> Y;
         } 
    
    function getMonth()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> M;
         } 
    
    function getDay()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> D;
         } 
    
    function getWeekday()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> weekday;
         } 
    
    function getYearDay()
    
    
    {
         if ($this -> change)
             $this -> _calc();
         return date("z", $this -> ts);
         } 
    
    function getHours()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> h;
         } 
    
    function getMinutes()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> m;
         } 
    
    function getSeconds()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> s;
         } 
    
    function getSecondsInDay()
    
    {
         if ($this -> change) $this -> _calc();
         $ts1 = mktime(0, 0, 0, $this -> M, $this -> D, $this -> Y);
         return $this -> ts - $ts1;
         } 
    
    function getWeekofYear()
    
    {
         if ($this -> change) $this -> _calc();
        
         return (intval(strftime('%W', $this -> getTimestamp())) + 1);
         } 
    
    // return Unix timestamp (seconds since epoch )
    function getTimestamp()
    
    {
         if ($this -> change) $this -> _calc();
         return $this -> ts;
         } 
    
    function daysInMonth()
    
    
    {
         if ($this -> change)
             $this -> _calc();
         return date("t", $this -> ts);
         } 
    
    function weeksInMonth()
    
    
    {
         if ($this -> change)
             $this -> _calc();
        
         // Guardamos valores
        $Y = $this -> Y;
         $M = $this -> M;
         $D = $this -> D;
         $h = $this -> h;
         $m = $this -> m;
         $s = $this -> s;
        
         $this -> setFirstDayOfMonth();
         $this -> _calc();
         $primera_semana = strftime("%W", $this -> ts);
        
         $this -> setLastDayOfMonth();
         $this -> _calc();
         $ultima_semana = strftime("%W", $this -> ts);
        
         // Recuperamos la fecha
        $this -> Y = $Y;
         $this -> M = $M;
         $this -> D = $D;
         $this -> h = $h;
         $this -> m = $m;
         $this -> s = $s;
         $this -> _calc();
        
         return intval($ultima_semana) - intval($primera_semana);
         } 
    
    function weeksInYear()
    
    
    {
         if ($this -> change)
             $this -> _calc();
        
         // Guardamos valores
        $Y = $this -> Y;
         $M = $this -> M;
         $D = $this -> D;
         $h = $this -> h;
         $m = $this -> m;
         $s = $this -> s;
        
         $this -> D = 1;
         $this -> M = 1;
         $this -> _calc();
         $primera_semana = strftime("%W", $this -> ts);
        
         $this -> D = 31;
         $this -> M = 12;
         $this -> _calc();
         $ultima_semana = strftime("%W", $this -> ts);
        
         // Recuperamos la fecha
        $this -> Y = $Y;
         $this -> M = $M;
         $this -> D = $D;
         $this -> h = $h;
         $this -> m = $m;
         $this -> s = $s;
         $this -> _calc();
        
         return intval($ultima_semana) - intval($primera_semana);
         } 
    
    function daysInYear()
    
    
    {
         if ($this -> change)
             $this -> _calc();
         return date("t", $this -> ts);
         } 
    
    function DaysTo($date)
    
    
    {
         if (! is_object($date) || get_class($date) != "date")
             return false;
         $deltats = $date -> getTimestamp() - $this -> getTimestamp();
         if ($deltats > 0)
             return (int) floor($deltats / SEC_DAY);
         else
             return (int) ceil($deltats / SEC_DAY);
         } 
    
    function compareTo($date)
    
    
    {
         if (! is_object($date) || strtoupper(get_class($date)) != strtoupper("date")) {
            return false;
             } 
        return $this -> getTimestamp() - $date -> getTimestamp();
         } 
    
    function addDays($numdays)
    
    
    {
         $this -> D += $numdays;
         $this -> _calc();
         } 
    
    function addWeeks ($numweeks)
    
    
    {
         $this -> addDays(7 * $numweeks);
         } 
    
    function addMonths($num)
    
    
    {
         $this -> M += $num;
         $this -> _calc();
         } 
    
    function addYears($num)
    
    
    {
         $this -> Y += $num;
         $this -> _calc();
         } 
    
    function addHours($num)
    
    
    {
         $this -> h += $num;
         $this -> _calc();
         } 
    
    function addMinutes($num)
    
    
    {
         $this -> m += $num;
         $this -> _calc();
         } 
    
    function addSeconds($num)
    
    
    {
         $this -> s += $num;
         $this -> _calc();
         } 
    
    /**
     * *************************************************** SETTERS ***
     */
    
    function setTimestamp($ts)
    
    
    {
         $this -> ts = $ts;
         $a = getdate($this -> ts);
         $this -> Y = $a['year'];
         $this -> M = $a['mon'];
         $this -> D = $a['mday'];
         $this -> h = $a['hours'];
         $this -> m = $a['minutes'];
         $this -> s = $a['seconds'];
         $this -> weekday = $a['wday'];
         $this -> change = 0;
         unset($a);
         } 
    
    function setDate($Y, $M, $D = 1)
    
    
    {
         $this -> Y = $Y;
         $this -> M = $M;
         $this -> D = $D;
         $this -> change = 1;
         } 
    
    function setTime($h, $m, $s = 0)
    
    
    {
         $this -> h = $h;
         $this -> m = $m;
         $this -> s = $s;
         $this -> change = 1;
         } 
    function setTimeFromHour($t)
    {
      $times=explode(':',$t);
      if (sizeof($times)>=2){
         $this -> h = $times[0];
         $this -> m = $times[1];
         if (isset($times[2])) $this -> s = $times[2];
         
         $this -> change = 1;
      }
    } 
         
    function setHours($val)
    
    
    {
         $this -> h = $val;
         $this -> change = 1;
         } 
    
    function setMinutes($val)
    
    
    {
         $this -> m = $val;
         $this -> change = 1;
         } 
    
    function setSeconds($val)
    
    
    {
         $this -> s = $val;
         $this -> change = 1;
         } 
    
    function setYear($val)
    
    
    {
         $this -> Y = $val;
         $this -> change = 1;
         } 
    
    function setMonth($val)
    
    
    {
         $this -> M = $val;
         $this -> change = 1;
         } 
    
    function setDay($val)
    
    
    {
         $this -> D = $val;
         $this -> change = 1;
         } 
    
    // setWeekday( [0-6] )
    function setWeekday($weekday)
    
    
    {
         $this -> D += ($weekday - $this -> weekday);
         $this -> change = 1;
         } 
    
    function setLastDayOfMonth()
    
    
    {
         $last_day = 28;
         while (checkdate($this -> M , $last_day + 1, $this -> Y))
         {
            $last_day ++;
             } 
        $this -> D = $last_day;
         $this -> change = 1;
         } 
    
    function setFirstDayOfMonth()
    
    
    {
         $this -> D = 1;
         $this -> change = 1;
         } 
    
    function setFirstDayOfYear()
    
    
    {
         $this -> D = 1;
         $this -> M = 1;
         $this -> change = 1;
         } 
    
    function setLastDayOfYear()
    
    
    {
         $this -> D = 31;
         $this -> M = 12;
         $this -> change = 1;
         } 
         
    function isValid()
    
    
    {
         if (! checkdate($this -> M, $this -> D, $this -> Y))
             return false;
         if ($this -> Y < 1970 || $this -> Y > 2038)
             return false;
         if ($this -> h < 0 || $this -> h > 23 || $this -> m < 0 || $this -> m > 59 || $this -> s < 0 || $this -> s > 59)
             return false;
         return true;
         } 
    
    /**
     * 
     * @protected 
     */
    function _calc()
    
    
    {
         $this -> ts = mktime($this -> h, $this -> m, $this -> s, $this -> M, $this -> D, $this -> Y);
         $a = getdate($this -> ts);
         $this -> Y = $a['year'];
         $this -> M = $a['mon'];
         $this -> D = $a['mday'];
         $this -> h = $a['hours'];
         $this -> m = $a['minutes'];
         $this -> s = $a['seconds'];
         $this -> weekday = $a['wday'];
         $this -> change = 0;
         } 
    
    } 

?>
