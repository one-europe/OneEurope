
	<section class="inbrief">
		<div class="h"><span><a href="/in-brief">In Brief</a></span></div>
			
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