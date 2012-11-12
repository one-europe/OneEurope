<?php echo $theme->display ( 'header'); ?>

<!-- debate.single -->

	<div id="main" class="debate-single">
	
		<div id="post-<?php echo $post->id; ?>" class="primary <?php echo $post->statusname; ?>">

			<h1><?php echo $post->title; ?></h1>

			<figure>
				<img class="pic" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
				<figcaption>
						<span class="license"><?php echo $post->info->photolicense; ?></span>
						<?php echo $post->info->photoinfo; ?>
				</figcaption>
			</figure>

			<?php echo $post->content_out; ?>

			<?php if ( User::identify()->loggedin ) { ?>
					<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>

			<?php } ?>

			<div class="clear"></div>

		</div>
	
		<div class="secondary">
						
			<div class="tile-depth-1 list-1">
					
				<?php $id = $post->id;
				$posts = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'status' => 'published' ) );
				$count = $posts->count_all(); ?>
				
				<?php if ($count == 0) { ?>
					
					<br />
					<p class="message">There are no posts treating this topic yet.</p>
					<p class="message"><a href="http://one-europe.info/admin/publish?content_type=article">Please contribute!</a></p>
					<br/>
					
				<?php } ?>
				
				
				<?php foreach ( $posts as $post ) { ?>						

					<?php if ($post) { ?>

					<div class="list">

						<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>

						<header>
						
							<h1><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
							<span class="entry-tags">
								<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
								<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
							</span>

						</header>

						<article class="body">
						<?php if ( $post->info->excerpt ) {
								echo $post->info->excerpt; } 
							else {
								echo $post->content_out;
								}?>
						</article>

						<footer>

								<?php if ( $show_author ) { ?><span class="entry-autor"><?php _e( 'by <span>%s</span>', array( $post->author->displayname ) ); ?> </span> <?php } ?>

						</footer>

					</div>

					<?php } else { ?>

						There's been no contribution considering this topic yet.

					<?php } ?>

				<?php } ?>
				
			</div>
			
		</div>

	</div>
	

<!-- /debate.single -->

<?php echo $theme->display ( 'footer' ); ?>
