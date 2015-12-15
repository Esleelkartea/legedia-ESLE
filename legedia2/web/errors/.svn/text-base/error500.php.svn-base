<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="NeoCRM" />
<meta name="robots" content="index, follow" />
<meta name="description" content="CRM" />
<meta name="keywords" content="symfony, project, CRM" />
<meta name="language" content="es_ES" />

<title>NeoCRM</title>

<link rel="shortcut icon" href="/icons/favicon.ico" />

<link rel="stylesheet" type="text/css" media="screen" href="/neocrm/web/css/principal.css" />

</head>
        
<body>
<div id="wrap">
  <div id="cabezal">
    <?php $usuario = sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios'); ?>
    <div id="organizador">
      <?php 
          if ($usuario) {
            $grupos = $usuario->getGrupos(); 
            foreach ($grupos as $grupo ) $grupoNombre = $grupo->getNombre();
            echo $usuario->getUsuario().' ('.$grupoNombre.') | '; 
       ?>
            <a class="link_especial" onclick="return confirm('¿Está seguro de que desea salir de la aplicación?');" href="/neocrm/web/gestion_dev.php/login/logout">Salir</a>
       <?php }  ?>     

    </div>
    <a href="/neocrm/web/index.php/"><img alt="NeoCRM" title="NeoCRM" border="0" width="350" src="/neocrm/web/images/logos/logo.jpg" /></a>                     
   </div>
   <div id="wrapper">
      <div id="centro">
      <span align="center">
        <img alt="page not found" class="sfTMessageIcon" src="/neocrm/web/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
        <h1>An Error Occurred - Ha ocurrido un error</h1>
        <h2>The server returned a "500 Internal Server Error".</h2>
        <dl class="sfTMessageInfo">
          <dt>Something is broken</dt>
          <dd>Please e-mail us at [email] and let us know what you were doing when this error occurred. We will fix it as soon as possible.
          Sorry for any inconvenience caused.</dd>

          <dt>What's next</dt>
          <dd>
            <ul class="sfTIconList">
              <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Back to previous page</a></li>
              <li class="sfTLinkMessage"><a href="/neocrm/web/index.php/">Go to Homepage</a></li>
              <li class="sfTLinkMessage"><a href="/neocrm/web/gestion_dev.php/content/bugreport">Informe acerca de un error</a></li>
            </ul>
          </dd>
        </dl>
        </span>
      </div>
      <div class="separador"></div>
  </div>
                
  <div id="footer">
    <hr />

    <ul>
      <li class="first"><span class="copyright">Copyright &copy; 2009 Neofis nuevas tecnologías, S.L.  </span></li>
      <li><a href="http://www.neofis.com">Sobre nosotros</a>&nbsp;&&nbsp;<a href="">Contacto</a></li>
      <li><a href="/neocrm/web/gestion_dev.php/content/about">Acerca de NeoCRM</a></li>

    </ul>

  </div>
  <div style="clear:both"><!-- ie bugfix --></div>
        
</div>
</body>
</html>

