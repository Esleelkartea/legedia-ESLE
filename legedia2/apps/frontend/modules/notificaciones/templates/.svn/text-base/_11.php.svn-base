<br /><fieldset>
    <legend class="form1"><span class="number">11</span> <?php echo __('Supresión de la inscripción del fichero'); ?></legend>
    <fieldset id="denom_fichero_">
        <legend><?php echo __('Denominación'); ?></legend>
        <div class="flerro">
            <div id="codinsmod_div_" class="fcell" style="margin-top:7px"><?php echo __('Código de Inscripción').': '; ?>
                <input id="codinsmod_" type="text" name="codinsmod_" size="10" class="text required mayus" maxlength="10" value="<?php echo $codigo_agencia; ?>" />
            </div>
            <div id="txtmod1_div_" class="fcell" style="clear:both;margin-top:7px"><?php
                echo __('Motivos de la supresión').': '; ?>
                <input id="txtmod1_" type="text" name="txtmod1_" size="60" class="text required mayus" maxlength="140"<?php
                if ($notificacion->tipo == 'Supresion') { echo ' value="'.$notificacion->ac_supr_motivos.'" ' ; } ?>/>
            </div>
            <div id="txtmod2_div_" class="fcell" style="clear:both;margin-top:7px"><?php
                echo __('Destino de la información y previsiones adoptadas para su destrucción').': '; ?>
                <input id="txtmod2_" type="text" name="txtmod2_" size="70" class="text required mayus" maxlength="210"<?php
                if ($notificacion->tipo == 'Supresion') { echo ' value="'.$notificacion->ac_supr_destino_previsiones.'" ' ; } ?>/>
            </div>
        </div>
    </fieldset>
</fieldset>