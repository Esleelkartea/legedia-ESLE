<script type="text/javascript"><!--
    jQuery(document).ready(function() {
        var same_height = 0;
        jQuery('fieldset.same_height').each(function() {<?php
            if (isset($solicitud) && $solicitud) { ?>
                if (jQuery(this).height() > same_height)    same_height = jQuery(this).height() - 10;
                else    jQuery(this).height(same_height);<?php
            } else { ?>
                if (jQuery(this).height() > same_height)    same_height = jQuery(this).height();
                else    jQuery(this).height(same_height);<?php
            } ?>
        });<?php
        if (isset($solicitud) && $solicitud) { ?>
            jQuery(document).find('input, textarea, select, radio, checkbox').each(function() {
                jQuery(this).readonly(true);
                jQuery(this).css({'border' : '0px'});
                jQuery(this).css({'background-color' : '#ffffff'});
                jQuery(this).css({'color' : '#000000'});
            });<?php
        } ?>
    });
--></script><?php
if (isset($solicitud) && $solicitud) {
    preg_match('/<tot_altas>(.*)<\/tot_altas>/', $respuesta, $altas);
    preg_match('/<tot_modif>(.*)<\/tot_modif>/', $respuesta, $modif);
    preg_match('/<tot_bajas>(.*)<\/tot_bajas>/', $respuesta, $bajas);
    preg_match('/<id_upload>(.*)<\/id_upload>/', $respuesta, $n_envio);
    preg_match('/de(.*)de/', $fecha, $mes); ?>
<div id="persona" style="width: 96%"><?php
} else { ?>
<div id="persona" style="width: 100%"><?php
} ?>
    <div style="float: left; margin-right: 1%; width: 49%">
        <fieldset class="same_height">
            <legend class="form1"><span>&nbsp;</span><?php echo __('Tipo de solicitud'); ?></legend>
            <div style="text-align: left; width: 100%"><?php
                if (isset($solicitud) && $solicitud) { ?>
                    <input type="text" name="altas" size="1" maxlength="2" style="text-align: right" value="<?php
                    if (strpos($respuesta, '<tot_altas>') !== false)    echo $altas[1];
                    else  echo '0'; ?>" /><?php
                    echo ' '.__('Inscripción de creación de fichero o tratamiento <strong>C</strong>').'<br />'; ?>
                    <input type="text" name="modif" size="1" maxlength="2" style="text-align: right" value="<?php
                    if (strpos($respuesta, '<tot_modif>') !== false)    echo $modif[1];
                    else    echo '0'; ?>" /><?php
                    echo ' '.__('Inscripción de modificación de fichero <strong>M</strong>').'<br />'; ?>
                    <input type="text" name="bajas" size="1" maxlength="2" style="text-align: right" value="<?php
                    if (strpos($respuesta, '<tot_bajas>') !== false)    echo $bajas[1];
                    else  echo '0'; ?>" /><?php
                    echo ' '.__('Inscripción de supresión de fichero <strong>S</strong>').'<br />';
                    echo '<label style="margin-top:1%; margin-left:2%; margin-bottom: 1%; color:black">'.__('Código Inscripción').'</label> ';
                    if (strpos($respuesta, '<tot_altas>') === false) {
                        $id_campo_codigo_agencia = CampoPeer::getCampoCodAgencia();
                        $c = new Criteria();
                        $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
                        $c->addAnd(ItemPeer::ID_FORMULARIO, $id_fichero, Criteria::EQUAL);
                        $c->addAnd(ItemBasePeer::ID_CAMPO, $id_campo_codigo_agencia, Criteria::EQUAL);
                        $val_item = ItemPeer::doSelectOne($c);
                        $codigo_agencia = $val_item->getTextoCorto();
                        echo input_tag('cod_ins', $codigo_agencia, array('style' => 'margin-top:1%; margin-bottom: 1%')).'<br />';
                    } else  echo input_tag('cod_ins', '', array('style' => 'margin-top:1%; margin-bottom: 1%')).'<br />';
                } else  echo '<fieldset style="margin-top:7px">'.strtoupper($notificacion->tipo).__(' DE FICHERO').'</fieldset>'; ?>
            </div>
        </fieldset>
    </div>
    <div style="float: left; margin-left: 1%; width: 49%">
        <fieldset class="same_height">
            <legend class="form1" style="width: 100%"><span>&nbsp;</span><?php
                echo __('Datos de registro de entrada (A consignar en la Actuación <br/ >sobre el fichero Agencia Española de Protección de Datos).'); ?>
            </legend>
            <div style="text-align: left; width: 100%">
            </div>
        </fieldset>
    </div>
    <div style="float:left; margin-right:1%; width:49%">
        <div class="fcell"><?php echo __('Soporte de la solicitud y modo de presentación').' '; ?>
            <input type="text" style="border: 0px; background-color: #ffffff; color: #000000;" size="20" readonly="readonly" value="<?php echo str_replace('INTERNET', 'XML SIN FIRMAR', str_replace('INTERNET FIRMADO CON CERTIFICADO DIGITAL', 'XML FIRMADO', strtoupper($notificacion->soporte))); ?>" />
        </div>
    </div>
    <div style="float:left; margin-left:1%; width:49%">
        <div class="fcell"><?php echo __('Número del envío').' '; ?>
            <input id="txt00" type="text" name="n_envio_0" size="30"<?php if (isset($solicitud) && $solicitud)    echo ' value="'.$n_envio[1].'" '; ?> />
        </div>
    </div>
    <div style="clear:both; padding-top:1%">
    <fieldset>
        <legend class="form1">
            <span class="number">0</span> <?php echo __('Persona física que actúa en representación del responsable del fichero ante la AEPD'); ?>
        </legend>
        <fieldset>
            <legend class="form1"><?php echo __('Datos del responsable del fichero (del Apartado 1)'); ?></legend>
            <div class="flerro">
                <div id="txt01_div" class="fcell" style="float:left"><?php
                    echo __('Razón social o Nombre y apellidos'); ?><br />
                    <input id="txt01" type="text" name="razsocial_0" class="text required" size="60" value="<?php echo $notificacion->pf_razon_s; ?>" />
                </div>
                <div id="txt02_div" class="fcell"><?php
                    echo __('CIF/NIF/NIE'); ?><br />
                    <input id="txt02" type="text" name="cif_0" class="cif required" maxlength="9" size="30" value="<?php echo $notificacion->pf_cif_nif; ?>" />
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend class="form1"><?php echo __('Declarante'); ?></legend>
            <div class="flerro">
                <div id="txt03_div" class="fcell" style="float:left"><?php
                    echo __('Nombre'); ?><br />
                    <input id="txt03" type="text" name="nombre_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $notificacion->pf_nombre; ?>" />
                </div>
                <div id="txt04_div" class="fcell" style="float:left"><?php
                    echo __('Primer Apellido'); ?><br />
                    <input id="txt04" type="text" name="apellido1_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $notificacion->pf_apellido1; ?>" />
                </div>
                <div id="txt05_div" class="fcell"><?php
                    echo __('Segundo Apellido'); ?><br />
                    <input id="txt05" type="text" name="apellido2_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $notificacion->pf_apellido2; ?>" />
                </div>
            </div>
            <div class="flerro">
                <div id="txt06_div" class="fcell" style="float:left"><?php
                    echo __('NIF'); ?><br />
                    <input id="txt06" type="text" name="nif_0" class="cif" maxlength="9" size="30" value="<?php echo $notificacion->pf_nif; ?>" />
                </div>
                <div id="txt07_div" class="fcell"><?php
                    echo __('Cargo o condición del firmante en relación con el responsable del fichero'); ?><br />
                    <input id="txt07" type="text" name="cargo_0" class="text required mayus" size="70" maxlength="70" value="<?php echo $notificacion->pf_cargo; ?>" />
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend class="form1"><?php echo __('Dirección a efectos de notificación'); ?></legend>
            <div class="flerro">
                <div id="txt08_div" class="fcell">
                    <?php echo __('Razón social o Nombre y apellidos'); ?><br />
                    <input id="txt08" type="text" name="razon_s_0" size="70" maxlength="70" class="text required mayus" value="<?php echo $notificacion->dec_razon_s; ?>" />
                </div>
            </div>
            <div class="flerro">
                <div id="domicilio0_div" class="fcell"><?php echo __('Dirección postal'); ?><br />
                    <input id="domicilio0" type="text" name="direccion_0" size="70" maxlength="100" class="text required mayus" value="<?php echo $notificacion->dec_direccion; ?>" />
                </div>
            </div>
            <div class="flerro">
                <div id="localidad0_div" class="fcell"><?php echo __('Localidad'); ?><br />
                    <input id="localidad0" type="text" name="localidad_0" size="30" maxlength="50" class="text required mayus" value="<?php echo $notificacion->dec_localidad; ?>" />
                </div>
                <div id="cp_pais0_div" class="fcell"><?php echo __('Código Postal'); ?><br />
                    <input id="cp_pais0" type="text" name="cp_0" size="5" maxlength="5" class="cp text required" value="<?php echo $notificacion->dec_cp; ?>" />
                </div>
                <div id="provincia_pais0_div" class="fcell"><?php echo __('Provincia'); ?><br /><?php
                    if (isset($solicitud) && $solicitud) {
                        if ($notificacion->dec_provincia != '') {
                            $c = new Criteria();
                            $c->add(ProvinciaPeer::ID_PROVINCIA, $notificacion->dec_provincia);
                            $provincia = ProvinciaPeer::doSelectOne($c);
                            echo input_tag('provincia', $provincia->getNombre());
                        } else  echo input_tag('provincia', '');
                    } else { ?>
                        <select id="provincia_pais0" name="provincia_0" class="prov list required"><?php
                            include_partial('options_provincias', array('id_provincia' => $notificacion->dec_provincia)); ?>
                        </select><?php
                    } ?>
                </div>
                <div id="pais0_div" class="fcell"><?php echo __('País'); ?><br /><?php
                    if (isset($solicitud) && $solicitud) {
                        if ($notificacion->dec_pais != '') {
                            $c = new Criteria();
                            $c->add(PaisesPeer::PID, $notificacion->dec_pais);
                            $pais = PaisesPeer::doSelectOne($c);
                            echo input_tag('pais', $pais->getPais());
                        } else  echo input_tag('pais', '');
                    } else { ?>
                        <select id="pais0" name="pais_0" class="pais list required"><?php
                            include_partial('options_paises', array('id_pais' => $notificacion->dec_pais)); ?>
                        </select><?php
                    } ?>
                </div>
            </div>
            <div class="flerro">
                <div id="tel0_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel0" type="text" name="tel_0" size="18" class="tel text" maxlength="10" value="<?php echo $notificacion->dec_tel; ?>" /></div>
                <div id="fax0_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax0" type="text" name="fax_0" size="18" class="fax text" maxlength="10" value="<?php echo $notificacion->dec_fax; ?>" /></div>
                <div id="mail0_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail0" type="text" name="mail_0" size="30" class="mail text" maxlength="70" value="<?php echo $notificacion->dec_mail; ?>" /></div>
                <br /><br />
                <div id="list0_div" class="fcell" style="clear:both; float:left"><?php echo __('Medio de notificación'); ?><br /><?php
                    if (isset($solicitud) && $solicitud) {
                        if ($notificacion->dec_forma == '1')    echo input_tag('dec_forma', __('CORREO POSTAL'));
                        elseif ($notificacion->dec_forma == '2')    echo input_tag('dec_forma', __('DEU-SNTS'));
                    } else { ?>
                        <select id="list0" name="medio_0" class="list required" value="<?php echo $notificacion->dec_forma; ?>">
                            <option value="1"><?php echo __('CORREO POSTAL'); ?></option>
                            <option value="2"><?php echo __('DEU-SNTS'); ?></option>
                        </select><?php
                    } ?>
                </div><?php
                if (isset($solicitud) && $solicitud) { ?>
                    <div id="list0_div" class="fcell" style="float:left"><?php echo __('Dirección electrónica servicio Notificaciones'); ?><br /><?php
                        echo input_tag('dir_elec_serv_noti', __('')); ?>
                    </div><?php
                } ?>
            </div>
        </fieldset>
    </fieldset>
    </div><?php
if (isset($solicitud) && $solicitud) { ?>
    <div class="fcell" style="margin-left:1%"><?php
        echo __('De conformidad con lo establecido en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, solicito la inscripción en el Registro General
de Protección de Datos del fichero de datos de carácter personal al que hace referencia el presente formulario de notificación. Asimismo, bajo mi responsabilidad manifiesto
que dispongo de representación suficiente para solicitar la inscripción de este fichero en nombre del responsable del fichero y que éste está informado del resto de
obligaciones que se derivan de la LOPD. Igualmente, declaro que todos los datos consignados son ciertos y que el responsable del fichero ha sido informado de los supuestos
legales que habilitan el tratamiento de datos especialmente protegidos, así como la cesión y la transferencia internacional de datos. La Agencia Española de Protección de
Datos podrá requerir que se acredite la representación de la persona que formula la presente notificación.'); ?>
    </div>
    <div class="fcell" style="clear:both; margin-top:1%; float:left"><strong><?php
        echo __('En '); ?> <input id="data_00" type="text" name="data_00" size="20" class="date text required" value="<?php echo $notificacion->dec_localidad; ?>" /><?php
        echo __(' a '); ?> <input id="data_01" type="text" name="data_01" size="2" class="date text" value="<?php echo trim(substr($fecha, 0, 2)); ?>" /><?php
        echo __(' de '); ?> <input id="data_02" type="text" name="data_02" size="10" class="date text" value="<?php echo trim(ucwords($mes[1])); ?>" /><?php
        echo __(' de '); ?> <input id="data_03" type="text" name="data_03" size="4" class="date text" value="<?php echo trim(substr($fecha, strlen($fecha) - 4, strlen($fecha))); ?>" /></strong>
    </div>
    <div class="fcell" style="margin-top:1%; float:right">
        <strong><?php echo __('Firma de la persona que efectúa la notificación'); ?></strong>
    </div>
    <div id="chk_0_div" class="fcell" style="clear:both; margin-top:3%; margin-left:1%;">
        <input id="chk_0" type="checkbox" name="accept" class="chk0 required" checked="checked" /> <strong><?php echo __('Conocimiento de los deberes del declarante'); ?></strong>
    </div>
    <div class="fcell" style="clear:both; margin-top:1%; margin-left:1%; margin-bottom:2%"><?php
        echo __('En cumplimiento del artículo 5 de la Ley 15/1999, por el que se regula el derecho de información en la recogida de los datos, se advierte de los siguientes extremos:
Los datos de carácter personal, que pudieran constar en esta notificación, se incluirán en el fichero de nombre “Registro General Protección de Datos”, creado por
Resolución del Director de la Agencia Española de Protección de Datos (AEPD) de fecha 28 de abril de 2006, (B.O.E. nº 117) por la que se crean y modifican los ficheros
de datos de carácter personal existentes en la AEPD. La finalidad del fichero es velar por la publicidad de la existencia de los ficheros que contengan datos de carácter
personal con el fin de hacer posible el ejercicio de los derechos de información, oposición, acceso, rectificación y cancelación de los datos. Los datos relativos a la
persona física que presenta la notificación de ficheros y solicita su inscripción en el Registro General de Protección de Datos se utilizarán en los términos previstos en los
procedimientos administrativos que sean necesarios para la tramitación de la correspondiente solicitud y posteriores comunicaciones con la AEPD. Tendrán derecho a
acceder a sus datos personales, rectificarlos o, en su caso, cancelarlos en la AEPD, órgano responsable del fichero.'); ?><br /><?php
        echo __('En caso de que en la notificación deban incluirse datos de carácter personal, referentes a personas físicas distintas de la que efectúa la solicitud o del responsable del
fichero, deberá, con carácter previo a su inclusión, informarles de los extremos contenidos en el párrafo anterior.'); ?>
    </div><?php
} ?>
</div>