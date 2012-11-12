<?php /* Smarty version 2.6.26, created on 2012-11-09 15:27:10
         compiled from /var/www/virtual/one/html/piwik/plugins/CoreHome/templates/popover_multirowevolution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/virtual/one/html/piwik/plugins/CoreHome/templates/popover_multirowevolution.tpl', 2, false),array('modifier', 'escape', '/var/www/virtual/one/html/piwik/plugins/CoreHome/templates/popover_multirowevolution.tpl', 2, false),array('function', 'logoHtml', '/var/www/virtual/one/html/piwik/plugins/CoreHome/templates/popover_multirowevolution.tpl', 15, false),)), $this); ?>
<div class="rowevolution multirowevolution">
	<div class="popover-title"><?php echo ((is_array($_tmp=((is_array($_tmp='RowEvolution_MultiRowEvolutionTitle')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
	<div class="graph">
		<?php echo $this->_tpl_vars['graph']; ?>

	</div> 
	<div class="metrics-container">
		<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['availableRecordsText'])) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2>
		<table class="metrics" border="0" cellpadding="0" cellspacing="0">
			<?php $_from = $this->_tpl_vars['metrics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['metric']):
?>
				<tr>
					<td class="sparkline">
						<?php echo $this->_tpl_vars['metric']['sparkline']; ?>

					</td>
					<td class="text">
						<?php echo smarty_function_logoHtml(array('metadata' => $this->_tpl_vars['metric'],'alt' => ""), $this);?>
 <span style="color:<?php echo $this->_tpl_vars['metric']['color']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['metric']['label'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span><br />
						<span class="details"><?php echo $this->_tpl_vars['metric']['details']; ?>
</span>
					</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
		</table>
		<a href="#" class="rowevolution-startmulti">&raquo; <?php echo ((is_array($_tmp='RowEvolution_PickAnotherRow')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
	</div>
	<?php if (count ( $this->_tpl_vars['availableMetrics'] ) > 1): ?>
	<div class="metric-selectbox">
		<h2><?php echo ((is_array($_tmp='RowEvolution_AvailableMetrics')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</h2> 
		<select name="metric" class="multirowevoltion-metric">
			<?php $_from = $this->_tpl_vars['availableMetrics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['metric'] => $this->_tpl_vars['metricName']):
?>
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metric'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"<?php if ($this->_tpl_vars['selectedMetric'] == $this->_tpl_vars['metric']): ?> selected="selected"<?php endif; ?>>
					<?php echo ((is_array($_tmp=$this->_tpl_vars['metricName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

				</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	<?php endif; ?>
</div>