<?php

/**
 * content actions.
 *
 * @package    NeoCRM
 * @subpackage content
 * @author     Ana Martín
 * @version    10-02-09
 */
class contentActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  public function executeAbout()
  {
    //require_once('lib/markdown.php');
    $file = sfConfig::get('app_directorio_modulos').'/content/data/about_'.$this->getUser()->getCulture().'.txt';
    if (!is_readable($file))
    {
      $file = sfConfig::get('app_directorio_modulos').'/content/data/about_es.txt';
    }

    $this->html = sfMarkdown::doConvertFile($file);

    //$this->getResponse()->setTitle('askeet! &raquo; about');
  }
  
  public function executeBugreport()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->enviarEmail();
      $this->getUser()->setFlash('notice', 'Gracias por su notificación. Un administrador se encargará de evaluar el informe del problema.');
      return $this->redirect('content/bugreport');
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function handleErrorBugreport()
  {
    $this->preExecute();
    //$this->forward('content', 'bugreport');
    $this->labels = $this->getLabels();
    
    return sfView::SUCCESS;
  }
  
  protected function enviarEmail()
  {
    $bug = $this->getRequestParameter('bug');
    
    $mail = new sfMail();
    
    $mail->initialize();
    
    $mail->setMailer('smtp');
    $mail->setHostname(sfConfig::get('app_smtp_server'));
    $mail->setPort(sfConfig::get('app_smtp_port'));
    $mail->setUsername(sfConfig::get('app_smtp_user'));
    $mail->setPassword(sfConfig::get('app_smtp_password'));
    
		$mail->setCharset('utf-8');
		$mail->setContentType('text/html');
		$mail->setSender($bug['email'], $bug['name']);
		$mail->setFrom($bug['email'], $bug['name']);
		$mail->addAddress(sfConfig::get('app_bugreport_mail_recipient'));
		$mail->setSubject(sfConfig::get('app_bugreport_mail_subject'));
		//$this->body = $this->getRequestParameter('message');
		
		$cuerpo = sfConfig::get('app_bugreport_mail_txt_header');
		$cuerpo .= "<br/>";
		$cuerpo .= "url: ".$bug['url'];
		$cuerpo .= "<br/>";
		$cuerpo .= $bug['description'];
		$cuerpo .= "<br/><br/>";
		$cuerpo .= sfConfig::get('app_bugreport_mail_txt_footer');
		
		$mail->setBody($cuerpo);
		$resultado = $mail->send();
		return $resultado;
  }
  
  protected function getLabels()
  {
    return array(
      'bug{name}' => 'Nombre',
      'bug{email}' => 'Email',
      'bug{url}' => 'Página',
      'bug{description}' => 'Descripción',
    );
  }
  
}
