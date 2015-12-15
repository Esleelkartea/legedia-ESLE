
    <td><?php echo get_partial('lang', array('type' => 'list', 'trans_unit' => $trans_unit)) ?></td>
    <td><?php echo link_to($trans_unit->getSource() ? $trans_unit->getSource() : '-', 'sfTransUnit/edit?msg_id='.$trans_unit->getMsgId()) ?></td>
    <td><?php echo $trans_unit->getTarget() ?></td>
   <!-- <?php /*Ana: 16-02-09 No se necesita      <td><?php echo $trans_unit->getComments() ?></td> */ ?> -->
    <td><?php 
			    if ($trans_unit->getTranslated()) echo image_tag('/images/icons/accept.png', array('alt' => __('Si'), 'title' => __('Si')));
				  else echo image_tag('/images/icons/cross.png', array('alt' => __('No'), 'title' => __('No'))); ?></td>
  