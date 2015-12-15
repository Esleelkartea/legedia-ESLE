<option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
$paises = PaisesPeer::doSelect(new Criteria);
foreach ($paises as $pais => $pa) {
    if (isset($id_pais) && $id_pais == $pa->getPid()) { ?>
        <option title="<?php echo $pa->getPais(); ?>" value="<?php echo $pa->getPid(); ?>" selected="selected"><?php
            echo $pa->getPais(); ?>
        </option><?php
    } else { ?>
        <option title="<?php echo $pa->getPais(); ?>" value="<?php echo $pa->getPid(); ?>"><?php
            echo $pa->getPais(); ?>
        </option><?php
    }
} ?>