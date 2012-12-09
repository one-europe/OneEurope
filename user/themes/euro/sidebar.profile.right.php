		<div id="profile-sidebar" class="toggle">

			<?php Plugins::act( 'theme_sidebar_top' ); ?>

			<?php if ($post->info->user) {
				$source = User::get_by_id($post->info->user)->info;
		 	} else {
				$source = $post->info;
			}?>

			<?php 
			if ( User::identify()->id == $post->info->user ) { ?>
			<section class="edit">
				<div class="h"><span>Options:</span></div>
				<span><a href="<?php Site::out_url( 'home' ) ?>/admin/user">Edit</a></span><br />
			</section>
			<?php } ?>

			<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>
		
			<?php if ( $source->twitter ) { ?>
	
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
			
			<?php if ( $post->info->user == '0' ) { ?>
				
				<section>
					
					<div class="h"><span>This is you?</span></div>
				
					<p class="message">This is you or your organisation? <a href="/contact">Get in touch</a> to edit it yourself.</p>
				
				</section>
				
			<?php } else?>
			

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