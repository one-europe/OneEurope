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
			foreach ($inits as $initiative ) { 
				$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $initiative->slug ) ));
				if ( $inslideshow == true && $i < $initscount ) {
					$i++;
				} elseif ($j < 3) {
					$j++;
			?>
			<li class="brief">
				<a href="<?php echo $initiative->permalink; ?>" title="<?php echo $initiative->title; ?>">
					<img src="<?php echo $initiative->info->photourl; ?>" alt="<?php if ( $initiative->info->photoinfo ) { echo $initiative->info->photoinfo; } else { echo $initiative->title; } ?>" width="270" />
					<h3><?php echo $initiative->info->shorttitle; ?></h3>
				</a>
			</li>
			<?php } } ?>
			<li class="all"><a href="<?php echo Site::out_url( 'habari' ); ?>/initiatives/" title="click here to see all initiatives">view all ›</a></li>
		</ul>
</section>