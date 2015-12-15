<?php
                                        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n";
                                        $xml .= '<Envio Id="AGPD">';

                                        $xml .= "\n\t<reg_cero>";
                                        $xml .= "\n\t\t<id_rock>0</id_rock>";
                                        $xml .= "\n\t\t<ind_titula>".$post['titularidad']."</ind_titula>";
                                        $xml .= "\n\t\t<ind_soporte>".$post['presentacion']."</ind_soporte>";
                                        $xml .= "\n\t\t<f_proceso>".$post['fecha']."</f_proceso>";
                                        $xml .= "\n\t\t<h_proceso>".$post['hora_proceso']."</h_proceso>";
                                        $xml .= "\n\t\t<ind_procesado>0</ind_procesado>";
                                        $xml .= "\n\t</reg_cero>";

                                        $xml .= "\n\t<reg_uno>";

                                        $xml .= "\n\t\t<Control>";
                                        $xml .= "\n\t\t\t<id_rock>1</id_rock>";
                                        $xml .= "\n\t\t\t<forma_c>".$post['forma']."</forma_c>";
if ($post['titularidad'] == '1')        $xml .= "\n\t\t\t<signatura>Pu000</signatura>";
else if ($post['titularidad'] == '2')   $xml .= "\n\t\t\t<signatura>Pr000</signatura>";
                                        $xml .= "\n\t\t\t<id_upload>".$post['id_upload']."</id_upload>";
                                        $xml .= "\n\t\t\t<f_web/>";
                                        $xml .= "\n\t\t\t<h_web/>";
                                        $xml .= "\n\t\t\t<num_reg/>";
                                        $xml .= "\n\t\t</Control>";

                                        $xml .= "\n\t\t<declarante>";
                                        $xml .= "\n\t\t\t<control>";
                                        $xml .= "\n\t\t\t\t<futuro_uso/>";
                                        $xml .= "\n\t\t\t\t<est_err/>";
                                        $xml .= "\n\t\t\t\t<doc_anexa/>";
                                        $xml .= "\n\t\t\t</control>";
                                        $xml .= "\n\t\t\t<hoja_solicitud>";

                                        $xml .= "\n\t\t\t\t<persona_fisica>";
if (isset($post['pf_razon_s']))         $xml .= "\n\t\t\t\t\t<razon_s>".$post['pf_razon_s'].'</razon_s>';
else                                    $xml .= "\n\t\t\t\t\t<razon_s/>";
if (isset($post['pf_cif_nif']))         $xml .= "\n\t\t\t\t\t<cif_nif>".$post['pf_cif_nif'].'</cif_nif>';
else                                    $xml .= "\n\t\t\t\t\t<cif_nif/>";
if (isset($post['pf_nombre']))          $xml .= "\n\t\t\t\t\t<nombre>".$post['pf_nombre'].'</nombre>';
else                                    $xml .= "\n\t\t\t\t\t<nombre/>";
if (isset($post['pf_apellido1']))       $xml .= "\n\t\t\t\t\t<apellido1>".$post['pf_apellido1'].'</apellido1>';
else                                    $xml .= "\n\t\t\t\t\t<apellido1/>";
if (isset($post['pf_apellido2']))       $xml .= "\n\t\t\t\t\t<apellido2>".$post['pf_apellido2'].'</apellido2>';
else                                    $xml .= "\n\t\t\t\t\t<apellido2/>";
if (isset($post['pf_nif']))             $xml .= "\n\t\t\t\t\t<nif>".$post['pf_nif'].'</nif>';
else                                    $xml .= "\n\t\t\t\t\t<nif/>";
if (isset($post['pf_cargo']))           $xml .= "\n\t\t\t\t\t<cargo>".$post['pf_cargo']."</cargo>";
else                                    $xml .= "\n\t\t\t\t\t<cargo/>";
                                        $xml .= "\n\t\t\t\t</persona_fisica>";

                                        $xml .= "\n\t\t\t\t<direccion_notif>";
if (isset($post['dec_razon_s']))        $xml .= "\n\t\t\t\t\t<denomina_p>".$post['dec_razon_s'].'</denomina_p>';
else                                    $xml .= "\n\t\t\t\t\t<denomina_p/>";
if (isset($post['dec_direccion']))      $xml .= "\n\t\t\t\t\t<dir_postal>".$post['dec_direccion'].'</dir_postal>';
else                                    $xml .= "\n\t\t\t\t\t<dir_postal/>";
if (isset($post['dec_pais']) && $post['dec_pais'] != '0') {
    $con = Propel::getConnection();
    $query = "SELECT cod FROM `paises` WHERE `paises`.`pid` = '".$post['dec_pais']."';";
    $statement = $con->prepare($query);
    $statement->execute();
    $resultset = $statement->fetch(PDO::FETCH_OBJ);
                                        $xml .= "\n\t\t\t\t\t<pais>".$resultset->cod.'</pais>';
} else                                  $xml .= "\n\t\t\t\t\t<pais/>";
if (isset($post['dec_provincia']))      $xml .= "\n\t\t\t\t\t<provincia>".$post['dec_provincia'].'</provincia>';
else                                    $xml .= "\n\t\t\t\t\t<provincia/>";
if (isset($post['dec_localidad']))      $xml .= "\n\t\t\t\t\t<localidad>".$post['dec_localidad'].'</localidad>';
else                                    $xml .= "\n\t\t\t\t\t<localidad/>";
if (isset($post['dec_cp']))             $xml .= "\n\t\t\t\t\t<postal>".$post['dec_cp'].'</postal>';
else                                    $xml .= "\n\t\t\t\t\t<postal/>";
if (isset($post['dec_tel']))            $xml .= "\n\t\t\t\t\t<telefono>".$post['dec_tel'].'</telefono>';
else                                    $xml .= "\n\t\t\t\t\t<telefono/>";
if (isset($post['dec_fax']))            $xml .= "\n\t\t\t\t\t<fax>".$post['dec_fax'].'</fax>';
else                                    $xml .= "\n\t\t\t\t\t<fax/>";
if (isset($post['dec_mail']))           $xml .= "\n\t\t\t\t\t<email>".$post['dec_mail'].'</email>';
else                                    $xml .= "\n\t\t\t\t\t<email/>";
if (isset($post['dec_forma']))          $xml .= "\n\t\t\t\t\t<forma>".$post['dec_forma']."</forma>";
else                                    $xml .= "\n\t\t\t\t\t<forma/>";
                                        $xml .= "\n\t\t\t\t\t<Id_notific/>";
                                        $xml .= "\n\t\t\t\t\t<ind_deberes>1</ind_deberes>";
                                        $xml .= "\n\t\t\t\t</direccion_notif>";
                                        $xml .= "\n\t\t\t</hoja_solicitud>";
                                        $xml .= "\n\t\t</declarante>";

                                        $xml .= "\n\t\t<declaracion>";
                                        $xml .= "\n\t\t\t<responsable>";
                                        $xml .= "\n\t\t\t\t<control>";
                                        $xml .= "\n\t\t\t\t\t<ordinal>01</ordinal>";
                                        $xml .= "\n\t\t\t\t\t<est_err/>";
                                        $xml .= "\n\t\t\t\t\t<texto_libre/>";
                                        $xml .= "\n\t\t\t\t</control>";
                                        $xml .= "\n\t\t\t\t<responsable_fichero>";
if (isset($post['rf_cif']))             $xml .= "\n\t\t\t\t\t<cif>".$post['rf_cif'].'</cif>';
else                                    $xml .= "\n\t\t\t\t\t<cif/>";
if (isset($post['rf_domicilio']))       $xml .= "\n\t\t\t\t\t<dir_postal>".$post['rf_domicilio'].'</dir_postal>';
else                                    $xml .= "\n\t\t\t\t\t<dir_postal/>";
if (isset($post['rf_cp']))              $xml .= "\n\t\t\t\t\t<postal>".$post['rf_cp'].'</postal>';
else                                    $xml .= "\n\t\t\t\t\t<postal/>";
                                        $xml .= "\n\t\t\t\t\t<localidad>".$post['rf_localidad'].'</localidad>';
if (isset($post['rf_provincia']))       $xml .= "\n\t\t\t\t\t<provincia>".$post['rf_provincia'].'</provincia>';
else                                    $xml .= "\n\t\t\t\t\t<provincia/>";
$con = Propel::getConnection();
$query = "SELECT cod FROM `paises` WHERE `paises`.`pid` = '".$post['rf_pais']."';";
$statement = $con->prepare($query);
$statement->execute();
$resultset = $statement->fetch(PDO::FETCH_OBJ);
                                        $xml .= "\n\t\t\t\t\t<pais>".$resultset->cod.'</pais>';
if (isset($post['rf_tel']))             $xml .= "\n\t\t\t\t\t<telefono>".$post['rf_tel'].'</telefono>';
else                                    $xml .= "\n\t\t\t\t\t<telefono/>";
if (isset($post['rf_fax']))             $xml .= "\n\t\t\t\t\t<fax>".$post['rf_fax'].'</fax>';
else                                    $xml .= "\n\t\t\t\t\t<fax/>";
if (isset($post['rf_mail']))            $xml .= "\n\t\t\t\t\t<email>".$post['rf_mail'].'</email>';
else                                    $xml .= "\n\t\t\t\t\t<email/>";
                                        $xml .= "\n\t\t\t\t\t<n_razon>".$post['rf_nombre']."</n_razon>";
                                        $xml .= "\n\t\t\t\t\t<cap>".$post['rf_actividad']."</cap>";
                                        $xml .= "\n\t\t\t\t\t<tip_admin/>";
                                        $xml .= "\n\t\t\t\t\t<cod_automia/>";
                                        $xml .= "\n\t\t\t\t\t<denomina_ente/>";
                                        $xml .= "\n\t\t\t\t\t<denomina_dirdep/>";
                                        $xml .= "\n\t\t\t\t\t<denomina_organo/>";
                                        $xml .= "\n\t\t\t\t</responsable_fichero>";
                                        $xml .= "\n\t\t\t\t<derecho>";
if (isset($post['dr_nombreof']))        $xml .= "\n\t\t\t\t\t<oficina>".$post['dr_nombreof'].'</oficina>';
else                                    $xml .= "\n\t\t\t\t\t<oficina/>";
if (isset($post['dr_cif']))             $xml .= "\n\t\t\t\t\t<nif_cif>".$post['dr_cif'].'</nif_cif>';
else                                    $xml .= "\n\t\t\t\t\t<nif_cif/>";
if (isset($post['dr_dirpostal']))       $xml .= "\n\t\t\t\t\t<dir_postal>".$post['dr_dirpostal'].'</dir_postal>';
else                                    $xml .= "\n\t\t\t\t\t<dir_postal/>";
if (isset($post['dr_localidad']))       $xml .= "\n\t\t\t\t\t<localidad>".$post['dr_localidad'].'</localidad>';
else                                    $xml .= "\n\t\t\t\t\t<localidad/>";
if (isset($post['dr_cp']))              $xml .= "\n\t\t\t\t\t<postal>".$post['dr_cp'].'</postal>';
else                                    $xml .= "\n\t\t\t\t\t<postal/>";
if (isset($post['dr_provincia']))       $xml .= "\n\t\t\t\t\t<provincia>".$post['dr_provincia'].'</provincia>';
else                                    $xml .= "\n\t\t\t\t\t<provincia/>";
if (isset($post['dr_pais']) && $post['dr_pais'] != '0')
                                        $xml .= "\n\t\t\t\t\t<pais>".$post['dr_pais'].'</pais>';
else                                    $xml .= "\n\t\t\t\t\t<pais/>";
if (isset($post['dr_tel']))             $xml .= "\n\t\t\t\t\t<telefono>".$post['dr_tel'].'</telefono>';
else                                    $xml .= "\n\t\t\t\t\t<telefono/>";
if (isset($post['dr_fax']))             $xml .= "\n\t\t\t\t\t<fax>".$post['dr_fax'].'</fax>';
else                                    $xml .= "\n\t\t\t\t\t<fax/>";
if (isset($post['dr_mail']))            $xml .= "\n\t\t\t\t\t<email>".$post['dr_mail'].'</email>';
else                                    $xml .= "\n\t\t\t\t\t<email/>";
                                        $xml .= "\n\t\t\t\t</derecho>";
                                        $xml .= "\n\t\t\t</responsable>";

                                        $xml .= "\n\t\t\t<fichero>";
                                        $xml .= "\n\t\t\t\t<control>";

                                        $xml .= "\n\t\t\t\t\t<acciones_generales>";
                                        $xml .= "\n\t\t\t\t\t\t<ordinal>0001</ordinal>";
                                        $xml .= "\n\t\t\t\t\t\t<tipo_solicitud>".$post['tipo_solicitud']."</tipo_solicitud>";
                                        $xml .= "\n\t\t\t\t\t\t<est_err/>";
                                        $xml .= "\n\t\t\t\t\t\t<doc_anexa/>";
                                        $xml .= "\n\t\t\t\t\t</acciones_generales>";

                                        $xml .= "\n\t\t\t\t\t<acciones_not_alta>";
                                        $xml .= "\n\t\t\t\t\t\t<fecha_reg/>";
                                        $xml .= "\n\t\t\t\t\t\t<num_reg/>";
                                        $xml .= "\n\t\t\t\t\t\t<id_resolucion/>";
                                        $xml .= "\n\t\t\t\t\t</acciones_not_alta>";

                                        $xml .= "\n\t\t\t\t\t<acciones_mod>";
if ($post['hook'] == 'Modificacion' && $post['tipo_solicitud'] == '2') {
                                        $xml .= "\n\t\t\t\t\t\t<responsable>".$post['ac_mod_responsable']."</responsable>";
                                        $xml .= "\n\t\t\t\t\t\t<cif_nif_ant>".$post['ac_mod_cif_nif_ant']."</cif_nif_ant>";
                                        $xml .= "\n\t\t\t\t\t\t<servicio_unidad>".$post['ac_mod_servicio_unidad']."</servicio_unidad>";
                                        $xml .= "\n\t\t\t\t\t\t<disposicion>".$post['ac_mod_disposicion']."</disposicion>";
                                        $xml .= "\n\t\t\t\t\t\t<iden_finalid>".$post['ac_mod_iden_finalid']."</iden_finalid>";
                                        $xml .= "\n\t\t\t\t\t\t<encargado>".$post['ac_mod_encargado']."</encargado>";
                                        $xml .= "\n\t\t\t\t\t\t<estruct_sistema>".$post['ac_mod_estruct_sistema']."</estruct_sistema>";
                                        $xml .= "\n\t\t\t\t\t\t<medidas_seg>".$post['ac_mod_medidas_seg']."</medidas_seg>";
                                        $xml .= "\n\t\t\t\t\t\t<origen>".$post['ac_mod_origen']."</origen>";
                                        $xml .= "\n\t\t\t\t\t\t<trans_inter>".$post['ac_mod_trans_inter']."</trans_inter>";
                                        $xml .= "\n\t\t\t\t\t\t<comunic_ces>".$post['ac_mod_comunic_ces']."</comunic_ces>";
} else {
                                        $xml .= "\n\t\t\t\t\t\t<responsable/>";
                                        $xml .= "\n\t\t\t\t\t\t<cif_nif_ant/>";
                                        $xml .= "\n\t\t\t\t\t\t<servicio_unidad/>";
                                        $xml .= "\n\t\t\t\t\t\t<disposicion/>";
                                        $xml .= "\n\t\t\t\t\t\t<iden_finalid/>";
                                        $xml .= "\n\t\t\t\t\t\t<encargado/>";
                                        $xml .= "\n\t\t\t\t\t\t<estruct_sistema/>";
                                        $xml .= "\n\t\t\t\t\t\t<medidas_seg/>";
                                        $xml .= "\n\t\t\t\t\t\t<origen/>";
                                        $xml .= "\n\t\t\t\t\t\t<trans_inter/>";
                                        $xml .= "\n\t\t\t\t\t\t<comunic_ces/>";
}
                                        $xml .= "\n\t\t\t\t\t</acciones_mod>";

                                        $xml .= "\n\t\t\t\t\t<acciones_supr>";
if ($post['hook'] == 'Supresion' && $post['tipo_solicitud'] == '3') {
                                        $xml .= "\n\t\t\t\t\t\t<motivos>".$post['ac_supr_motivos']."</motivos>";
                                        $xml .= "\n\t\t\t\t\t\t<destino_previsiones>".$post['ac_supr_destino_previsiones']."</destino_previsiones>";
                                        $xml .= "\n\t\t\t\t\t\t<cifnif>".$post['ac_supr_cifnif']."</cifnif>";
} else {
                                        $xml .= "\n\t\t\t\t\t\t<motivos/>";
                                        $xml .= "\n\t\t\t\t\t\t<destino_previsiones/>";
                                        $xml .= "\n\t\t\t\t\t\t<cifnif/>";
}
                                        $xml .= "\n\t\t\t\t\t</acciones_supr>";

                                        $xml .= "\n\t\t\t\t</control>";

                                        $xml .= "\n\t\t\t\t<dispo_gen_cms>";
if ($post['titularidad'] == '2') {  //// Titularidad privada.
                                        $xml .= "\n\t\t\t\t\t<cod_boletin/>";
                                        $xml .= "\n\t\t\t\t\t<num_boletin/>";
                                        $xml .= "\n\t\t\t\t\t<fecha/>";
                                        $xml .= "\n\t\t\t\t\t<disposicion/>";
                                        $xml .= "\n\t\t\t\t\t<url/>";
} else {
    //// Titularidad pública, habría que implemetar si fuera necesario.
}
                                        $xml .= "\n\t\t\t\t</dispo_gen_cms>";

                                        $xml .= "\n\t\t\t\t<encargado>";
if ($post['hook'] == 'Supresion' && $post['tipo_solicitud'] == '3') {
                                        $xml .= "\n\t\t\t\t\t<n_razon/>";
                                        $xml .= "\n\t\t\t\t\t<cif_nif/>";
                                        $xml .= "\n\t\t\t\t\t<dir_postal/>";
                                        $xml .= "\n\t\t\t\t\t<localidad/>";
                                        $xml .= "\n\t\t\t\t\t<postal/>";
                                        $xml .= "\n\t\t\t\t\t<provincia/>";
                                        $xml .= "\n\t\t\t\t\t<pais/>";
                                        $xml .= "\n\t\t\t\t\t<telefono/>";
                                        $xml .= "\n\t\t\t\t\t<fax/>";
                                        $xml .= "\n\t\t\t\t\t<email/>";
} else {
    if (isset($post['et_nombre']))      $xml .= "\n\t\t\t\t\t\t<n_razon>".$post['et_nombre'].'</n_razon>';
    else                                $xml .= "\n\t\t\t\t\t<n_razon/>";
    if (isset($post['et_cif']))         $xml .= "\n\t\t\t\t\t\t<cif_nif>".$post['et_cif'].'</cif_nif>';
    else                                $xml .= "\n\t\t\t\t\t<cif_nif/>";
    if (isset($post['et_dirpostal']))   $xml .= "\n\t\t\t\t\t<dir_postal>".$post['et_dirpostal'].'</dir_postal>';
    else                                $xml .= "\n\t\t\t\t\t<dir_postal/>";
    if (isset($post['et_localidad']))   $xml .= "\n\t\t\t\t\t<localidad>".$post['et_localidad'].'</localidad>';
    else                                $xml .= "\n\t\t\t\t\t<localidad/>";
    if (isset($post['et_cp']))          $xml .= "\n\t\t\t\t\t<postal>".$post['et_cp'].'</postal>';
    else                                $xml .= "\n\t\t\t\t\t<postal/>";
    if (isset($post['et_provincia']))   $xml .= "\n\t\t\t\t\t<provincia>".$post['et_provincia'].'</provincia>';
    else                                $xml .= "\n\t\t\t\t\t<provincia/>";
    if (isset($post['et_pais']))        $xml .= "\n\t\t\t\t\t<pais>".$post['et_pais'].'</pais>';
    else                                $xml .= "\n\t\t\t\t\t<pais/>";
    if (isset($post['et_tel']))         $xml .= "\n\t\t\t\t\t<telefono>".$post['et_tel'].'</telefono>';
    else                                $xml .= "\n\t\t\t\t\t<telefono/>";
    if (isset($post['et_fax']))         $xml .= "\n\t\t\t\t\t<fax>".$post['et_fax'].'</fax>';
    else                                $xml .= "\n\t\t\t\t\t<fax/>";
    if (isset($post['et_mail']))        $xml .= "\n\t\t\t\t\t<email>".$post['et_mail'].'</email>';
    else                                $xml .= "\n\t\t\t\t\t<email/>";
}
                                        $xml .= "\n\t\t\t\t</encargado>";

                                        $xml .= "\n\t\t\t\t\t<identifica_finalidad>";
                                        $xml .= "\n\t\t\t\t\t<denominacion>";
if (isset($post['idn_nombre']))         $xml .= "\n\t\t\t\t\t\t<fichero>".$post['idn_nombre'].'</fichero>';
else                                    $xml .= "\n\t\t\t\t\t\t<fichero/>";
// Código de inscripción:   En las solicitudes de modificación o de supresión de ficheros, deberá contener obligatoriamente el código de inscripción del fichero a modificar o a suprimir.

if (($post['hook'] == 'Modificacion' && $post['tipo_solicitud'] == '2') || ($post['hook'] == 'Supresion' && $post['tipo_solicitud'] == '3'))
                                        $xml .= "\n\t\t\t\t\t\t<c_inscripcion>".$codigo_agencia.'</c_inscripcion>';
else                                    $xml .= "\n\t\t\t\t\t\t<c_inscripcion/>";
// Código de inscripción de terceros:   En las notificaciones realizadas por las Agencias Autonómicas de Protección de Datos, se podrá indicar en este elemento el código de inscripción asignado por la Agencia Autonómica para el fichero que se notifica.
                                        $xml .= "\n\t\t\t\t\t\t<c_inscrip_t/>";
// Fecha de inscripción:    No se rellena. Debe venir vacío.
                                        $xml .= "\n\t\t\t\t\t\t<f_inscrip/>";                                        
if (isset($post['idn_descripcion']))    $xml .= "\n\t\t\t\t\t\t<desc_fin_usos>".$post['idn_descripcion'].'</desc_fin_usos>';
else                                    $xml .= "\n\t\t\t\t\t\t<desc_fin_usos/>";
                                        $xml .= "\n\t\t\t\t\t</denominacion>";
                                        $xml .= "\n\t\t\t\t\t<tipificacion>";
if (isset($post['idn_finalidades']))    $xml .= "\n\t\t\t\t\t\t<finalidades>".$post['idn_finalidades'].'</finalidades>';
else                                    $xml .= "\n\t\t\t\t\t\t<finalidades/>";
                                        $xml .= "\n\t\t\t\t\t</tipificacion>";
                                        $xml .= "\n\t\t\t\t</identifica_finalidad>";

                                        $xml .= "\n\t\t\t\t<procedencia>";
                                        
                                        $xml .= "\n\t\t\t\t\t<origen>";
                                        $xml .= "\n\t\t\t\t\t\t<indica_inte>".$post['indica_inte']."</indica_inte>";
                                        $xml .= "\n\t\t\t\t\t\t<indica_otras>".$post['indica_otras']."</indica_otras>";
                                        $xml .= "\n\t\t\t\t\t\t<indic_fap>".$post['indic_fap']."</indic_fap>";
                                        $xml .= "\n\t\t\t\t\t\t<indic_rp>".$post['indic_rp']."</indic_rp>";
                                        $xml .= "\n\t\t\t\t\t\t<indic_ep>".$post['indic_ep']."</indic_ep>";
                                        $xml .= "\n\t\t\t\t\t\t<indic_ap>".$post['indic_ap']."</indic_ap>";
                                        $xml .= "\n\t\t\t\t\t</origen>";

                                        $xml .= "\n\t\t\t\t\t<colectivos_categ>";
if (isset($post['op_colectivos']))      $xml .= "\n\t\t\t\t\t\t<colectivos>".$post['op_colectivos']."</colectivos>";
else                                    $xml .= "\n\t\t\t\t\t\t<colectivos/>";
if (isset($post['op_otroscol']))        $xml .= "\n\t\t\t\t\t\t<otro_col>".$post['op_otroscol']."</otro_col>";
else                                    $xml .= "\n\t\t\t\t\t\t<otro_col/>";
                                        $xml .= "\n\t\t\t\t\t</colectivos_categ>";
                                        $xml .= "\n\t\t\t\t</procedencia>";

                                        $xml .= "\n\t\t\t\t<medidas_seg>";
if (isset($post['seguridad']) && ($post['hook'] == 'Inscripcion' || $post['hook'] == 'Modificacion')) {
                                        $xml .= "\n\t\t\t\t\t<nivel>".$post['seguridad']."</nivel>";
} else if ($post['hook'] == 'Supresion') {
                                        $xml .= "\n\t\t\t\t\t<nivel/>";
}
                                        $xml .= "\n\t\t\t\t\t<f_audit/>";
                                        $xml .= "\n\t\t\t\t\t<t_audit/>";
                                        $xml .= "\n\t\t\t\t</medidas_seg>";

                                        $xml .= "\n\t\t\t\t<estructura>";

                                        $xml .= "\n\t\t\t\t\t<datos_esp_proteg>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_ide>".$post['ind_ide']."</ind_ide>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_as>".$post['ind_as']."</ind_as>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_r>".$post['ind_r']."</ind_r>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_c>".$post['ind_c']."</ind_c>";
                                        $xml .= "\n\t\t\t\t\t</datos_esp_proteg>";

                                        $xml .= "\n\t\t\t\t\t<otros_esp_proteg>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_re>".$post['ind_re']."</ind_re>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_sal>".$post['ind_sal']."</ind_sal>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_sexo>".$post['ind_sexo']."</ind_sexo>";
                                        $xml .= "\n\t\t\t\t\t</otros_esp_proteg>";

                                        $xml .= "\n\t\t\t\t\t<infracciones_penal>";
if ($post['titularidad'] == '2') {  //  Titularidad pública
                                        $xml .= "\n\t\t\t\t\t\t<ind_ipen>0</ind_ipen>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_iad>0</ind_iad>";
}
                                        $xml .= "\n\t\t\t\t\t</infracciones_penal>";

                                        $xml .= "\n\t\t\t\t\t<identificativos>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_nif>".$post['ind_nif']."</ind_nif>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_ss>".$post['ind_ss']."</ind_ss>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_n_a>".$post['ind_n_a']."</ind_n_a>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_ts>".$post['ind_ts']."</ind_ts>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_dir>".$post['ind_dir']."</ind_dir>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_tel>".$post['ind_tel']."</ind_tel>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_huella>".$post['ind_huella']."</ind_huella>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_img>".$post['ind_img']."</ind_img>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_marcas>".$post['ind_marcas']."</ind_marcas>";
                                        $xml .= "\n\t\t\t\t\t\t<ind_firma>".$post['ind_firma']."</ind_firma>";
if ($post['titularidad'] == '2') {  //  Titularidad pública
                                        $xml .= "\n\t\t\t\t\t\t<ind_registro>1</ind_registro>";
} elseif ($post['titularidad'] == '1') {  //  Titularidad privada
                                        $xml .= "\n\t\t\t\t\t\t<ind_registro>0</ind_registro>";
}
if (isset($post['td_otrosprotegidos'])) $xml .= "\n\t\t\t\t\t\t<ODCI>".$post['td_otrosprotegidos']."</ODCI>";
else                                    $xml .= "\n\t\t\t\t\t\t<ODCI/>";
                                        $xml .= "\n\t\t\t\t\t</identificativos>";

                                        $xml .= "\n\t\t\t\t\t<otros>";
if (isset($post['td_otrostipificados']))    $xml .= "\n\t\t\t\t\t\t<otros_tipos>".$post['td_otrostipificados']."</otros_tipos>";
else                                        $xml .= "\n\t\t\t\t\t\t<otros_tipos/>";
if (isset($post['td_otrostiposdatos'])) $xml .= "\n\t\t\t\t\t\t<desc_otros_tipos>".$post['td_otrostiposdatos']."</desc_otros_tipos>";
else                                    $xml .= "\n\t\t\t\t\t\t<desc_otros_tipos/>";
                                        $xml .= "\n\t\t\t\t\t</otros>";

                                        $xml .= "\n\t\t\t\t\t<sist_tratamiento>";
if (isset($post['td_tratamiento']))     $xml .= "\n\t\t\t\t\t\t<sis_trata>".$post['td_tratamiento']."</sis_trata>";
else                                    $xml .= "\n\t\t\t\t\t\t<sis_trata/>";
                                        $xml .= "\n\t\t\t\t\t</sist_tratamiento>";

                                        $xml .= "\n\t\t\t\t</estructura>";

                                        $xml .= "\n\t\t\t\t<cesion>";
                                        $xml .= "\n\t\t\t\t\t<cesiones/>";
                                        $xml .= "\n\t\t\t\t\t<desc_otros/>";
                                        $xml .= "\n\t\t\t\t</cesion>";

                                        $xml .= "\n\t\t\t\t<transfer_inter>";
if (isset($post['paises_destina']) && isset($post['cat_destina'])) {
                                        $xml .= "\n\t\t\t\t\t<pais>".$post['paises_destina']."</pais>";
                                        $xml .= "\n\t\t\t\t\t<categoria>".$post['cat_destina']."</categoria>";
} else {
                                        $xml .= "\n\t\t\t\t\t<pais/>";
                                        $xml .= "\n\t\t\t\t\t<categoria/>";
}
if (isset($post['otro_pais_destina']))  $xml .= "\n\t\t\t\t\t<otros>".$post['otro_pais_destina']."</otros>";
else                                    $xml .= "\n\t\t\t\t\t<otros/>";
                                        $xml .= "\n\t\t\t\t</transfer_inter>";

                                        $xml .= "\n\t\t\t</fichero>";
                                        $xml .= "\n\t\t</declaracion>";

                                        $xml .= "\n\t\t<final>";
                                        $xml .= "\n\t\t\t<contador/>";
                                        $xml .= "\n\t\t\t<tot_altas/>";
                                        $xml .= "\n\t\t\t<tot_modif/>";
                                        $xml .= "\n\t\t\t<tot_bajas/>";
                                        $xml .= "\n\t\t</final>";
                                        $xml .= "\n\t</reg_uno>";
                                        $xml .= "\n</Envio>";

file_put_contents(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$post['id_fichero'].'-'.$notid.'.xml', utf8_decode($xml));
if (isset($insert) && $insert)  include_partial('mostrar', array('id_fichero' => $post['id_fichero'], 'notid' => $notid, 'encargado' => $encargado, 'action' => $action, 'insert' => $insert));
else    include_partial('mostrar', array('id_fichero' => $post['id_fichero'], 'notid' => $notid, 'encargado' => $encargado, 'action' => $action)); ?>