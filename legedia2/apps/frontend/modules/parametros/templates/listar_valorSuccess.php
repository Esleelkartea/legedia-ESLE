<?php if (sizeof($valorParametros)>=0) : ?>
obj=document.getElementById("parametrover");
for (var q=obj.options.length;q>=0;q--) obj.options[q]=null;
<?php foreach ($valorParametros as $param) :?>
	obj.options[obj.options.length]=new Option(
	  '<?php echo str_replace("'","\\'",$param->getNombreLista()) ?>',
	  '<?php echo $param->getIdparametro() ?>'
	); 
<?php endforeach; ?>

<?php endif; ?>
