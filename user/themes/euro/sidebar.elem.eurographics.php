<section class="side-block">
	<a class="top-link" href="<?php echo Site::out_url( 'habari' ); ?>/eurographics">Eurographics:</a>
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
			<a class="initiative" href="<?php echo $brief->permalink; ?>" title="<?php echo $initiative->title; ?>">
				<img src="<?php echo $brief->info->photourl; ?>" alt="<?php echo $brief->title; ?>" width="270" />
				<h2><?php echo $brief->title; ?></h2>
			</a>
		<?php } } ?>
		<a class="link-view-all" href="<?php echo Site::out_url( 'habari' ); ?>/eurographics" title="view all">view all</a>
</section>