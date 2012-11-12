<?php /* Smarty version 2.6.26, created on 2012-11-09 15:26:36
         compiled from /var/www/virtual/one/html/piwik/plugins/Live/templates/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', '/var/www/virtual/one/html/piwik/plugins/Live/templates/index.tpl', 32, false),)), $this); ?>
<?php echo '
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	// persist the &segment parameter so that the Live! widget is also segmented
	var hash = broadcast.getHash();
	var segment = broadcast.getValueFromUrl(\'segment\', hash);
	var appendSegment = segment != \'\' ? \'&segment=\'+ segment : \'\';
	
    $(\'#visitsLive\').liveWidget({
        interval: '; ?>
<?php echo $this->_tpl_vars['liveRefreshAfterMs']; ?>
<?php echo ',
        onUpdate: function(){
        	
		    //updates the numbers of total visits in startbox
		    $("#visitsTotal").load("index.php?module=Live&idSite='; ?>
<?php echo $this->_tpl_vars['idSite']; ?>
<?php if (! empty ( $this->_tpl_vars['liveTokenAuth'] )): ?>&token_auth=<?php echo $this->_tpl_vars['liveTokenAuth']; ?>
<?php endif; ?><?php echo '&action=ajaxTotalVisitors" + appendSegment);
		},
        maxRows: 10,
        fadeInSpeed: 600,
        dataUrl: \'index.php?module=Live&idSite='; ?>
<?php echo $this->_tpl_vars['idSite']; ?>
<?php if (! empty ( $this->_tpl_vars['liveTokenAuth'] )): ?>&token_auth=<?php echo $this->_tpl_vars['liveTokenAuth']; ?>
<?php endif; ?><?php echo '&action=getLastVisitsStart\' + appendSegment
    });
});
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Live/templates/totalVisits.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo $this->_tpl_vars['visitors']; ?>


<div class="visitsLiveFooter">
	<a title="Pause Live!" href="javascript:void(0);" onclick="onClickPause();"><img id="pauseImage" border="0" src="plugins/Live/templates/images/pause_disabled.gif" /></a>
	<a title="Start Live!" href="javascript:void(0);" onclick="onClickPlay();"><img id="playImage" border="0" src="plugins/Live/templates/images/play.gif" /></a>
	<?php if (! $this->_tpl_vars['disableLink']): ?>
		&nbsp; <a class="rightLink" href="javascript:broadcast.propagateAjax('module=Live&action=getVisitorLog')"><?php echo ((is_array($_tmp='Live_LinkVisitorLog')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</a>
	<?php endif; ?>
</div>