<?php 
    $usuario_actual = Usuario::getUsuarioActual();
    if ($usuario_actual->getEsDelegado()) {
?>
<div class="sf_admin_filters">

</div>
<?php } ?>
