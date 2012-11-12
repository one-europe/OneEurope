<?php $theme->display( 'header'); ?>


			<section id="content">
				
				
				<?php if (isset($post)) : ?>
					
				
					<h2><?php _e('Search results for %s', array( htmlspecialchars( $criteria ) ) ); ?></h2>
				
				
					<?php foreach ( $posts as $post ) { ?>

						<article>
					
							<header>

								<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
								<h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>

								<?php if ( count( $post->tags ) > 0 ) { ?>
									<span class="entry-tags">in <?php echo $post->tags_out; ?><?php if ( $post->comments->count > 0 ) { ?> - <?php } ?>
								<?php } ?>

								<?php if ( $post->comments->count > 0 ) { ?>
									<a class="entry-comments" href="<?php echo $post->permalink; ?>#responses"><?php echo $post->comments->count; ?> Comments</a>
								<?php } ?>
									</span> 
								
								<?php /*<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>"></a> */ ?>

							</header>
					
							<section class="body"><?php echo $post->content_out; ?></section>

							<footer>

								<?php /* <span class="entry-autor"><span class="entry-meta">von</span> <?php $post->author->displayname; ?></span> */ ?>
							
								<span class="entry-comments"><span class="entry-meta">Kommentare</span> <?php $theme->comments_link($post); ?></span>

								<?php if ( is_array( $post->tags ) ) { ?>
									<span class="entry-tags"><span class="entry-meta">Tags</span> <?php echo $post->tags_out; ?></span>
								<?php } ?>

							</footer>
					
						</article>
				
					<?php } ?>
					
					<section id="page-selector">

						<?php $theme->prev_page_link(); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link(); ?>

					</section>
					
				<?php else : ?>
					
					<h2 class="nomatch"><?php _e('No results for'); ?> <?php echo htmlspecialchars( $criteria ); ?></h2>
				
				<?php endif; ?>


				
			</section>

<?php $theme->display ( 'sidebar' ); ?>


<?php $theme->display ('footer'); ?>

