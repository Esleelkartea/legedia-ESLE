<?php
$dir = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$id_fichero.'-'.$notid.'.xml';
$con = Propel::getConnection();
$query = "SELECT `notificaciones`.* FROM `notificaciones` WHERE `notificaciones`.`notid` = '".$notid."' AND `notificaciones`.`id_fichero` = '".$id_fichero."';";
$statement = $con->prepare($query);
$statement->execute();
$notificacion = $statement->fetch(PDO::FETCH_OBJ);
$hook = str_replace('modify', 'Modificacion', str_replace('supress', 'Supresion', $action));
if ($action == 'modify' || $action == 'supress') {
    $id_campo_codigo_agencia = CampoPeer::getCampoCodAgencia();
    $c = new Criteria();
    $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
    $c->addAnd(ItemPeer::ID_FORMULARIO, $id_fichero, Criteria::EQUAL);
    $c->addAnd(ItemBasePeer::ID_CAMPO, $id_campo_codigo_agencia, Criteria::EQUAL);
    $val_item = ItemPeer::doSelectOne($c);
    $codigo_agencia = $val_item->getTextoCorto();
}
if ($action == 'view' || $action == 'modify' || $action == 'supress') {
    use_helper('Date');
    $date = substr($notificacion->fecha, 4, 4).'-'.substr($notificacion->fecha, 2, 2).'-'.substr($notificacion->fecha, 0, 2);
    $time = substr($notificacion->hora_proceso, 0, 2).':'.substr($notificacion->hora_proceso, 2, 2).':'.substr($notificacion->hora_proceso, 4, 2);
    if ($notificacion->tipo_noti != '' && ($action == 'modify' || $action == 'supress')) {
        $tipo_noti = $notificacion->tipo_noti;
        $js = get_partial('form_detail_js', array('tipo' => $tipo_noti, 'hook' => $hook));
    } elseif ($action == 'modify' || $action == 'supress')  $js = get_partial('form_detail_js', array('hook' => $hook));
} ?>
<script type="text/javascript"><!--
    jQuery(document).ready(function() {
        jQuery("#div_log").hide();
        jQuery("#log").click(function() {
            jQuery("#div_"+jQuery(this).attr('id')).css({'text-align' : 'left'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'border' : 'solid 2px #67727b'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'background' : '#000000'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'color' : '#ffffff'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'padding' : '4px'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'height' : '350px'});
            jQuery("#div_"+jQuery(this).attr('id')).css({'overflow' : 'scroll'});
            jQuery("#div_"+jQuery(this).attr('id')).toggle('fast');
            return false;
        });<?php
        if ($action == 'view' || $action == 'new') { ?>
            jQuery('#persona').show();
            jQuery('#persona').find('input, textarea, select, radio, checkbox, submit, buttom, a').each(function() { jQuery(this).readonly(true); });
            jQuery('#cuerpo').find('input, textarea, select, radio, checkbox, submit, buttom, a').each(function() { jQuery(this).readonly(true); });<?php
        } elseif ($action == 'supress' || $action == 'modify') { ?>
            jQuery('#txtmod').readonly(true);
            jQuery('#cifmod').readonly(true);
            jQuery('#codinsmod').readonly(true);
            jQuery('#persona').hide();
            jQuery('#_1').hide();
            jQuery('#_2').hide();
            jQuery('#_4').hide();
            jQuery('#_5').hide();
            jQuery('#_6').hide();
            jQuery('#_7').hide();
            jQuery('#_8').hide();
            jQuery('#_9').hide();
            jQuery('#_10').hide();
            jQuery('#bot1').hide();
            jQuery('#append').hide();
            jQuery('#bot2').hide();
            jQuery('.docu').click(function() { jQuery('#bot1').show(); });
            jQuery('input.reset').click(function() {
                jQuery('#mod1').show();
                jQuery('#mod2').show();
                jQuery('#bot1').hide();
                jQuery('.parent_div').each(function() { jQuery(this).hide(); });
                jQuery('#append').hide();
                jQuery('#bot2').hide();
            });<?php
        }
        if ($action == 'supress') { ?>
            jQuery('#_11').hide();
            jQuery('#commit1').click(function() {
                jQuery('#_11').show();
                jQuery('#codinsmod_').readonly();
                jQuery('#mod1').hide();
                jQuery('#mod2').hide();
                jQuery('#bot1').hide();
                jQuery('#append').append('<br />');
                jQuery('#append').show();
                jQuery('#bot2').show();<?php
                echo str_replace('<script type="text/javascript"><!--', '', str_replace('--></script>', '', $js)); ?>
                return redi();
            });
            jQuery('#commit2').click(function() {
                if (trim(jQuery('#txtmod1_').val()) == '') {
                    alert('<?php echo __('Rellene el campo "Motivos de la supresión"'); ?>');
                    jQuery('#txtmod1_').focus();
                    jQuery('#txtmod1_').select();
                    return false;
                } else if (trim(jQuery('#txtmod2_').val()) == '') {
                    alert('<?php echo __('Rellene el campo "Destino de la información y previsiones adoptadas para su destrucción"'); ?>');
                    jQuery('#txtmod2_').focus();
                    jQuery('#txtmod2_').select();
                    return false;
                }
            });<?php
        } elseif ($action == 'modify') { ?>
            jQuery('#commit1').click(function() {
                var i = 0;
                jQuery('input.modchk:checked').each(function() {
                    i ++;
                    if (jQuery(this).val() == '1') {
                        jQuery('#_1').show();
                        jQuery('#__1').val('1');
                    }
                    if (jQuery(this).val() == '2') {
                        jQuery('#_2').show();
                        jQuery('#__2').val('1');
                    }
                    if (jQuery(this).val() == '4') {
                        jQuery('#_4').show();
                        jQuery('#__4').val('1');
                    }
                    if (jQuery(this).val() == '5') {
                        jQuery('#_5').show();
                        jQuery('#__5').val('1');
                    }
                    if (jQuery(this).val() == '6') {
                        jQuery('#_6').show();
                        jQuery('#__6').val('1');
                    }
                    if (jQuery(this).val() == '7') {
                        jQuery('#_7').show();
                        jQuery('#__7').val('1');
                    }
                    if (jQuery(this).val() == '8') {
                        jQuery('#_8').show();
                        jQuery('#__8').val('1');
                    }
                    if (jQuery(this).val() == '9') {
                        jQuery('#_9').show();
                        jQuery('#__9').val('1');
                    }
                    if (jQuery(this).val() == '10') {
                        jQuery('#_10').show();
                        jQuery('#__10').val('1');
                    }
                });
                if (i == 0)  alert('<?php echo __("Debe seleccionar el apartado o apartados que quiere modificar"); ?>');
                else {
                    jQuery('#mod1').hide();
                    jQuery('#mod2').hide();
                    jQuery('#bot1').hide();
                    jQuery('#append').append('<br />');
                    jQuery('#append').show();
                    jQuery('#bot2').show();<?php
                    echo str_replace('<script type="text/javascript"><!--', '', str_replace('--></script>', '', $js)); ?>
                    return redi();
                }
            });<?php
        } ?>
    });
--></script><?php
include_partial('cabecera', array('id_fichero' => $id_fichero, 'notid' => $notid)); ?>
<br />
<fieldset>
    <label style="float:none; text-align:center; font-size: 12px" class="form1"><?php
        if ($action == 'new') {
            echo __('Creación del fichero de inscripción exitosa en: %%dir%%', array('%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log'))), 'messages');
        } elseif ($notificacion->tipo == 'Modificacion' && isset($insert) && $insert) {
            echo __('Creación del fichero de modificación exitosa en: %%dir%%', array('%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log'))), 'messages');
        } elseif ($notificacion->tipo == 'Supresion' && isset($insert) && $insert) {
            echo __('Creación del fichero de supresión exitosa en: %%dir%%', array('%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log'))), 'messages');
        } elseif (!is_file($dir)) {
            echo __('<strong>Error:</strong> Fichero %%dir%% no encontrado', array('%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log'))), 'messages');
        } else {
            echo __('Fichero de %%tipo%% creado el %%fecha%% a las %%hora%% en: %%dir%%', array('%%tipo%%' => strtolower($notificacion->tipo), '%%dir%%' => link_to($dir, $_SERVER["PHP_SELF"], array('id' => 'log')), '%%fecha%%' => format_date($date, "D", 'es'), '%%hora%%' => format_date($time, "t", 'es')), 'messages');
        } ?>
    </label>
    <div id="div_log" style="clear:both; height: 300px; overflow: auto; border: 1px solid silver; padding: 5px; margin: 5px;"><?php
        if (is_file($dir))  echo str_replace("\n", '<br />', str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", htmlentities(file_get_contents($dir))));
        else    echo __('Error:     No encontrado'); ?>
    </div>
</fieldset>
<div id="cuerpo" style="clear:both"><?php
    if ($action == 'modify' || $action == 'supress') {
        echo input_hidden_tag('hook' , $hook);
        echo input_hidden_tag('modelo' , $notificacion->modelo);
        echo input_hidden_tag('id_fichero', $id_fichero); ?>
        <fieldset id="mod1">
            <legend class="form1">&nbsp;<?php
                if ($action == 'modify')    echo __('Modificación de la inscripción del fichero');
                elseif ($action == 'supress')    echo __('Supresión de la inscripción del fichero'); ?>
            </legend>
            <div class="flerro">
                <div id="txtmod_div" class="fcell"><?php
                    echo __('Denominación social del responsable del fichero').': '; ?>
                    <input id="txtmod" type="text" name="txtmod" size="60" class="text required mayus" maxlength="140" value="<?php echo $notificacion->rf_nombre; ?>" />
                </div>
                <div id="cifmod_div" class="fcell" style="clear:both;margin-top:7px"><?php echo __('CIF/NIF/NIE con el que figure inscrito el fichero').': '; ?>
                    <input id="cifmod" type="text" name="cifmod" size="10" class="cif required" maxlength="9" value="<?php echo $notificacion->rf_cif; ?>" />
                </div>
                <div id="codinsmod_div" class="fcell" style="margin-top:7px">&nbsp;&nbsp;<?php echo __('Código de Inscripción').': '; ?>
                    <input id="codinsmod" type="text" name="codinsmod" size="10" class="text required mayus" maxlength="10" value="<?php echo $codigo_agencia; ?>" />
                </div><?php
                if ($action == 'modify') { ?>
                    <div class="fcell" style="clear:both;margin-top:7px">
                        <table class="quitar_borde" width="100%">
                            <tr>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk1" type="checkbox" name="modchk1" class="modchk" value="1" /> <?php echo __('Responsable del fichero o tratamiento'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk2" type="checkbox" name="modchk2" class="modchk" value="2" /> <?php echo __('Derechos de oposición, acceso, rectificacion y cancelación'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk4" type="checkbox" name="modchk4" class="modchk" value="4" /> <?php echo __('Encargado del tratamiento'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk5" type="checkbox" name="modchk5" class="modchk" value="5" /> <?php echo __('Identificación y finalidad del fichero'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk6" type="checkbox" name="modchk6" class="modchk" value="6" /> <?php echo __('Origen y procedencia de los datos'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk7" type="checkbox" name="modchk6" class="modchk" value="7" /> <?php echo __('Tipos de datos, estructura y organización del fichero'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk8" type="checkbox" name="modchk6" class="modchk" value="8" /> <?php echo __('Medidas de seguridad'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk9" type="checkbox" name="modchk6" class="modchk" value="9" /> <?php echo __('Cesión o comunicación de datos'); ?>
                                </td>
                                <td class="quitar_borde" width="33%">
                                    <input id="modchk10" type="checkbox" name="modchk6" class="modchk" value="10" /> <?php echo __('Transferencias internacionales'); ?>
                                </td>
                            </tr>
                        </table>
                    </div><?php
                } ?>
            </div>
        </fieldset>
        <fieldset id="mod2">
            <legend class="form1">&nbsp;<?php echo __('Presentación de la documentación'); ?></legend><?php
                echo __('¿Cuál es el sistema que empleará para presentar la declaración?'); ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="1" /> <?php echo __('Formulario en papel'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="2" /> <?php echo __('Internet'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde">
                        <input class="docu" type="radio" name="sistema" value="3" /> <?php echo __('Internet firmado con certificado digital'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset id="bot1" class="boton">
            <table class="quitar_borde" width="100%">
                <tr>
                    <td class="quitar_borde" width="50%" align="center">
                        <input id="commit1" type="button" name="commit1" value="<?php echo __('Cumplimentar'); ?>" class="submit cump" />
                    </td>
                    <td class="quitar_borde" width="50%" align="center">
                        <input id="reinicia1" type="reset" name="reinicia1" value="<?php echo __('Reiniciar'); ?>" class="reset cump" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <div id="append" class="sistema"><?php
            if ($action == 'modify' || $action == 'supress') {
                include_partial('00', array('notificacion' => $notificacion));
                echo '<div id="_1" class="parent_div">'.get_partial('01', array('notificacion' => $notificacion)).'</div>';
                echo '<div id="_2" class="parent_div">'.get_partial('02', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_4" class="parent_div">'.get_partial('04', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_5" class="parent_div">'.get_partial('05', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_6" class="parent_div">'.get_partial('06', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_7" class="parent_div">'.get_partial('07', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_8" class="parent_div">'.get_partial('08', array('notificacion' => $notificacion)).'</div>';
                echo '<div id="_9" class="parent_div">'.get_partial('09', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                echo '<div id="_10" class="parent_div">'.get_partial('10', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
                if ($action == 'supress')   echo '<div id="_11" class="parent_div">'.get_partial('11', array('action' => $action, 'notificacion' => $notificacion, 'codigo_agencia' => $codigo_agencia)).'</div>';
            } ?>
        </div>
        <fieldset id="bot2" class="boton">
            <table class="quitar_borde" width="100%">
                <tr>
                    <td class="quitar_borde" width="50%" align="center"><?php
                        echo submit_tag("Guardar cambios", array('id' => 'commit2', 'class' => 'submit cump')); ?>
                    </td>
                    <td class="quitar_borde" width="50%" align="center">
                        <input id="reinicia2" type="reset" name="reinicia2" value="<?php echo __('Cancelar'); ?>" class="reset cump" />
                    </td>
                </tr>
            </table>
        </fieldset>
</div><?php
    } elseif ($action == 'view' || $action == 'new') {
        include_partial('00', array('notificacion' => $notificacion));
        echo '<div id="_1">'.get_partial('01', array('notificacion' => $notificacion)).'</div>';
        echo '<div id="_2">'.get_partial('02', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_4">'.get_partial('04', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_5">'.get_partial('05', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_6">'.get_partial('06', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_7">'.get_partial('07', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_8">'.get_partial('08', array('notificacion' => $notificacion)).'</div>';
        echo '<div id="_9">'.get_partial('09', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        echo '<div id="_10">'.get_partial('10', array('action' => $action, 'notificacion' => $notificacion)).'</div>';
        if ($notificacion->tipo == 'Supresion') echo '<div id="_11">'.get_partial('11', array('action' => $action, 'notificacion' => $notificacion, 'codigo_agencia' => $codigo_agencia)).'</div>'; ?>
</div>
        <div id="sf_admin_container"><div id="sf_admin_bar"><div class="sf_admin_filters">
            <ul class="sf_admin_actions"><?php
                if ((isset($insert) && $insert) || $notificacion->procesado == '0') {
                    $o = substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), '/notificaciones'));
                    $u = substr($o, 0, strrpos($o, '/')).'/images/icons/';
                    echo '<li>'.link_to(__('Enviar a la APD'), 'notificaciones/enviar?id_fichero='.$id_fichero.'&id_notificacion='.$notid,
                                array('class' => 'sf_admin_action_save', 'style' => '
                                    text-decoration:none;
                                    float:right;
                                    background-color:#E3E3E3;
                                    border-color:-moz-use-text-color #999999 -moz-use-text-color -moz-use-text-color;
                                    border-style:none solid none none;
                                    border-width:0 4px 0 0;
                                    color:#333333;
                                    cursor:pointer;
                                    font-family:Arial,sans-serif;
                                    font-size:11px;
                                    padding:4px 3px 3px 20px;
                                    -moz-background-clip:border;
                                    -moz-background-inline-policy:continuous;
                                    -moz-background-origin:padding;
                                    background:#E3E3E3 url('.$u.'bullet_go.png'.') no-repeat scroll 3px 2px;
                                    border-right: 4px solid #73B65A !important;
                                    max-width: 100% !important;
                                    list-style-type: none;
                                    text-align: right;
                                    margin-bottom: 3%;')).'</li>';
                }
                if (!isset($insert)) {
                    $con = Propel::getConnection();
                    $query = "SELECT `notificaciones`.* FROM `notificaciones` WHERE `notificaciones`.`notid` <> '".$notid."' AND `notificaciones`.`id_fichero` = '".$id_fichero."';";
                    $statement = $con->prepare($query);
                    $statement->execute();
                    $anteriores_tipo = array();
                    $anteriores_procesado = array();
                    while ($notificaciones_anteriores = $statement->fetch(PDO::FETCH_OBJ)) {
                        $anteriores_tipo[] = $notificaciones_anteriores->tipo;
                        $anteriores_procesado[] = $notificaciones_anteriores->procesado;
                    }
                    if (empty($anteriores_tipo) && empty($anteriores_procesado) && $notificacion->tipo == 'Inscripcion' && $notificacion->procesado == '0') {

                    } else {
                        if (!in_array('Modificacion', $anteriores_tipo) && !in_array('0', $anteriores_procesado) && $notificacion->tipo != 'Modificacion')
                            echo '<li>'.button_to(__('Modificar en APD'), 'notificaciones/modificar?id_fichero='.$id_fichero.'&id_notificacion='.$notid, 'class=sf_admin_action_reset_filter').'</li>';
                        if (!in_array('Supresion', $anteriores_tipo) && !in_array('0', $anteriores_procesado) && $notificacion->tipo != 'Supresion')
                            echo '<li>'.button_to(__('Suprimir en APD'), 'notificaciones/suprimir?id_fichero='.$id_fichero.'&id_notificacion='.$notid, 'class=sf_admin_action_filter').'</li>';
                    }
                } ?>
            </ul>
        </div></div></div><?php
    } ?><br />