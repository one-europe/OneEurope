<div id="sidebar">
	<?php echo $theme->display ('sidebar.elem.welcome'); ?>
	<?php Plugins::act( 'theme_sidebar_top' ); ?>
	<?php echo $theme->display ('sidebar.elem.recent-comments'); ?>
	<?php echo $theme->display ('sidebar.elem.social'); ?>
	<div style="clear: both; margin-left: -4px; margin-bottom: 15px;">
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/CompanyProfile" data-id="2916037" data-format="inline" data-width="300"></script>
	</div>
	<div class="pinterest-board" style="clear: both; margin-left: -3px; margin-bottom: 15px;">
		<a data-pin-do="embedUser" href="http://www.pinterest.com/oneeurope/" data-pin-scale-width="91" data-pin-scale-height="200" data-pin-board-width="600">Visit One Europe's profile on Pinterest.</a>
	</div>
	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	
	<?php echo $theme->display ('sidebar.elem.debates'); ?>
	<?php echo $theme->display ('sidebar.elem.profilepool'); ?>
	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>
	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>
</div>