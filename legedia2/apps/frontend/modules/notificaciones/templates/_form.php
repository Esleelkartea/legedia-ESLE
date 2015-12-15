<?php
if ($modelo == 'Tipo') {
    include_partial('notificaciones/form_detail', array('hook' => $hook, 'modelo' => $modelo, 'tipo' => $tipo, 'sistema' => $sistema, 'id_fichero' => $id_fichero, 'empresa_actual' => $empresa_actual, 'encargado' => $encargado, 'user_id' => $user_id, 'user' => $user));
} else  include_partial('notificaciones/form_detail', array('hook' => $hook, 'modelo' => $modelo, 'sistema' => $sistema, 'id_fichero' => $id_fichero, 'empresa_actual' => $empresa_actual, 'encargado' => $encargado, 'user_id' => $user_id, 'user' => $user)); ?>
<br />
<fieldset id="boton" class="boton">
    <table class="quitar_borde" width="100%">
        <tr>
            <td class="quitar_borde" width="50%" align="center">
                <input type="submit" name="bidali" value="<?php echo __('Cumplimetar Hoja de Solicitud'); ?>" class="submit cump"/>
            </td>
            <td class="quitar_borde" width="50%" align="center">
                <input type="reset" name="limpiar" value="<?php echo __('Limpiar'); ?>" class="reset cump"/>
            </td>
        </tr>
    </table>
</fieldset>