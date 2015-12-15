<br /><fieldset id="chk_5">
    <legend class="form1"><span class="number">8</span> <?php echo __('Medidas de seguridad'); ?></legend><?php
    if ($notificacion->tipo == 'Supresion') echo __('En solicitudes de supresión este nodo va vacío.');
    else {
        echo input_hidden_tag('__8', '0'); ?>
        <table id="nivel_seg_div" width="100%" class="quitar_borde">
            <tr>
                <td width="33%" class="quitar_borde">
                    <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="22"<?php
                        if ($notificacion->seguridad == '1')    echo ' checked="checked"'; ?>/> <?php echo __('Nivel básico'); ?>
                </td><td width="33%" class="quitar_borde">
                    <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="23"<?php
                        if ($notificacion->seguridad == '2')    echo ' checked="checked"'; ?>/> <?php echo __('Nivel medio'); ?>
                </td><td width="33%" class="quitar_borde">
                    <input type="radio" name="seguridad_8" class="med_seg required nivel_seg" value="24"<?php
                        if ($notificacion->seguridad == '3')    echo ' checked="checked"'; ?>/> <?php echo __('Nivel alto'); ?>
                </td>
            </tr>
        </table><?php
    } ?>
</fieldset>