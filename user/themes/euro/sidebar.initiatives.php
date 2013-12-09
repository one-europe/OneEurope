<div id="sidebar">
	<div class="welcome">
		<a href="/about" title="We incite cross-border debate for the emerging European society"></a>
	</div>
	<?php Plugins::act( 'theme_sidebar_top' ); ?>
	<?php echo $theme->display ('sidebar.elem.recent-comments'); ?>
	<?php echo $theme->display ('sidebar.elem.de-vote'); ?>
	<?php echo $theme->display ('sidebar.elem.social'); ?>
	<div style="clear: both; margin-left: -4px; margin-bottom: 15px;">
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/CompanyProfile" data-id="2916037" data-format="inline" data-width="300"></script>
	</div>
	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	
	<?php echo $theme->display ('sidebar.elem.debates'); ?>
	<?php echo $theme->display ('sidebar.elem.profilepool'); ?>
	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>
	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>
</div>