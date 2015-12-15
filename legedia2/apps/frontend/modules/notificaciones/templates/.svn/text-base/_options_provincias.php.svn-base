<option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
$provincias = ProvinciaPeer::getProvinciasOrdenadas();
foreach ($provincias as $provincia => $pro) {
    if (isset($id_provincia) && $id_provincia == $pro->getIdProvincia()) { ?>
        <option title="<?php echo $pro->getNombre(); ?>" value="<?php echo $pro->getIdProvincia(); ?>" selected="selected"><?php
            echo $pro->getNombre(); ?>
        </option><?php
    } else { ?>
        <option title="<?php echo $pro->getNombre(); ?>" value="<?php echo $pro->getIdProvincia(); ?>"><?php
            echo $pro->getNombre(); ?>
        </option><?php
    }
} ?>