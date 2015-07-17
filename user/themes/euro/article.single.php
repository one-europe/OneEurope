<?php echo $theme->display ( 'header'); ?>
<article>
	<h1><?php echo $post->title_out; ?></h1>
	<p class="descr"><?php echo $post->info->excerpt; ?></p>
	<p class="meta">
		<?php /* if ( $show_author ) { ?>
			<?php if ( $post->info->origsource ) { ?>
				<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="<?php echo $post->info->origauthor; ?>"><?php echo $post->info->origauthor; ?></a>
			<?php } elseif ($post->info->author) { ?>
				<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
				<a href="<?php echo $publisher->permalink; ?>" title="<?php echo User::get($post->info->author)->displayname; ?>"><?php echo User::get($post->info->author)->displayname; ?></a>
			<?php } else { 
					if (is_object(Post::get(array( 'all:info' => array( 'user' => $post->author->id ) )))) { 
						$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
				<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $post->author->displayname; ?>"><?php echo $post->author->displayname; ?></a>
					<?php } else { ?>
				<?php echo $post->author->displayname; ?>
					<?php } ?>
			<?php } ?>
		<?php } */ ?>
		<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time></span>
		<?php if ($post->tags_out) { ?> | tags: <?php } else { ?> | no tags<?php } ?><?php echo $post->tags_out; ?>
	</p>
	<?php if ( User::identify()->loggedin ) { ?>
			<span class="article-edit"> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
	<?php } ?>
	<div class="post-content">
		<?php if ($post->info->photourl) { ?>
			<figure>					
				<span class="license" title="<?php echo $post->info->photolicense; ?>"><?php echo $post->info->photolicense; ?></span>
				<a href="<?php echo $post->info->photourl; ?>"><img alt="<?php echo $post->title; ?>" src="<?php echo $post->info->photourl; ?>" /></a>
				<figcaption><?php echo $post->info->photoinfo; ?></figcaption>
			</figure>			
		<?php } ?>
		<?php echo $post->content_out; ?>
		<?php
			// $username = User::get_by_id($post->info->editor)->username;
			// if ($username) {
			// 	$editor_slug = DB::get_results('SELECT slug FROM {posts} WHERE title LIKE "%' . $username . '%"')[0]->slug;
			// 	echo '<p>Edited by: <a href="/team/' . $editor_slug . '">' . $username . '</a></p>';	
			// }
		?>
	</div>
		
	<?php if ( User::identify()->loggedin ) { ?><span class="article-edit alignright"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span><?php } ?>

	<div class="spread-the-word">
		Spread the word:
		<?php echo $theme->display('social.spread-the-word'); ?>
	</div>

	<div class="fb-comments" style="padding-top: 20px; display: block; overflow: hidden;" data-width="100%" data-href="<?php echo $post->permalink; ?>" data-numposts="5" data-colorscheme="light"></div>

	<?php /*echo $theme->display('comments');*/ ?>

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
							<img src="<?php echo $item->info->photourl ? $item->info->photourl : Site::out_url('theme') . '/img/video-icon.png'; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/>
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
<?php echo $theme->display('sidebar.article.right'); ?>
<?php echo $theme->display('footer'); ?>
