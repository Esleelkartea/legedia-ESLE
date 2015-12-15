<?php


set_time_limit(0);

class BackupsLib{

  public $conexion;
  
  function BackupsLib($parametro = false){
    $this->conexion = Propel::getConnection();
  }
  
  //resturar base de datos
  function restore_database($filename){
    $pwd = sfConfig::get('app_general_cifrado_usuario');
    
   
    @$fp = fopen($filename, "rb");

	if (!$fp) {
	 //Usuario::logAjax(__FILE__, __CLASS__, __FUNCTION__, print_r("adios desde el servidor", true)); 
	return false;
	}
	
	 
    $contador = 0;
		while (!feof($fp)) {
			$rlen = fread($fp, 4);
			if (feof($fp)) break;

			$len = unpack("L", $rlen);
			$len = array_pop($len);
			$line = fread($fp, $len);
			$line = $this->RC4($pwd, $line);

			//$result = $this->query($line,array());
			$stmt = $this->conexion->prepare($line);
			$stmt->execute(); // EJECUTAR LINEA DEL FICHERO.
			
			//$linea = fgets($fp);
			//$contador++;
			//$stmt = $this->conexion->prepare($linea);
			//$resul = $stmt->execute(); // EJECUTAR LINEA DEL FICHERO.
		}
		fclose($fp);
		return true;
  }
  
  
  //realizar copia de seguridad
  function backup_database($filename){
    $pwd = sfConfig::get('app_general_cifrado_usuario');
    
    @$fp = fopen($filename, "w");
    if (!$fp)
      return false;
    
    $conexion = Propel::getConnection();
    $consulta = "show tables";
    $stmt = $conexion->prepare($consulta);
    $stmt->execute();
		$sql = '';
		$part = '';
		
		while ($row = $stmt->fetch()) {
		  $tabla = $row[0];
		  
		  $part = "DELETE FROM $tabla;\n";
			$len = pack("L", strlen($part));
			fwrite($fp, $len);
			$part = $this->RC4($pwd, $part);
			fwrite($fp, $part);
				
		  $consultaCol = "show columns from `$tabla`";
		  $stmt1 = $conexion->prepare($consultaCol);
		  $stmt1->execute();
		  
		  $listaCol = array();
		  while($row = $stmt1->fetch()){
		    $listaCol[] = $row['Field'];
		  }
		  
		  $consulta2 = "select * from `$tabla`";
		  $stmt2 = $conexion->prepare($consulta2);
		  $stmt2->execute();
		  
		  while($datos = $stmt2->fetch()){
		    $valores = "values(";
			  $valor = "";
			  $campo = "";
			  $primero = 1;
			  
			  foreach($listaCol as $id=>$campo){
			    $valor = $datos[$campo];
			    if ($primero){
			      $valores .= "'" . addslashes($valor) . "'";
			      $primero = 0;
			      $campos = "(" . $campo;
			    }else{
			      $valores .= ",'" . addslashes($valor) . "'";
			      $campos .= ",$campo";
			    }
			  }
			  $campos .= ')';
				$valores .= ")";
				$part = "insert into $tabla $campos $valores;";
				
				$lineaBeta = str_replace("\n" , "\\n" , $part);
				$lineaAlfa = str_replace("\r" , "\\r" , $lineaBeta);
				$linea = $lineaAlfa."\n";
  			$len = pack("L", strlen($linea));
  			fwrite($fp, $len);
  			$linea = $this->RC4($pwd, $linea);
				fwrite($fp, $linea);
		  }//while (datos)
		}//while (tablas)
		
		fclose($fp);
		
		return true;
  }
  
  
  
  //copio y pego la siguiente funcion.
  function RC4($pwd, $data) {
	  $key[] = "";

		$box[] = "";
		$temp_swap = "";
		$pwd_length = 0;
		$pwd_length = strlen($pwd);

		for ($i = 0; $i <= 255; $i++) {
			$key[$i] = ord(substr($pwd, ($i % $pwd_length) + 1, 1));

			$box[$i] = $i;
		}

		$x = 0;
		for ($i = 0; $i < 255; $i++) {
			$x = ($x + $box[$i] + $key[$i]) % 256;

			$temp_swap = $box[$i];
			$box[$i] = $box[$x];
			$box[$x] = $temp_swap;
		}

		$temp = "";
		$k = "";
		$cipherby = "";
		$cipher = "";
		$a = 0;
		$j = 0;

		for ($i = 0; $i < strlen($data); $i++) {
			$a = ($a + 1) % 256;

			$j = ($j + $box[$a]) % 256;
			$temp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $temp;
			$k = $box[(($box[$a] + $box[$j]) % 256)];
			$cipherby = ord(substr($data, $i, 1)) ^ $k;
			$cipher .= chr($cipherby);
		}

		return $cipher;
	}
  
  
}

?>
