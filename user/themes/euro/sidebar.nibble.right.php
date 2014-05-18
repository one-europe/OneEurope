
<div id="sidebar" class="brief-sidebar">

	<?php Plugins::act( 'theme_sidebar_top' ); ?>


	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


	<?php /* <section class="">
		<div class="h"><span>Dossier: "Tag1"</span></div>

		... list of entries....

	</section> */ ?>

	<?php if ( $post->info->showauthor == 1 ) { ?>
		<section class="authorbox">
			<div class="h"><span>Author</span></div>

				<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) ); ?>

				<a href="<?php echo $publisher->permalink; ?>">
					<img src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
					<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
					<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
					<p>read more › </p>
					<div class="clear"></div>
				</a>
				
			<div class="clear"></div>

		</section>
	<?php } ?>

	<section class="fb">
		<div class="h"><span>Stay Tuned</span></div>

			<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
			<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>

			<div class="g-plus-box">		
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
				<g:plus href="https://plus.google.com/118353934830681553476" width="297" height=""></g:plus>
			</div>
			<br/>
			<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="false" data-border-color="#eee" data-header="false"></div>

		</ul>
	</section>

	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>	

	<?php echo $theme->display ('sidebar.elem.de-vote'); ?>	

	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	

	<div style="clear: both; margin-left: -3px; margin-bottom: 15px;">
		<a data-pin-do="embedUser" href="http://www.pinterest.com/oneeurope/" data-pin-scale-width="91" data-pin-scale-height="200" data-pin-board-width="600">Visit One Europe's profile on Pinterest.</a>
		<!-- Please call pinit.js only once per page -->
		<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
	</div>


	<section class="disqusthreads">
		<div class="h"><span>Most Commented</span></div>
		<div id="popularthreads" class="dsq-widget"><script type="text/javascript" src="http://oneeurope.disqus.com/popular_threads_widget.js?num_items=5"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	</section>


	<section class="recentposts">
		<div class="h"><span>Recently Published</span></div>
		<ul>
			<?php
				foreach ($theme->recent_posts as $post) {
					echo '<li><a href="', $post->permalink, '">',
					$post->title, '</a></li>';
				}
			?>
		</ul>
	</section>


	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>