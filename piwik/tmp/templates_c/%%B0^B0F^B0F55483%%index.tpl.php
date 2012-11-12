<?php /* Smarty version 2.6.26, created on 2012-11-09 15:26:38
         compiled from /var/www/virtual/one/html/piwik/plugins/SEO/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/virtual/one/html/piwik/plugins/SEO/templates/index.tpl', 6, false),array('modifier', 'ucfirst', '/var/www/virtual/one/html/piwik/plugins/SEO/templates/index.tpl', 6, false),array('modifier', 'escape', '/var/www/virtual/one/html/piwik/plugins/SEO/templates/index.tpl', 7, false),array('function', 'ajaxLoadingDiv', '/var/www/virtual/one/html/piwik/plugins/SEO/templates/index.tpl', 13, false),)), $this); ?>
<div id='SeoRanks'>
	<script type="text/javascript" src="plugins/SEO/templates/rank.js"></script>
	
	<form method="post" style="padding: 8px;" >
	  <div align="left" class="mediumtext">
		  <?php echo ((is_array($_tmp=((is_array($_tmp='Installation_SetupWebSiteURL')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)))) ? $this->_run_mod_handler('ucfirst', true, $_tmp) : ucfirst($_tmp)); ?>
 
		  <input type="text" id="seoUrl" size="30" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['urlToRank'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="textbox" />
		  <span style="padding-left:2px;"> 
		  <input type="submit" id="rankbutton" value="<?php echo ((is_array($_tmp='SEO_Rank')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
" />
		  </span>
	  </div>
	
		<?php echo smarty_function_ajaxLoadingDiv(array('id' => 'ajaxLoadingSEO'), $this);?>


	   <div id="rankStats" align="left" style='margin-top:10px'>
	   		<?php if (empty ( $this->_tpl_vars['ranks'] )): ?>
	   			<?php echo ((is_array($_tmp='General_Error')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

	   		<?php else: ?>
<?php ob_start(); ?>
<a href='<?php echo ((is_array($_tmp=$this->_tpl_vars['urlToRank'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
' target='_blank'><?php echo ((is_array($_tmp=$this->_tpl_vars['urlToRank'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
<?php $this->_smarty_vars['capture']['cleanUrl'] = ob_get_contents(); ob_end_clean(); ?>
	   			<?php echo ((is_array($_tmp='SEO_SEORankingsFor')) ? $this->_run_mod_handler('translate', true, $_tmp, $this->_smarty_vars['capture']['cleanUrl']) : smarty_modifier_translate($_tmp, $this->_smarty_vars['capture']['cleanUrl'])); ?>

	   			<table cellspacing='2' style='margin:auto;line-height:1.5em;padding-top:10px'>
	   			<?php $_from = $this->_tpl_vars['ranks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rank']):
?>
	   			<tr>
	   				<td><img style='vertical-align:middle;margin-right:6px;' src='<?php echo $this->_tpl_vars['rank']['logo']; ?>
' border='0' alt="<?php echo $this->_tpl_vars['rank']['label']; ?>
"> <?php echo $this->_tpl_vars['rank']['label']; ?>

	   				</td><td>
	   					<div style='margin-left:15px'>
		   					<?php if (isset ( $this->_tpl_vars['rank']['rank'] )): ?><?php echo $this->_tpl_vars['rank']['rank']; ?>
<?php else: ?>-<?php endif; ?>
		   					<?php if ($this->_tpl_vars['rank']['id'] == 'pagerank'): ?> /10 
		   					<?php elseif ($this->_tpl_vars['rank']['id'] == 'yahoo-bls'): ?> <?php echo ((is_array($_tmp='SEO_Backlinks')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
 
		   					<?php elseif ($this->_tpl_vars['rank']['id'] == 'yahoo-pages'): ?> <?php echo ((is_array($_tmp='SEO_Pages')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>

		   					<?php endif; ?>
	   					</div>	
   					</td>
	   			</tr>
	   			<?php endforeach; endif; unset($_from); ?>
	   			
	   			</table>
	   		<?php endif; ?>
	   </div>
	</form>
</div>