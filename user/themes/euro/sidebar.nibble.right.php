<div id="sidebar" class="brief-sidebar">
	<?php if ( $post->info->showauthor == 1 ) { ?>
		<section class="authorbox">
			<div class="h"><span>Author</span></div>
				<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) ); ?>
				<a href="<?php echo $publisher->permalink; ?>">
					<img src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
					<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
					<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
					<p>read more › </p>
					<div class="clear"></div>
				</a>
			<div class="clear"></div>
		</section>
	<?php } ?>
	<?php echo $theme->display ('sidebar.elem.stay-tuned'); ?>	
	<?php echo $theme->display ('sidebar.elem.newsletter'); ?>	
	<?php echo $theme->display ('sidebar.elem.most-shared'); ?>	
	<?php echo $theme->display ('sidebar.elem.pinterest-board'); ?>	
	<?php echo $theme->display ('sidebar.elem.popular-threads'); ?>	
	<?php echo $theme->display ('sidebar.elem.recent-posts'); ?>	
</div>