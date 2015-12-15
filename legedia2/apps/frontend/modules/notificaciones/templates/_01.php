<br /><fieldset>
    <legend class="form1">
        <span class="number">1</span> <?php echo __('Responsable del fichero'); ?>
    </legend><?php
        echo input_hidden_tag('__1', '0'); ?>
    <div class="flerro">
        <div id="txt1_div" class="fcell"><?php
            echo __('Denominación social del responsable del fichero'); ?><br />
            <input id="txt1" type="text" name="denomsocial_1" size="60" class="text required mayus" maxlength="140" value="<?php echo $notificacion->rf_nombre; ?>" />
        </div>
        <div id="list1_div" class="fcell"><?php echo __('Actividad'); ?><br />
            <select id="list1" name="actividad_1" class="list required">
            <option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
                $actividades = Taula1Peer::doSelect(new Criteria);
                foreach ($actividades as $taula1 => $act) {
                    if ($act->getT1id() == $notificacion->rf_actividad) { ?>
                        <option title="<?php echo $act->getActividad(); ?>" value="<?php echo $act->getT1id(); ?>" selected="selected"><?php echo $act->getActividad(); ?></option><?php
                    } else { ?>
                        <option title="<?php echo $act->getActividad(); ?>" value="<?php echo $act->getT1id(); ?>"><?php echo $act->getActividad(); ?></option><?php
                    }
                } ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="cif_pais1_div" class="fcell"><?php echo __('CIF/NIF/NIE'); ?><br />
            <input id="cif_pais1" type="text" name="cif_1" size="30" class="cif required" maxlength="9" value="<?php echo $notificacion->rf_cif; ?>" />
        </div>
        <div id="domicilio1_div" class="fcell"><?php echo __('Domicilio social'); ?><br />
            <input id="domicilio1" type="text" name="domiciliosocial_1" size="70" class="text required mayus" maxlength="100" value="<?php echo $notificacion->rf_domicilio; ?>" />
        </div>
    </div>
    <div class="flerro">
        <div id="localidad1_div" class="fcell"><?php echo __('Localidad'); ?><br />
            <input id="localidad1" type="text" name="localidad_1" size="30" class="text required mayus" maxlength="50" value="<?php echo $notificacion->rf_localidad; ?>" />
        </div>
        <div id="cp_pais1_div" class="fcell"><?php echo __('Código Postal'); ?><br />
            <input id="cp_pais1" type="text" name="cp_1" size="5" class="cp text required" maxlength="5" value="<?php echo $notificacion->rf_cp; ?>" />
        </div>
        <div id="provincia_pais1_div" class="fcell"><?php echo __('Provincia'); ?><br />
            <select id="provincia_pais1" name="provincia_1" class="prov list required"><?php
                include_partial('options_provincias', array('id_provincia' => $notificacion->rf_provincia)); ?>
            </select>
        </div>
        <div id="pais1_div" class="fcell"><?php echo __('País'); ?><br />
            <select id="pais1" name="pais_1" class="pais list required"><?php
                include_partial('options_paises', array('id_pais' => $notificacion->rf_pais)); ?>
            </select>
        </div>
    </div>
    <div class="flerro">
        <div id="tel1_div" class="fcell"><?php echo __('Teléfono'); ?> <input id="tel1" type="text" name="tel_1" size="18" class="tel text not_required" maxlength="10" value="<?php echo $notificacion->rf_tel; ?>" /></div>
        <div id="fax1_div" class="fcell"><?php echo __('Fax'); ?> <input id="fax1" type="text" name="fax_1" size="18" class="fax text not_required" maxlength="10" value="<?php echo $notificacion->rf_fax; ?>" /></div>
        <div id="mail1_div" class="fcell"><?php echo __('Correo electrónico'); ?> <input id="mail1" type="text" name="mail_1" size="30" class="mail text not_required" maxlength="70" value="<?php echo $notificacion->rf_mail; ?>" /></div>
    </div>
</fieldset>