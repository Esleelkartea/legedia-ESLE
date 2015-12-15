<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfErrorLogger.class.php 8080 2008-03-25 16:41:29Z fabien $
 */
 
class sfErrorLogger
{
  static public function log500(sfEvent $event)
  {
    $exception = $event->getSubject();
    $context = sfContext::getInstance();
    //print_r($context);
    // is database configured?
    try
    {
      Propel::getConnection();

      // log exception in db
      //$log = new sfErrorLog();
      //$log->setType('sfError404Exception' == get_class($exception) ? 404 : 500);
      //$log->setClassName(get_class($exception));
      //$log->setMessage(!is_null($exception->getMessage()) ? $exception->getMessage() : 'n/a');
      //$log->setModuleName($context->getModuleName());
      //$log->setActionName($context->getActionName());
      //$log->setExceptionObject($exception);
      //$log->setRequest($context->getRequest());
      //$log->setUri($context->getRequest()->getUri());
      //$log->save();
      
      // send email
      if (strtolower(SF_ENVIRONMENT) == "prod") {
		    $mail = new sfMail();
		    
		    $mail->initialize();
		    
		    $mail->setMailer('smtp');
		    $mail->setHostname(sfConfig::get('app_smtp_server'));
		    $mail->setPort(sfConfig::get('app_smtp_port'));
		    $mail->setUsername(sfConfig::get('app_smtp_user'));
		    $mail->setPassword(sfConfig::get('app_smtp_password'));
		    
				$mail->setCharset('utf-8');
				$mail->setContentType('text/html');
				$mail->setFrom(sfConfig::get('app_email_default_address_from'), sfConfig::get('app_email_default_name_from'));
				$mail->addAddress(sfConfig::get('app_bugreport_mail_recipient1'));
				//$mail->addAddress(sfConfig::get('app_bugreport_mail_recipient2'));
				$mail->setSubject("Automatic: ".sfConfig::get('app_bugreport_mail_subject'));
				
				$cuerpo = "Type: 500<br />";
				$cuerpo .= "Class: ".get_class($exception)."<br />";
				$cuerpo .= "Msg: ".(null !== $exception->getMessage()) ? $exception->getMessage() : 'n/a'."<br />";
				$cuerpo .= "Module: ".$context->getModuleName()."<br />";
				$cuerpo .= "Action: ".$context->getActionName()."<br />";
				$cuerpo .= "Uri: ".$context->getRequest()->getUri()."<br />";
				$cuerpo .= "Referer: ".$context->getRequest()->getReferer()."<br />";
				$cuerpo .= "Method: ".$context->getRequest()->getMethodName()."<br />";
				$cuerpo .= "Parameters: <br />";
		    foreach ($context->getRequest()->getParameterHolder()->getAll() as $key => $value):
		      $cuerpo .= "&nbsp;&nbsp;&nbsp;&nbsp;".$key.": ".$value."<br />";
		    endforeach;
				$cuerpo .= "Cookies: ".$context->getRequest()->getHttpHeader('cookie')."<br />";
				$cuerpo .= "User Agent: ".$context->getRequest()->getHttpHeader('user-agent')."<br />";
				$cuerpo .= "Accept: ".$context->getRequest()->getHttpHeader('accept')."<br />";
				$cuerpo .= "Accept encoding: ".$context->getRequest()->getHttpHeader('accept-encoding')."<br />";
				$cuerpo .= "Accept language: ".$context->getRequest()->getHttpHeader('accept-language')."<br />";
				$cuerpo .= "Accept charset: ".$context->getRequest()->getHttpHeader('accept-charset')."<br />";
				$cuerpo .= "<br/><br/>";
				
				$mail->setBody($cuerpo);
				$result = $mail->send();
			}
			// end send email      
    }
    catch (PropelException $e)
    {
    }
  }

  static public function log404(sfEvent $event)
  {
    $request = sfContext::getInstance()->getRequest();

    // is database configured?
    try
    {
      Propel::getConnection();

      // log 404 in db
      //$log = new sfErrorLog();
      //$log->setType(404);
      //$log->setClassName(null);
      //$log->setMessage('n/a');
      //$log->setModuleName($event['module']);
      //$log->setActionName($event['action']);
      //$log->setExceptionObject(null);
      //$log->setRequest($request);
      //$log->setUri($request->getUri());
      //$log->save();
    }
    catch (PropelException $e)
    {
    }
  }
}
