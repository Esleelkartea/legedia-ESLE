<?php


define('_APACHE_CERT_FOLDER', '/etc/httpd/certs/');

$debug = TRUE;
debug('$_SERVER[\'SSL_CLIENT_CERT\']', $_SERVER['SSL_CLIENT_CERT']);

// erabiltzailearen zertifikatua jaso fitxategi tenporal batean
$user_cert_file_path = dirname(__FILE__) .'/temp/user_cert.pem';
$user_pubkey_file_path = dirname(__FILE__) .'/temp/user_pubkey.pem';

$src_file = dirname(__FILE__) . '/docs/dokumentu.xml';
$target_file = dirname(__FILE__) . '/docs/dokumentu-sinatua.xml';




$result = authenticate_dni();
//$result = authenticate_ona();

if($result){
  // get public key from user certificate
  $output = shell_exec('openssl x509 -inform pem -in '.$user_cert_file_path.' -pubkey -noout > '. $user_pubkey_file_path);

  debug('User public key', $user_pubkey = file_get_contents($user_pubkey_file_path));
}

?>

<html>
<head>
<title></title>
<script src="sign.js" type="text/javascript"></script>
<script>

/*
function onSmartCardChange() {
  alert("Smart card changed");
}
function register() {
  // alert("registered");
  // window.crypto.enableSmartCardEvents = true;
  document.addEventListener("smartcard-insert", onSmartCardChange, false);
  document.addEventListener("smartcard-remove", onSmartCardChange, false);
}
function deregister() {
  // alert("deregistered");
  document.removeEventListener("smartcard-insert", onSmartCardChange, false);
  document.removeEventListener("smartcard-remove", onSmartCardChange, false);
}

function signAndSend() {
  // document.sinatu.sinatua.value=crypto.signText(document.sinatu.sinatzeko.value, "ask");
  return false;
}  
*/

</script>

</head>
<!--<body onload="register()" onunload="deregister()">-->
<body>


<?php

if(isset($_POST['sinatuta'])){
  signDocument();
} else {
  processDocument();
  print firm_form();
}

?>
</body>
</html>


<?php

/*
 * XML dokumentuan sinaduraren atala txertatzen du, sinatu beharreko hash-a eratuz.
 */
function processDocument(){
  global $src_file, $target_file, $user_pubkey_file_path, $user_cert_file_path;
  require(dirname(__FILE__) . '/xmlseclibs.php');

  if (file_exists($target_file)) {
      unlink($target_file);
  }

  $doc = new DOMDocument();
  $doc->load($src_file);

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
    debug('File not found', $user_cert_file_path);
  } else {
    $objDSig->add509Cert($user_cert_file_path);
  }

  $objDSig->appendSignature($doc->documentElement);
  $doc->save($target_file);
}


function signDocument(){
  global $src_file, $target_file, $user_cert_file_path;

  // replace signature value with the signature made by card
  $src = file_get_contents($target_file);
  $src = preg_replace('/<ds:SignatureValue>[^<]*<\/ds:SignatureValue>/i', '<ds:SignatureValue>'.$_POST['sinatuta'].'</ds:SignatureValue>', $src);
  file_put_contents($target_file, $src);

  // send to service
  require_once('xmlResponseProba.class.php');

  $xml=file_get_contents($target_file);

  $encodedXml=xmlResponse::encodeXML($xml);
  $aa=xmlResponse::probarXML($encodedXml);

  echo xmlResponse::decodeXML($aa['res']);

  echo "END";
}

function firm_form(){
  $output = '';
  $output .= '
<!-- <object id="oCAPICOM" classid="clsid:A996E48C-D3DC-4244-89F7-AFA33EC60679" codebase="lib/capicom.cab"></object>-->
<form name="formFirma" method="post">
<label for="datos">Introduzca los datos a Firmar:</label><br />
<textarea id="sinatzeko" name="sinatzeko" cols="80" rows="2">'.trim(strip_tags(_CANON_DATA)).'</textarea><br />
<input onclick="document.getElementById(\'sinatuta\').value = signDigest(document.getElementById(\'sinatzeko\').value);" value="Firmar documento con tarjeta" type="button">

<label for="datosFirmados">Resultado de la Firma:</label><br />
<textarea id="sinatuta" name="sinatuta" cols="80" rows="15"></textarea>

<input type="submit" name="submit" value="Enviar" />

</form>';
  return $output;
}


function authenticate_ona(){
  global $user_cert_file_path;

  $cert_ca = _APACHE_CERT_FOLDER . 'RAIZ2007_CERTIFICATE_AND_CRL_SIGNING_SHA1_PEM.cer'; // honek bigarren mailako zertifikatuak balidatu behar ditu
  file_put_contents($user_cert_file_path, $_SERVER['SSL_CLIENT_CERT']);

  $issuer_cert = _APACHE_CERT_FOLDER . "CCEER_PEM.cer";

  debug("$issuer_cert file exists", file_exists($issuer_cert));
  debug("$cert_ca file exists", file_exists($cert_ca));
  debug("$user_cert_file_path file exists", file_exists($user_cert_file_path));

  // balidatu
  $output = shell_exec($c = 'openssl ocsp -CAfile '.$cert_ca.' -issuer '.$issuer_cert.' -cert '. $user_cert_file_path.' -url http://ocsp.izenpe.com:8094/');
  debug('Autenticate user certificate command', $c);
  debug('OCSP services response', $output);

  if(strstr($output, 'good')){
    return TRUE;
  } elseif(strstr($output, 'revoked')){
    return FALSE;
  } else { // unkown
    return FALSE;
  }

}


function authenticate_dni(){
  global $user_cert_file_path;

  $cert_ca = _APACHE_CERT_FOLDER . 'ACRAIZ-SHA1.pem'; // honek bigarren mailako zertifikatuak balidatu behar ditu

  file_put_contents($user_cert_file_path, $_SERVER['SSL_CLIENT_CERT']);

  // issuer nor den jakin behar dugu, zein zertifikatuarekin balidatu jakiteko
  // (kontua da hiru aukera daudela dnie-ari dagokionez)         
  $output = shell_exec($c = 'openssl x509 -in '.$user_cert_file_path .' -issuer -noout');
  if (strpos($output,"CN=AC DNIE 001")){
    $issuer_cert = _APACHE_CERT_FOLDER . "ACDNIE001-SHA1.pem";
  } else if (strpos($output,"CN=AC DNIE 002")){
    $issuer_cert = _APACHE_CERT_FOLDER . "ACDNIE002-SHA1.pem";
  } else if (strpos($output,"CN=AC DNIE 003")){
    $issuer_cert = _APACHE_CERT_FOLDER . "ACDNIE003-SHA1.pem";
  }

  debug("$issuer_cert file exists", file_exists($issuer_cert));
  debug("$cert_ca file exists", file_exists($cert_ca));
  debug("$user_cert_file_path file exists", file_exists($user_cert_file_path));

  // balidatu
  $output = shell_exec($c = 'openssl ocsp -CAfile '.$cert_ca.' -issuer '.$issuer_cert.' -cert '. $user_cert_file_path.' -url http://ocsp.dnie.es');
  debug('Autenticate user certificate command', $c);
  debug('OCSP services response', $output);

  if(strstr($output, 'good')){
    return TRUE;
  } elseif(strstr($output, 'revoked')){
    return FALSE;
  } else { // unkown
    return FALSE;
  }

}

function debug($label, $var){
  global $debug;
  if($debug){
    print '<fieldset><legend>'.$label.'</legend>'.print_r($var, 1).'</fieldset>';
  }
}

?>