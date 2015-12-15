<?php 
  use_helper('Text');
  use_helper('Date');
  use_helper('I18N');
?>

<?php $usuario = Usuario::getUsuarioActual(); ?>

<?php
  $id_empresa_sel = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
  $c= TablaPeer::getCriterioAlcance(true);
  $c->add(TablaPeer::ID_EMPRESA, $id_empresa_sel);
  $tablas = TablaPeer::doSelect($c);       
?>

<div id="sf_admin_content" style="width:100%;">
<div class="grid2col" style="width: 100%; position: relative; top: -90px">
  <div class="column first" style="width: 35%; padding-top: 120px; border-right: 1px solid grey;">
    <div>

        <?php include_partial('mensajes', array('pager' => $mensajes , 'labels' => $labels)) ?>
      
        <div style="clear:both"><!-- ie bugfix --></div>

        <div style="width: 95%; border-bottom: 1px dotted black; font-weight: bold; font-size: 15px;">
        <?echo __('Calendario de Eventos y Tareas')?>
        </div>

        <div style="clear: both; height: 6px;"></div>

        <div style="width: 95%; background-color: black; color: white; height: 25px; font-weight: bold; font-size: 12px; text-align: right; padding-top: 10px;">
        <?echo __('Próximos eventos')?>&nbsp;&nbsp;
        </div>

        <?php include_partial('calendario', array('calendarMes' => $calendarMes, 'sumario'=> $sumario, 'mes'=>date('m'), 'year'=>date('Y'))) ?>
    </div>
  </div>

  <div class="column last" style="width: 63%;">
    <div style="padding-top: 30px; padding-left: 44px; padding-right: 65px">
        <div style="width: 100%; border-bottom: 1px dotted black; font-weight: bold; font-size: 15px;">
        <?echo __('Acceso a datos')?>
        </div>

        <div style="clear: both; height: 6px;"></div>

        <div style="width: 100%; background-color: black; color: white; height: 20px; font-weight: bold; font-size: 12px; text-align: right; padding-top: 10px;">
        &nbsp;&nbsp;
        </div>
        
        <ul style="PADDING-RIGHT: 0px; PADDING-LEFT: 4px; FLOAT: left; PADDING-BOTTOM: 0px; MARGIN: 15px 0px; WIDTH: 100%; PADDING-TOP: 0px; LIST-STYLE-TYPE: none;">
          <?php
            /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
            $ruta = UsuarioPeer::getRuta();
            $i = 1;
            foreach ($tablas as $tabla){

                  $c = new Criteria();
                  $c->addAnd(FormularioPeer::ID_TABLA, $tabla->getIdTabla(), Criteria::EQUAL);
                  $c->addDescendingOrderByColumn(FormularioPeer::FECHA);
                  $formularios = FormularioPeer::doSelect($c);
                  if (sizeof($formularios) > 0) $ult_mod = format_date($formularios[0]->getFecha(), "d");
                  else $ult_mod = "-";
                  if ($i % 2 == 0) $textalign = "right";
                  else $textalign = "left";

                  echo '<li style=\'PADDING-RIGHT: 4px; DISPLAY: inline; PADDING-LEFT: 4px; FLOAT: left; PADDING-BOTTOM: 4px; WIDTH: 48%; PADDING-TOP: 4px; text-align:'.$textalign.'\'>';
                  echo '<a href="'.$ruta.'/formularios/create/?id_tabla='.$tabla->getIdTabla().'" style=\'text-decoration: none; font-weight: bold; font-size: 12px\'><!--class="clientes" '.__('Añadir registro a ').'-->'.strtoupper($tabla->getNombre()).'</a>';
                  echo '<br /><a href="'.$ruta.'/formularios/list/?filters[id_empresa]='.$id_empresa_sel.'&filters[id_tabla]='.$tabla->getIdTabla().'&filter=filter" style=\'text-decoration: none; \' >'.(sizeof($formularios).__(' registros')).'</a> <br /> Ult. Mod: '.$ult_mod;
                  echo '</li>';

                  $i++;
            }
          ?>
        </ul>
    </div>
  </div>
</div>

</div>


</div>
