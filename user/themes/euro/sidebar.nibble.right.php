
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

			<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="false" data-border-color="#eee" data-header="false"></div>

			<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
			<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>

		</ul>
	</section>

	<section>
		<div class="h"><span>Newsletter</span></div>
		<p><big><a href="http://eepurl.com/pODn9" target="_blank">Sign up for our free newsletter! ›</a></big></p>
	</section>


	<section class="viral">
		<div class="h"><span>Most Viral</span></div>


		<!-- AddThis Trending Content BEGIN -->
		<div id="addthis_trendingcontent"></div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>
		<script type="text/javascript">
		addthis.box("#addthis_trendingcontent", {
		    feed_title : "",
		    feed_type : "shared",
		    feed_period : "month",
		    num_links : 8,
		    height : "auto",
		    width : "auto",
		    domain : "one-europe.info"});
		</script>
		<!-- AddThis Trending Content END -->
	</section>

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