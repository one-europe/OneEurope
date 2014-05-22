<?php echo $theme->display('header'); ?>
	<div id="content" class="tag">
		<h2>Everything tagged with "<?php echo $tag; ?>":</h2>
		<span class="rss-feed-link alignright"><a href="<?php Site::out_url( 'home' )?>/tag/<?php echo $tag ?>/rss" title="subscribe to the RSS feed of this tag">RSS feed</a></span>
		</br>
		<div class="tile-depth-1 list-1 thumbs-list">					
		<?php foreach ($posts as $post ) { ?>
				<div class="list">
					<div class="img-wrap">
						<img src="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" />
					</div>
					<header>
						<h3><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h3>
					</header>
					<article class="body"><?php if ( $post->info->excerpt ) { echo $post->info->excerpt; } else { echo $post->content_out; } ?></article>
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
			<?php } ?>
		</div>
		<div id="page-selector">
			<?php echo $theme->prev_page_link( '&laquo;' . _t('Newer Posts') ); ?>
			<?php echo $theme->page_selector ( null, array( 'leftSide' => 20, 'rightSide' => 20 ) ); ?>
			<?php echo $theme->next_page_link( _t('&nbsp;Older Posts') . '&raquo;' ); ?>
		</div>
	</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>