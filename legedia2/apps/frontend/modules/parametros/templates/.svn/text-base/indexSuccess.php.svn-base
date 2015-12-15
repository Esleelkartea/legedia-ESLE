<?php use_helper('I18N','Javascript') ?>

<div id="sf_admin_container">
<h1><?php echo __('Parámetros Generales') ?></h1>

<div id="sf_admin_header">
</div>

<div id="sf_admin_content">
<div id="datosTipoParametro">
&nbsp;
</div>

</div><!-- /content -->

<div id="sf_admin_bar">
<?php include_partial('tipos_parametros', array('DefParametros' => $DefParametros)) ?>
</div>

<div style="display:none;">
<?php $ruta=sfContext::getInstance()->getUser()->getAttribute('ruta',null); ?>
<script type="text/javascript" src="<?php echo $ruta; ?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
//<![CDATA[

tinyMCE.init({
  theme : "advanced",
  mode : "none",
  language: "es",
  plugins: "table,advimage,advlink,flash",
  theme: "advanced",
  theme_advanced_toolbar_location: "top",
  theme_advanced_toolbar_align: "left",
  theme_advanced_path_location: "bottom",
  theme_advanced_buttons1: "justifyleft,justifycenter,justifyright,justifyfull,separator,bold,italic,strikethrough,separator,sub,sup,separator,charmap",
  theme_advanced_buttons2: "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,image,flash,separator,cleanup,removeformat,separator,code",
  theme_advanced_buttons3: "tablecontrols",
  extended_valid_elements: "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]",
  relative_urls: false,
  debug: false  
});
//]]>
</script>
</div>

</div><!-- /container -->

