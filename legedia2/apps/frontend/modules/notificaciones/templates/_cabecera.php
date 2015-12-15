<br />
<div style="width:50%; padding-left:25%;">
    <table class="quitar_borde"><tr>
        <td class="quitar_borde"><?php echo image_tag('nota.png'); ?></td>
        <td width="434" height="75" class="buru quitar_borde"><?php
            echo __('Fichero de tituralidad privada'); ?><br /><?php
            echo __('CONTENIDO DE LA NOTIFICACIÓN'); ?>
        </td>
    </tr></table>
</div>
<div style="text-align:right; font-weight: bold; color: red; font-size: 12px;"><?php
    if (is_file($file = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$id_fichero.'-'.$notid.'.xml')) {
        $doc = new DOMDocument();
        $doc->load($file);
        $xsd = @$doc->schemaValidate(sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'pattern.xsd');
        if ($xsd == 1)  echo __('Validación esquemática XSD correcta');
        else    echo __('Validación esquemática XSD incorrecta');
    } else  echo '<strong>'.__('Fichero XML no encontrado').'</strong>'; ?>
</div>