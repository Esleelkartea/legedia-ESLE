<?php

class xmlResponse {
    static $client;

    static function connect() {
        $opts = array('trace' => true, 'encoding' => 'ISO-8859-1' ,'cache_wsdl' => WSDL_CACHE_NONE);
        //$opts = array('trace' => true, 'encoding'=>'ISO-8859-1', 'cache_wsdl' => WSDL_CACHE_NONE, 'local_cert' => './servidor.cer');
        $wsdl_url = "https://www.aespd.es:443/agenciapd/axis/SolicitudService?wsdl";
        try {
            xmlResponse::$client = new SoapClient($wsdl_url, $opts);
            return array('result' => 'ok');
        } catch(SOAPFault $e) {
            return array('result' => 'fail', 'message' => $e);
        }
    }

    #  probarXML
    static function probarXML($encodedXml) {
        $connect = xmlResponse::connect();
        if ($connect['result'] == 'fail')   return array('result' => __('Error de conexión'), 'message' => $connect['message']);
        elseif ($connect['result'] == 'ok') {
            try {
                //_COMUNICACION_APD_
                $c1 = new Criteria();
                $c1->addAnd(ParametroPeer::TIPOPARAMETRO, "_COMUNICACION_APD_", Criteria::EQUAL);
                $parametro = ParametroPeer::doSelectOne($c1);
                if ($parametro->getSiNo()) $ejecutar = sfConfig::get('app_metodo_prueba_xml');
                else $ejecutar = $ejecutar = sfConfig::get('app_metodo_registro_xml');

                $res = xmlResponse::$client->__soapCall($ejecutar, array($encodedXml));
                //echo "\n\nRESPONSE1:\n" . xmlResponse::$client->__getLastResponse() . "\n";
                //echo "\n\nRESPONSE2:\n" . print_r($res) . "\n";
                return array('result' => 'ok', 'res' => $res, 'last' => xmlResponse::$client->__getLastResponse());
             } catch(SOAPFault $e) {
                 return array('result' => __('Error de Soap'), 'message' => $e);
             }
        }
    }

    static function encodeXML($xml){
        return base64_encode($xml);
    }

    static function decodeXML($encodedXml){
        return base64_decode($encodedXml);
    }

} ?>