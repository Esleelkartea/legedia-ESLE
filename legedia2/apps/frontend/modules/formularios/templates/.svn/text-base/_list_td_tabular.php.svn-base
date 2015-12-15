    <!--<td><?php echo link_to($formulario->getIdFormulario() ? $formulario->getIdFormulario() : '-', 'formularios/show?id_formulario='.$formulario->getIdFormulario()) ?></td>-->
    <?php         
        foreach ($lista_campos_extra as $campo) {
          $myestilo = "";

          if (!$campo->getBorrado()){
            if ($campo->esTipoNumero()) $alineacion="right";
            elseif ($campo->esTipoFecha()) $alineacion="center";
            else $alineacion="left";
          
            if (!$campo->esTipoLista()){
              $item_base = $campo->getElementoUnico();
              $item = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
            }else {
              $item = null;
              $lista = $campo->getItemBases();
              foreach ($lista as $ib){
                if (isset($items_formulario[$ib->getIdItemBase()])){
                  $myestilo = $ib->getSoloEstilo();
                  $item = $items_formulario[$ib->getIdItemBase()];
                  break;
                }
              }
            }

            $value = "<td style=\"padding-".$alineacion.": 5px;".$myestilo."\" align=\"".$alineacion."\">";
            
            if ($item)
            {
               if ($campo->esTipoBooleano())
                 $value .= image_ok($item->__toString());
               else {
                 $value .= $item->__toString();
               }
            }
            
            $value.= "</td>";
            echo $value;
          }
        }
    ?>
    <td align="center"><?php echo ($formulario->getFecha() !== null && $formulario->getFecha() !== '') ? format_date($formulario->getFecha(), "d")." ".format_date($formulario->getFecha(), "t") : '' ?></td>
