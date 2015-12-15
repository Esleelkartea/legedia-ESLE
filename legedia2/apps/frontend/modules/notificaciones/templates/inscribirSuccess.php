<?php
if (isset($_GET['model']) && isset($_GET['system'])) {
    if (isset($_GET['type']))
        $partial = get_partial('form', array('hook' => 'Inscripcion', 'empresa_actual' => $empresa_actual, 'encargado' => $encargado, 'id_fichero' => $id_fichero, 'modelo' => $_GET['model'], 'tipo' => $_GET['type'], 'sistema' => $_GET['system'], 'user_id' => $user_id, 'user' => $user));
    else
        $partial = get_partial('form', array('hook' => 'Inscripcion', 'empresa_actual' => $empresa_actual, 'encargado' => $encargado, 'id_fichero' => $id_fichero, 'modelo' => $_GET['model'], 'sistema' => $_GET['system'], 'user_id' => $user_id, 'user' => $user));
    if (!isset($_GET['redirect'])) {
        echo $partial;
        exit;
    }
} ?>
<script type="text/javascript"><!--
    jQuery(document).ready(function() {
        jQuery('#tip2').hide();
        jQuery('#documentacion').hide();
        jQuery('#bot').hide();
        jQuery('#formulario').hide();
        var r = new Array ('#tip2','#documentacion','#bot');
        var c = new Array ('#modelo','#tip2','#documentacion','#bot');
        jQuery('#normal').click(function() {
            jQuery('#tip2').hide();
            jQuery('#documentacion').show();
        });
        jQuery('#tip').click(function() {
            jQuery('#documentacion').hide();
            jQuery('#tip2').show();
        });
        jQuery('.mota').click(function() { jQuery('#documentacion').show(); });
        jQuery('.docu').click(function() { jQuery('#bot').show(); });
        jQuery('#reinicia').click(function() {
            for (var i = 0; i < r.length; i++) { jQuery(r[i]).hide(); }
        });
        jQuery('#commit').click(function() {
            var modelo;
            jQuery('.mod').each(function() {
                if (jQuery(this).attr('checked') == true) {
                    modelo = this.value;
                    return false;
                } else  modelo = '';
            });
            var tipo;
            jQuery('.mota').each(function() {
                if (jQuery(this).attr('checked') == true) {
                    tipo = this.value;
                    return false;
                } else  tipo = '';
            });
            var sistema;
            jQuery('.docu').each(function() {
                if (jQuery(this).attr('checked') == true) {
                    sistema = this.value;
                    return false;
                } else  sistema = '';
            });
            for(var i = 0; i < c.length; i++) { jQuery(c[i]).hide(); }
            jQuery('#formulario').show();
            jQuery.get("<?php echo Notificaciones::selfURL(); ?>", { model: modelo, type: tipo, system: sistema },
                function (data) { jQuery('#append').append(data); });
            return false;
        });
    });
--></script>
<br />
<div style="width:50%; padding-left:25%;">
    <table class="quitar_borde">
        <tr>
            <td class="quitar_borde"><?php echo image_tag('nota.png'); ?></td>
            <td width="434" height="75" class="buru quitar_borde"><?php
                echo __('Fichero de tituralidad privada'); ?><br /><?php
                echo __('CONTENIDO DE LA NOTIFICACIÓN'); ?>
            </td>
        </tr>
    </table>
</div><?php

echo form_tag('notificaciones/guardar_empezar_proceso', array(
    'id' => 'sf_notis_form',
    'name' => 'sf_notis_form',
    'method' => 'post'));
if (isset($_GET['redirect']))   echo $partial;
else { ?>
    <div id="modelo">
        <fieldset>
            <legend><?php echo __('Modelo de declaración'); ?></legend><br /><?php
            echo __('Si la notificación se refiere a un tratamiento de datos sobre miembros de comunidades de propietarios, clientes propios, libro de recetario, (clientes de farmacias), nóminas-recursos humanos (empleados) o pacientes, y la finalidad es la gestión propia de estos colectivos, puede marcar el cuadro TIPO y seleccionar el modelo que corresponda (se rellenan determinados apartados con valores apropiados) o bien seleccionar NORMAL para partir de un formulario totalmente vacío.'); ?>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde" width="50%" style="text-align: center">
                        <input id="normal" type="radio" name="modelo" value="Normal" class="mod"/> <?php echo __('Normal'); ?>
                    </td><td class="quitar_borde" width="50%" style="text-align: left">
                        <input id="tip" type="radio" name="modelo" value="Tipo" class="mod"/> <?php echo __('Tipo'); ?>
                    </td>
                </tr>
            </table>
        </fieldset >
    </div><?php
} ?>
    <div id="tip2">
        <fieldset>
            <legend><?php echo __('Tipos'); ?></legend>
            <table width="100%" class="quitar_borde">
                <tr>
                    <td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="1" class="mota" /> <?php echo __('Comunidad de propietarios'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="4" class="mota" /> <?php echo __('Nóminas - Recursos Humanos'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="7" class="mota" /> <?php echo __('Videovigilancia'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="2" class="mota" /> <?php echo __('Clientes y/o proveedores'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="5" class="mota" /> <?php echo __('Pacientes'); ?>
                    </td><td class="quitar_borde" width="33%">
                        <input type="radio" name="tip" value="3" class="mota" /> <?php echo __('Libro Recetario'); ?>
                    </td>
                </tr><tr>
                    <td class="quitar_borde" colspan="2" width="100%">
                        <input type="radio" name="tip" value="6" class="mota" /> <?php echo __('Gestión Escolar'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
    <div id="documentacion">
        <fieldset>
            <legend><?php echo __('Presentación de la documentación'); ?></legend><?php
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
    </div>
    <fieldset id="bot" class="boton">
        <table class="quitar_borde" width="100%">
            <tr>
                <td class="quitar_borde" width="50%" align="center"><?php
                    echo submit_tag("Cumplimentar", array('id' => 'commit', 'class' => 'submit cump')); ?>
                </td>
                <td class="quitar_borde" width="50%" align="center">
                    <input id="reinicia" type="reset" name="reiniciar" value="<?php echo __('Reiniciar'); ?>" class="reset cump" />
                </td>
            </tr>
        </table>
    </fieldset>
    <div id="append" class="sistema"></div>
</form>