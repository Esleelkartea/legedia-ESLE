<?php  
  
  $fp = fopen($fichero, "rb");

  header("Content-type: application/force-download");
  if ($mime != '') 
  {
    header("Content-type: ".$mime);
  }
  else 
  {
    header("Content-type: application/doc");
  }
  
  header("Content-Disposition: attachment; filename=\"$nombre_fichero_original\"\n");
  header("Content-Length: " . filesize($fichero));
  
  fpassthru($fp);
  exit();  
?>
