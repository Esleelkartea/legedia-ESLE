    <tr>
        <td align="center" class="quitar_borde">
            <select id="pais_10_<?php echo $id; ?>" name="pais_10_<?php echo $id; ?>" class="next"><?php
                include_partial('notificaciones/options_paises'); ?>
            </select>
        </td>
        <td align="center" class="quitar_borde">
            <select id="cat-destina_10_<?php echo $id; ?>" name="cat-destina_10_<?php echo $id; ?>" class="next_detail">
                <option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
                $categorias = Taula7Peer::doSelect(new Criteria);
                foreach ($categorias as $cat) { ?>
                    <option title="<?php echo $cat->getDescripcion(); ?>" value="<?php echo $cat->getT7id(); ?>" ><?php
                        echo $cat->getDescripcion(); ?>
                    </option><?php
                } ?>
            </select>
        </td>
    </tr>