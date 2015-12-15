<style type="text/css">
    /* CSS snippet to prepare the display of the elements
     * for both the screen and the printed page in order to
     * print only the newly created #lda-print
     */
    @media print {
        .lda-noprint{display:none !important}
        #lda-print{display:block}
        #lda-print{width:100%}
        #lda-print{height:100%}

    }
    @media screen {
        #lda-print{display:none !important}
    }
</style>

<script type="text/javascript"><!--
    jQuery(document).ready(function() {
        jQuery("#div_log1").hide();
        jQuery("#div_log2").hide();
        jQuery(".log").click(function() {
            jQuery("#div_"+jQuery(this).attr('id')).css({'text-align' : 'left'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'border' : 'solid 2px #67727b'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'background' : '#000000'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'color' : '#ffffff'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'padding' : '4px'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'height' : '350px'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'overflow' : 'scroll'});
            jQuery("#div_"+jQuery(this).attr('id')).toggle('fast');
            return false;
        });
        // Hook up the print link.
        jQuery('.print-button').click(function() {  // Print the DIV.
            jQuery('#printable').css({'margin-left' : '1%'});
            jQuery('#printable').css({'margin-right' : '1%'});
            jQuery('head').append('<link rel="stylesheet" href="<?php echo substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), 'web/') + 4).'/css/principal.css'; ?>" type="text/css" media="print" />');
            jQuery('head').append('<link rel="stylesheet" href="<?php echo substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), 'web/') + 4).'/css/sfCssTabs.css'; ?>" type="text/css" media="print" />');
            jQuery('head').append('<link rel="stylesheet" href="<?php echo substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), 'web/') + 4).'/css/notificaciones.css'; ?>" type="text/css" media="print" />');
            jQuery('#printable').print();
            // Cancel click event.
            return false;
        });
    });
-->
</script>

<?php
$dir = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$id_fichero.'-'.$id_notificacion.'.xml';

$con = Propel::getConnection();
$query = "SELECT `notificaciones`.* FROM `notificaciones` WHERE `notificaciones`.`notid` = '".$id_notificacion."' AND `notificaciones`.`id_fichero` = '".$id_fichero."';";
$statement = $con->prepare($query);
$statement->execute();
$notificacion = $statement->fetch(PDO::FETCH_OBJ);

use_helper('Date');
$date = substr($notificacion->fecha, 4, 4).'-'.substr($notificacion->fecha, 2, 2).'-'.substr($notificacion->fecha, 0, 2);
$time = substr($notificacion->hora_proceso, 0, 2).':'.substr($notificacion->hora_proceso, 2, 2).':'.substr($notificacion->hora_proceso, 4, 2);

$xml = file_get_contents($dir);

include_partial('cabecera', array('id_fichero' => $id_fichero, 'notid' => $id_notificacion)); ?>
<br /><?php
if (!is_file($dir)) {
    echo __('Fichero no encontrado');
}
else {
    //ES ENVIAR CON FIRMA
    if ($notificacion->soporte == 'Internet firmado con certificado digital'){
        if (!file_exists(dirname(__FILE__) .'/temp/')) mkdir (dirname(__FILE__) .'/temp/', 0777);
        
        //GENERANDO XML PARA FIRMAR
        $user_cert_file_path = dirname(__FILE__) .'/temp/user_cert.pem';
        $user_pubkey_file_path = dirname(__FILE__) .'/temp/user_pubkey.pem';
        $target_file = dirname(__FILE__) . '/temp/dokumentu-sinatua.xml';
        $openssl = sfConfig::get("app_bin_openssl", "openssl");

        file_put_contents($user_cert_file_path, $_SERVER['SSL_CLIENT_CERT']);
        
        $output = shell_exec($openssl.' x509 -inform pem -in '.$user_cert_file_path.' -pubkey -noout > '. $user_pubkey_file_path);

        if ($yafirmado){
          $src = file_get_contents($target_file);
          $src = preg_replace('/<ds:SignatureValue>[^<]*<\/ds:SignatureValue>/i', '<ds:SignatureValue>'.$sinatuta.'</ds:SignatureValue>', $src);
          file_put_contents($target_file, $src);

          $xml=file_get_contents($target_file);

        } else {
            if (file_exists($target_file)) {
                unlink($target_file);
            }

            $doc = new DOMDocument();
            $doc->load($dir);

            $objDSig = new XMLSecurityDSig();
            $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
            $objDSig->addReference($doc, XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'));

            /* gako pribatu bat behar dugu prozesua burutzeko. orain edozein erabiliko dugu. gero txartelekoarekin ordezkatzeko */
            $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
            /* if key has Passphrase, set it using $objKey->passphrase = <passphrase> " */
            $objKey->loadKey(dirname(__FILE__) . '/privkey.pem', TRUE);
            $objDSig->sign($objKey);

            /* Add associated public key */
            // $objDSig->add509Cert(file_get_contents(dirname(__FILE__) . '/mycert.pem'));
            // $objDSig->add509Cert(file_get_contents($user_cert_file_path));
            if(!file_exists($user_cert_file_path)){
              die('File not found : '.$user_cert_file_path);
            } else {
              $objDSig->add509Cert($user_cert_file_path);
            }

            $objDSig->appendSignature($doc->documentElement);
            $doc->save($target_file);

            ?>

            <h3>Por favor, apriete el botón "Enviar" para acabar con el registro del fichero en la Agencia de Proteccion de datos</h3>
            <?php


            echo '<form id="formMyFirma" name="formMyFirma" method="post" onsubmit="document.getElementById(\'sinatuta\').value = signDigest(document.getElementById(\'sinatzeko\').value);" action="'.str_replace("http://","https://",UsuarioPeer::getRuta()).'/notificaciones/enviar/id_notificacion/'.$notificacion->notid.'/id_fichero/'.$notificacion->id_fichero.'/yafirmado/1">';
            echo '<input type="hidden" id="sinatzeko" name="sinatzeko" value="'.trim(strip_tags(_CANON_DATA)).'">';
            echo '<input type="hidden" id="sinatuta" name="sinatuta" value="">';
            //echo '<input onclick="document.getElementById(\'sinatuta\').value = signDigest(document.getElementById(\'sinatzeko\').value);" value="Firmar documento con tarjeta" type="button"><br />';
            echo '<input type="submit" name="submit" value="Enviar" /><br />';
            echo '</form>';
            echo '<script type="text/javascript">';
            echo '/*document.getElementById(\'sinatuta\').value = signDigest(document.getElementById(\'sinatzeko\').value);*/';
            echo 'document.getElementById(\'formMyFirma\').submit();';
            echo '</script><br />';

            return true;
        }
    }

    ?>
        <fieldset>
            <label style="float:none; text-align:center; font-size: 12px" class="form1"><?php
                echo __('El fichero de %%tipo%% (creado el %%fecha%% a las %%hora%%) ha sido <strong>enviado</strong>: %%dir%%', array('%%tipo%%' => strtolower($notificacion->tipo), '%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log1', 'class' => 'log')), '%%fecha%%' => format_date($date, "D", 'es'), '%%hora%%' => format_date($time, "t", 'es')), 'messages'); ?>
            </label>
            <div id="div_log1" style="clear:both; height: 300px; overflow: auto; border: 1px solid silver; padding: 5px; margin: 5px;"><?php
                echo str_replace("\n", '<br />', str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", htmlentities(file_get_contents($dir)))); ?>
            </div>
        </fieldset><?php

        $encodedXml = xmlResponse::encodeXML($xml);
        $rEncodedXml = xmlResponse::probarXML($encodedXml);
        $res = '';
    ?>

        <fieldset>
            <label style="float:none; text-align:center; font-size: 12px" class="form1"><?php
            if ($rEncodedXml['result'] != 'ok') {
                echo '<strong>'.$rEncodedXml['result'].'</strong><br /><br />';
                echo '<u>'.__('Mensaje').'</u>:<br />'.$rEncodedXml['message'].'<br /><br />';
            } else  $res .= xmlResponse::decodeXML($rEncodedXml['res']);
            if (strpos($res, '<est_err>00</est_err>') !== false) {
                $dir = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$id_fichero.'-'.$id_notificacion.'-result.xml';
                if (is_file($dir))  unlink($dir);
                file_put_contents($dir, utf8_decode($res));
                $date = substr(date('dmY'), 4, 4).'-'.substr(date('dmY'), 2, 2).'-'.substr(date('dmY'), 0, 2);
                $time = substr(date('His'), 0, 2).':'.substr(date('His'), 2, 2).':'.substr(date('His'), 4, 2);
                echo __('<strong>Resultado</strong> (fichero creado el %%fecha%% a las %%hora%%): %%dir%%', array('%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log2', 'class' => 'log')), '%%fecha%%' => format_date($date, "D", 'es'), '%%hora%%' => format_date($time, "t", 'es')), 'messages');
            } else  echo '<u id="log2" style="color: black; cursor: pointer" class="log">'.__('Resultado').'</u>'; ?>
            </label>
            <div id="div_log2" style="text-align:left; border:solid 2px #67727b; background:#000000; color:#ffffff; padding:4px; height:350px; overflow:scroll"><?php
                echo str_replace("\n", '<br />', str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", htmlentities($res))); ?>
            </div>
        </fieldset><?php

        if (strpos($res, '<est_err>00</est_err>') !== false) {
            $con = Propel::getConnection();
            $query = "UPDATE `notificaciones` SET `notificaciones`.`procesado` = '1' WHERE `notificaciones`.`notid` = '".$id_notificacion."';";
            $statement = $con->prepare($query);
            $update_result = $statement->execute(); 
        ?>
            <fieldset>
            <label style="float:none; text-align:center; font-size: 12px" class="form1">
            <?php
            if ($update_result == '1')  echo '<strong>'.__('Envío del fichero XML satisfactorio').'</strong>';
            else    echo '<strong>'.__('Envío del fichero XML satisfactorio pero error actualizando la BBDD').'</strong>'; ?>:&nbsp

            <?php if ($notificacion->soporte != 'Internet firmado con certificado digital') : ?>
            <strong style="color: red"><?php echo __('No olvide que dispone de 10 días para imprimir, firmar y mandar la solicitud'); ?></strong>
            <?php endif; ?>

            </label>
            </fieldset>
            
            <fieldset class="boton">
                <table class="quitar_borde" width="100%"><tr><td class="quitar_borde" width="50%" align="center">
                <a class="print-button cump" style="padding-bottom: 5px; border: 2px solid black" href="#"><?php echo __('Imprimir solicitud'); ?></a>
            </td></tr><tr><td class="quitar_borde" width="50%" align="left" style="background-color: #FFFEF2; border: 2px solid black">
                <div style="width:100%; margin-top:2%; margin-left:2%; margin-right:2%" id="printable" style="margin-top: 1%; margin-bottom: 1%; padding-left: 1%; padding-right: 1%"><?php
                    include_partial('00', array('notificacion' => $notificacion, 'solicitud' => true, 'respuesta' => $res, 'id_fichero' => $id_fichero, 'fecha' => format_date($date, "D", 'es'))); ?>
                </div>
            </td></tr>
             <tr><td class="quitar_borde" width="50%" align="center">
                <a class="print-button cump" style="padding-bottom: 5px; border: 2px solid black" href="#"><?php echo __('Imprimir solicitud'); ?></a>
            </td></tr>
                </table>
            </fieldset>
       <?php
        } else { ?>
            <fieldset><label style="float:none; text-align:center; font-size: 12px" class="form1"><?php
                echo '<strong>Envío del fichero XML fallido</strong>'; ?>
            </label></fieldset><?php
        }
}
?>