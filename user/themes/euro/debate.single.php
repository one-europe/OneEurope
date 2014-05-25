<?php echo $theme->display ( 'header'); ?>
	<div id="main" class="debate-single">
		<div id="post-<?php echo $post->id; ?>" class="primary <?php echo $post->statusname; ?>">
			<h1><?php echo $post->title; ?></h1>
			<figure>
				<img class="pic" src="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
				<figcaption>
						<span class="license"><?php echo $post->info->photolicense; ?></span>
						<?php echo $post->info->photoinfo; ?>
				</figcaption>
			</figure>
			<?php echo $post->content_out; ?>
			<?php if ( User::identify()->loggedin ) { ?>
					</br></br><span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
			<?php } ?>
			<div class="clear"></div>
			<section class="share">
				<div class="h"><span>Share this debate</span></div>
				<div class="addthis addthis_toolbox addthis_default_style add_this_multiple">
					<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
					<a class="addthis_button_tweet" tw:count="vertical"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>	
					<a class="addthis_counter"></a>
					<div class="scoopit-wrap"><a href="http://www.scoop.it" class="scoopit-button" scit-position="none" scit-url="<?php echo $post->permalink; ?>" >Scoop.it</a></div>
					<a class="addthis_button_pinterest_pinit"></a>
					<a class="addthis_button_print"></a>
					<a class="addthis_button_reddit"></a>
					<a class="addthis_button_stumbleupon"></a>
				</div>
			</section>
		</div>
		<div class="secondary">
			<div class="tile-depth-1 list-1 thumbs-list">
				<?php $id = $post->id;
				$posts = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'status' => 'published' ) );
				$count = $posts->count_all(); ?>
				<?php if ($count == 0) { ?>
					<br />
					<p class="message">There are no posts treating this topic yet.</p>
					<p class="message"><a href="http://one-europe.info/admin/publish?content_type=article">Please contribute!</a></p>
					<br/>
				<?php } ?>
				<?php foreach ($posts as $post ) { ?>
					<?php if ($post) { ?>
						<div class="list">
							<div class="img-wrap">
								<img src="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" />
							</div>
							<header>
								<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
							</header>
							<article class="body"><?php if ( $post->info->excerpt ) { echo strip_tags($post->info->excerpt, '<p>'); } else { echo strip_tags($post->content_out, '<p>'); } ?></article>
							<footer>
								<span class="entry-tags">
							        <?php if ( $show_author && $post->typename == 'article' ) { ?>
										<span class="entry-autor">
											<?php if ( $post->info->origauthor ) { ?>
												<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="Portrait"><span><?php echo $post->info->origauthor; ?></span></a>
											<?php } elseif ($post->info->author) { ?>
												<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
												<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo User::get($post->info->author)->displayname; ?></span></a>
											<?php } else { 
												$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
												<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $post->author->displayname; ?></span></a>
											<?php } ?>
										</span>
									<?php } ?>
							        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
								</span>
							        <a class="alignright entry-comments" href="<?php echo $post->permalink ?>#disqus_thread">Comments</a>
							</footer>
						</div>
					<?php } else { ?>There's been no contribution considering this topic yet.<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php echo $theme->display('footer'); ?>