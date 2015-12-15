<?php
if (isset($tipo)) {
    include_partial('notificaciones/form_detail_js', array('tipo' => $tipo, 'hook' => $hook));
    echo input_hidden_tag('tipo', $tipo);
} else  include_partial('notificaciones/form_detail_js', array('hook' => $hook)); ?>
<script type="text/javascript">
<!--
    jQuery(document).ready(function() { return redi(); });
-->
</script>
<?php

echo input_hidden_tag('hook' , $hook);
echo input_hidden_tag('modelo' , $modelo);
echo input_hidden_tag('id_fichero', $id_fichero);
if ($sistema == '1' || $sistema == '2') {
    $presentacion = '6';    // FICHERO XML SIN FIRMA
    $forma = 'u';           // ALTA SIN FIRMA
} elseif ($sistema == '3') {
    $presentacion = '5';    // FICHERO XML FIRMADO
    $forma = 'x';           // ALTA FIRMADA
}
echo input_hidden_tag('presentacion', $presentacion);
echo input_hidden_tag('forma', $forma);

$sistema_text = array('1' => __('Formulario en papel'), '2' => __('Internet'), '3' => __('Internet firmado con certificado digital'));

echo input_hidden_tag('soporte', $sistema_text[$sistema]); ?>
<div id="persona" width="100%"><br />
    <div style="float:left; margin-right:1%" width="45%">
        <fieldset class="same_height"t>
            <legend class="form1"><span>&nbsp;</span><?php echo __('Tipo de solicitud'); ?></legend>
            <div style="text-align:center"><?php
                echo __('Actuación sobre el fichero'); ?>
                <fieldset style="margin-top:7px"><?php
                    echo strtoupper($hook).__(' DE FICHERO'); ?>
                </fieldset><?php
                if (isset($tipo)) {
                    $con = Propel::getConnection();
                    $query = "SELECT `tipos_finalidades`.`name` FROM `tipos_finalidades` WHERE `tipos_finalidades`.`id` = '".$tipo."';";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $resultset = $statement->fetch(PDO::FETCH_OBJ); ?>
                    <fieldset style="margin-top:7px"><?php
                        echo strtoupper($resultset->name); ?>
                    </fieldset><?php
                } ?>
            </div>
        </fieldset>
    </div>
    <div width="45%">
        <fieldset class="same_height">
            <legend class="form1"><span>&nbsp;</span><?php echo __('Datos de registro de entrada (A consignar en la Actuación sobre el fichero Agencia Española de Protección de Datos).'); ?></legend>
            <div style="text-align:center">
            </div>
        </fieldset>
    </div>
    <div style="float:left; margin-left:1%;" width="45%">
        <div class="fcell"><?php echo __('Soporte de la solicitud y modo de presentación').' '; ?>
            <input type="text" style="border: 0px; background-color: #ffffff; color: #000000;" size="20" readonly="readonly" value="<?php echo strtoupper($sistema_text[$sistema]); ?>" />
        </div>
    </div>
    <div style="float:right; margin-left:1%;" width="45%">
        <div class="fcell"><?php echo __('Número del envío').' '; ?>
            <input id="txt00" type="text" name="n_envio_0" size="30" />
        </div>
    </div>
    <br /><br />
    <fieldset style="clear:both">
        <legend class="form1">
            <span class="number">0</span> <?php echo __('Persona física que actúa en representación del responsable del fichero ante la AEPD'); ?>
        </legend>
        <fieldset style="margin-top:-3px;">
            <legend><?php echo __('Datos del responsable del fichero (del Apartado 1)'); ?></legend>
            <div class="flerro">
                <div id="txt01_div" class="fcell" style="float:left"><?php
                    $c = new Criteria();
                    $c->addAnd(EmpresaPeer::ID_USUARIO, $user_id, Criteria::EQUAL);
                    $empresa = EmpresaPeer::doSelectOne($c);
                    echo __('Razón social o Nombre y apellidos'); ?><br />
                    <input id="txt01" type="text" name="razsocial_0" class="text required" size="60" value="<?php echo $empresa->getNombre(); ?>" />
                </div>
                <div id="txt02_div" class="fcell"><?php
                    echo __('CIF/NIF/NIE'); ?><br />
                    <input id="txt02" type="text" name="cif_0" class="cif required" maxlength="9" size="30" value="<?php echo $empresa->getCif(); ?>" />
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo __('Declarante'); ?></legend>
            <div class="flerro">
                <div id="txt03_div" class="fcell" style="float:left"><?php
                    echo __('Nombre'); ?><br />
                    <input id="txt03" type="text" name="nombre_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $user->getNombre(); ?>" />
                </div>
                <div id="txt04_div" class="fcell" style="float:left"><?php
                    echo __('Primer Apellido'); ?><br />
                    <input id="txt04" type="text" name="apellido1_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $user->getApellido1(); ?>" />
                </div>
                <div id="txt05_div" class="fcell"><?php
                    echo __('Segundo Apellido'); ?><br />
                    <input id="txt05" type="text" name="apellido2_0" class="text required mayus" size="60" maxlength="35" value="<?php echo $user->getApellido2(); ?>" />
                </div>
            </div>
            <div class="flerro">
                <div id="txt06_div" class="fcell" style="float:left"><?php
                    echo __('NIF'); ?><br />
                    <input id="txt06" type="text" name="nif_0" class="cif" maxlength="9" size="30" value="<?php echo $user->getDni(); ?>" />
                </div>
                <div id="txt07_div" class="fcell"><?php
                    echo __('Cargo o condición del firmante en relación con el responsable del fichero'); ?><br />
                    <input id="txt07" type="text" name="cargo_0" class="text required mayus" size="90" maxlength="70" value="" />
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo __('Dirección a efectos de notificación'); ?></legend>
            <div class="flerro">
                <div id="txt08_div" class="fcell">
                    <?php echo __('Razón social o Nombre y apellidos'); ?><br />
                    <input id="txt08" type="text" name="razon_s_0" size="105" maxlength="70" class="text required mayus" />
                </div>
            </div>
            <div class="flerro">
                <div id="domicilio0_div" class="fcell"><?php echo __('Dirección postal'); ?><br />
                    <input id="domicilio0" type="text" name="direccion_0" size="105" maxlength="100" class="text required mayus" />
                </div>
            </div>
            <div class="flerro">
                <div id="localidad0_div" class="fcell"><?php echo __('Localidad'); ?><br />
                    <input id="localidad0" type="text" name="localidad_0" size="30" maxlength="50" class="text required mayus" />
                </div>
                <div id="cp_pais0_div" class="fcell"><?php echo __('Código Postal'); ?><br />
                    <input id="cp_pais0" type="text" name="cp_0" size="5" maxlength="5" class="cp text required" />
                </div>
                <div id="provincia_pais0_div" class="fcell"><?php echo __('Provincia'); ?><br />
                    <select id="provincia_pais0" name="provincia_0" class="prov list required"><?php
                        include_partial('notificaciones/options_provincias'); ?>
                    </select>
                </div>
                <div id="pais0_div" class="fcell"><?php echo __('País'); ?><br />
                    <select id="pais0" name="pais_0" class="pais list required"><?php
                        include_partial('notificaciones/options_paises'); ?>
                    </select>
                </div>
            </div>
            <div class="flerro">
                <div id="tel0_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel0" type="text" name="tel_0" size="18" class="tel text" maxlength="10" /></div>
                <div id="fax0_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax0" type="text" name="fax_0" size="18" class="fax text" maxlength="10" /></div>
                <div id="mail0_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail0" type="text" name="mail_0" size="30" class="mail text" maxlength="70" /></div>
                <br /><br />
                <div id="list0_div" class="fcell" style="clear:both; float:left"><?php echo __('Medio de notificación'); ?><br />
                    <select id="list0" name="medio_0" class="list required">
                        <option value="1"><?php echo __('CORREO POSTAL'); ?></option>
                        <option value="2"><?php echo __('DEU-SNTS'); ?></option>
                    </select>
                </div>
            </div>
        </fieldset>
    </fieldset>
    <div class="fcell" style="margin-left:1%"><?php
        echo __('De conformidad con lo establecido en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, solicito la inscripción en el Registro General
de Protección de Datos del fichero de datos de carácter personal al que hace referencia el presente formulario de notificación. Asimismo, bajo mi responsabilidad manifiesto
que dispongo de representación suficiente para solicitar la inscripción de este fichero en nombre del responsable del fichero y que éste está informado del resto de
obligaciones que se derivan de la LOPD. Igualmente, declaro que todos los datos consignados son ciertos y que el responsable del fichero ha sido informado de los supuestos
legales que habilitan el tratamiento de datos especialmente protegidos, así como la cesión y la transferencia internacional de datos. La Agencia Española de Protección de
Datos podrá requerir que se acredite la representación de la persona que formula la presente notificación.'); ?>
    </div>
    <div class="fcell" style="clear:both; margin-top:1%; float:left"><strong><?php
        echo __('En '); ?> <input id="data_00" type="text" name="data_00" size="25" class="date text required" /><?php
        echo __(' a '); ?> <input id="data_01" type="text" name="data_01" size="5" class="date text" /><?php
        echo __(' de '); ?> <input id="data_02" type="text" name="data_02" size="15" class="date text" /><?php
        echo __(' de '); ?> <input id="data_03" type="text" name="data_03" size="10" class="date text" /></strong>
    </div>
    <div class="fcell" style="margin-top:1%; float:right">
        <strong><?php echo __('Firma de la persona que efectúa la notificación'); ?></strong>
    </div>
    <div id="chk_0_div" class="fcell" style="clear:both; margin-top:1%; margin-left:1%;">
        <input id="chk_0" type="checkbox" name="accept" class="chk0 required" /> <strong><?php echo __('Conocimiento de los deberes del declarante'); ?></strong>
    </div>
    <div class="fcell" style="clear:both; margin-top:1%; margin-left:1%"><?php
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
    </div>
    <div style="clear:both; margin-top:1%"><br /><fieldset class="boton"><table class="quitar_borde" width="100%"><tr>
        <td class="quitar_borde" width="50%" align="center"><?php
            echo submit_tag(__('Finalizar Formulario'), array('name' => 'bukatu', 'class' => 'submit cump')); ?>
        </td><td class="quitar_borde" width="50%" align="center">
            <a class="cump" style="text-decoration: none;" href="javascript:window.print()"><?php echo __('Imprimir borrador'); ?></a>
        </td>
    </tr></table></fieldset></div><br /><br />
</div>
<div id="cuerpo" width="100%" style="clear:both">
<fieldset>
    <legend class="form1">
        <span class="number">1</span> <?php echo __('Responsable del fichero'); ?>
    </legend><br />
    <div class="flerro">
        <div id="txt1_div" class="fcell"><?php
            echo __('Denominación social del responsable del fichero'); ?><br />
            <input id="txt1" type="text" name="denomsocial_1" size="60" class="text required mayus" maxlength="140" value="<?php echo $empresa->getNombre(); ?>" />
        </div>
        <div id="list1_div" class="fcell"><?php echo __('Actividad'); ?><br />
            <select id="list1" name="actividad_1" class="list required">
            <option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
                $actividades = Taula1Peer::doSelect(new Criteria);
                foreach ($actividades as $taula1 => $act) {
                    if ($act->getT1id() == $empresa_actual->getIdActividad()) { ?>
                        <option title="<?php echo $act->getActividad(); ?>" value="<?php echo $act->getT1id(); ?>" selected="selected"><?php echo $act->getActividad(); ?></option><?php
                    } else { ?>
                        <option title="<?php echo $act->getActividad(); ?>" value="<?php echo $act->getT1id(); ?>"><?php echo $act->getActividad(); ?></option><?php
                    }
                } ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="cif_pais1_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
            <input id="cif_pais1" type="text" name="cif_1" size="30" class="cif required" maxlength="9" value="<?php echo $empresa_actual->getCif(); ?>" />
        </div>
        <div id="domicilio1_div" class="fcell"><?php echo __('Domicilio social'); ?><br />
            <input id="domicilio1" type="text" name="domiciliosocial_1" size="70" class="text required mayus" maxlength="100" value="<?php echo $empresa_actual->getDomicilio(); ?>" />
        </div>
    </div>
    <div class="flerro">
        <div id="localidad1_div" class="fcell"><?php echo __('Localidad'); ?><br />
            <input id="localidad1" type="text" name="localidad_1" size="30" class="text required mayus" maxlength="50" value="<?php echo $empresa_actual->getPoblacion(); ?>" />
        </div>
        <div id="cp_pais1_div" class="fcell"><?php echo __('Código Postal'); ?><br />
            <input id="cp_pais1" type="text" name="cp_1" size="5" class="cp text required" maxlength="5" value="<?php echo $empresa_actual->getCodigoPostal(); ?>" />
        </div>
        <div id="provincia_pais1_div" class="fcell"><?php echo __('Provincia'); ?><br />
            <select id="provincia_pais1" name="provincia_1" class="prov list required"><?php
                include_partial('notificaciones/options_provincias', array('id_provincia' => $empresa_actual->getIdProvincia())); ?>
            </select>
        </div>
        <div id="pais1_div" class="fcell"><?php echo __('País'); ?><br />
            <select id="pais1" name="pais_1" class="pais list required"><?php
                include_partial('notificaciones/options_paises'); ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="tel1_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel1" type="text" name="tel_1" size="18" class="tel text not_required" maxlength="10" value="<?php echo $empresa_actual->getTelefono(); ?>" /></div>
        <div id="fax1_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax1" type="text" name="fax_1" size="18" class="fax text not_required" maxlength="10" value="<?php echo $empresa_actual->getFax(); ?>" /></div>
        <div id="mail1_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail1" type="text" name="mail_1" size="30" class="mail text not_required" maxlength="70" value="<?php echo $empresa_actual->getEmail(); ?>" /></div>
    </div>
</fieldset>
<br />
<fieldset id="derechos">
    <legend class="form1">
        <span class="number">2</span> <?php echo __('Derechos de oposición, acceso, rectificación y cancelación'); ?>
    </legend><?php
        if ($hook == 'Inscripcion') { ?>
            <label style="margin-top:-5px;margin-bottom:10px">
                [<?php echo __('Obligatorio sólo si el responsable está ubicado fuera de la Unión Europea'); ?>]<br />
                [<?php echo __('Si el domicilio es el mismo que el del responsable, estos elementos tendrán que estar vacíos'); ?>]
            </label><?php
        } ?><br />
    <div class="flerro">
        <div id="txt2_div" class="fcell"><?php echo __('Nombre de la oficina o dependencia'); ?><br />
            <input id="txt2" type="text" name="oficina_2" size="105" class="text required mayus" maxlength="140" />
        </div>
    </div>
    <div class="flerro">
        <div id="cif_pais2_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
            <input id="cif_pais2" type="text" name="cif_2" size="20" class="cif required" maxlength="9" />
        </div>
        <div id="domicilio2_div" class="fcell"><?php echo __('Dirección postal/Apdo. de Correos'); ?><br />
            <input id="domicilio2" type="text" name="direccion_2" size="79" class="text required mayus" maxlength="100" />
        </div>
    </div>
    <div class="flerro">
        <div id="localidad2_div" class="fcell"><?php echo __('Localidad'); ?><br />
            <input id="localidad2" type="text" name="localidad_2" size="30" class="text required mayus" maxlength="50" />
        </div>
        <div id="cp_pais2_div" class="fcell"><?php echo __('Código Postal'); ?><br />
            <input id="cp_pais2" type="text" name="cp_2" size="5" class="cp text required" maxlength="5" />
        </div>
        <div id="provincia_pais2_div" class="fcell"><?php echo __('Provincia'); ?><br />
            <select id="provincia_pais2" name="provincia_2" class="prov list required"><?php
                include_partial('notificaciones/options_provincias'); ?>
            </select>
        </div>
        <div id="pais2_div" class="fcell"><?php echo __('País'); ?><br />
            <select id="pais2" name="pais_2" class="pais list required"><?php
                include_partial('notificaciones/options_paises_europa'); ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="tel2_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel2" type="text" name="tel_2" size="18" class="tel text not_required" maxlength="10" /></div>
        <div id="fax2_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax2" type="text" name="fax_2" size="18" class="fax text not_required" maxlength="10" /></div>
        <div id="mail2_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail2" type="text" name="mail_2" size="30" class="mail text not_required" maxlength="70" /></div>
    </div>
</fieldset>
<br />
<fieldset id="encargado">
    <legend class="form1">
        <span class="number">4</span><?php echo __('Encargado del tratamiento'); ?>
    </legend><?php
        if ($hook == 'Inscripcion') { ?>
            <label style="margin-top:-5px;margin-bottom:10px">
                [<?php echo __('Obligatorio sólo en el caso de que el tratamiento de los datos se realice por persona, física o jurídica, distinta al responsable del fichero.'); ?>]<br />
                [<?php echo __('Si el tratamiento lo realiza el propio responsable, estos elementos tendrán que estar vacíos'); ?>]
            </label><?php
        } ?><br />
    <div class="flerro">
        <div id="txt4_div" class="fcell"><?php echo __('Denominación social del encargado del tratamiento'); ?><br />
            <input id="txt4" type="text" name="denomsocial_4" size="105" class="text not_required mayus" maxlength="140" />
        </div>
    </div>
    <div class="flerro">
        <div id="cif_pais4_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
            <input id="cif_pais4" type="text" name="cif_4" size="20" class="cif not_required" maxlength="9" />
        </div>
        <div id="domicilio4_div" class="fcell"><?php echo __('Dirección postal'); ?><br />
            <input id="domicilio4" type="text" name="direccion_4" size="79" class="text not_required mayus" maxlength="100" />
        </div>
    </div>
    <div class="flerro">
        <div id="localidad4_div" class="fcell"><?php echo __('Localidad'); ?><br />
            <input id="localidad4" type="text" name="localidad_4" size="30" class="text not_required mayus" maxlength="50" />
        </div>
        <div id="cp_pais4_div" class="fcell"><?php echo __('Código Postal'); ?><br />
            <input id="cp_pais4" type="text" name="cp_4" size="5" class="cp text not_required" maxlength="5" />
        </div>
        <div id="provincia_pais4_div" class="fcell"><?php echo __('Provincia'); ?><br />
            <select id="provincia_pais4" name="provincia_4" class="prov list not_required"><?php
                include_partial('notificaciones/options_provincias'); ?>
            </select>
        </div>
        <div id="pais4_div" class="fcell"><?php echo __('País'); ?><br />
            <select id="pais4" name="pais_4" class="pais list not_required"><?php
                include_partial('notificaciones/options_paises'); ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="tel4_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel4" type="text" name="tel_4" size="18" class="tel text not_required" maxlength="10" /></div>
        <div id="fax4_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax4" type="text" name="fax_4" size="18" class="fax text not_required" maxlength="10" /></div>
        <div id="mail4_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail4" type="text" name="mail_4" size="30" class="mail text not_required" maxlength="70" /></div>
    </div>
</fieldset>
<br />
<fieldset>
    <legend class="form1">
        <span class="number">5</span><?php echo __('Identificación y finalidad del fichero'); ?>
    </legend>
    <fieldset id="denom_fichero">
        <legend><?php echo __('Denominación'); ?></legend>
        <div class="flerro">
            <div id="txt5_div" class="fcell"><?php echo __('Nombre del fichero o tratamiento'); ?><br /><?php
                if (isset($tipo)) {
                    $con = Propel::getConnection();
                    $query = "SELECT * FROM `tipos_finalidades` WHERE `tipos_finalidades`.`id` = '".$tipo."';";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $resultset1 = $statement->fetch(PDO::FETCH_OBJ);
                    $finalidades_left = explode(',', $resultset1->left_finalidades);
                    $finalidades_right = explode(',', $resultset1->right_finalidades); ?>
                    <input id="txt5" type="text" name="nombre_5" size="102" class="text required mayus" value="<?php echo $resultset1->name; ?>" maxlength="70" /><?php
                } else { ?>
                    <input id="txt5" type="text" name="nombre_5" size="102" class="text required mayus" maxlength="70" /><?php
                } ?>

            </div>
        </div>
        <div class="flerro">
            <div id="txt6_div" class="fcell"><?php echo __('Descripción detallada de finalidad y usos previstos'); ?><br /><?php
                if (isset($tipo)) { ?>
                    <textarea id="txt6" name="descripcion_uso_5" cols="70" class="text required mayus" maxlength="350"><?php echo $resultset1->description; ?></textarea><?php
                } else { ?>
                    <textarea id="txt6" name="descripcion_uso_5" cols="70" class="text required mayus" maxlength="350"></textarea><?php
                } ?>
            </div>
        </div>
    </fieldset>
    <fieldset id="finalidades">
        <legend><?php echo __('Tipifiación correspondiente a la finalidad y usos previstos'); ?></legend>
        <div id="finalidades2_div" class="fcell div_finalidades"><?php echo __('Finalidades'); ?><br />
            <div id="finalidades1_div" class="finalidades">
                <select id="finalidades1" name="finalidades1[]" multiple="multiple" class="finalidades multiple_list"><?php
                    if ((isset($tipo)) && ($finalidades_left[0] != '')) {
                        foreach ($finalidades_left as $f_left) {
                            $c = new Criteria();
                            $c->add(Taula2Peer::T2ID, $f_left, Criteria::EQUAL);
                            $finalidad = Taula2Peer::doSelectOne($c); ?>
                            <option title="<?php echo $finalidad->getDescripcion(); ?>" value="<?php echo $finalidad->getT2id(); ?>">
                                <?php echo $finalidad->getDescripcion(); ?>
                            </option><?php
                        }
                    } elseif (!isset($tipo)) {
                        $finalidades = Taula2Peer::doSelect(new Criteria);
                        foreach ($finalidades as $finalidad => $fin) { ?>
                            <option title="<?php echo $fin->getDescripcion(); ?>" value="<?php echo $fin->getT2id(); ?>">
                                <?php echo $fin->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
            <div id="finalidades0_div"  class="finalidades_buttons">
                <a class="finalidades_link" href="#" id="add_finalidades">&gt;&gt;</a>
                <a class="finalidades_link" href="#" id="remove_finalidades">&lt;&lt;</a>
            </div>
            <div class="finalidades">
                <select id="finalidades2" name="finalidades2[]" multiple="multiple" class="finalidades multiple_list"><?php
                    if ((isset($tipo)) && ($finalidades_right[0] != '')) {
                        foreach ($finalidades_right as $f_right) {
                            $c = new Criteria();
                            $c->add(Taula2Peer::T2ID, $f_right, Criteria::EQUAL);
                            $finalidad = Taula2Peer::doSelectOne($c); ?>
                            <option title="<?php echo $finalidad->getDescripcion(); ?>" value="<?php echo $finalidad->getT2id(); ?>">
                                <?php echo $finalidad->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
        </div>
    </fieldset>
</fieldset>
<br />
<fieldset>
    <legend class="form1">
        <span class="number">6</span><?php echo __('Origen y procedencia de los datos'); ?>
    </legend>
    <fieldset id="origenes">
        <legend><?php echo __('Origen'); ?></legend>
        <table class="quitar_borde" width="100%">
            <tr>
                <td class="quitar_borde" width="33%">
                    <input id="chk1" type="checkbox" name="origen1_6" class="chk required origen" value="1"<?php
                    if (isset($tipo))   echo ' checked="checked" /> '.__('El propio interesado o su representante legal');
                    else    echo ' /> '.__('El propio interesado o su representante legal'); ?>
                </td>
                <td class="quitar_borde" width="33%">
                    <input id="chk2" type="checkbox" name="origen2_6" class="chk1 required origen" value="2" /> <?php echo __('Otras personas físicas'); ?>
                </td>
                <td class="quitar_borde" width="33%">
                    <input id="chk3" type="checkbox" name="origen3_6" class="chk1 required origen" value="3" /> <?php echo __('Fuentes accesibles al público'); ?>
                </td>
            </tr>
            <tr>
                <td class="quitar_borde" width="33%">
                    <input id="chk4" type="checkbox" name="origen4_6" class="chk1 required origen" value="4" /> <?php echo __('Registros públicos'); ?>
                </td>
                <td class="quitar_borde" width="33%">
                    <input id="chk5" type="checkbox" name="origen5_6" class="chk1 required origen" value="5" /> <?php echo __('Entidad privada'); ?>
                </td>
                <td class="quitar_borde" width="33%">
                    <input id="chk6" type="checkbox" name="origen6_6" class="chk1 required origen" value="6" /> <?php echo __('Administraciones Públicas'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset id="colectivos">
        <legend><?php echo __('Colectivos o categorías de interesados'); ?></legend>
        <div id="colectivos2_div" class="fcell div_colectivos">
            <div id="colectivos1_div" class="colectivos"><?php
                if (isset($tipo)) {
                    $con = Propel::getConnection();
                    $query = "SELECT * FROM `tipos_colectivos` WHERE `tipos_colectivos`.`id` = '".$tipo."';";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $resultset2 = $statement->fetch(PDO::FETCH_OBJ);
                    $colectivos_left = explode(',', $resultset2->left_colectivos);
                    $colectivos_right = explode(',', $resultset2->right_colectivos);
                } ?>
                <select id="colectivos1" name="colectivos1[]" multiple="multiple" class="colectivos multiple_list"><?php
                    if ((isset($tipo)) && ($colectivos_left[0] != '')) {
                        foreach ($colectivos_left as $c_left) {
                            $c = new Criteria();
                            $c->add(Taula3Peer::T3ID, $c_left, Criteria::EQUAL);
                            $colectivo = Taula3Peer::doSelectOne($c); ?>
                            <option title="<?php echo $colectivo->getDescripcion(); ?>" value="<?php echo $colectivo->getT3id(); ?>">
                                <?php echo $colectivo->getDescripcion(); ?>
                            </option><?php
                        }
                    } elseif (!isset($tipo)) {
                        $colectivos = Taula3Peer::doSelect(new Criteria);
                        foreach ($colectivos as $colectivo => $col) { ?>
                            <option title="<?php echo $col->getDescripcion(); ?>" value="<?php echo $col->getT3id(); ?>">
                                <?php echo $col->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
            <div id="colectivos0_div" class="colectivos_buttons">
                <a class="colectivos_link" href="#" id="add_colectivos">&gt;&gt;</a>
                <a class="colectivos_link" href="#" id="remove_colectivos">&lt;&lt;</a>
            </div>
            <div class="colectivos">
                <select id="colectivos2" name="colectivos2[]" multiple="multiple" class="colectivos multiple_list"><?php
                    if ((isset($tipo)) && ($colectivos_right[0] != '')) {
                        foreach ($colectivos_right as $f_right) {
                            $c = new Criteria();
                            $c->add(Taula3Peer::T3ID, $f_right, Criteria::EQUAL);
                            $colectivo = Taula3Peer::doSelectOne($c); ?>
                            <option title="<?php echo $colectivo->getDescripcion(); ?>" value="<?php echo $colectivo->getT3id(); ?>">
                                <?php echo $colectivo->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div style="clear:both"><?php
            echo __('Otros colectivos'); ?> <input id="otros" type="checkbox" name="otras_6" value="otros colectivos" class="otros" /><br />
            <textarea id="text_otros" name="otroscolectivos_6" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
        </div>
    </fieldset>
</fieldset>
<br />
<fieldset>
    <legend class="form1">
        <span class="number">7</span><?php echo __('Tipos de datos, estructura y organización del fichero'); ?>
    </legend>
    <h4><?php echo __('Datos especialmente protegidos:'); ?></h4>
    <p><?php echo __('Los tratamientos de datos de carácter personal que revelen o hagan referencia a ideología, afiliación sindical, religión o creencias, deberán ampararse en alguno de los supuestos que la Ley establece al efecto para poder tratarlos. El tratamiento de estos datos sólo puede realizarse si se ha recabado el consentimiento expreso y por escrito del afectado. Para más información consulte la ayuda del formulario.'); ?></p><?php
    if (isset($tipo)) {
        $con = Propel::getConnection();
        $query = "SELECT * FROM `tipos_datos_seguridad_cesion` WHERE `tipos_datos_seguridad_cesion`.`id` = '".$tipo."';";
        $statement = $con->prepare($query);
        $statement->execute();
        $resultset3 = $statement->fetch(PDO::FETCH_OBJ);
        $datos_check = explode(',', $resultset3->datos_check);
        $datos_left = explode(',', $resultset3->datos_select_izq);
        $datos_right = explode(',', $resultset3->datos_select_der);
        $medidas_check = explode(',', $resultset3->medidas_check);
        $medidas_left = explode(',', $resultset3->medidas_select_izq);
        $medidas_right = explode(',', $resultset3->medidas_select_der);
    } ?>
    <fieldset>
        <legend><?php echo __('Datos especialmente protegidos'); ?></legend>
        <table width="100%" class="quitar_borde">
            <tr>
                <td class="quitar_borde" width="25%">
                    <input id="ind_ide" type="checkbox" name="datos-pro1_7" value="1" class="checkboxes"<?php
                        if (isset($tipo) && in_array('1', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Ideología'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_as" type="checkbox" name="datos-pro2_7" value="2" class="checkboxes"<?php
                        if (isset($tipo) && in_array('2', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Afiliación sindical'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_r" type="checkbox" name="datos-pro3_7" value="3" class="checkboxes"<?php
                        if (isset($tipo) && in_array('3', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Religión'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_c" type="checkbox" name="datos-pro4_7" value="4" class="checkboxes"<?php
                        if (isset($tipo) && in_array('4', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Creencias'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <h4><?php echo __('Otros Datos especialmente protegidos:'); ?></h4>
    <p><?php echo __('Los tratamientos de datos de carácter personal que revelen o hagan referencia al origen racial, la salud o la vida sexual deberán ampararse en alguno de los supuestos que la Ley establece al efecto para poder tratarlos. Para el tratamiento de estos datos será obligatorio recabar el consentimiento expreso del afectado o que, por razones de interés general, así lo disponga una Ley.'); ?></p>
    <fieldset>
        <legend><?php echo __('Otros datos especialmente protegidos'); ?></legend>
        <table width="100%" class="quitar_borde">
            <tr>
                <td class="quitar_borde" width="33%">
                    <input id="ind_re" type="checkbox" name="datos-pro5_7" value="5" class="checkboxes"<?php
                        if (isset($tipo) && in_array('5', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Origen racial o étnico'); ?>
                </td><td class="quitar_borde" width="33%">
                    <input id="ind_sal" type="checkbox" name="datos-pro6_7" value="6" class="checkboxes"<?php
                        if (isset($tipo) && in_array('6', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Salud'); ?>
                </td><td class="quitar_borde" width="33%">
                    <input id="ind_sexo" type="checkbox" name="datos-pro7_7" value="7" class="checkboxes"<?php
                        if (isset($tipo) && in_array('7', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Vida sexual'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset id="identificativos">
        <legend><?php echo __('Datos de carácter identificativo'); ?></legend>
        <table width="100%" class="quitar_borde">
            <tr>
                <td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_8" value="8" class="chk2 required"<?php
                        if (isset($tipo) && in_array('8', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('NIF/DNI'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_9" value="9" class="chk2 required"<?php
                        if (isset($tipo) && in_array('9', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('NºSS/Mutualidad'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_10" value="10" class="chk2 required"<?php
                        if (isset($tipo) && in_array('10', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Nombre y apellidos'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_11" value="11" class="chk2 required"<?php
                        if (isset($tipo) && in_array('11', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Tarjeta sanitaria'); ?>
                </td>
            </tr>
            <tr>
                <td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_12" value="12" class="chk2 required"<?php
                        if (isset($tipo) && in_array('12', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Dirección'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_13" value="13" class="chk2 required"<?php
                        if (isset($tipo) && in_array('13', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Teléfono'); ?>
                </td><td colspan="2" class="quitar_borde" width="50%">
                    <input type="checkbox" name="datos-pro7_14" value="14" class="chk2 required"<?php
                        if (isset($tipo) && in_array('14', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Firma/Huella'); ?>
                </td>
            </tr>
            <tr>
                <td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_15" value="15" class="chk2 required"<?php
                        if (isset($tipo) && in_array('15', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Imagen/voz'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input type="checkbox" name="datos-pro7_16" value="16" class="chk2 required"<?php
                        if (isset($tipo) && in_array('16', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Marcas físicas'); ?>
                </td><td colspan="2" class="quitar_borde" width="50%">
                    <input type="checkbox" name="datos-pro7_17" value="17" class="chk2 required"<?php
                        if (isset($tipo) && in_array('17', $datos_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Firma electrónica'); ?>
                </td>
            </tr>
            <tr>
                <td class="quitar_borde" width="25%">
                    <input id="otros2" type="checkbox" name="datos-pro7_18" value="18" class="chk2 required" /> <?php echo __('Otros datos de carácter identificativo'); ?>:
                </td><td colspan="3" class="quitar_borde" width="75%">
                    <input id="text_otros2" type="text" name="otros_7" size="60 mayus" class="text mayus" maxlength="100" />
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Otros datos tipificados'); ?></legend>
        <div id="datos2_div" class="fcell div_datos">
            <div id="datos1_div" class="datos">
                <select id="datos1" name="datos1[]" multiple="multiple" class="datos multiple_list"><?php
                    if ((isset($tipo)) && ($datos_left[0] != '')) {
                        foreach ($datos_left as $d_left) {
                            $c = new Criteria();
                            $c->add(Taula4Peer::T4ID, $d_left, Criteria::EQUAL);
                            $dato = Taula4Peer::doSelectOne($c); ?>
                            <option title="<?php echo $dato->getDescripcion(); ?>" value="<?php echo $dato->getT4id(); ?>">
                                <?php echo $dato->getDescripcion(); ?>
                            </option><?php
                        }
                    } elseif (!isset($tipo)) {
                        $datos = Taula4Peer::doSelect(new Criteria);
                        foreach ($datos as $dato => $dat) { ?>
                            <option title="<?php echo $dat->getDescripcion(); ?>" value="<?php echo $dat->getT4id(); ?>">
                                <?php echo $dat->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
            <div id="datos0_div" class="datos_buttons">
                <a class="datos_link" href="#" id="add_datos">&gt;&gt;</a>
                <a class="datos_link" href="#" id="remove_datos">&lt;&lt;</a>
            </div>
            <div class="datos">
                <select id="datos2" name="datos2[]" multiple="multiple" class="datos multiple_list"><?php
                    if ((isset($tipo)) && ($datos_right[0] != '')) {
                        foreach ($datos_right as $d_right) {
                            $c = new Criteria();
                            $c->add(Taula4Peer::T4ID, $d_right, Criteria::EQUAL);
                            $dato = Taula4Peer::doSelectOne($c); ?>
                            <option title="<?php echo $dato->getDescripcion(); ?>" value="<?php echo $dato->getT4id(); ?>">
                                <?php echo $dato->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div style="clear:both"><?php
            echo __('Otros tipos de datos'); ?> <input id="otros3" type="checkbox" name="otrostipos_7" value="otros tipos" class="otros" /><br />
            <textarea id="text_otros3" name="otrostiposdatos_7" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
        </div>
    </fieldset>
    <fieldset id="tratamiento">
        <legend><?php echo __('Sistema de tratamiento'); ?></legend>
        <table width="100%" class="quitar_borde">
            <tr>
                <td width="33%" class="quitar_borde">
                    <input type="radio" name="tratamiento_7" class="sist_tratam required" value="19"<?php
                        if (isset($tipo) && in_array('19', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Automatizado'); ?>
                </td><td width="33%" class="quitar_borde">
                    <input type="radio" name="tratamiento_7" class="sist_tratam required" value="20"<?php
                        if (isset($tipo) && in_array('20', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Manual'); ?>
                </td><td width="33%" class="quitar_borde">
                    <input type="radio" name="tratamiento_7" class="sist_tratam required" value="21"<?php
                        if (isset($tipo) && in_array('21', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Mixto'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
</fieldset>
<br />
<fieldset id="chk_5">
    <legend class="form1"><span class="number">8</span> <?php echo __('Medidas de seguridad'); ?></legend>
    <table id="nivel_seg_div" width="100%" class="quitar_borde">
        <tr>
            <td width="33%" class="quitar_borde">
                <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="22"<?php
                    if (isset($tipo) && in_array('22', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Nivel básico'); ?>
            </td><td width="33%" class="quitar_borde">
                <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="23"<?php
                    if (isset($tipo) && in_array('23', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Nivel medio'); ?>
            </td><td width="33%" class="quitar_borde">
                <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="24"<?php
                    if (isset($tipo) && in_array('24', $medidas_check)) { echo ' checked="checked"'; } ?>/> <?php echo __('Nivel alto'); ?>
            </td>
        </tr>
    </table>
</fieldset>
<br />
<fieldset>
    <legend class="form1">
        <span class="number">9</span><?php echo __('Cesión o comunicación de datos'); ?>
    </legend><p><?php
        echo __('Este apartado únicamente ha de cumplimentarse en el caso de que se prevea realizar cesiones o comunicaciones de datos. No se considerará cesión de datos la prestación de un servicio al responsable del fichero por parte del encargado del tratamiento. La comunicación de los datos ha de ampararse en alguno de los supuestos legales establecidos en la LOPD. Para mayor información consulte la ayuda de este formulario'); ?>.<br />
    </p><fieldset id="cesion">
        <legend><?php echo __('Categorías de destinatarios de cesiones'); ?></legend>
        <div id="medidas2_div" class="fcell div_medidas">
            <div id="medidas1_div" class="medidas">
                <select id="medidas1" name="medidas1[]" multiple="multiple" class="medidas multiple_list"><?php
                    if ((isset($tipo)) && ($medidas_left[0] != '')) {
                        foreach ($medidas_left as $m_left) {
                            $c = new Criteria();
                            $c->add(Taula5Peer::T5ID, $m_left, Criteria::EQUAL);
                            $medida = Taula5Peer::doSelectOne($c); ?>
                            <option title="<?php echo $medida->getDescripcion(); ?>" value="<?php echo $medida->getT5id(); ?>">
                                <?php echo $medida->getDescripcion(); ?>
                            </option><?php
                        }
                    } elseif (!isset($tipo)) {
                        $medidas = Taula5Peer::doSelect(new Criteria);
                        foreach ($medidas as $medida => $med) { ?>
                            <option title="<?php echo $med->getDescripcion(); ?>" value="<?php echo $med->getT5id(); ?>">
                                <?php echo $med->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
            <div id="medidas0_div" class="medidas_buttons">
                <a class="medidas_link" href="#" id="add_medidas">&gt;&gt;</a>
                <a class="medidas_link" href="#" id="remove_medidas">&lt;&lt;</a>
            </div>
            <div class="medidas">
                <select id="medidas2" name="medidas2[]" multiple="multiple" class="medidas multiple_list"><?php
                    if ((isset($tipo)) && ($medidas_right[0] != '')) {
                        foreach ($medidas_right as $m_right) {
                            $c = new Criteria();
                            $c->add(Taula5Peer::T5ID, $m_right, Criteria::EQUAL);
                            $medida = Taula5Peer::doSelectOne($c); ?>
                            <option title="<?php echo $medida->getDescripcion(); ?>" value="<?php echo $medida->getT5id(); ?>">
                                <?php echo $medida->getDescripcion(); ?>
                            </option><?php
                        }
                    } ?>
                </select>
            </div>
        </div>
        <div style="clear:both"><?php
             echo __('Otros destinatarios de cesiones'); ?> <input id="otros4" type="checkbox" name="otrosdestina_9" value="otros destinatarios" class="otros" /><br />
            <textarea id="text_otros4" name="otrosdestinatarioscesion_9" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
        </div>
    </fieldset>
</fieldset>
<br />
<fieldset>
    <legend class="form1">
        <span class="number">10</span><?php echo __('Transferencias internacionales'); ?>
    </legend><p><?php
        echo __('Este apartado únicamente ha de cumplimentarse en el caso de que se realice o está previsto realizar un tratamiento de datos fuera del territorio del Espacio Económico Europeo. En el caso de que la transferencia internacional tenga como destino un país que no preste un nivel de protección adecuado al que presta la LOPD, deberá tener en cuenta que la LOPD establece que las previsiones para realizar transferencias internacionales son diferentes, dependiendo de que los países destinatarios tengan un nivel de protección adecuado o no. Para más información consulte la ayuda de este formulario.'); ?>
    </p><fieldset id="cat_inter">
        <legend><?php echo __('Países y destinatarios de la transferencia'); ?></legend>
        <table width="100%" style="border:1px solid #F4C025">
            <tr>
                <th><?php echo __('Países'); ?></th>
                <th><?php echo __('Categoría de destinatarios'); ?></th>
            </tr><?php
            include_partial('notificaciones/transferencias_internacionales', array('id' => '1'));
            include_partial('notificaciones/transferencias_internacionales', array('id' => '2'));
            include_partial('notificaciones/transferencias_internacionales', array('id' => '3'));
            include_partial('notificaciones/transferencias_internacionales', array('id' => '4')); ?>
        </table>
        <br />
        <table width="100%" style="border:1px solid #F4C025">
            <tr>
                <th><?php echo __('País'); ?></th>
                <th><?php echo __('Otra categoría de destinatarios'); ?></th>
            </tr>
            <tr>
                <td class="quitar_borde" align="center">
                    <select id="otros5" name="otro-pais_10"><?php
                        include_partial('notificaciones/options_paises'); ?>
                    </select>
                </td>
                <td class="quitar_borde" align="center">
                    <input id="text_otros5" type="text" name="otra-cat-destina_10" size="77" class="text mayus" maxlength="100" />
                </td>
            </tr>
        </table>
    </fieldset>
</fieldset>
</div>