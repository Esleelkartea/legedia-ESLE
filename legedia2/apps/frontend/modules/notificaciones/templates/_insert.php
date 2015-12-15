<?php
foreach ($_POST as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $k => $v) {
            if (trim($v) == '') unset($_POST[$key][$k]);
        }
    } else if (trim($value) == '')  unset($_POST[$key]);
}

                                                                $post = array();
                                                                $hook = $_POST['hook'];
                                                                $post['soporte'] = $_POST['soporte'];
                                                                $post['tipo'] = $hook;
if (isset($_POST['tipo']))                                      $post['tipo_noti'] = $_POST['tipo'];
                                                                $post['id_fichero'] = $_POST['id_fichero'];
                                                                $post['modelo'] = $_POST['modelo'];
                                                                $post['titularidad'] = sfConfig::get('app_tipo_titularidad');
                                                                $post['presentacion'] = $_POST['presentacion'];
                                                                $post['fecha'] = date('dmY');
                                                                $post['hora_proceso'] = date('His');
                                                                $post['forma'] = strtolower($_POST['forma']);
                                                                $post['id_upload'] = $_POST['cif_0'].date('d').dechex(date('m')).date('Y').date('His');
                                                                $post['pf_razon_s'] = $_POST['razsocial_0'];
                                                                $post['pf_cif_nif'] = $_POST['cif_0'];
                                                                $post['pf_nombre'] = $_POST['nombre_0'];
                                                                $post['pf_apellido1'] = $_POST['apellido1_0'];
                                                                $post['pf_apellido2'] = $_POST['apellido2_0'];
if (isset($_POST['nif_0']))                                     $post['pf_nif'] = $_POST['nif_0'];
                                                                $post['pf_cargo'] = $_POST['cargo_0'];
                                                                $post['dec_razon_s'] = $_POST['razon_s_0'];
                                                                $post['dec_direccion'] = $_POST['direccion_0'];
                                                                $post['dec_localidad'] = $_POST['localidad_0'];
if (isset($_POST['cp_0']) && $_POST['pais_0'] == '55')          $post['dec_cp'] = $_POST['cp_0'];
if (isset($_POST['provincia_0']) && $_POST['pais_0'] == '55')   $post['dec_provincia'] = $_POST['provincia_0'];
                                                                $post['dec_pais'] = $_POST['pais_0'];
if (isset($_POST['tel0']))                                      $post['dec_tel'] = $_POST['tel0'];
if (isset($_POST['fax0']))                                      $post['dec_fax'] = $_POST['fax0'];
if (isset($_POST['mail0']))                                     $post['dec_mail'] = $_POST['mail0'];
                                                                $post['dec_forma'] = $_POST['medio_0'];
                                                                $post['rf_nombre'] = $_POST['denomsocial_1'];
                                                                $post['rf_actividad'] = $_POST['actividad_1'];
if (isset($_POST['cif_1']))                                     $post['rf_cif'] = $_POST['cif_1'];
if (isset($_POST['domiciliosocial_1']))                         $post['rf_domicilio'] = $_POST['domiciliosocial_1'];
                                                                $post['rf_localidad'] = $_POST['localidad_1'];
if (isset($_POST['cp_1']) && $_POST['pais_1'] == '55')          $post['rf_cp'] = $_POST['cp_1'];
if (isset($_POST['provincia_1']) && $_POST['pais_1'] == '55')   $post['rf_provincia'] = $_POST['provincia_1'];
                                                                $post['rf_pais'] = $_POST['pais_1'];
if (isset($_POST['tel_1']))                                     $post['rf_tel'] = $_POST['tel_1'];
if (isset($_POST['fax_1']))                                     $post['rf_fax'] = $_POST['fax_1'];
if (isset($_POST['mail_1']))                                    $post['rf_mail'] = $_POST['mail_1'];
if (isset($_POST['oficina_2']))                                 $post['dr_nombreof'] = $_POST['oficina_2'];
if (isset($_POST['cif_2']))                                     $post['dr_cif'] = $_POST['cif_2'];
if (isset($_POST['direccion_2']))                               $post['dr_dirpostal'] = $_POST['direccion_2'];
if (isset($_POST['localidad_2']))                               $post['dr_localidad'] = $_POST['localidad_2'];
if (isset($_POST['cp_2']) && $_POST['pais_2'] == '55')          $post['dr_cp'] = $_POST['cp_2'];
if (isset($_POST['provincia_2']) && $_POST['pais_2'] == '55')   $post['dr_provincia'] = $_POST['provincia_2'];
if (isset($_POST['pais_2']))                                    $post['dr_pais'] = $_POST['pais_2'];
if (isset($_POST['tel_2']))                                     $post['dr_tel'] = $_POST['tel_2'];
if (isset($_POST['fax_2']))                                     $post['dr_fax'] = $_POST['fax_2'];
if (isset($_POST['mail_2']))                                    $post['dr_mail'] = $_POST['mail_2'];
if ($hook == 'Inscripcion')                                     $post['tipo_solicitud'] = '1';
elseif ($hook == 'Modificacion')                                $post['tipo_solicitud'] = '2';
elseif ($hook == 'Supresion')                                   $post['tipo_solicitud'] = '3';
if ($hook == 'Modificacion' && $post['tipo_solicitud'] == '2') {
    //      Se cumplimentarán con valor “1” aquellos elementos correspondientes a los apartados de los que se notifica la modificación
    //    de los datos que figuran inscritos en el Registro General de Protección de Datos, y tendrán valor “0” aquellos elementos
    //    correspondientes a los apartados que no sufran variación. Deberá haber al menos un elemento correspondiente a los apartados
    //    a modificar que tenga valor “1”.
    //      También deberá cumplimentarse el elemento Envio/reg_uno/declaracion/fichero/identifica_finalidad/denominación/c_inscripcion
    //    indicando el código de inscripción del fichero cuya modificación se solicita.
                                                                $post['ac_mod_responsable'] = $_POST['__1'];
                                                                $post['ac_mod_cif_nif_ant'] = $post['rf_cif'];
                                                                $post['ac_mod_servicio_unidad'] = $_POST['__2'];
                                                                $post['ac_mod_disposicion'] = '0';  // si fuera pública sería '1'
                                                                $post['ac_mod_iden_finalid'] = $_POST['__5'];
                                                                $post['ac_mod_encargado'] = $_POST['__4'];
                                                                $post['ac_mod_estruct_sistema'] = $_POST['__7'];
                                                                $post['ac_mod_medidas_seg'] = $_POST['__8'];
                                                                $post['ac_mod_origen'] = $_POST['__6'];
                                                                $post['ac_mod_trans_inter'] = $_POST['__10'];
                                                                $post['ac_mod_comunic_ces'] = $_POST['__9'];
}
if ($hook == 'Supresion' && $post['tipo_solicitud'] == '3') {
    //      También deberá cumplimentarse el elemento Envio/reg_uno/declaracion/fichero/identifica_finalidad/denominación/c_inscripcion
    //    indicando el código de inscripción del fichero cuya modificación se solicita.
                                                                $post['ac_supr_motivos'] = $_POST['txtmod1_'];
                                                                $post['ac_supr_destino_previsiones'] = $_POST['txtmod2_'];
                                                                $post['ac_supr_cifnif'] = $post['rf_cif'];
}

if ($hook != 'Supresion' && $post['tipo_solicitud'] != '3') {
    if (isset($_POST['denomsocial_4']))                             $post['et_nombre'] = $_POST['denomsocial_4'];
    if (isset($_POST['cif_4']))                                     $post['et_cif'] = $_POST['cif_4'];
    if (isset($_POST['direccion_4']))                               $post['et_dirpostal'] = $_POST['direccion_4'];
    if (isset($_POST['localidad_4']))                               $post['et_localidad'] = $_POST['localidad_4'];
    if (isset($_POST['cp_4']) && $_POST['pais_4'] == '55')          $post['et_cp'] = $_POST['cp_4'];
    if (isset($_POST['provincia_4']) && $_POST['pais_4'] == '55')   $post['et_provincia'] = $_POST['provincia_4'];
    if (isset($_POST['pais_4']))                                    $post['et_pais'] =  $_POST['pais_4'];
    if (isset($_POST['tel_4']))                                     $post['et_tel'] = $_POST['tel_4'];
    if (isset($_POST['fax_4']))                                     $post['et_fax'] = $_POST['fax_4'];
    if (isset($_POST['mail_4']))                                    $post['et_mail'] = $_POST['mail_4'];
    if (isset($_POST['nombre_5']))                              $post['idn_nombre'] = $_POST['nombre_5'];
    if (isset($_POST['descripcion_uso_5']))                     $post['idn_descripcion'] = $_POST['descripcion_uso_5'];
    if (isset($_POST['finalidades2'])) {
    //    foreach ($_POST['finalidades2'] as $key => $f_key) {
    //        $_POST['finalidades2'][$key] = Taula2Peer::retrieveByPk($f_key)->getDescripcion();
    //    }
                                                                $post['idn_finalidades'] = implode(';', $_POST['finalidades2']);
    }
}

if (isset($_POST['origen1_6']) && $_POST['origen1_6'] == '1')   $post['indica_inte'] = '1';
else                                                            $post['indica_inte'] = '0';
if (isset($_POST['origen2_6']) && $_POST['origen2_6'] == '2')   $post['indica_otras'] = '1';
else                                                            $post['indica_otras'] = '0';
if (isset($_POST['origen3_6']) && $_POST['origen3_6'] == '3')   $post['indic_fap'] = '1';
else                                                            $post['indic_fap'] = '0';
if (isset($_POST['origen4_6']) && $_POST['origen4_6'] == '4')   $post['indic_rp'] = '1';
else                                                            $post['indic_rp'] = '0';
if (isset($_POST['origen5_6']) && $_POST['origen5_6'] == '5')   $post['indic_ep'] = '1';
else                                                            $post['indic_ep'] = '0';
if (isset($_POST['origen6_6']) && $_POST['origen6_6'] == '6')   $post['indic_ap'] = '1';
else                                                            $post['indic_ap'] = '0';
if (isset($_POST['colectivos2'])) {
//    foreach ($_POST['colectivos2'] as $key => $c_key) {
//        $_POST['colectivos2'][$key] = Taula3Peer::retrieveByPk($c_key)->getDescripcion();
//    }
                                                                $post['op_colectivos'] = implode(';', $_POST['colectivos2']);
}
if (isset($_POST['otroscolectivos_6']))                         $post['op_otroscol'] = $_POST['otroscolectivos_6'];
if (isset($_POST['datos-pro1_7']) && $_POST['datos-pro1_7'] == '1')     $post['ind_ide'] = '1';
else                                                                    $post['ind_ide'] = '0';
if (isset($_POST['datos-pro2_7']) && $_POST['datos-pro2_7'] == '2')     $post['ind_as'] = '1';
else                                                                    $post['ind_as'] = '0';
if (isset($_POST['datos-pro3_7']) && $_POST['datos-pro3_7'] == '3')     $post['ind_r'] = '1';
else                                                                    $post['ind_r'] = '0';
if (isset($_POST['datos-pro4_7']) && $_POST['datos-pro4_7'] == '4')     $post['ind_c'] = '1';
else                                                                    $post['ind_c'] = '0';
if (isset($_POST['datos-pro5_7']) && $_POST['datos-pro5_7'] == '5')     $post['ind_re'] = '1';
else                                                                    $post['ind_re'] = '0';
if (isset($_POST['datos-pro6_7']) && $_POST['datos-pro6_7'] == '6')     $post['ind_sal'] = '1';
else                                                                    $post['ind_sal'] = '0';
if (isset($_POST['datos-pro7_7']) && $_POST['datos-pro7_7'] == '7')     $post['ind_sexo'] = '1';
else                                                                    $post['ind_sexo'] = '0';
if (isset($_POST['datos-pro7_8']) && $_POST['datos-pro7_8'] == '8')     $post['ind_nif'] = '1';
else                                                                    $post['ind_nif'] = '0';
if (isset($_POST['datos-pro7_9']) && $_POST['datos-pro7_9'] == '9')     $post['ind_ss'] = '1';
else                                                                    $post['ind_ss'] = '0';
if (isset($_POST['datos-pro7_10']) && $_POST['datos-pro7_10'] == '10')  $post['ind_n_a'] = '1';
else                                                                    $post['ind_n_a'] = '0';
if (isset($_POST['datos-pro7_11']) && $_POST['datos-pro7_11'] == '11')  $post['ind_ts'] = '1';
else                                                                    $post['ind_ts'] = '0';
if (isset($_POST['datos-pro7_12']) && $_POST['datos-pro7_12'] == '12')  $post['ind_dir'] = '1';
else                                                                    $post['ind_dir'] = '0';
if (isset($_POST['datos-pro7_13']) && $_POST['datos-pro7_13'] == '13')  $post['ind_tel'] = '1';
else                                                                    $post['ind_tel'] = '0';
if (isset($_POST['datos-pro7_14']) && $_POST['datos-pro7_14'] == '14')  $post['ind_huella'] = '1';
else                                                                    $post['ind_huella'] = '0';
if (isset($_POST['datos-pro7_15']) && $_POST['datos-pro7_15'] == '15')  $post['ind_img'] = '1';
else                                                                    $post['ind_img'] = '0';
if (isset($_POST['datos-pro7_16']) && $_POST['datos-pro7_16'] == '16')  $post['ind_marcas'] = '1';
else                                                                    $post['ind_marcas'] = '0';
if (isset($_POST['datos-pro7_17']) && $_POST['datos-pro7_17'] == '17')  $post['ind_firma'] = '1';
else                                                                    $post['ind_firma'] = '0';
if (isset($_POST['otros_7']))                                   $post['td_otrosprotegidos'] = $_POST['otros_7'];
if (isset($_POST['datos2'])) {
//    foreach ($_POST['datos2'] as $key => $d_key) {
//        $_POST['datos2'][$key] = Taula4Peer::retrieveByPk($d_key)->getDescripcion();
//    }
                                                                $post['td_otrostipificados'] = implode(';', $_POST['datos2']);
}
if (isset($_POST['otrostiposdatos_7']))                         $post['td_otrostiposdatos'] = $_POST['otrostiposdatos_7'];
if (isset($_POST['tratamiento_7']) && $_POST['tratamiento_7'] == '19')      $post['td_tratamiento'] = '1';  // Automatizado
elseif (isset($_POST['tratamiento_7']) && $_POST['tratamiento_7'] == '20')  $post['td_tratamiento'] = '2';  // Manual
elseif (isset($_POST['tratamiento_7']) && $_POST['tratamiento_7'] == '21')  $post['td_tratamiento'] = '3';  // Mixto
if (isset($_POST['seguridad_8']) && $_POST['seguridad_8'] == '22')      $post['seguridad'] = '1';   // Nivel básico
elseif (isset($_POST['seguridad_8']) && $_POST['seguridad_8'] == '23')  $post['seguridad'] = '2';   // Nivel medio
elseif (isset($_POST['seguridad_8']) && $_POST['seguridad_8'] == '24')  $post['seguridad'] = '3';   // Nivel alto
if (isset($_POST['medidas2'])) {
//    foreach ($_POST['medidas2'] as $key => $m_key) {
//        $_POST['medidas2'][$key] = Taula5Peer::retrieveByPk($m_key)->getDescripcion();
//    }
                                                                $post['cd_destinatarios'] = implode(';', $_POST['medidas2']);
}
if (isset($_POST['otrosdestina_9']))                            $post['cd_otrosdestinatarios'] = $_POST['otrosdestinatarioscesion_9'];
$paises_destina = array();
$cat_destina = array();
if (isset($_POST['pais_10_1']) && $_POST['pais_10_1'] != '0' && isset($_POST['cat-destina_10_1']) && $_POST['cat-destina_10_1'] != '0') {
    $paises_destina[] = $_POST['pais_10_1'];
    $cat_destina[] = $_POST['cat-destina_10_1'];
}
if (isset($_POST['pais_10_2']) && $_POST['pais_10_2'] != '0' && isset($_POST['cat-destina_10_2']) && $_POST['cat-destina_10_2'] != '0') {
    $paises_destina[] = $_POST['pais_10_2'];
    $cat_destina[] = $_POST['cat-destina_10_2'];
}
if (isset($_POST['pais_10_3']) && $_POST['pais_10_3'] != '0' && isset($_POST['cat-destina_10_3']) && $_POST['cat-destina_10_3'] != '0') {
    $paises_destina[] = $_POST['pais_10_3'];
    $cat_destina[] = $_POST['cat-destina_10_3'];
}
if (isset($_POST['pais_10_4']) && $_POST['pais_10_4'] != '0' && isset($_POST['cat-destina_10_4']) && $_POST['cat-destina_10_4'] != '0') {
    $paises_destina[] = $_POST['pais_10_4'];
    $cat_destina[] = $_POST['cat-destina_10_4'];
}
if (count($paises_destina) > 1 && count($cat_destina) > 1) {
    foreach ($paises_destina as $k => $v) {
        $con = Propel::getConnection();
        $query = "SELECT `paises`.`cod` FROM `paises` WHERE `paises`.`pid` = '".$v."';";
        $statement = $con->prepare($query);
        $statement->execute();
        $resultset = $statement->fetch(PDO::FETCH_OBJ);
        $paises_destina[$k] = $resultset->cod;
    }
                                                                $post['paises_destina'] = implode(';', $paises_destina);
                                                                $post['cat_destina'] = implode(';', $cat_destina);
} else if (count($paises_destina) == 1 && count($cat_destina) == 1) {
    $con = Propel::getConnection();
    $query = "SELECT `paises`.`cod` FROM `paises` WHERE `paises`.`pid` = '".$paises_destina[0]."';";
    $statement = $con->prepare($query);
    $statement->execute();
    $resultset = $statement->fetch(PDO::FETCH_OBJ);
                                                                $post['paises_destina'] = $resultset->cod;
                                                                $post['cat_destina'] = $cat_destina[0];
}
if (isset($_POST['otro-pais_10']) && $_POST['otro-pais_10'] != '0' && isset($_POST['otra-cat-destina_10']) && $_POST['otra-cat-destina_10'] != '') {
    $con = Propel::getConnection();
    $query = "SELECT `paises`.`cod` FROM `paises` WHERE `paises`.`pid` = '".$_POST['otro-pais_10']."';";
    $statement = $con->prepare($query);
    $statement->execute();
    $resultset = $statement->fetch(PDO::FETCH_OBJ);
                                                                $post['otro_pais_destina'] = $_POST['otra-cat-destina_10'].';'.$resultset->cod;
}

foreach ($post as $k => $v) $post[$k] = '"'.filter_var($v, FILTER_SANITIZE_SPECIAL_CHARS).'"';
$con = Propel::getConnection();
$query = 'INSERT INTO `notificaciones` ('.implode(',', array_keys($post)).') VALUES ('.implode(',', $post).');';
$statement = $con->prepare($query);
try {
    $statement->execute();
                                                                $post['hook'] = $hook;
    foreach ($post as $k => $v) $post[$k] = str_replace('"', '', $v);
    $insert = true;
    if ($hook == 'Inscripcion' && $post['tipo_solicitud'] == '1') {
        include_partial('ver_xml', array('post' => $post, 'notid' => Propel::getConnection()->lastInsertId(), 'encargado' => $encargado, 'action' => $action, 'insert' => $insert));
    } elseif ($hook == 'Modificacion' && $post['tipo_solicitud'] == '2') {
        include_partial('ver_xml', array('post' => $post, 'notid' => Propel::getConnection()->lastInsertId(), 'encargado' => $encargado, 'action' => $action, 'insert' => $insert, 'codigo_agencia' => $_POST['codinsmod']));
    } elseif ($hook == 'Supresion' && $post['tipo_solicitud'] == '3') {
        include_partial('ver_xml', array('post' => $post, 'notid' => Propel::getConnection()->lastInsertId(), 'encargado' => $encargado, 'action' => $action, 'insert' => $insert, 'codigo_agencia' => $_POST['codinsmod_']));
    }
} catch (Exception $e) {
    echo __('Error insertando en la base de datos');
} ?>