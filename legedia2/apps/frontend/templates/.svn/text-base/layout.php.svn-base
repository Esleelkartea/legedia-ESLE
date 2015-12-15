
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/icons/favicon.ico" />

</head>
	
<?php 
    $usuario = sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');

    $lista_empresas = sfContext::getInstance()->getUser()->getAttribute('lista_empresas',array());
    $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',0);
?>
	
<body>

<div id="wrap">
    <div id="cabezal">

        <!--
        <div style="float: left; padding-left: 50px; margin-top: 20px;">
        <span style="color: #bececf;font-size: 35px; font-weight: bold;font-family: Arial">LEGEDIA</span> <span style="font-size: 16px;">Gestión de la normativa de <span style="color: #008B18;font-weight:bold;">protección de datos</span></span>
        </div>
        -->

        <div id="logo">
            <?php
                echo link_to(image_tag('/images/logos/legedia.jpg', array("alt"=>"Legedia", 'title' => "Legedia","border"=>0,  )), 'panel/index');
             ?>
        </div>

        <div id="organizador">
        <?php        
         if (sizeof($lista_empresas) > 0) {
            echo form_tag('empresas/cambiar');
        ?>
            <input type="hidden" name="mmodule" value="<?php echo sfContext::getInstance()->getModuleName(); ?>"/>

            <table border="1" cellpadding="0" cellspacing="0" style="border: 1px;">
            <tr>
                <td align="right" style="border: 0px;">
                    <?php echo select_tag('id_empresa', options_for_select($lista_empresas,$id_empresa)); ?>

                </td>
            </tr>
            <?php } ?>
            <tr>
                <td style="padding-top: 10px;  border: 0px;">
                    <?php
                    if ($usuario) {
                         $grupos = $usuario->getGrupos();
                         $grupoNombre = "";
                         foreach ($grupos as $grupo ) $grupoNombre = $grupo->getNombre();
                         echo "¡ ".__("Bienvenido")." ".link_to($usuario->getUsuario(),'preferencias/index').' ('.$grupoNombre.') ! | ';
                         echo link_to(__("Salir")/*image_tag('/images/icons/exit.gif', array('title' => 'Salir', 'alt' => 'Salir', "width"=>"15"))*/, 'login/logout',
                                 array('confirm' => __('Esta seguro de que desea salir de la aplicación'), "style"=>"text-decoration: none;"));
                    }
                    ?>
                </td>
            </tr>
            </table>
        </form>
        </div>

    </div>

    <br />

    <div id="menu">
    <?php  /*if ($usuario) sfCssTabs::singleton()->render();*/ ?>
    <?php use_helper("JSCookMenu") ?>
    <?php if ($usuario) echo jscookmenu_from_yml(dirname(__FILE__)."/../config/menu.yml", "menu_name", "hbr", "cmThemeGray") ?>
    </div>

    <div id="wrapper">
        <div id="centro">
            <div id="logo_empresa">
                <?php
                $empresa = EmpresaPeer::retrieveByPk($id_empresa);
                if ($empresa != null && sfContext::getInstance()->getModuleName() != "login") $url_image=$empresa->getUrlLogoMax();
                /*else $url_image='/images/logos/default_logo_max.jpg';*/

                if ($empresa instanceof Empresa && sfContext::getInstance()->getModuleName() != "login"){
                    echo link_to(image_tag($url_image, array("alt" => $empresa->getNombre(), 'title' => $empresa->getNombre(),"border"=>0)), 'empresas/show?id_empresa='.$empresa->getIdEmpresa());
                }/*else {
                    echo image_tag($url_image, array());
                }*/
                ?>
            </div>
            
            <?php echo $sf_content ?>
        </div>
        
        <div class="separador"></div>
    </div>
	
    <div id="footer">
        <hr />

        <ul>
            <li class="first">
                <span class="copyright"><?php echo __('&copy; 2010 ESLE Elkartea')?></span>
            </li>
            <li><?php echo link_to(__('Acerca de Legedia') , 'content/about') ?></li>
            <li><?php echo link_to(__('Informe acerca de un error') , 'content/bugreport') ?></li>
        </ul>
    </div>

    <div style="clear:both"><!-- ie bugfix --></div>
    
</div>

    <?php
      $base = 85;
      $categorias = ParametroPeer::getCategorias();
      $base = $base + (sizeof($categorias) * 90 );
    ?>
    <script language="Javascript">
        elements = getElementsByClassName(document, "*", "ThemeGrayMenu");
        for (i = 0; i < elements.length; i++){
            elements[i].style.marginLeft = "-<?php echo $base;?>px";
        }
    </script>
<?php /*
<?php
  $empresa = EmpresaPeer::retrieveByPk($id_empresa);
  if ($empresa instanceof Empresa) :
?>
<script language="Javascript">
//COLORES LETRAS

  var colorFondoActual = "FFFFFF";
  var colorPrimarioActual = "EAEAF4";
  var colorSecundarioActual = "3D4584";
  var colorFondoTablasActual = "FFFEF2";

  var colorletra1Actual = "000000";
  var colorletra2Actual = "FFFFFF";
  var colorletra3Actual = "333333";
  var colorletra4Actual = "666666";

  var colorFondo = "<?php echo $empresa->getColor1(); ?>";
  var colorPrimario = "<?php echo $empresa->getColor2(); ?>";
  var colorSecundario = "<?php echo $empresa->getColor3(); ?>";
  var colorFondoTablas = "<?php echo $empresa->getColor4(); ?>";

  var colorletra1 = "<?php echo $empresa->getColorLetra1(); ?>";
  var colorletra2 = "<?php echo $empresa->getColorLetra2(); ?>";
  var colorletra3 = "<?php echo $empresa->getColorLetra3(); ?>";
  var colorletra4 = "<?php echo $empresa->getColorLetra4(); ?>";

  if (
    colorFondoActual != colorFondo.substring(1) || colorPrimarioActual != colorPrimario.substring(1) || colorSecundarioActual != colorSecundario.substring(1) || colorFondoTablasActual != colorFondoTablas.substring(1) ||
    colorletra1Actual != colorletra1.substring(1) || colorletra2Actual != colorletra2.substring(1) || colorletra3Actual != colorletra3.substring(1) || colorletra4Actual != colorletra4.substring(1)
    ){
    cambiar_colores(
      colorFondo, colorFondoActual, colorPrimario, colorPrimarioActual, colorSecundario, colorSecundarioActual, colorFondoTablas, colorFondoTablasActual,
      colorletra1Actual, colorletra1, colorletra2Actual, colorletra2, colorletra3Actual, colorletra3, colorletra4Actual, colorletra4
      )
  }
</script>
<?php endif; ?>

 
 */ ?>

</body>

</html>