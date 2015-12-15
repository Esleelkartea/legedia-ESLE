<?php
if ($_POST['sistema'] == '1' || $_POST['sistema'] == '2') {
    $_POST['presentacion'] = '6';   // FICHERO XML SIN FIRMA
    $_POST['forma'] = 'u';          // ALTA SIN FIRMA
} elseif ($_POST['sistema'] == '3') {
    $_POST['presentacion'] = '5';   // FICHERO XML FIRMADO
    $_POST['forma'] = 'x';          // ALTA FIRMADA
}
$sistema_text = array('1' => __('Formulario en papel'), '2' => __('Internet'), '3' => __('Internet firmado con certificado digital'));
$_POST['soporte'] = $sistema_text[$_POST['sistema']];

include_partial('insert', array('encargado' => $encargado, 'action' => 'view'));
?>