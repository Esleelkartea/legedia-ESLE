<br /><fieldset id="encargado">
    <legend class="form1">
        <span class="number">4</span><?php echo __('Encargado del tratamiento'); ?>
    </legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__4', '0');
        if ($action == 'modify') { ?>
            <label style="margin-top:-5px;margin-bottom:10px">
                [<?php echo __('Obligatorio sólo en el caso de que el tratamiento de los datos se realice por persona, física o jurídica, distinta al responsable del fichero.'); ?>]<br />
                [<?php echo __('Si el tratamiento lo realiza el propio responsable, estos elementos tendrán que estar vacíos'); ?>]
            </label><?php
        } ?><br />
        <div class="flerro">
            <div id="txt4_div" class="fcell"><?php echo __('Denominación social del encargado del tratamiento'); ?><br />
                <input id="txt4" type="text" name="denomsocial_4" size="105" class="text not_required mayus" maxlength="140" value="<?php echo $notificacion->et_nombre; ?>" />
            </div>
        </div>
        <div class="flerro">
            <div id="cif_pais4_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
                <input id="cif_pais4" type="text" name="cif_4" size="20" class="cif not_required" maxlength="9" value="<?php echo $notificacion->et_cif; ?>" />
            </div>
            <div id="domicilio4_div" class="fcell"><?php echo __('Dirección postal'); ?><br />
                <input id="domicilio4" type="text" name="direccion_4" size="79" class="text not_required mayus" maxlength="100" value="<?php echo $notificacion->et_dirpostal; ?>" />
            </div>
        </div>
        <div class="flerro">
            <div id="localidad4_div" class="fcell"><?php echo __('Localidad'); ?><br />
                <input id="localidad4" type="text" name="localidad_4" size="30" class="text not_required mayus" maxlength="50" value="<?php echo $notificacion->et_localidad; ?>" />
            </div>
            <div id="cp_pais4_div" class="fcell"><?php echo __('Código Postal'); ?><br />
                <input id="cp_pais4" type="text" name="cp_4" size="5" class="cp text not_required" maxlength="5" value="<?php echo $notificacion->et_cp; ?>" />
            </div>
            <div id="provincia_pais4_div" class="fcell"><?php echo __('Provincia'); ?><br />
                <select id="provincia_pais4" name="provincia_4" class="prov list not_required"><?php
                    include_partial('options_provincias', array('id_provincia' => $notificacion->et_provincia)); ?>
                </select>
            </div>
            <div id="pais4_div" class="fcell"><?php echo __('País'); ?><br />
                <select id="pais4" name="pais_4" class="pais list not_required"><?php
                    include_partial('options_paises', array('id_pais' => $notificacion->et_pais)); ?>
                </select>
            </div>
        </div>
        <div class="flerro">
            <div id="tel4_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel4" type="text" name="tel_4" size="18" class="tel text not_required" maxlength="10" value="<?php echo $notificacion->et_tel; ?>" /></div>
            <div id="fax4_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax4" type="text" name="fax_4" size="18" class="fax text not_required" maxlength="10" value="<?php echo $notificacion->et_fax; ?>" /></div>
            <div id="mail4_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail4" type="text" name="mail_4" size="30" class="mail text not_required" maxlength="70" value="<?php echo $notificacion->et_mail; ?>" /></div>
        </div><?php
    } ?>
</fieldset>