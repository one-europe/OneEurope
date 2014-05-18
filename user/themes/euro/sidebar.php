<div id="sidebar">

	<div class="welcome">
		<a href="/about" title="We incite cross-border debate for the emerging European society"></a>
	</div>
	<?php Plugins::act( 'theme_sidebar_top' ); ?>

	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>
	<?php echo $theme->display ('sidebar.elem.in-brief'); ?>	
	<?php echo $theme->display ('sidebar.elem.recent-comments'); ?>
	<?php echo $theme->display ('sidebar.elem.de-vote'); ?>	
	<?php echo $theme->display ('sidebar.elem.social'); ?>	
	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	
	<?php echo $theme->display ('sidebar.elem.debates'); ?>
	<?php echo $theme->display ('sidebar.elem.profilepool'); ?>


	<?php /* section id="subscribe">	
		<a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow"><img src="<?php echo Site::out_url('theme')?>/img/atomfeed.png" alt="Atom Feed" height="25" width="25" /></a>
	</section> */ ?>

	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>
	
	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>