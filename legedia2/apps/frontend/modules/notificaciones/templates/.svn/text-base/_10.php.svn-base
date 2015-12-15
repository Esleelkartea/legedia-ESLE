<br /><fieldset>
    <legend class="form1">
        <span class="number">10</span><?php echo __('Transferencias internacionales'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__10', '0'); ?><p><?php
        echo __('Este apartado únicamente ha de cumplimentarse en el caso de que se realice o está previsto realizar un tratamiento de datos fuera del territorio del Espacio Económico Europeo. En el caso de que la transferencia internacional tenga como destino un país que no preste un nivel de protección adecuado al que presta la LOPD, deberá tener en cuenta que la LOPD establece que las previsiones para realizar transferencias internacionales son diferentes, dependiendo de que los países destinatarios tengan un nivel de protección adecuado o no. Para más información consulte la ayuda de este formulario.'); ?>
        </p><fieldset id="cat_inter">
            <legend><?php echo __('Países y destinatarios de la transferencia'); ?></legend><?php
            if ($action == 'view' || $action == 'new') {
                if ($notificacion->paises_destina != '') { ?>
                    <table width="100%" style="border:1px solid #F4C025">
                        <tr>
                            <th><?php echo __('Países'); ?></th>
                            <th><?php echo __('Categoría de destinatarios'); ?></th>
                        </tr><?php
                        $paises_destina = explode(';', $notificacion->paises_destina);
                        $cat_destina = explode(';', $notificacion->cat_destina);
                        for ($i = 0; $i < count($paises_destina); $i ++) { ?>
                            <tr>
                                <td align="center" class="quitar_borde"><?php
                                    $con = Propel::getConnection();
                                    $query = "SELECT `paises`.* FROM `paises` WHERE `paises`.`cod` = '".$paises_destina[$i]."';";
                                    $statement = $con->prepare($query);
                                    $statement->execute();
                                    $pais = $statement->fetch(PDO::FETCH_OBJ);
                                    echo $pais->pais; ?>
                                </td>
                                <td align="center" class="quitar_borde"><?php
                                    $con = Propel::getConnection();
                                    $query = "SELECT `taula7`.* FROM `taula7` WHERE `taula7`.`t7id` = '".$cat_destina[$i]."';";
                                    $statement = $con->prepare($query);
                                    $statement->execute();
                                    $cat = $statement->fetch(PDO::FETCH_OBJ);
                                    echo $cat->descripcion; ?>
                                </td>
                            </tr><?php
                        } ?>
                    </table>
                    <br /><?php
                }
                if ($notificacion->otro_pais_destina != '') { ?>
                    <table width="100%" style="border:1px solid #F4C025">
                        <tr>
                            <th><?php echo __('País'); ?></th>
                            <th><?php echo __('Otra categoría de destinatarios'); ?></th>
                        </tr>
                        <tr>
                            <td class="quitar_borde" align="center"><?php
                                $con = Propel::getConnection();
                                $query = "SELECT `paises`.`pais` FROM `paises` WHERE `paises`.`cod` = '".substr($notificacion->otro_pais_destina, strlen($notificacion->otro_pais_destina) - 2, strlen($notificacion->otro_pais_destina))."';";
                                $statement = $con->prepare($query);
                                $statement->execute();
                                $pais = $statement->fetch(PDO::FETCH_OBJ);
                                echo $pais->pais; ?>
                            </td>
                            <td class="quitar_borde" align="center"><?php
                                echo substr($notificacion->otro_pais_destina, 0, strlen($notificacion->otro_pais_destina) - 3); ?>
                            </td>
                        </tr>
                    </table><?php
                }
                if ($notificacion->paises_destina == '' && $notificacion->otro_pais_destina == '')  echo __('No hay ninguno');
            } elseif ($action == 'modify') {
                $paises_destina = explode(';', $notificacion->paises_destina);
                $cat_destina = explode(';', $notificacion->cat_destina); ?>
                <table width="100%" style="border:1px solid #F4C025">
                    <tr>
                        <th><?php echo __('Países'); ?></th>
                        <th><?php echo __('Categoría de destinatarios'); ?></th>
                    </tr><?php
                        $i = 0;
                        empty($paises_destina);
                        if (count($paises_destina) == 1 && $paises_destina[0] == '') {}
                        else {
                            foreach ($paises_destina as $k => $p_dest) {
                                $i++;
                                $con = Propel::getConnection();
                                $query = "SELECT `paises`.`pid` FROM `paises` WHERE `paises`.`cod` = '".$p_dest."';";
                                $statement = $con->prepare($query);
                                $statement->execute();
                                $pais = $statement->fetch(PDO::FETCH_OBJ); ?>
                                <tr>
                                    <td class="quitar_borde" align="center">
                                        <select id="pais_10_<?php echo $i; ?>" name="pais_10_<?php echo $i; ?>" class="next"><?php
                                            include_partial('options_paises', array('id_pais' => $pais->pid)); ?>
                                        </select>
                                    </td>
                                    <td align="center" class="quitar_borde">
                                        <select id="cat-destina_10_<?php echo $i; ?>" name="cat-destina_10_<?php echo $i; ?>" class="next_detail">
                                            <option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
                                            $categorias = Taula7Peer::doSelect(new Criteria);
                                            foreach ($categorias as $cat) {
                                                if ($cat_destina[$k] == $cat->getT7id()) { ?>
                                                    <option title="<?php echo $cat->getDescripcion(); ?>" value="<?php echo $cat->getT7id(); ?>" selected="selected"><?php
                                                        echo $cat->getDescripcion(); ?>
                                                    </option><?php
                                                } else { ?>
                                                    <option title="<?php echo $cat->getDescripcion(); ?>" value="<?php echo $cat->getT7id(); ?>" ><?php
                                                        echo $cat->getDescripcion(); ?>
                                                    </option><?php
                                                }
                                            } ?>
                                        </select>
                                    </td>
                                </tr><?php
                            }
                        }
                        for (; $i < 4; $i++) {
                            include_partial('transferencias_internacionales', array('id' => $i + 1));
                        } ?>
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
                                if ($notificacion->otro_pais_destina == '')  include_partial('options_paises');
                                else {
                                    $con = Propel::getConnection();
                                    $query = "SELECT `paises`.`pid` FROM `paises` WHERE `paises`.`cod` = '".substr($notificacion->otro_pais_destina, strlen($notificacion->otro_pais_destina) - 2, strlen($notificacion->otro_pais_destina))."';";
                                    $statement = $con->prepare($query);
                                    $statement->execute();
                                    $pais = $statement->fetch(PDO::FETCH_OBJ);
                                    include_partial('options_paises', array('id_pais' => $pais->pid));
                                } ?>
                            </select>
                        </td>
                        <td class="quitar_borde" align="center"><?php
                            if ($notificacion->otro_pais_destina == '') { ?>
                                <input id="text_otros5" type="text" name="otra-cat-destina_10" size="77" class="text mayus" maxlength="100" /><?php
                            } else { ?>
                                <input id="text_otros5" type="text" name="otra-cat-destina_10" size="77" class="text mayus" maxlength="100" value="<?php echo substr($notificacion->otro_pais_destina, 0, strlen($notificacion->otro_pais_destina) - 3); ?>" /><?php
                            } ?>
                        </td>
                    </tr>
                </table><?php
            } ?>
        </fieldset><?php
    } ?>
</fieldset>