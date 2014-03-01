<div id="sidebar" class="article-sidebar">

	<?php Plugins::act( 'theme_sidebar_top' ); ?>


	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


	<?php /* <section class="">
		<div class="h"><span>Dossier: "Tag1"</span></div>
		
		... list of entries....
		
	</section> */ ?>

	<section class="authorbox">
		<div class="h"><span>Author</span></div>
	
		<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
			
			This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 

			<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
			.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
			come from, with profile here if existing.<br /> */ ?>

		<?php } elseif ($post->info->author) { ?>
			
			<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>

			<a href="<?php echo $publisher->permalink; ?>">
				<img alt="<?php echo User::get($post->info->author)->displayname; ?>" src="<?php if ( User::get($post->info->author)->info->photourl ) { echo User::get($post->info->author)->info->photourl; } else { echo $publisher->info->photourl; } ?>" />
				<h3><?php if (  User::get($post->info->author)->info->displayname ) { echo User::get($post->info->author)->info->displayname; } else { echo $publisher->title; } ?></h3>
				<p><?php if ( User::get($post->info->author)->info->teaser ) { echo User::get($post->info->author)->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
				<p class="nopbottom">read more › </p>
				<div class="clear"></div>
			</a>

			<?php if (User::get($post->info->author)->info->twitter) { ?>
				<a href="https://twitter.com/<?php echo User::get($post->info->author)->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<?php } elseif ($publisher->info->twitter) { ?>
				<a href="https://twitter.com/<?php echo $publisher->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<?php } ?>

		<?php } else { 
			$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>

			<a href="<?php echo $publisher->permalink; ?>">
				<img alt="<?php echo $post->author->displayname; ?>" src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
				<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
				<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
				<p class="nopbottom">read more › </p>
				<div class="clear"></div>
			</a>

			<?php if ($publisher->info->twitter) { ?>
				<a href="https://twitter.com/<?php echo $publisher->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			<?php } ?>

		<?php } ?>

		<div class="clear"></div>
	
	</section>

	<a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding" title="Together we build the Future of Europe!">
		<img style="margin-bottom: 20px;" src="<?php Site::out_url( 'theme' )?>/img/static/right-banner.png" width="295" height="295" />
	</a>

	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>	
		
	<?php echo $theme->display ('sidebar.elem.de-vote'); ?>	
		
	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	


		<?php /* <ul>
			<?php
			$recent = Posts::get( array( 'content_type' => 'initiative', 'limit'=>8, 'status'=>'published', 'orderby'=>'pubdate DESC' ) );
				foreach ($recent as $rec) {
					echo '<li><a href="', $rec->permalink, '">',
					$rec->title, ' ›</a></li>';
				}
			?>
		
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/initiatives">view all ›</a></li>
		
		</ul> */ ?>
	</section>	
		
		
		
	<?php /*?><section class="recentposts">
		<div class="h"><span>Other Recent Articles</span></div>
		<ul>
			<?php
				foreach ($theme->recent_posts as $post) {
					echo '<li><a href="', $post->permalink, '">',
					$post->title, '</a></li>';
				}
			?>
		</ul>
	</section> */ ?>
	
	<section class="fb">
		<div class="h"><span>Stay Tuned</span></div>
	
		<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="true" data-border-color="#eee" data-header="false"></div>
	
		<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
		<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
		
	</section>
	
	<section class="disqusthreads">
		<div class="h"><span>Popular Threads</span></div>
		<div id="popularthreads" class="dsq-widget"><script type="text/javascript" src="http://oneeurope.disqus.com/popular_threads_widget.js?num_items=5"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	</section>
	
	
	<section class="inbrief">
		<div class="h"><span><a href="/in-brief">The Big Picture:</a></span></div>
			
			<ul>
			<?php
			$i = 0; $j = 1;
			foreach ($briefsteaser as $brief ) { 	

				/* 
				show only if not currently in the slideshow and if there aren't already two displayed
				*/	
				$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $brief->slug ) ));
				if ( $inslideshow == true ) { 
					if ( $i < $nibblescount ) {
						$i++;
						//echo $brief->title . " is featured</br>";
					}
				} elseif ( $j <= 2 ) {
					$j++;
				?>

				
					<li class="brief">						
						<?php if ( $brief->status == Post::status('scheduled') ) { ?>
							<div class="content-badge scheduled">
								<span>scheduled</span>
							</div>
						<?php } ?>
			   	    	<a href="<?php echo $brief->permalink; ?>">
							<img src="<?php echo $brief->info->photourl; ?>" width="270" />
			   	    		<h3><?php echo $brief->title; ?></h3>
							<div class="clear"></div>
						</a>
					</li>   	    

				<?php /* span class="entry-autor">by <span><?php echo $post->author->displayname; ?></span></span> */ ?>
			<?php }
			} ?>

				<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/in-brief">view all ›</a></li>

	</section>

	<?php echo $theme->display ('sidebar.elem.profilepool'); ?>



	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>