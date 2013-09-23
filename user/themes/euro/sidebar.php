<div id="sidebar">

	<div class="welcome">
		<a href="/about" title="We incite cross-border debate for the emerging European society"></a>
	</div>

	<?php Plugins::act( 'theme_sidebar_top' ); ?>

	<?php /* section class="">
		<div class="h"><span>{recent activity}</span></div>
		
		<div>Recent/trending content (upcoming or happening event, initiative,...)<br/>
			TODO: Create a slider.</div>
		
	</section */?>
	
	
	<?php /* section class="disqusthreads">
		<div class="h"><span class="dsq-widget-title">Most Commented</span></div>
		<div id="popularthreads" class="dsq-widget">
			<script type="text/javascript" src="http://oneeurope.disqus.com/popular_threads_widget.js?num_items=5"></script>
		</div>
	</section */ ?>
	
	<?php echo $theme->display ('sidebar.elem.in-brief'); ?>	
	
	<?php echo $theme->display ('sidebar.elem.recent-comments'); ?>
	
	<?php echo $theme->display ('sidebar.elem.de-vote'); ?>	

	<?php echo $theme->display ('sidebar.elem.social'); ?>	

	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	
	
	<?php echo $theme->display ('sidebar.elem.debates'); ?>
	
	<?php /*echo $theme->display ('sidebar.elem.feedback');*/ ?>

	<?php echo $theme->display ('sidebar.elem.profilepool'); ?>

	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>


	<?php /* section id="subscribe">	
		<a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow"><img src="<?php echo Site::out_url('theme')?>/img/atomfeed.png" alt="Atom Feed" height="25" width="25" /></a>
	</section> */ ?>

	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>
	
	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>