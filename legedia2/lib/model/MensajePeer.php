<?php

/**
 * Subclass for performing query and update operations on the 'mensaje' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MensajePeer extends BaseMensajePeer
{


  /**
  * Función que busca la plantilla de la empresa y sustituye los datos solicitados en la plantilla.
  * @param cuerpo, cuerpo del mensaje
  * @param empresa, objeto de tipo empresa
  * @param asunto, asunto del mensaje
  */
  protected static function prepararMailingCuerpo($cuerpo='' , $empresa, $asunto)
  {
    $plantilla = null;
   
    
    $plantilla = $empresa->getTextoCampania();
    
    $plantilla = isset($plantilla) ? $plantilla : "{MENSAJE}";

    $resultado = str_replace('{MENSAJE}' , $cuerpo , $plantilla);
    $resultado = str_replace('{ASUNTO}' , $asunto , $resultado);
    $resultado = str_replace('{FECHA}' , date('d-m-Y') , $resultado);
   
    return $resultado;
  }
  
  
  
  /**
  * Envía un email a través de la configuración de campanias de la empresa que se pasa como parámetro. Utiliza el plugin sfSwiftPlugin
  * @param id_empresa, identificador de la empresa a través de la que se envia el mensaje.
  * @param asunto, asunto del mensaje
  * @param cuerpo, cuerpo del mensaje
  * @param lista_emails, lista de emails, a los que se envia el mensjae.
  * @return integer, número de mensajes enviados
  * @version 25-02-09
  * @author Ana Martin
  */
  public static function enviarEmailDefault($id_empresa, $asunto, $cuerpo, $lista_emails) {

    $empresa = EmpresaPeer::retrievebypk($id_empresa);
    
    if ($empresa instanceof Empresa) {
        $smtp_server = $empresa->getSmtpServer();
        $smtp_user = $empresa->getSmtpUser();
        $smtp_password = $empresa->getSmtpPassword();
        $smtp_port = $empresa->getSmtpPort();
        $sender_email = $empresa->getSenderAddress();
        $sender_name = $empresa->getSenderName();

        //$c = new Criteria();
        //$c->add(PlantillaPeer::ID_EMPRESA, $empresa->getIdEmpresa());
        //$plantilla = PlantillaPeer::doSelectOne($c);
        $plantilla = "";
        
        $cuerpo = MensajePeer::prepararMailingCuerpoDefault($cuerpo, $plantilla, $asunto);
                        
        $smtp = new Swift_Connection_SMTP($smtp_server, $smtp_port);
        $smtp->setUsername($smtp_user);
        $smtp->setpassword($smtp_password);

        $mailer = new Swift($smtp);
        $message = new Swift_Message(utf8_decode($asunto));
    	$message->attach(new Swift_Message_Part($cuerpo, "text/html"));		
    		    	   
    	$recipients = new Swift_RecipientList();
    	foreach ($lista_emails as $email) {
          $recipients->addTo($email);             
    	}
    	  
    	  //Load the plugin with these replacements
    	/*  $replacaments = array(
                  '{FECHA}' => date('d-m-Y') , 
                  '{ASUNTO}' => utf8_decode($asunto),
                  '{MENSAJE}' => utf8_decode($cuerpo),             
               );
    	  $mailer->attachPlugin(new Swift_Plugin_Decorator($replacaments), "decorator");*/
    	  $enviado_por = new Swift_Address($sender_email, $sender_name);
    	  $cuantos = $mailer->send($message, $recipients, $enviado_por);
    	   
    	  $mailer->disconnect();        
    
        return $cuantos;
    }
    else return 0;
  }
  
    /**
  * Función que busca la plantilla de la empresa y sustituye los datos solicitados en la plantilla.
  * @param cuerpo, cuerpo del mensaje
  * @param empresa, objeto de tipo empresa
  * @param asunto, asunto del mensaje
  * @version 25-02-09
  */
  protected static function prepararMailingCuerpoDefault($cuerpo='' , $plantilla='', $asunto)
  {
        
    //$plantilla = isset($plantilla) ? $plantilla->getHtml() : "{CONTENIDO}";
    $resultado = $cuerpo;

    //$resultado = str_replace('{CONTENIDO}' , $cuerpo , $plantilla);
    $resultado = str_replace('{ASUNTO}' , $asunto , $resultado);
    $resultado = str_replace('{FECHA}' , date('d-m-Y') , $resultado);
   
    return $resultado;
  }
}
