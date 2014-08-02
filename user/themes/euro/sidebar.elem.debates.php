<section class="side-block">
	<a class="top-link" href="<?php Site::out_url( 'home' ); ?>/debates">Debates</a>
	<?php 
	$posts = Posts::get( array( 'content_type' => 'debate', 'status' => 'published', 'limit' => 2 /* attention: $i */ ) );
	foreach ($posts as $post ) { ?>
			
		<div class="debate">
			<p class="header"><a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a></p>
			<p class="links">
	
			<?php 
			$id = $post->id;
			$teasers = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'limit' => 2 ) ); 
			foreach ( $teasers as $teaser ) { ?>
				<a href="<?php echo $teaser->permalink; ?>"><?php echo $teaser->title; ?> ›</a>
			<?php } ?>
		
			</p>
		</div>

	<?php } ?>
	<a class="link-view-all" href="<?php Site::out_url( 'home' ); ?>/debates" title="View all debates">view all</a>
</section>