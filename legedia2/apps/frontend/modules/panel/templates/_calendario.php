<?php use_helper('Javascript') ?>
<div align="center" id="div_calendario" style="padding-top: 10px;">
    
    <?php
        $mesAnterior = $mes-1;
        $mesPosterior = $mes+1;
        $yearAnterior = $year;
        $yearPosterior = $year;
			
        if ($mes == 1) {
            $mesAnterior = 12;
            $yearAnterior = $year - 1;
        }
        else if ($mes == 12) {
            $mesPosterior = 1;
            $yearPosterior = $year + 1;
        }
      ?>

    <table style="border:0px solid !important">
        <tr >
          <td style="border:0px solid !important; background-color: #ffffff">
                <?php /*echo link_to_remote(image_tag('icons/calendar_view_day.png', array('alt'=>'hoy', 'title'=>'hoy')),
                        array('update' => 'div_calendario',
                              'url'    => 'panel/cambiarcalendario?mes='.date('m').'&year='.date('Y'),)
                );*/?>

		<?php  							
			
		 echo link_to_remote(image_tag('icons/previous_day.jpg', array('alt'=>'anterior', 'title'=>'anterior')),
                        array('update' => 'div_calendario',
                              'url'    => 'panel/cambiarcalendario?mes='.$mesAnterior.'&year='.$yearAnterior,)
                );?>
           </td>
           <td style="border:0px solid !important;background-color: #ffffff"><?php echo $calendarMes; ?></td>
           <td style="border:0px solid !important;background-color: #ffffff; text-align: left;"><?php
		echo link_to_remote(image_tag('icons/next_day.jpg',array('alt'=>'posterior', 'title'=>'posterior')),
                        array('update' => 'div_calendario',
                              'url'    => 'panel/cambiarcalendario?mes='.$mesPosterior.'&year='.$yearPosterior,)
		);?>
           </td>
	</tr>
    </table>
    
    <?php if ($sumario != "") : ?>
    <div style="padding-top: 5px; width: 100%;">
        <?php echo $sumario; ?>
    </div>
    <?php endif; ?>
    
    <div style="width: 95%; text-align: right;">
    <ul style="list-style-type: none;">
      <li>
        <?php echo link_to(__('Añadir evento/tarea') , 'tareas/create', array('style' => 'font-weight: bold; font-size: 13px;'))?>
      </li>
    </ul>
    </div>
</div>