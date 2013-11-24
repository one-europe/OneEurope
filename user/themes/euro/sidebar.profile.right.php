		<div id="profile-sidebar" class="toggle">

			<?php Plugins::act( 'theme_sidebar_top' ); ?>

			<?php if ($post->info->user) {
				$source = User::get_by_id($post->info->user)->info;
		 	} else {
				$source = $post->info;
			}?>

			<?php /* didn't work
			if ( User::identify()->id == $post->info->user ) { ?>
			<section class="edit">
				<div class="h"><span>Options:</span></div>
				<span><a href="<?php Site::out_url( 'home' ) ?>/admin/user">Edit</a></span><br />
			</section>
			<?php } */ ?>

			<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>
		
		
			<?php if ($source->twitter) { 
				$twname = $source->twitter;
			} elseif ($post->info->twitter) {
				$twname = $post->info->twitter;
			} ?>
		
			<?php if ( $twname ) {
				$tw_data = explode('-', $twname);
				$tw_id = $tw_data[1];
				$tw_name = $tw_data[0];
				if ($tw_id && $tw_name) {
				?>
					<section class="twitter">
						<a class="twitter-timeline" href="https://twitter.com/<?php echo $tw_name; ?>"
							data-dnt="true"
							data-widget-id="<?php echo $tw_id; ?>">Tweets by @<?php echo $tw_name; ?></a>
					</section>
				<?php }
				} ?>
			
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