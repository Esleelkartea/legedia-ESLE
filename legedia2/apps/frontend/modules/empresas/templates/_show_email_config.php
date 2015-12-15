<h3 class="email">
  <?php echo __('Configuración de correo electrónico')?>
</h2>


<fieldset id="sf_fieldset_smtp" class="">
<h2><?php echo __('Servidor SMTP')?></h2>

<div class="form-row">
  <?php echo label_for('empresa[smtp_server]', __($labels['empresa{smtp_server}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getSmtpServer() ? $empresa->getSmtpServer() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[smtp_user]', __($labels['empresa{smtp_user}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getSmtpUser() ? $empresa->getSmtpUser() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[smtp_port]', __($labels['empresa{smtp_port}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getSmtpPort() ? $empresa->getSmtpPort() : '-';
  ?>
  </div>
</div>

<?php /*
<div class="form-row">
  <?php echo label_for('empresa[sender_address]', __($labels['empresa{sender_address}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getSenderAddress() ? $empresa->getSenderAddress() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[sender_name]', __($labels['empresa{sender_name}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getSenderName() ? $empresa->getSenderName() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[to_marketing]', __($labels['empresa{to_marketing}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getToMarketing() ? $empresa->getToMarketing() : '-';
  ?>
  </div>
</div>

<div class="form-row">
  <?php echo label_for('empresa[to_telemarketing]', __($labels['empresa{to_telemarketing}']).":", '') ?>
  <div class="content">
  <?php 
    echo $empresa->getToTelemarketing() ? $empresa->getToTelemarketing() : '-';
  ?>
  </div>
</div>
*/
?>

</fieldset>

<ul class="sf_admin_actions">
  <li><?php echo button_to(__('Configurar correo'), 'empresas/edit_email?id_empresa='.$empresa->getPrimaryKey(), array (
  'class' => 'sf_admin_action_edit',
)) ?></li>
</ul>
