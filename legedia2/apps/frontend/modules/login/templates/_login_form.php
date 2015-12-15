<?php use_helper('I18N') ?>
<?php use_stylesheet('/css/main') ?>

<div style="padding-top: 55px; width:700px; position: absolute; left: 50%; margin-left: -350px">

    <div style="width: 100%">
        <div><?php echo image_tag('/images/logos/default_logo_max.jpg', array("align"=>"left")); ?></div>
        <div style="padding-top: 2px; clear:both"><h1 style="color: #333333; margin-left: 15px;"><?php echo __('¡ Bienvenido a la aplicación !') ?></h1></div>
    </div>

    <?php echo form_tag('login/login', array(
 	 'id'        => 'sf_login_form',
 	 'name'      => 'sf_login_form',
 	 'method' => 'post',
    )) ?>

    <?php echo input_hidden_tag('modulo',$modulo) ?>
    <?php echo input_hidden_tag('accion',$accion) ?>

    <div style="height: 30px; clear: both;"></div>

    <div style="float: right; width: 270px;">
    <?php if ($sinPermisos): ?>
    <div style="height: 90px; border: 1px solid #FF9899; background-color: #FFCCCB; text-align: center; ">
        <h1 style="padding-top: 10px; color: #CC0100; font-size: 17px; font-weight: bold"><?php echo image_tag("icons/atencion.jpg");?> <?php echo __('ATENCIÓN') ?>!</h1>
        <span style="color: #CC0100; font-size: 11px;"><?php echo __("Usted no tiene permisos para ").$modulo.":".$accion ?></span>
        <span style="font-size: 11px;"><br /><?php echo __('Introduzca su nombre de usuario y su clave.') ?></span>
    </div>
    <?php elseif ($sf_user->hasFlash('logout')): ?>
    <div style="height: 90px; border: 1px solid #267F00; background-color: #73B65A; text-align: center; ">
        <h1 style="padding-top: 10px; color: #267F00; font-size: 17px; font-weight: bold"><?php echo image_tag("icons/ok.png");?> <?php echo __('ATENCIÓN') ?>!</h1>
        <span style="font-size: 11px; color: white;"><?php echo __($sf_user->getFlash('logout')) ?></span>
    </div>
    <?php endif; ?>

        <div style="padding-top: 10px;">
            <div style="float: left; width: 80px;"><?php echo image_tag("dni.jpg",array("valign"=>"middle"));?></div>
            <div style="float: right; width: 190px; padding-top: 20px; font-size: 12px;"><?php echo __('Si lo desea, puede acceder con '); ?><a href="<?php echo str_replace("http://","https://", UsuarioPeer::getRuta())."/login/loginDni"; ?>" style="font-weight: bold; color: #0612F4; font-size: 15px;"><?php echo __('DNI ELECTRÓNICO');?></a></div>
        </div>
    </div>

    <div style="float: left; width: 350px; padding-left: 40px; border: 0px solid red;">

         <div>
            <div>
                <?php echo label_for('login[username]', __('Usuario').":", 'style="color: black; font-size: 13px;"') ?>
            </div>
            <div style="clear: both;">
                <?php echo input_tag('login[username]', '', array('control_name' => 'login[username]', 'style'=>'background-color: black; border: 0px; color: white; height: 25px; width: 100%;')) ?>
            </div>
	</div>

	<div style="padding-top: 10px;">
            <div>
            <?php echo label_for('login[password]', __('Contraseña').":", 'style="color: black; font-size: 13px;"') ?><br />
            </div>
            <div style="clear: both;">
                <?php echo input_password_tag('login[password]','' , array('control_name' => 'login[password]', 'style'=>'background-color: black; color: white; border: 0px; height: 25px; width: 100%;')); ?>
            </div>
	</div>

        <div style="text-align: right; padding-top: 20px;">
            <?php echo submit_tag(__('ENTRAR'), array (
            'name' => 'enter',
            'style' => 'border: 0px; font-weight: bold; font-size: 12px; color: #ffffff; background-color: #393D48; padding-top: 10px; padding-bottom: 10px; width: 100px; -moz-border-radius: 4px; -webkit-border-radius: 4px;',
             )); ?>
        </div>

    </div>

    <div style="height: 50px; clear: both;"></div>

    <div style="width: 100%; padding-left: 20px; color:#393D48; font-size: 11px; ">
        <?php echo __("Aplicación para la normativa gestión de la Normativa de Protección de Datos");?>
    </div>
    
    </form>

    <div style="height: 50px; clear: both;"></div>
</div>
