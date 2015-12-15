<option value="0">... <?php echo __('Seleccione uno'); ?> ...</option><?php
$a = new Criteria();
$europeans_pids = array('3', '12', '19', '28', '38', '46', '157', '54', '55', '57', '62', '63', '69', '80', '85', '92', '102', '107', '108', '115', '136', '143', '144', '147', '149', '158', '176');
foreach($europeans_pids as $pid) {
    $b = new Criteria();
    $b = $a->getNewCriterion(PaisesPeer::PID, $pid);
    $a->addOr($b);
}
$paises = PaisesPeer::doSelect($a);
foreach ($paises as $pais => $pa) { ?>
    <option title="<?php echo $pa->getPais(); ?>" value="<?php echo $pa->getPid(); ?>">
        <?php echo $pa->getPais(); ?>
    </option><?php
} ?>