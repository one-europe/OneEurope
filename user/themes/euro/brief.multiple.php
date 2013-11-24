<?php if ($matched_rule->name != 'display_briefs') {

	echo $theme->display('home');

} else { ?>

<?php echo $theme->display('header'); ?>

			<div class="breadcrumb">
				<span class="first"><a href="/in-brief">The Big Picture ›</a></span>
			</div>

			<div id="content" class="home">
					
				<ul class="nibble-list">
				
					<?php foreach ($briefs as $post ) { ?>						

					<li class="nibble">

						<?php if ( $post->status == Post::status('scheduled') ) { ?>
							<div class="content-badge scheduled">
								<span>scheduled</span>
							</div>
						<?php } ?>
						
						<article>
						<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img class="img" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>
						</article>
						
						<aside>
							<h3><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h3>
							<p class="body">
								<?php echo $post->content_out; ?>
							</p>
							<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
							<span class="timestamp">posted on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time></span>
							<?php if ( User::identify()->loggedin ) { ?>
									<span class="alignright article-edit"> <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
							<?php } ?>
						
							<div class="addthis">
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style add_this_multiple">
									<a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
									<a class="addthis_button_tweet" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
									<div class="scoopit-wrap"><a href="http://www.scoop.it" class="scoopit-button" scit-position="none" scit-url="<?php echo $post->permalink; ?>" >Scoop.it</a></div>
									<a class="addthis_button_pinterest_pinit" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
									<a class="addthis_counter addthis_pill_style" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
								</div>
								<!-- AddThis Button END -->
							</div>
						</aside>
						<div class="clear"></div>
					</li>

					<?php } ?>
					
				</ul>



				<?php if ( $current_page >= 2 || $all > $pagination ) { ?>

					<div class="pagination">
						<?php if ( $current_page >= 2 ) { ?>
							<a href="<?php Site::out_url( 'home' ); ?>/in-brief/page/<?php echo $current_page - 1; ?>" title="Previous Page" class="alignleft">&laquo; Newer Posts</a>
						<?php } if ( $all > $pagination ) { ?>
							<a href="<?php Site::out_url( 'home' ); ?>/in-brief/page/<?php echo $current_page + 1; ?>" title="Previous Page" class="alignright">Older Posts &raquo;</a>
						<?php } ?>
					</div>

				<?php } ?>

		
			</div>

		<?php echo $theme->display ('sidebar.nibble.right'); ?>

		<?php echo $theme->display ('footer'); ?>

<?php } ?>
