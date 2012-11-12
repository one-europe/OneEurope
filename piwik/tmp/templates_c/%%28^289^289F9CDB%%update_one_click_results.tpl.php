<?php /* Smarty version 2.6.26, created on 2012-11-09 15:25:08
         compiled from /var/www/virtual/one/html/piwik/plugins/CoreUpdater/templates/update_one_click_results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/virtual/one/html/piwik/plugins/CoreUpdater/templates/update_one_click_results.tpl', 12, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreUpdater/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br/>
<?php $_from = $this->_tpl_vars['feedbackMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
	<p><?php echo $this->_tpl_vars['message']; ?>
</p>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['coreError']): ?>
	<br /><br />
	<div class="error"><img src="themes/default/images/error_medium.png" /> <?php echo $this->_tpl_vars['coreError']; ?>
</div>
	<br /><br />
	<div class="warning"><img src="themes/default/images/warning_medium.png" /> <?php echo ((is_array($_tmp='CoreUpdater_UpdateHasBeenCancelledExplanation')) ? $this->_run_mod_handler('translate', true, $_tmp, "<br /><br />", "<a target='_blank' href='?module=Proxy&action=redirect&url=http://piwik.org/docs/update/'>", "</a>") : smarty_modifier_translate($_tmp, "<br /><br />", "<a target='_blank' href='?module=Proxy&action=redirect&url=http://piwik.org/docs/update/'>", "</a>")); ?>
</div>
	<br /><br />
<?php endif; ?>

<form action="index.php">
<input type="submit" class="submit" value="<?php echo ((is_array($_tmp='CoreUpdater_ContinueToPiwik')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CoreUpdater/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>