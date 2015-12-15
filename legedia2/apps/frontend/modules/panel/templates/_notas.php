<h3 class="evento"><?php echo __('Notas')?></h3>
<?php if (!$pager->getNbResults()): ?>
<blockquote class="notice"><p>
<?php echo __('No hay notas') ?>
</p></blockquote>
<?php else: ?>
<?php include_partial('notas_list', array('pager' => $pager , 'labels' => $labels)) ?>
<?php endif; ?>
<?php //include_partial('notas_actions' ) 
?>
