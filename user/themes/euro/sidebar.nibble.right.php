<div id="sidebar" class="article-sidebar">

	<?php Plugins::act( 'theme_sidebar_top' ); ?>


	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


	<?php /* <section class="">
		<div class="h"><span>Dossier: "Tag1"</span></div>
		
		... list of entries....
		
	</section> */ ?>

	<?php echo $profile->title; ?>


	<section class="authorbox">
		<div class="h"><span>Author</span></div>
	
		<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
			
			This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 

			<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
			.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
			come from, with profile here if existing.<br /> */ ?>

		<?php } else { ?>
			
			<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) ); ?>
			
			<a href="<?php echo $publisher->permalink; ?>">
				<img src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
				<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
				<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
				<p>read more › </p>
				<div class="clear"></div>
			</a>
			
		<?php } ?>
		<div class="clear"></div>
	
	</section>
	
	<section class="fb">
		<div class="h"><span>Stay Tuned</span></div>
	
			<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="true" data-border-color="#eee" data-header="false"></div>
	
			<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
			<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
		
		</ul>
	</section>
	
	<section>
		<div class="h"><span>Newsletter</span></div>
		<p><big><a href="http://eepurl.com/pODn9" target="_blank">Sign up for our free newsletter! ›</a></big></p>
	</section>
	
	<section class="disqusthreads">
		<div id="popularthreads" class="dsq-widget"><h2 class="dsq-widget-title">Popular Threads</h2><script type="text/javascript" src="http://oneeurope.disqus.com/popular_threads_widget.js?num_items=5"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	</section>
	
	
	<section class="recentposts">
		<div class="h"><span>Other Recent Articles</span></div>
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