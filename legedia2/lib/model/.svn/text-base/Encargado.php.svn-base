<?php

class Encargado extends BaseEncargado
{
  public function __toString()
  {
   
    if (trim($this->getNombre()) != "" && trim($this->getContacto()) != "") 
      return $this->getNombre()." (".$this->getContacto().")";
    elseif (trim($this->getNombre()) != "") return $this->getNombre();
    elseif (trim($this->getContacto()) != "") return $this->getContacto();
    else return "-";
  }
}
