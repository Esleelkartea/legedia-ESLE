    
    <td><input type="checkbox" class="checkbox_seleccionable" name="<?php echo $formulario->__toString(); ?>" value="<?php echo $formulario->getIdFormulario(); ?>" <?php if ($valor_sel == $formulario->getIdFormulario()) echo "CHECKED"; ?> onclick="desquitar(this);"></td>
    <!--<td><?php echo link_to($formulario->getIdFormulario() ? $formulario->getIdFormulario() : '-', 'formularios/show?id_formulario='.$formulario->getIdFormulario()) ?></td>-->
    <?php         
        foreach ($lista_campos_extra as $campo) {
          if (!$campo->getBorrado()){
            if ($campo->esTipoNumero()) $alineacion="right";
            elseif ($campo->esTipoFecha()) $alineacion="center";
            else $alineacion="left";
        
            $value = "<td style=\"padding-".$alineacion.": 5px;\" align=\"".$alineacion."\">";
  
            if (!$campo->esTipoLista()){
              $item_base = $campo->getElementoUnico();
              $item = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
            }else {
              $item = null;
              $lista = $campo->getItemBases();
              foreach ($lista as $ib){
                if (isset($items_formulario[$ib->getIdItemBase()])){
                 $item = $items_formulario[$ib->getIdItemBase()];
                  break;
                }
              }
            }

            if ($item)
            {
               if ($campo->esTipoBooleano())
                 $value .= image_ok($item->__toString());
               else 
                 $value .= $item->__toString();
            }

            $value.= "</td>";
            echo $value;
          }
        }
    ?>
    <!--<td align="center"><?php echo ($formulario->getFecha() !== null && $formulario->getFecha() !== '') ? format_date($formulario->getFecha(), "d")." ".format_date($formulario->getFecha(), "t") : '' ?></td>-->
