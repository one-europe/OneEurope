
	<section class="pool">
		<div class="h"><span>Profile Database:</span></div>
	
		<ul>
		<?php
		
		
		/*
		normally, show 2.
		in case of article, retrieve 3 and show whichever 2 don't match the article's author's id.
		*/
		$i = 2;
		if ( isset($post)) { $i = 3; };
		$j = 0;
		$hide = false;
		
		$profiles = Posts::get( array( 'content_type' => 'profile', 'status' => 'published', 'limit' => $i, 'all:info' => array('ccontributor' => 1), 'orderby' => 'RAND()' ) );
		foreach ($profiles as $profile ) { 
			
				if ( isset($post) ) { 
					if( $profile->info->user == $post->author->id ) {
						$hide = true;
					}
				}

				if ($profile->info->user) {
					$source = User::get_by_id($profile->info->user)->info;
					$title = User::get_by_id($profile->info->user)->displayname;
			 	} else {
					$source = $profile->info;
					$title = $profile->title;
				} 

				// if current not author's and not already 2 are displayed, go (and count up)
				if ($hide != true && $j < 2) {
					$j++;
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
				<?php } ?>	    

		<?php } ?>
				
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/profiles">view all ›</a></li>
				
		</ul>	
	</section>