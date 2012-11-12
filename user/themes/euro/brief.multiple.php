<?php echo $theme->display('header'); ?>

			<div class="breadcrumb">
				<span class="first"><a href="/in-brief">In Brief ›</a></span>
			</div>

			<div id="content" class="home">
					
				<ul class="nibble-list">
				
					<?php foreach ($briefs as $post ) { ?>						

					<li class="nibble">

						<article>
						<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img class="img" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>
						</article>
						
						<aside>
							<h3><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h3>
							<p class="body">
								<?php echo $post->content_70; ?>
							</p>
							<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
							<span class="timestamp">posted on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time></span>
							<?php if ( User::identify()->loggedin ) { ?>
									<span class="alignright article-edit"> <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
							<?php } ?>
						
							<div class="addthis">
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
								<a class="addthis_button_tweet" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
								<a class="addthis_button_facebook_send" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
								<a class="addthis_button_pinterest_pinit" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
								<a class="addthis_counter addthis_pill_style" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						
								</div>
								<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
								<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>
								<!-- AddThis Button END -->
							</div>
						
						</aside>
						<div class="clear"></div>
					</li>

					<?php } ?>
					
				</ul>
		
			</div>

			<div id="sidebar" class="article-sidebar">

				<?php Plugins::act( 'theme_sidebar_top' ); ?>


				<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


				<?php /* <section class="">
					<div class="h"><span>Dossier: "Tag1"</span></div>

					... list of entries....

				</section> */ ?>

				<?php echo $profile->title; ?>

				<section class="fb">
					<div class="h"><span>Stay Tuned</span></div>

						<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="295" data-show-faces="true" data-stream="false" data-border-color="#eee" data-header="false"></div>

						<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
						<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>

					</ul>
				</section>

				<section>
					<div class="h"><span>Newsletter</span></div>
					<p><big><a href="http://eepurl.com/pODn9" target="_blank">Subscribe to our email newsletter ›</a></big></p>
				</section>
				
				<section class="disqusthreads">
					<div class="h"><span>Popular Threads</span></div>
					<div id="popularthreads" class="dsq-widget"><script type="text/javascript" src="http://oneeurope.disqus.com/popular_threads_widget.js?num_items=5"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
				</section>

				<section class="recentposts">
					<div class="h"><span>Recently Published</span></div>
					<ul>
						<?php
							foreach ($theme->recent_posts as $post) {
								echo '<li><a href="', $post->permalink, '">',
								$post->title, '</a></li>';
							}
						?>
					</ul>
				</section>


				<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

			</div>

		<?php echo $theme->display ('footer'); ?>

