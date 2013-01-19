<?php /* Smarty version 2.6.26, created on 2013-01-17 14:15:28
         compiled from CoreUpdater/templates/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'translate', 'CoreUpdater/templates/header.tpl', 5, false),array('function', 'loadJavascriptTranslations', 'CoreUpdater/templates/header.tpl', 38, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Piwik &rsaquo; <?php echo ((is_array($_tmp='CoreUpdater_UpdateTitle')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="plugins/CoreHome/templates/images/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="themes/default/simple_structure.css" />
	<link rel="stylesheet" type="text/css" href="libs/jquery/themes/base/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="themes/default/styles.css" />
	<link rel="stylesheet" type="text/css" href="plugins/CoreHome/templates/donate.css"></link>
	<link rel="stylesheet" type="text/css" href="plugins/CoreHome/templates/jquery.ui.autocomplete.css"></link>
<?php echo '
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
.topBarElem {
        font-family:arial,sans-serif !important;
        font-size:13px;
        line-height:1.33;
}

#donate-form-container {
	margin: 0 0 2em 2em;
}
</style>
'; ?>


	<script type="text/javascript" src="libs/jquery/jquery.js"></script>
	<script type="text/javascript" src="libs/jquery/jquery-ui.js"></script>
	<script type="text/javascript" src="plugins/CoreHome/templates/donate.js"></script>
<?php if (((is_array($_tmp='General_LayoutDirection')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)) == 'rtl'): ?>
<link rel="stylesheet" type="text/css" href="themes/default/rtl.css" />
<?php endif; ?>
<?php echo smarty_function_loadJavascriptTranslations(array('plugins' => 'CoreHome'), $this);?>

</head>
<body id="simple">
<div id="contentsimple">
	<div id="title"><img title='Piwik' alt="Piwik" src='themes/default/images/logo-header.png' style='margin-left:10px' /><span id="subh1"> # <?php echo ((is_array($_tmp='General_OpenSourceWebAnalytics')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp)); ?>
</span></div>