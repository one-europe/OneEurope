<?php echo $theme->display( 'header'); ?>
<?php if ($post) { ?>
<article>
	<h1><?php echo $post->title; ?></h1>
	<div class="post-content">
		<figure>
			<img src="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
		</figure>
		<?php echo $post->content_out; ?>
		<?php if ( User::identify()->loggedin ) { ?>
			<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
		<?php } ?>
	</div>
	<div style="overflow: hidden;">
		<?php if (is_object($news)) {
			$count = $news->count_all();
				if ( $count > 0 ) { ?>
					<aside>
				        <div class="h"><span>News about <?php echo $post->title; ?>:</span></div>
				        <div class="affiliated-posts tile-thumbs list-1">
				        	<?php foreach ($news as $item ) { ?>
				        		<div class="list">
				        			<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php echo $item->info->photourl; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/></a>
				        			<header>
				        				<h2><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h2>
				        			</header>
				        			<article class="body"><?php if ( $item->info->excerpt ) { echo $item->info->excerpt; }  else { echo $item->content_out; }?></article>
				        			<footer>
				        				<span class="entry-tags">
				        			        <?php if ( $show_author && $item->typename == 'article' ) { ?>
				        						<span class="entry-autor">
				        							<?php if ( $item->info->origauthor ) { ?>
				        								<a href="<?php if ( $item->info->origprofile ) { echo $item->info->origprofile; } else { echo $item->info->origsource; } ?>" title="Portrait"><span><?php echo $item->info->origauthor; ?></span></a>
				        							<?php } elseif ($item->info->author) { ?>
				        								<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $item->info->author ) ) );?>
				        								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo User::get($item->info->author)->displayname; ?></span></a>
				        							<?php } else { 
				        								$publisher = Post::get(array( 'all:info' => array( 'user' => $item->author->id ) ) );?>
				        								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $item->author->displayname; ?></span></a>
				        							<?php } ?>
				        						</span>
				        					<?php } ?>
				        			        on <time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
				        				</span>
				        			        <a class="alignright entry-comments" href="<?php echo $item->permalink ?>#disqus_thread">Comments</a>
				        			</footer>
				        		</div>
				        	<?php } ?>
				        </div>
					</aside>
				<?php } ?>
		<?php } ?>														
	</div>

	<div class="spread-the-word">
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
<?php echo $theme->display('sidebar.initiative.right'); ?>
<?php } else { ?>
	<?php echo $theme->display('404msg'); ?>
<?php } ?>
<?php echo $theme->display('footer'); ?>