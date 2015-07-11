<?php echo $theme->display( 'header'); ?>
<?php if ( $post ) { ?>
	<article>
		<div class="breadcrumb">
			<a class="to-root" href="<?php Site::out_url( 'habari' ); ?>/videos">Back to Videos</a>
			<div class="pager">
				<?php if ($previous = $post->descend()): ?>
				<a class="prev" href="<?php echo $previous->permalink ?>" title="<?php echo $previous->title; ?>">Previous</a>
				<?php endif; ?>
				<?php if ($post->ascend() && $post->descend()) : echo " | "; endif; ?>
				<?php if ($next = $post->ascend()): ?>
				<a class="next" href="<?php echo $next->permalink ?>" title="<?php echo $next->title; ?>">Next</a>
				<?php endif; ?>
			</div>
		</div>
		<!-- <div class="metacat"><span><?php echo $post->info->metacat; ?></span></div> -->
		<h1><?php echo $post->title_out; ?></h1>
		<p class="descr"><?php echo $post->info->excerpt; ?></p>
		<?php if ( $post->info->showauthor == 1 ) { ?>
			<span class="article-autor">
				<?php if ( $post->info->origsource ) { ?>
					<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="Portrait"><?php echo $post->info->origauthor; ?></a>
				<?php } else { 
					$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
					<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><?php echo $post->author->displayname; ?></a>
				<?php } ?>
			|</span>
		<?php } ?>
		<p class="meta">
			<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time>
			<?php if ($post->tags_out) { ?> | tags: <?php } else { ?> | no tags<?php } ?><?php echo $post->tags_out; ?>
			<?php if ( User::identify()->loggedin ) { ?>
				<span class="alignright article-edit"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
			<?php } ?>
		</p>

		<div class="post-content"><?php echo $post->content_out; ?></div>

		<div class="spread-the-word">
			<?php if ( $post->author->info->userfield_Description || $post->info->origauthor ) { 
				if ( $post->info->showauthor == 1 ) { ?>
				<div style="overflow: hidden; background: linen;">
					<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
						This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
					<?php } elseif ( $post->author->info->userfield_Description ) { ?>
					<span><?php echo $post->author->info->userfield_Description; ?></span>
					<?php } ?>
				</div>
			<?php } } ?>
			Spread the word:
			<?php echo $theme->display('social.spread-the-word'); ?>
		</div>

		<div class="fb-comments" style="padding-top: 20px; display: block; overflow: hidden;" data-width="100%" data-href="<?php echo $post->permalink; ?>" data-numposts="5" data-colorscheme="light"></div>

		<div class="further-reading post-list">
			<p class="header">Further Reading:</p>
		 	<div class="similar-posts">
				<?php $list = Posts::get( array( 'content_type' => Post::type( 'article' ),
						'status' => Post::status( 'published' ),
						'order' => 'DESC',
						'limit' => 3,
						'vocabulary' => array('any' => $post->tags ),
						'not:id' => $post->id ) );
						foreach ($list as $item ) { ?>
						<section>
							<div class="img-wrap">
								<img src="<?php echo $item->info->photourl; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/>
							</div>
							<h2><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h2>
							<p><?php if ( $item->info->excerpt ) { echo $item->info->excerpt; } else { echo $item->content_out; } ?></p>
							<p class="meta">
						        <?php if ( $show_author && $item->typename == 'article' ) { ?>
									<?php if ( $item->info->origauthor ) { ?>
										<a href="<?php if ( $item->info->origprofile ) { echo $item->info->origprofile; } else { echo $item->info->origsource; } ?>" title="<?php echo $item->info->origauthor; ?>"><?php echo $item->info->origauthor; ?></a>
									<?php } elseif ($item->info->author) { ?>
										<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $item->info->author ) ) );?>
										<a href="<?php echo $publisher->permalink; ?>" title="<?php echo User::get($item->info->author)->displayname; ?>"><?php echo User::get($item->info->author)->displayname; ?></a>
									<?php } else { 
										$publisher = Post::get(array( 'all:info' => array( 'user' => $item->author->id ) ) );?>
										<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $item->author->displayname; ?>"><?php echo $item->author->displayname; ?></a>
									<?php } ?>
								<?php } ?>
						        on <time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
							</p>
						</section>
				<?php } ?>
			</div>
		</div>

		<?php echo $theme->display('social.buttons-bottom'); ?>

	</article>
<?php
	echo $theme->display('sidebar.nibble.right');
} else {
	echo $theme->display('404msg');
}
echo $theme->display('footer'); ?>