<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    $this->dispatcher->connect('application.throw_exception', array('sfErrorLogger', 'log500'));
    $this->dispatcher->connect('controller.page_not_found', array('sfErrorLogger', 'log404'));
  }
}
