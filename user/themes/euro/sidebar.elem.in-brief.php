
	<section class="inbrief">
		<div class="h"><span><a href="<?php echo Site::out_url( 'habari' ); ?>/initiatives/">European Initiatives</a></span></div>
			
			<ul>
			<?php
					
				$i = 0;
				$j = 0;

				/* 
				in case this post is featured, hide it. 
				do this by looking up how many articles are in the slideshow.
				hide as many slideshow-systagged articles in the main loop.
				*/
				foreach ($inits as $post ) { 

					$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $post->slug ) ));
					if ( $inslideshow == true && $i < $initscount ) {
							$i++; 
					} elseif ($j < 5) {
						$j++;
				
				?>
				
				<li class="brief">
					<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>">
						<!-- <img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" width="270" /> -->
						<img src="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" width="270" />
						<h3><?php echo $post->info->shorttitle; ?></h3>
					</a>
				</li>
				
					<?php }
				} ?>

				<li class="all"><a href="<?php echo Site::out_url( 'habari' ); ?>/initiatives/" title="click here to see all initiatives">view all ›</a></li>

	</section>