<?php $theme->display( 'header'); ?>


			<div id="content">

				<article>
				
					<header>
						
						<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						<h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
						
						<?php if ( count( $post->tags ) > 0 ) { ?>
							<span class="entry-tags">in <?php echo $post->tags_out; ?></span> 
						<?php } ?>
												
						<?php /*<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>"></a> */ ?>

					</header>
				
					<section class="body"><?php echo $post->content_out; ?></section>

					<footer>
						
						<?php /* <ul>
							<li>
								<time class="entry-pubdate"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
							</li>
							<li>
								<?php if ( $show_author ) { ?>
									<span class="entry-autor"><span class="entry-meta">von</span> <?php $post->author->displayname; ?></span>
								<?php } ?>
							</li>
							<li>
								<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" title="Kommentare">Kommentare</a>
							</li>
							<li>
								<?php if ( count( $post->tags ) > 0 ) { ?>
									<span class="entry-tags">Tag<?php if ( count( $post->tags ) > 1) { ?>s<?php } ?>: <?php echo $post->tags_out; ?> - </span> 
								<?php } ?>
							</li>
							<li>
								<?php if ( $loggedin ) { ?>
									<span class="entry-edit"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
								<?php } ?>
							</li>
						</ul> 
											
						<nav>
							<?php if ( $previous = $post->descend() ): ?>
								<div class="left"> &laquo; <a href="<?php echo $previous->permalink ?>" title="<?php echo $previous->slug ?>"><?php echo $previous->title ?></a></div>
							<?php endif; ?>
							<?php if ( $next = $post->ascend() ): ?>
								<div class="right"><a href="<?php echo $next->permalink ?>" title="<?php echo $next->slug ?>"><?php echo $next->title ?></a> &raquo;</div>
							<?php endif; ?>
							<div class="clear"></div>
						</nav> */ ?>

					</footer>
				
				</article>

<?php $theme->display ('comments'); ?>
				
			</div>

<?php $theme->display ( 'sidebar' ); ?>


<?php $theme->display ('footer'); ?>

