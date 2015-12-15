<br /><fieldset>
    <legend class="form1">
        <span class="number">7</span><?php echo __('Tipos de datos, estructura y organización del fichero'); ?>
    </legend><?php
        echo input_hidden_tag('__7', '0'); ?>
    <h4><?php echo __('Datos especialmente protegidos:'); ?></h4>
    <p><?php echo __('Los tratamientos de datos de carácter personal que revelen o hagan referencia a ideología, afiliación sindical, religión o creencias, deberán ampararse en alguno de los supuestos que la Ley establece al efecto para poder tratarlos. El tratamiento de estos datos sólo puede realizarse si se ha recabado el consentimiento expreso y por escrito del afectado. Para más información consulte la ayuda del formulario.'); ?></p><?php
    if (isset($tipo_noti) && $action == 'modify') {
        $con = Propel::getConnection();
        $query = "SELECT * FROM `tipos_datos_seguridad_cesion` WHERE `tipos_datos_seguridad_cesion`.`id` = '".$tipo_noti."';";
        $statement = $con->prepare($query);
        $statement->execute();
        $resultset3 = $statement->fetch(PDO::FETCH_OBJ);
        //$datos_check = explode(',', $resultset3->datos_check);
        $datos_left = explode(',', $resultset3->datos_select_izq);
        //$datos_right = explode(',', $resultset3->datos_select_der);
        //$medidas_check = explode(',', $resultset3->medidas_check);
        $medidas_left = explode(',', $resultset3->medidas_select_izq);
        //$medidas_right = explode(',', $resultset3->medidas_select_der);
    } ?>
    <fieldset>
        <legend><?php echo __('Datos especialmente protegidos'); ?></legend>
        <table width="100%" class="quitar_borde">
            <tr>
                <td class="quitar_borde" width="25%">
                    <input id="ind_ide" type="checkbox" name="datos-pro1_7" value="1" class="checkboxes"<?php
                        if ($notificacion->ind_ide == '1')  echo ' checked="checked"'; ?>/> <?php echo __('Ideología'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_as" type="checkbox" name="datos-pro2_7" value="2" class="checkboxes"<?php
                        if ($notificacion->ind_as == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Afiliación sindical'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_r" type="checkbox" name="datos-pro3_7" value="3" class="checkboxes"<?php
                        if ($notificacion->ind_r == '1')    echo ' checked="checked"'; ?>/> <?php echo __('Religión'); ?>
                </td><td class="quitar_borde" width="25%">
                    <input id="ind_c" type="checkbox" name="datos-pro4_7" value="4" class="checkboxes"<?php
                        if ($notificacion->ind_c == '1')    echo ' checked="checked"'; ?>/> <?php echo __('Creencias'); ?>
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
                        if ($notificacion->ind_re == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Origen racial o étnico'); ?>
                </td><td class="quitar_borde" width="33%">
                    <input id="ind_sal" type="checkbox" name="datos-pro6_7" value="6" class="checkboxes"<?php
                        if ($notificacion->ind_sal == '1')  echo ' checked="checked"'; ?>/> <?php echo __('Salud'); ?>
                </td><td class="quitar_borde" width="33%">
                    <input id="ind_sexo" type="checkbox" name="datos-pro7_7" value="7" class="checkboxes"<?php
                        if ($notificacion->ind_sexo == '1') echo ' checked="checked"'; ?>/> <?php echo __('Vida sexual'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset id="identificativos">
        <legend><?php echo __('Datos de carácter identificativo'); ?></legend><?php
        if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
        else { ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_8" value="8" class="chk2 required"<?php
                            if ($notificacion->ind_nif == '1')  echo ' checked="checked"'; ?>/> <?php echo __('NIF/DNI'); ?>
                    </td><td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_9" value="9" class="chk2 required"<?php
                            if ($notificacion->ind_ss == '1')   echo ' checked="checked"'; ?>/> <?php echo __('NºSS/Mutualidad'); ?>
                    </td><td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_10" value="10" class="chk2 required"<?php
                            if ($notificacion->ind_n_a == '1')  echo ' checked="checked"'; ?>/> <?php echo __('Nombre y apellidos'); ?>
                    </td><td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_11" value="11" class="chk2 required"<?php
                            if ($notificacion->ind_ts == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Tarjeta sanitaria'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_12" value="12" class="chk2 required"<?php
                            if ($notificacion->ind_dir == '1')      echo ' checked="checked"'; ?>/> <?php echo __('Dirección'); ?>
                    </td><td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_13" value="13" class="chk2 required"<?php
                            if ($notificacion->ind_tel == '1')      echo ' checked="checked"'; ?>/> <?php echo __('Teléfono'); ?>
                    </td><td colspan="2" class="quitar_borde" width="50%">
                        <input type="checkbox" name="datos-pro7_14" value="14" class="chk2 required"<?php
                            if ($notificacion->ind_huella == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Firma/Huella'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_15" value="15" class="chk2 required"<?php
                            if ($notificacion->ind_img == '1')      echo ' checked="checked"'; ?>/> <?php echo __('Imagen/voz'); ?>
                    </td><td class="quitar_borde" width="25%">
                        <input type="checkbox" name="datos-pro7_16" value="16" class="chk2 required"<?php
                            if ($notificacion->ind_marcas == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Marcas físicas'); ?>
                    </td><td colspan="2" class="quitar_borde" width="50%">
                        <input type="checkbox" name="datos-pro7_17" value="17" class="chk2 required"<?php
                            if ($notificacion->ind_firma == '1')    echo ' checked="checked"'; ?>/> <?php echo __('Firma electrónica'); ?>
                    </td>
                </tr><?php
                if ($notificacion->td_otrosprotegidos != '' && ($action == 'modify' || $action == 'view' || $action == 'new')) { ?>
                    <tr>
                        <td class="quitar_borde" width="25%">
                            <input id="otros2" type="checkbox" name="datos-pro7_18" value="18" class="chk2 required" checked="checked" /> <?php echo __('Otros datos de carácter identificativo'); ?>:
                        </td><td colspan="3" class="quitar_borde" width="75%">
                            <input id="text_otros2" type="text" name="otros_7" size="60 mayus" class="text mayus" maxlength="100" value="<?php echo $notificacion->td_otrosprotegidos; ?>" />
                        </td>
                    </tr><?php
                } elseif ($action == 'modify') { ?>
                    <tr>
                        <td class="quitar_borde" width="25%">
                            <input id="otros2" type="checkbox" name="datos-pro7_18" value="18" class="chk2 required" /> <?php echo __('Otros datos de carácter identificativo'); ?>:
                        </td><td colspan="3" class="quitar_borde" width="75%">
                            <input id="text_otros2" type="text" name="otros_7" size="60 mayus" class="text mayus" maxlength="100" />
                        </td>
                    </tr><?php
                } ?>
            </table><?php
        } ?>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Otros datos tipificados'); ?></legend>
        <div id="datos2_div" class="fcell div_datos"><?php
            $datos = explode(';', $notificacion->td_otrostipificados);
            if ($action == 'modify') { ?>
                <div id="datos1_div" class="datos">
                    <select id="datos1" name="datos1[]" multiple="multiple" class="datos multiple_list"><?php
                        if (isset($tipo_noti) && $datos_left[0] != '') {
                            foreach ($datos_left as $d_left) {
                                if (!in_array($d_left, $datos)) {
                                    $c = new Criteria();
                                    $c->add(Taula4Peer::T4ID, $d_left, Criteria::EQUAL);
                                    $dato = Taula4Peer::doSelectOne($c); ?>
                                    <option title="<?php echo $dato->getDescripcion(); ?>" value="<?php echo $dato->getT4id(); ?>">
                                        <?php echo $dato->getDescripcion(); ?>
                                    </option><?php
                                }
                            }
                        } elseif (!isset($tipo_noti)) {
                            $datos_ = Taula4Peer::doSelect(new Criteria);
                            foreach ($datos_ as $dat) {
                                if (!in_array($dat->getT4id(), $datos)) { ?>
                                    <option title="<?php echo $dat->getDescripcion(); ?>" value="<?php echo $dat->getT4id(); ?>">
                                        <?php echo $dat->getDescripcion(); ?>
                                    </option><?php
                                }
                            }
                        } ?>
                    </select>
                </div>
                <div id="datos0_div" class="datos_buttons">
                    <a class="datos_link" href="#" id="add_datos">&gt;&gt;</a>
                    <a class="datos_link" href="#" id="remove_datos">&lt;&lt;</a>
                </div><?php
            }
            if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
            else { ?>
                <div class="datos">
                    <select id="datos2" name="datos2[]" multiple="multiple" class="datos multiple_list"><?php
                        foreach ($datos as $d) {
                            $c = new Criteria();
                            $c->add(Taula4Peer::T4ID, $d, Criteria::EQUAL);
                            $dato = Taula4Peer::doSelectOne($c);
                            if (!$dato instanceof Taula4) $dato = new Taula4();
                            ?>
                            <option title="<?php echo $dato->getDescripcion(); ?>" value="<?php echo $dato->getT4id(); ?>">
                                <?php echo $dato->getDescripcion(); ?>
                            </option><?php
                        } ?>
                    </select>
                </div><?php
            } ?>
        </div><br /><?php
        if ($notificacion->td_otrostiposdatos != '' && ($action == 'modify' || $action == 'view' || $action == 'new')) { ?>
            <div style="clear:both"><?php
                echo __('Otros tipos de datos'); ?> <input id="otros3" type="checkbox" name="otrostipos_7" value="otros tipos" class="otros" checked="checked" /><br />
                <textarea id="text_otros3" name="otrostiposdatos_7" cols="80" rows="2" class="text mayus"><?php echo $notificacion->td_otrostiposdatos; ?></textarea>
            </div><?php
        } elseif ($action == 'modify') { ?>
            <div style="clear:both"><?php
                echo __('Otros tipos de datos'); ?> <input id="otros3" type="checkbox" name="otrostipos_7" value="otros tipos" class="otros" /><br />
                <textarea id="text_otros3" name="otrostiposdatos_7" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
            </div><?php
        } ?>
    </fieldset>
    <fieldset id="tratamiento">
        <legend><?php echo __('Sistema de tratamiento'); ?></legend><?php
        if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
        else { ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td width="33%" class="quitar_borde">
                        <input type="radio" name="tratamiento_7" class="sist_tratam required" value="19"<?php
                            if ($notificacion->td_tratamiento == '1')   echo ' checked="checked"'; ?>/> <?php echo __('Automatizado'); ?>
                    </td><td width="33%" class="quitar_borde">
                        <input type="radio" name="tratamiento_7" class="sist_tratam required" value="20"<?php
                            if ($notificacion->td_tratamiento == '2')   echo ' checked="checked"'; ?>/> <?php echo __('Manual'); ?>
                    </td><td width="33%" class="quitar_borde">
                        <input type="radio" name="tratamiento_7" class="sist_tratam required" value="21"<?php
                            if ($notificacion->td_tratamiento == '3')   echo ' checked="checked"'; ?>/> <?php echo __('Mixto'); ?>
                    </td>
                </tr>
            </table><?php
        } ?>
    </fieldset>
</fieldset>