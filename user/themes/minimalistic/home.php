<?php $theme->display( 'header'); ?>


			<div id="content">
				
					<?php foreach ( $posts as $post ) { ?>

					<article>
					
						<header>
							
							<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
							<h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
							
							<span class="entry-tags">
								<?php if ( count( $post->tags ) > 0 ) { ?>
									in <?php echo $post->tags_out; ?><?php if ( $post->comments->count > 0 ) { ?> - <?php } ?>
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
							
						</footer>
					
					</article>
				
				<?php } ?>


				<div id="page-selector">

					<?php $theme->prev_page_link(); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link(); ?>

				</div>
				
			</div>

<?php $theme->display ( 'sidebar' ); ?>


<?php $theme->display ('footer'); ?>

