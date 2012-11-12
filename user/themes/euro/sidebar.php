<div id="sidebar">

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
	
	<section class="inbrief">
		<div class="h"><span>In Brief:</span></div>
	
			<ul>
			<?php

			$briefsteaser = Posts::get( array( 'content_type' => 'brief', 'limit' => '2' ) );
			foreach ($briefsteaser as $brief ) { ?>

					<li class="brief">
			   	    	<a href="<?php echo $brief->permalink; ?>">
							<img src="<?php echo $brief->info->photourl; ?>" width="270" />
			   	    		<h3><?php echo $brief->title; ?></h3>
							<div class="clear"></div>
						</a>
					</li>   	    

				<?php /* span class="entry-autor">by <span><?php echo $post->author->displayname; ?></span></span> */ ?>
			<?php } ?>

				<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/in-brief">view all ›</a></li>

	</section>
		
	<section class="pool">
		<div class="h"><span>Who is who in Europe:</span></div>
	
		<ul>
		<?php
		
		$profiles = Posts::get( array( 'content_type' => 'profile', 'status' => 'published', 'limit' => 2, 'all:info' => array('ccontributor' => 1), 'orderby' => 'RAND()' ) );
		foreach ($profiles as $profile ) { 
							
				if ($profile->info->user) {
					$source = User::get_by_id($profile->info->user)->info;
					$title = User::get_by_id($profile->info->user)->displayname;
			 	} else {
					$source = $profile->info;
					$title = $profile->title;
				} 
				?>
				
				<li class="profileteaser">
		   	    	<a href="<?php echo $profile->permalink; ?>">
						<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( !$source->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title ?>" />
		   	    		<h3><?php echo $title; ?></h3>
		   	    		<p class="teaser">
							<?php echo $source->teaser; ?>
		   	    		</p>
						<div class="clear"></div>
					</a>
				</li>   	    

			<?php /* span class="entry-autor">by <span><?php echo $post->author->displayname; ?></span></span> */ ?>
		<?php } ?>
				
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/profiles">view all ›</a></li>
				
		</ul>	
	</section>
	
	<section class="trending">
		<div class="h"><span>Debates</span></div>
		
		<ul class="dossier">
			
				<?php 
				$posts = Posts::get( array( 'content_type' => 'debate', 'status' => 'published', 'limit' => 2 /* attention: $i */ ) );
				foreach ($posts as $post ) { ?>
						
					<li>
						<h3><a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a></h3>

						<div class="teaserlist">
				
						<?php 
						$id = $post->id;
						$teasers = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'limit' => 2 ) ); 
						foreach ( $teasers as $teaser ) { ?>
					
							<a href="<?php echo $teaser->permalink; ?>"><?php echo $teaser->title; ?> ›</a><br/>

						<?php } ?>
					
						</div>
					</li>
			
				<?php } ?>
			
			<?php /* li>		
				<?php $i = 1; // TAG 2
				$posts = Posts::get( array( 'vocabulary' => array( 'tags:term' => 'tag2' ), 'content_type' => 'article', 'status' => 'published', 'limit' => 3 ) );
				foreach ($posts as $post ) { ?>
			
					<?php if ($i == 1) { ?>
			
					<div class="first">
			
						<a href="<?php echo $post->permalink; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" /></a>
						<h3><a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a></h3>
						<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						<p class="author"><?php echo $post->author->displayname; ?></p>
				
					</div>
					<div class="teaserlist">
				
					<?php } else { ?>
						<a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?> ›</a><br/>
					<?php } ?>
					<?php if ( $i == 3 ) { ?>
						</div>
					<?php } ?>
			
				<?php $i++; } ?>
			</li */ ?>
			
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/debates">view all ›</a></li>
			
		</ul>
		
	</section>	
		
	
	<section class="fb">
		<div class="h"><span>Connect with us</span></div>
				
		<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="false" data-border-color="#eee" data-header="false"></div>
		<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://one-europe.info/about"></a>
		<noscript><a href="http://flattr.com/thing/697920/OneEurope" target="_blank">
		<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
		<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
		
			<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script>
			new TWTR.Widget({
			  version: 2,
			  type: 'profile',
			  rpp: 4,
			  interval: 30000,
			  width: 275,
			  height: 220,
			  theme: {
			    shell: {
			      background: '#EEF1F5',
			      color: '#333333'
			    },
			    tweets: {
			      background: '#FAFBFC',
			      color: '#52525252',
			      links: '#000000'
			    }
			  },
			  features: {
			    scrollbar: true,
			    loop: true,
			    live: true,
			    behavior: 'all'
			  }
			}).render().setUser('one1europe').start();
			</script>
	
	</section>	
	
	<section>
		<div class="h"><span>Newsletter</span></div>
		<p><big><a href="http://eepurl.com/pODn9" target="_blank">Sign up for our free newsletter! ›</a></big></p>
	</section>
	
		
	<?php /* section id="subscribe">	
		<a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow"><img src="<?php echo Site::out_url('theme')?>/img/atomfeed.png" alt="Atom Feed" height="25" width="25" /></a>
	</section> */ ?>

	<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>
	
	<section class="recentposts">
		<div class="h"><span>Recent Initiatives</span></div>
		<ul>
			<?php
			$recent = Posts::get( array( 'content_type' => 'initiative', 'limit'=>8, 'status'=>'published', 'orderby'=>'pubdate DESC' ) );
				foreach ($recent as $rec) {
					echo '<li><a href="', $rec->permalink, '">',
					$rec->title, ' ›</a></li>';
				}
			?>
		
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/initiatives">view all ›</a></li>
		
		</ul>
	</section>

	<section class="disqus-recentcomments">
		<div class="h"><span>Recent Comments</span></div>
		<div id="recentcomments" class="dsq-widget">
			<script type="text/javascript" src="http://oneeurope.disqus.com/recent_comments_widget.js?num_items=5&amp;hide_avatars=0&amp;avatar_size=32&amp;excerpt_length=200"></script>
		</div>
	</section>
	
	<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>