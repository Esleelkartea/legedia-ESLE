<?php

class Taula1 extends BaseTaula1
{

  public function __toString(){
    return $this->getActividad();
  }
}
