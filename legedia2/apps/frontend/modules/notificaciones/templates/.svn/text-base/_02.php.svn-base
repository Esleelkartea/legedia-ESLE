<br /><fieldset id="derechos">
    <legend class="form1">
        <span class="number">2</span> <?php echo __('Derechos de oposición, acceso, rectificación y cancelación'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__2', '0');
        if ($action == 'modify') { ?>
            <label style="margin-top:-5px;margin-bottom:10px">
                [<?php echo __('Obligatorio sólo si el responsable está ubicado fuera de la Unión Europea'); ?>]<br />
                [<?php echo __('Si el domicilio es el mismo que el del responsable, estos elementos tendrán que estar vacíos'); ?>]
            </label><?php
        } ?><br />
        <div class="flerro">
            <div id="txt2_div" class="fcell"><?php echo __('Nombre de la oficina o dependencia'); ?><br />
                <input id="txt2" type="text" name="oficina_2" size="105" class="text required mayus" maxlength="140" value="<?php echo $notificacion->dr_nombreof; ?>" />
            </div>
        </div>
        <div class="flerro">
            <div id="cif_pais2_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
                <input id="cif_pais2" type="text" name="cif_2" size="20" class="cif required" maxlength="9" value="<?php echo $notificacion->dr_cif; ?>" />
            </div>
            <div id="domicilio2_div" class="fcell"><?php echo __('Dirección postal/Apdo. de Correos'); ?><br />
                <input id="domicilio2" type="text" name="direccion_2" size="79" class="text required mayus" maxlength="100" value="<?php echo $notificacion->dr_dirpostal; ?>" />
            </div>
        </div>
        <div class="flerro">
            <div id="localidad2_div" class="fcell"><?php echo __('Localidad'); ?><br />
                <input id="localidad2" type="text" name="localidad_2" size="30" class="text required mayus" maxlength="50" value="<?php echo $notificacion->dr_localidad; ?>" />
            </div>
            <div id="cp_pais2_div" class="fcell"><?php echo __('Código Postal'); ?><br />
                <input id="cp_pais2" type="text" name="cp_2" size="5" class="cp text required" maxlength="5" value="<?php echo $notificacion->dr_cp; ?>" />
            </div>
            <div id="provincia_pais2_div" class="fcell"><?php echo __('Provincia'); ?><br />
                <select id="provincia_pais2" name="provincia_2" class="prov list required"><?php
                    include_partial('options_provincias', array('id_provincia' => $notificacion->dr_provincia)); ?>
                </select>
            </div>
            <div id="pais2_div" class="fcell"><?php echo __('País'); ?><br />
                <select id="pais2" name="pais_2" class="pais list required"><?php
                    include_partial('options_paises', array('id_pais' => $notificacion->dr_pais)); ?>
                </select>
            </div>
        </div>
        <div class="flerro">
            <div id="tel2_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel2" type="text" name="tel_2" size="18" class="tel text not_required" maxlength="10" value="<?php echo $notificacion->dr_tel; ?>" /></div>
            <div id="fax2_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax2" type="text" name="fax_2" size="18" class="fax text not_required" maxlength="10" value="<?php echo $notificacion->dr_fax; ?>" /></div>
            <div id="mail2_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail2" type="text" name="mail_2" size="30" class="mail text not_required" maxlength="70" value="<?php echo $notificacion->dr_mail; ?>" /></div>
        </div><?php
    } ?>
</fieldset>