		<div id="profile-sidebar" class="toggle">

			<?php Plugins::act( 'theme_sidebar_top' ); ?>

			<?php /* if ( User::identify()->loggedin ) { ?>
			<section class="admininfo left">
				<div class="h"><span>Admininfo:</span></div>
				<span>$post->info->user: "<?php echo $post->info->user; ?>", this user has published <?php echo Posts::count_by_author( $post->info->user ); ?> posts.</span>
			</section>
			<?php } */ ?>

			<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


			<?php /* <section class="">
				<div class="h"><span>Dossier: "Tag1"</span></div>
		
				... list of entries....
		
			</section> */ ?>
		
			<section>
				<div class="h"><span>OneEurope Newsletter</span></div>
				<p><big><a href="http://eepurl.com/pODn9" target="_blank">Sign up for our newsletter! ›</a></big></p>
			</section>
		
			<section class="sharing">
				<div class="h"><span>Share</span></div>

				<div class="addthis addthis_toolbox addthis_default_style ">
					
					<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
					<a class="addthis_button_tweet" tw:count="vertical"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>	
					<a class="addthis_counter"></a>
				
					<a class="addthis_button_facebook_send clear"></a>
					<a class="addthis_button_pinterest_pinit"></a>
					<a class="addthis_button_print"></a>
					<a class="addthis_button_reddit"></a>
					<a class="addthis_button_stumbleupon"></a>

				</div>
			</section>
		
			<?php if ( $post->info->twitter ) { ?>
	
				<section class="twitter">
					<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
					<script>
					new TWTR.Widget({
					  version: 2,
					  type: 'profile',
					  rpp: 4,
					  interval: 30000,
					  width: 230,
					  height: 232,
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
					}).render().setUser('<?php echo $post->info->twitter; ?>').start();
					</script>
				</section>
	
			<?php } ?>
	
			<?php if ( $post->info->url || $post->info->twitter ) { ?>
			<section class="">
				<div class="h"><span>More about this</span></div>
				<span>
					<?php if ($post->info->url) { ?><a href="<?php echo $post->info->url; ?>" title="visit website" target="_blank">› Official website of <?php echo $post->title; ?></a><br/><?php } ?>
					<?php if ($post->info->twitter) { ?><a href="http://twitter.com/<?php echo $post->info->twitter; ?>" title="<?php echo $post->title ?> on Twitter" target="_blank">› <?php echo $post->title ?> on Twitter</a><?php } ?>	
				</span>
			</section>
			<?php } ?>
			
			<?php if ( $post->info->more ) { ?>
			<section class="">
				<div class="h"><span>More</span></div>
				<span>
					<?php echo $post->info->more; ?>	
				</span>
			</section>
			<?php } ?>

			<?php /*
			<section class="cat1">
				<div class="h"><span>Debate that "<?php echo $post->title; ?>" is most active in</span></div>
				<ul>
					<li>a</li>
					<li>b</li>
					<li>c</li>
				</ul>
			</section>

			<section class="recentposts">
				<div class="h"><span>Recent Initiatives</span></div>
				<ul>					
					<?php
								
						foreach ($tag1 as $post) {
							echo '<li><a href="', $post->permalink, '">',
							$post->title, '</a></li>';
						}
					?>
				</ul>
			</section>	*/ ?>
			
			<?php //Plugins::act( 'theme_sidebar_bottom' ); ?>
	
		</div>
	
	</div>