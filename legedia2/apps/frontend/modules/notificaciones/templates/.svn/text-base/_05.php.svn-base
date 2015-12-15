<br /><fieldset>
    <legend class="form1">
        <span class="number">5</span><?php echo __('Identificación y finalidad del fichero'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__5', '0'); ?>
        <fieldset id="denom_fichero">
            <legend><?php echo __('Denominación'); ?></legend>
            <div class="flerro">
                <div id="txt5_div" class="fcell"><?php echo __('Nombre del fichero o tratamiento'); ?><br /><?php
                    if (isset($tipo_noti)) {
                        $con = Propel::getConnection();
                        $query = "SELECT * FROM `tipos_finalidades` WHERE `tipos_finalidades`.`id` = '".$tipo_noti."';";
                        $statement = $con->prepare($query);
                        $statement->execute();
                        $resultset1 = $statement->fetch(PDO::FETCH_OBJ);
                        $finalidades_left = explode(',', $resultset1->left_finalidades);
                    } ?>
                    <input id="txt5" type="text" name="nombre_5" size="102" class="text required mayus" value="<?php echo $notificacion->idn_nombre; ?>" maxlength="70" />
                </div>
            </div>
            <div class="flerro">
                <div id="txt6_div" class="fcell"><?php echo __('Descripción detallada de finalidad y usos previstos'); ?><br />
                    <textarea id="txt6" name="descripcion_uso_5" cols="70" class="text required mayus" maxlength="350"><?php echo $notificacion->idn_descripcion; ?></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset id="finalidades">
            <legend><?php echo __('Tipifiación correspondiente a la finalidad y usos previstos'); ?></legend>
            <div id="finalidades2_div" class="fcell div_finalidades"><?php echo __('Finalidades'); ?><br /><?php
                $finalidades = explode(';', $notificacion->idn_finalidades);
                if ($action == 'modify') { ?>
                    <div id="finalidades1_div" class="finalidades">
                        <select id="finalidades1" name="finalidades1[]" multiple="multiple" class="finalidades multiple_list"><?php
                            if ((isset($tipo_noti)) && ($finalidades_left[0] != '')) {
                                foreach ($finalidades_left as $f_left) {
                                    if (!in_array($f_left, $finalidades)) {
                                        $c = new Criteria();
                                        $c->add(Taula2Peer::T2ID, $f_left, Criteria::EQUAL);
                                        $finalidad = Taula2Peer::doSelectOne($c); ?>
                                        <option title="<?php echo $finalidad->getDescripcion(); ?>" value="<?php echo $finalidad->getT2id(); ?>"><?php
                                            echo $finalidad->getDescripcion(); ?>
                                        </option><?php
                                    }
                                }
                            } elseif (!isset($tipo_noti)) {
                                $finalidades_ = Taula2Peer::doSelect(new Criteria);
                                foreach ($finalidades_ as $fin) {
                                    if (!in_array($fin->getT2id(), $finalidades)) { ?>
                                        <option title="<?php print_r($fin->getDescripcion()); ?>" value="<?php echo $fin->getT2id(); ?>"><?php
                                            print_r($fin->getDescripcion()); ?>
                                        </option><?php
                                    }
                                }
                            } ?>
                        </select>
                    </div>
                    <div id="finalidades0_div"  class="finalidades_buttons">
                        <a class="finalidades_link" href="#" id="add_finalidades">&gt;&gt;</a>
                        <a class="finalidades_link" href="#" id="remove_finalidades">&lt;&lt;</a>
                    </div><?php
                } ?>
                <div class="finalidades">
                    <select id="finalidades2" name="finalidades2[]" multiple="multiple" class="finalidades multiple_list"><?php
                        foreach ($finalidades as $f) {
                            $c = new Criteria();
                            $c->add(Taula2Peer::T2ID, $f, Criteria::EQUAL);
                            $finalidad = Taula2Peer::doSelectOne($c); ?>
                            <option title="<?php echo $finalidad->getDescripcion(); ?>" value="<?php echo $finalidad->getT2id(); ?>"><?php
                                echo $finalidad->getDescripcion(); ?>
                            </option><?php
                        } ?>
                    </select>
                </div>
            </div>
        </fieldset><?php
    } ?>
</fieldset>