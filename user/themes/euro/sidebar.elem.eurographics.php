<section class="side-block">
	<a class="top-link" href="<?php echo Site::out_url( 'habari' ); ?>/eurographics">Eurographics:</a>
		<?php
		$i = 0; $j = 1;
		$briefsteaser = Posts::get(array( 'content_type' => 'brief', 'limit' => 2, 'status'=> 'published', 'orderby' => 'pubdate DESC'));
		foreach ($briefsteaser as $brief ) { 	
		?>
			<a class="initiative" href="<?php echo $brief->permalink; ?>" title="<?php echo $brief->title; ?>">
				<img src="<?php echo $brief->info->photourl; ?>" alt="<?php echo $brief->title; ?>" width="270" />
				<h2><?php echo $brief->title; ?></h2>
			</a>
		<?php } ?>
		<a class="link-view-all" href="<?php echo Site::out_url( 'habari' ); ?>/eurographics" title="view all">view all</a>
</section>