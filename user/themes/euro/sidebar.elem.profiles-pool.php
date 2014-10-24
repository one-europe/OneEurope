	<section class="side-block">
		<a class="top-link" href="<?php Site::out_url( 'habari' ); ?>/team">Profiles Database</a>
		<?php
		/*
		normally, show 2.
		in case of article, retrieve 3 and show whichever 2 don't match the article's author's id.
		*/
		$i = 2;
		if ( isset($post)) { $i = 3; };
		$j = 0;
		$hide = false;
		
		$profiles = Posts::get( array( 'content_type' => 'profile', 'status' => 'published', 'limit' => $i/*, 'all:info' => array('ccontributor' => 1)*/, 'orderby' => 'RAND()' ) );
		// Utils::debug($profiles->get_query());
		
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
				
	   	    	<a class="profile" href="<?php echo $profile->permalink; ?>" title="<?php echo $title; ?>">
					<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( !$source->photourl ) { echo $profile->info->photourl; } else { echo Site::out_url( 'theme' ) ?>/img/face.jpg<?php } ?>" alt="<?php echo $title ?>" width="95" />
	   	    		<p class="teaser">
	   	    			<b><?php echo $title; ?></b>
	   	    			<?php echo $source->teaser ? $source->teaser :  strip_tags(explode('</p>', $profile->content)[0]); ?>
	   	    		</p>
				</a>
				<?php } ?>	    

		<?php } ?>
		<a class="link-view-all" href="<?php Site::out_url( 'habari' ); ?>/team" title="View all profiles">view all</a>
	</section>