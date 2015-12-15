<br /><fieldset>
    <legend class="form1">
        <span class="number">9</span><?php echo __('Cesión o comunicación de datos'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__9', '0'); ?><p><?php
        echo __('Este apartado únicamente ha de cumplimentarse en el caso de que se prevea realizar cesiones o comunicaciones de datos. No se considerará cesión de datos la prestación de un servicio al responsable del fichero por parte del encargado del tratamiento. La comunicación de los datos ha de ampararse en alguno de los supuestos legales establecidos en la LOPD. Para mayor información consulte la ayuda de este formulario'); ?>.<br />
        </p><fieldset id="cesion">
            <legend><?php echo __('Categorías de destinatarios de cesiones'); ?></legend>
            <div id="medidas2_div" class="fcell div_medidas"><?php
                $medidas = explode(';', $notificacion->cd_destinatarios);
                if ($action == 'modify') { ?>
                    <div id="medidas1_div" class="medidas">
                        <select id="medidas1" name="medidas1[]" multiple="multiple" class="medidas multiple_list"><?php
                            if (isset($tipo_noti) && $medidas_left[0] != '') {
                                foreach ($medidas_left as $m_left) {
                                    if (!in_array($m_left, $medidas)) {
                                        $c = new Criteria();
                                        $c->add(Taula5Peer::T5ID, $m_left, Criteria::EQUAL);
                                        $medida = Taula5Peer::doSelectOne($c); ?>
                                        <option title="<?php echo $medida->getDescripcion(); ?>" value="<?php echo $medida->getT5id(); ?>">
                                            <?php echo $medida->getDescripcion(); ?>
                                        </option><?php
                                    }
                                }
                            } elseif (!isset($tipo_noti)) {
                                $medidas_ = Taula5Peer::doSelect(new Criteria);
                                foreach ($medidas_ as $med) {
                                    if (!in_array($med->getT5id(), $medidas)) { ?>
                                        <option title="<?php echo $med->getDescripcion(); ?>" value="<?php echo $med->getT5id(); ?>">
                                            <?php echo $med->getDescripcion(); ?>
                                        </option><?php
                                    }
                                }
                            } ?>
                        </select>
                    </div>
                    <div id="medidas0_div" class="medidas_buttons">
                        <a class="medidas_link" href="#" id="add_medidas">&gt;&gt;</a>
                        <a class="medidas_link" href="#" id="remove_medidas">&lt;&lt;</a>
                    </div><?php
                } ?>
                <div class="medidas">
                    <select id="medidas2" name="medidas2[]" multiple="multiple" class="medidas multiple_list"><?php
                        foreach ($medidas as $m) {
                            $c = new Criteria();
                            $c->add(Taula5Peer::T5ID, $m, Criteria::EQUAL);
                            $medida = Taula5Peer::doSelectOne($c);
                            if (!$medida instanceof Taula5) $medida = new Taula5();
                            ?>
                            <option title="<?php echo $medida->getDescripcion(); ?>" value="<?php echo $medida->getT5id(); ?>">
                                <?php echo $medida->getDescripcion(); ?>
                            </option><?php
                        } ?>
                    </select>
                </div>
            </div><br /><?php
            if ($notificacion->cd_otrosdestinatarios != '' && ($action == 'modify' || $action == 'view' || $action == 'new')) { ?>
                <div style="clear:both"><?php
                     echo __('Otros destinatarios de cesiones'); ?> <input id="otros4" type="checkbox" name="otrosdestina_9" value="otros destinatarios" class="otros" checked="checked" /><br />
                    <textarea id="text_otros4" name="otrosdestinatarioscesion_9" cols="80" rows="2" class="text mayus" maxlength="100"><?php echo $notificacion->td_otrostiposdatos; ?></textarea>
                </div><?php
            } elseif ($action == 'modify') { ?>
                <div style="clear:both"><?php
                     echo __('Otros destinatarios de cesiones'); ?> <input id="otros4" type="checkbox" name="otrosdestina_9" value="otros destinatarios" class="otros" /><br />
                    <textarea id="text_otros4" name="otrosdestinatarioscesion_9" cols="80" rows="2" class="text mayus" maxlength="100"></textarea>
                </div><?php
            } ?>
        </fieldset><?php
    } ?>
</fieldset>