<section class="side-block">
	<a class="top-link" href="<?php echo Site::out_url( 'habari' ); ?>/initiatives">European Initiatives</a>
	<?php
		$initiatives = Posts::get(array( 'content_type' => 'initiative', 'limit' => 3, 'status' => 'published'));
		foreach ($initiatives as $initiative) { ?>
		<a class="initiative" href="<?php echo $initiative->permalink; ?>" title="<?php echo $initiative->title; ?>">
			<img src="<?php echo $initiative->info->photourl; ?>" alt="<?php if ( $initiative->info->photoinfo ) { echo $initiative->info->photoinfo; } else { echo $initiative->title; } ?>" width="270" />
			<h2><?php echo $initiative->info->shorttitle; ?></h2>
		</a>
		<?php } ?>
	<a class="link-view-all" href="<?php echo Site::out_url( 'habari' ); ?>/initiatives" title="view all initiatives">view all</a>
</section>