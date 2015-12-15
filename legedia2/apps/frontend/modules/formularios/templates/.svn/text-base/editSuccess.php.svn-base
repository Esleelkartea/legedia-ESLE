<?php
if (isset($_REQUEST['modelo']) && isset($_REQUEST['sistema']))  exit; ?>
<?php use_helper('MisObjetos'); ?>
<?php use_helper('FormularioModelo'); ?>
<?php use_helper('Date'); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#modelo').hide();
        jQuery('select').change(function() {
            if (trim(jQuery('#campo_34_item_base_51').val()) == '') {
                alert ('<?php echo __("Introduza un nombre para el fichero"); ?>');
                jQuery('#campo_34_item_base_51').focus();
                jQuery('#campo_34_item_base_51').select();
                jQuery('#campo_70_item_base_91').val('');
            } else {<?php
                if ($formulario->getTabla() == 'Ficheros' && trim($formulario->getPrimaryKey()) == "") { ?> jQuery('#modelo').show();<?php } ?>
            }
        });
        jQuery('#tip2').hide();
        jQuery('#documentacion').hide();<?php
        if ($formulario->getTabla() == 'Ficheros' && trim($formulario->getPrimaryKey()) == "") { ?>jQuery('#bot').hide();<?php } ?>
        jQuery('#formulario').hide();
        var r = new Array ('#modelo','#tip2','#documentacion','#bot');
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
    });
    
    function comprobar_cod_agencia(){
      if (document.getElementById(input_cod_agencia)){
        if (document.getElementById(input_cod_agencia).value == ""){
          alert("<?=__('Para modificar/suprimir la notificación en la agencia hace falta primero introducir el código que la APD le proporciono cuando inscribio fichero en curso')?>");
          return false;
        }
        if (document.getElementById(input_cod_agencia).value.length != 10){
          alert("<?=__('El código que ha introducido no es correcto. Este debe contener 10 caracteres. Asegurese ya que no podrá realizar esta operación sin el código correspondiente.')?>");
          return false;
        }
        if (isNaN(parseInt(document.getElementById(input_cod_agencia).value))) {
          alert("<?=__('El código que ha introducido no es correcto. Este debe ser númerico. Asegurese ya que no podrá realizar esta operación sin el código correspondiente.')?>");
          return false;
        }
      }
      return true;
    }
</script>
<div id="sf_admin_container"><?php
    if (!is_null($formulario->getTabla()))  $txtTabla = ' para la tabla "'.$formulario->getTabla()->getNombre().'"';
    if (trim($formulario->getPrimaryKey()) == "") { ?>
        <h1><?php echo ' '.__('Crear registro', array()).$txtTabla; ?></h1><?php
    } else { ?>
        <h1><?php echo " [".$formulario->getPrimaryKey()."] ".__('Editar registro', array()).$txtTabla; ?></h1><?php
    } ?>
    <div id="sf_admin_header"><?php
        include_partial('formularios/edit_header', array('formulario' => $formulario)); ?>
    </div>


    <div id="sf_admin_content">
        <?php include_partial('formularios/edit_messages', array('formulario' => $formulario, 'labels' => $labels)); ?>
        <?php include_partial('formularios/edit_form', array('formulario' => $formulario, 'labels' => $labels, 'tablas_auxiliares' => $tablas_auxiliares, 'id_formulario_proviene'=>$id_formulario_proviene, 'id_tabla_proviene'=>$id_tabla_proviene)); ?>
    </div>

<?php
    echo input_hidden_tag('id_file', $formulario->getPrimaryKey());
    if ($formulario->getTabla()->getEsFicheros() && trim($formulario->getPrimaryKey()) != "") { ?>
        <div id="sf_admin_bar"><div class="sf_admin_filters"><fieldset id="notis_widget">
            <h2><?php echo __('Notificaciones a la APD') ?></h2><?php
            $c = new Criteria();
            $c->addAscendingOrderByColumn(NotificacionesPeer::FECHA);
            $notificaciones = $formulario->getNotificacioness($c);
            foreach ($notificaciones as $noti) {
                $date = substr($noti->getFecha(), 4, 4).'-'.substr($noti->getFecha(), 2, 2).'-'.substr($noti->getFecha(), 0, 2);
                $time = substr($noti->getHoraProceso(), 0, 2).':'.substr($noti->getHoraProceso(), 2, 2).':'.substr($noti->getHoraProceso(), 4, 2);
                $o = substr(Notificaciones::selfURL(), 0, strpos(Notificaciones::selfURL(), '/formularios'));
                $u = substr($o, 0, strrpos($o, '/')).'/images/icons/'; ?>
                <ul style="margin-left: 7%; clear: both">
                    <li style="list-style-image: url(<?php echo $u.'bullet_green.png'; ?>)">
                        <label style="float: none"><?php echo format_date($date, 'p', 'es').', '.format_date($time, 't').':'; ?></label>
                        <label style="float: left; color: black"><?php
                        echo link_to($noti->getTipo(), 'notificaciones/consultar?id_fichero='.$formulario->getIdFormulario().'&id_notificacion='.$noti->getNotid()).'</label>';
                        if (!$noti->getProcesado()) { ?>
                            <strong style="color: red"><?php echo strtoupper(__('en proceso')); ?></strong><?php
                            echo link_to(__('Enviar'), 'notificaciones/enviar?id_fichero='.$formulario->getIdFormulario().'&id_notificacion='.$noti->getNotid(),
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
                                    border-right: 4px solid #73B65A !important;'));
                        } ?>
                    </li>
                </ul><?php
            } ?>
            <ul class="sf_admin_actions" style="padding-top: 5%"><?php
                if (sizeof($notificaciones) > 0) {
                    $ultima_noti = array_pop($notificaciones);
                    if (!$ultima_noti->getProcesado()) {  //SI SE ESTA PROCESANDO PONEMOS BOTON A PARAR
                        echo "<li>".button_to(__("Parar Notificicación en Proceso"), "notificaciones/parar?id_fichero=".$formulario->getIdFormulario()."&id_notificacion=".$ultima_noti->getNotid(),"class=sf_admin_action_filter")."</li>";
                    } else {  //Si la ultima notificación es supresion, entonces hay que añadir para volver a inscribir, sino modificar y suprimir
                        if ($ultima_noti->getTipo() == "Supresión") {
                            echo "<li>".button_to(__("Inscribir en APD"), "notificaciones/inscribir?id_fichero=".$formulario->getIdFormulario(),"class=sf_admin_action_filter")."</li>";
                        } else {
                            $ruta = UsuarioPeer::getRuta();
                            echo "<li><input class=\"sf_admin_action_reset_filter\" value=\"".__("Modificar en APD")."\" type=\"button\" onclick=\"if (comprobar_cod_agencia()) document.location.href='".$ruta."/notificaciones/modificar/?id_fichero=".$formulario->getIdFormulario()."&id_notificacion=".$ultima_noti->getNotid()."';\" /></li>";
                            echo "<li><input class=\"sf_admin_action_filter\" value=\"".__("Suprimir en APD")."\" type=\"button\" onclick=\"if (comprobar_cod_agencia()) document.location.href='".$ruta."/notificaciones/suprimir/?id_fichero=".$formulario->getIdFormulario()."&id_notificacion=".$ultima_noti->getNotid()."';\" /></li>";
                        }
                    }
                } else  echo "<li>".button_to(__("Inscribir en APD"), "notificaciones/inscribir?id_fichero=".$formulario->getIdFormulario(),"class=sf_admin_action_filter")."</li>"; ?>
            </ul>
        </fieldset></div></div>
    <?php
    }
    ?>
        
    <div id="sf_admin_footer">
        <?php include_partial('formularios/edit_footer', array('formulario' => $formulario)); ?>
    </div>
</div>