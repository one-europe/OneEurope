<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<?php if ( $post ) { ?>
	
	
<!-- nibble.single -->
	<div id="content">
		
		<div class="breadcrumb">
			<span class="first"><a href="/in-brief">In Brief ›</a></span> <span class="brief-title"><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></span>

			<div class="pager">
				<?php if ($previous = $post->descend()): ?>
				<a class="prev" href="<?php echo $previous->permalink ?>" title="<?php echo $previous->title; ?>">« Previous</a>
				<?php endif; ?>
				<?php if ($post->ascend() && $post->descend()) : echo " | "; endif; ?>
				<?php if ($next = $post->ascend()): ?>
				<a class="next" href="<?php echo $next->permalink ?>" title="<?php echo $next->title; ?>">Next »</a>
				<?php endif; ?>
			</div>
		</div>
		<div id="main" class="article-single">

    		<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?> plugticle plugnibble">

				<header>
					<div class="metacat"><span><?php echo $post->info->metacat; ?></span></div>
					<hgroup>
						<h1><?php echo $post->title_out; ?></h1>
						<h2 class="excerpt"><?php echo $post->info->excerpt; ?></h2>
					</hgroup>
				</header>
				
				<section class="meta">
					
					<?php if ( $post->info->showauthor == 1 ) { ?>
						<span class="article-autor">
							
							<?php if ( $post->info->origsource ) { ?>
								<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="Portrait"><?php echo $post->info->origauthor; ?></a>
							<?php } else { 
								$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><?php echo $post->author->displayname; ?></a>
							<?php } ?>
							
						|</span>
					<?php } ?>

					<span class="article-lastmodified"><time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time></span>
					
					<?php /* ?><span><a class="alignright entry-comments" href="<?php echo $post->url ?>#disqus_thread">Comments</a></span> */ ?>
					

					<?php if ( User::identify()->loggedin ) { ?>
							<span class="alignright article-edit">&nbsp;| <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					<?php } ?>
					<span class="alignright">&nbsp;| <span class="addthis_toolbox addthis_default_style"><a class="addthis_button_email tool-email">E-Mail</a></span></span>
					<span class="alignright"><a href="javascript:window.print()">Print</a></span>
					
					<span class="article-tags"><span class="label"><?php if ($post->tags_out) { ?> | archived in:  <?php } ?>&nbsp;</span><?php echo $post->tags_out; ?> </span>
					
					<div class="clearfix"></div>
					
				</section>

				<section class="body">
				
					<figure>
						<a href="<?php echo $post->info->photourl; ?>" title="view image in new tab" target="_blank"><img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photocaption; ?>" /></a>
						<figcaption>
							<span class="license"><?php echo $post->info->photolicense; ?></span>
							<?php echo $post->info->photoinfo; ?>
						</figcaption>
					</figure>
					
					<?php echo $post->content_out; ?>
				
				</section>
				
				<footer>
					
					<?php if ( $post->author->info->userfield_Description || $post->info->origauthor ) { 
						if ( $post->info->showauthor == 1 ) { ?>
						<section class="meta authorbox">
						
							<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
								
								This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
	
							<?php } elseif ( $post->author->info->userfield_Description ) { ?>
								
								<span>
									<?php echo $post->author->info->userfield_Description; ?>
								</span>
						
							<?php } ?>
						
						</section>
					<?php }
					 	} ?>
					
					<section class="meta">
				
						<div class="printemail">

							<span><a href="javascript:window.print()">Print</a></span> | <span class="addthis_toolbox addthis_default_style"><a class="addthis_button_email tool-email">E-Mail</a></span>
							
							<?php if ( User::identify()->loggedin ) { ?>
									<span class="article-edit alignright"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
							<?php } ?>

						</div>
							
						<span class="spreadtheword">Spread the word:</span>
				
						<div class="addthis addthis_toolbox addthis_default_style ">

							<a class="addthis_button_pinterest_pinit"></a>
							<a class="addthis_button_facebook_send"></a>
							
							<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
							<a class="addthis_button_tweet" tw:count="vertical"></a>
							<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>	
							<a class="addthis_counter"></a>
						
						</div>
					
						<div class="clearfix"></div>
					
					</section>
				
				</footer>

			</article>
		
			<aside class="disqus">
												
				<?php $theme->comments( $post ); ?>
		
			</aside>
			
		</div>
		
	</div>
	<!-- /nibble.single -->



	<div id="sidebar" class="article-sidebar">

		<?php Plugins::act( 'theme_sidebar_top' ); ?>


		<?php /* implement http://wiki.habariproject.org/en/Dev:Theme_Areas */?>


		<?php /* <section class="">
			<div class="h"><span>Dossier: "Tag1"</span></div>

			... list of entries....

		</section> */ ?>

		<?php if ( $post->info->showauthor == 1 ) { ?>
			<section class="authorbox">
				<div class="h"><span>Author</span></div>

					<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) ); ?>

					<a href="<?php echo $publisher->permalink; ?>">
						<img src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
						<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
						<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
						<p>read more › </p>
						<div class="clear"></div>
					</a>
					
				<div class="clear"></div>

			</section>
		<?php } ?>

		<section class="fb">
			<div class="h"><span>Stay Tuned</span></div>

				<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="297" data-show-faces="true" data-stream="false" data-border-color="#eee" data-header="false"></div>

				<a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a>
				<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>

			</ul>
		</section>

		<section>
			<div class="h"><span>Newsletter</span></div>
			<p><big><a href="http://eepurl.com/pODn9" target="_blank">Sign up for our free newsletter! ›</a></big></p>
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


<?php } else { ?>
	
	<?php echo $theme->display ( '404msg' ); ?>
	
<?php } ?>

<?php echo $theme->display ( 'footer' ); ?>
