<br /><fieldset>
    <legend class="form1">
        <span class="number">6</span><?php echo __('Origen y procedencia de los datos'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__6', '0'); ?>
        <fieldset id="origenes">
            <legend><?php echo __('Origen'); ?></legend>
            <table class="quitar_borde" width="100%">
                <tr>
                    <td class="quitar_borde" width="33%">
                        <input id="chk1" type="checkbox" name="origen1_6" class="chk required origen" value="1"<?php
                        if ($notificacion->indica_inte == '1' || isset($tipo_noti))   echo ' checked="checked" /> '.__('El propio interesado o su representante legal');
                        else    echo ' /> '.__('El propio interesado o su representante legal'); ?>
                    </td>
                    <td class="quitar_borde" width="33%">
                        <input id="chk2" type="checkbox" name="origen2_6" class="chk1 required origen" value="2"<?php
                        if ($notificacion->indica_otras == '1' && !isset($tipo_noti))   echo ' checked="checked" /> '.__('Otras personas físicas');
                        else    echo ' /> '.__('Otras personas físicas'); ?>
                    </td>
                    <td class="quitar_borde" width="33%">
                        <input id="chk3" type="checkbox" name="origen3_6" class="chk1 required origen" value="3"<?php
                        if ($notificacion->indic_fap == '1' && !isset($tipo_noti))   echo ' checked="checked" /> '.__('Fuentes accesibles al público');
                        else    echo ' /> '.__('Fuentes accesibles al público'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="quitar_borde" width="33%">
                        <input id="chk4" type="checkbox" name="origen4_6" class="chk1 required origen" value="4"<?php
                        if ($notificacion->indic_rp == '1' && !isset($tipo_noti))   echo ' checked="checked" /> '.__('Registros públicos');
                        else    echo ' /> '.__('Registros públicos'); ?>
                    </td>
                    <td class="quitar_borde" width="33%">
                        <input id="chk5" type="checkbox" name="origen5_6" class="chk1 required origen" value="5"<?php
                        if ($notificacion->indic_ep == '1' && !isset($tipo_noti))   echo ' checked="checked" /> '.__('Entidad privada');
                        else    echo ' /> '.__('Entidad privada'); ?>
                    </td>
                    <td class="quitar_borde" width="33%">
                        <input id="chk6" type="checkbox" name="origen6_6" class="chk1 required origen" value="6"<?php
                        if ($notificacion->indic_ap == '1' && !isset($tipo_noti))   echo ' checked="checked" /> '.__('Administraciones Públicas');
                        else    echo ' /> '.__('Administraciones Públicas'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset id="colectivos">
            <legend><?php echo __('Colectivos o categorías de interesados'); ?></legend>
            <div id="colectivos2_div" class="fcell div_colectivos"><?php
                $colectivos = explode(';', $notificacion->op_colectivos);
                if ($action == 'modify') { ?>
                    <div id="colectivos1_div"  class="colectivos"><?php
                        if (isset($tipo_noti)) {
                            $con = Propel::getConnection();
                            $query = "SELECT * FROM `tipos_colectivos` WHERE `tipos_colectivos`.`id` = '".$tipo_noti."';";
                            $statement = $con->prepare($query);
                            $statement->execute();
                            $resultset2 = $statement->fetch(PDO::FETCH_OBJ);
                            $colectivos_left = explode(',', $resultset2->left_colectivos);
                        } ?>
                        <select id="colectivos1" name="colectivos1[]" multiple="multiple" class="colectivos multiple_list"><?php
                            if ((isset($tipo_noti)) && ($colectivos_left[0] != '')) {
                                foreach ($colectivos_left as $c_left) {
                                    if (!in_array($c_left, $colectivos)) {
                                        $c = new Criteria();
                                        $c->add(Taula3Peer::T3ID, $c_left, Criteria::EQUAL);
                                        $colectivo = Taula3Peer::doSelectOne($c); ?>
                                        <option title="<?php echo $colectivo->getDescripcion(); ?>" value="<?php echo $colectivo->getT3id(); ?>">
                                            <?php echo $colectivo->getDescripcion(); ?>
                                        </option><?php
                                    }
                                }
                            } elseif (!isset($tipo_noti)) {
                                $colectivos_ = Taula3Peer::doSelect(new Criteria);
                                foreach ($colectivos_ as $col) {
                                    if (!in_array($col->getT3id(), $colectivos)) { ?>
                                        <option title="<?php echo $col->getDescripcion(); ?>" value="<?php echo $col->getT3id(); ?>">
                                            <?php echo $col->getDescripcion(); ?>
                                        </option><?php
                                    }
                                }
                            } ?>
                        </select>
                    </div>
                    <div id="colectivos0_div" class="colectivos_buttons">
                        <a class="colectivos_link" href="#" id="add_colectivos">&gt;&gt;</a>
                        <a class="colectivos_link" href="#" id="remove_colectivos">&lt;&lt;</a>
                    </div><?php
                } ?>
                <div class="colectivos">
                    <select id="colectivos2" name="colectivos2[]" multiple="multiple" class="colectivos multiple_list"><?php
                        foreach ($colectivos as $col) {
                            $c = new Criteria();
                            $c->add(Taula3Peer::T3ID, $col, Criteria::EQUAL);
                            $colectivo = Taula3Peer::doSelectOne($c); ?>
                            <option title="<?php echo $colectivo->getDescripcion(); ?>" value="<?php echo $colectivo->getT3id(); ?>"><?php
                                echo $colectivo->getDescripcion(); ?>
                            </option><?php
                        } ?>
                    </select>
                </div>
            </div><br /><?php
            if ($notificacion->op_otroscol != '' && ($action == 'modify' || $action == 'view' || $action == 'new')) { ?>
                <div style="clear:both"><?php
                    echo __('Otros colectivos'); ?> <input id="otros" type="checkbox" name="otras_6" value="otros colectivos" class="otros" checked="checked" /><br />
                    <textarea id="text_otros" name="otroscolectivos_6" cols="80" rows="2" class="text mayus" maxlength="100"><?php echo $notificacion->op_otroscol; ?></textarea>
                </div><?php
            } elseif ($action == 'modify') { ?>
                <div style="clear:both"><?php
                    echo __('Otros colectivos'); ?> <input id="otros" type="checkbox" name="otras_6" value="otros colectivos" class="otros" /><br />
                    <textarea id="text_otros" name="otroscolectivos_6" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
                </div><?php
            } ?>
        </fieldset><?php
    } ?>
</fieldset>