<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<!-- event.single -->
	<div id="content">
		<div id="primary" class="article-single">

    		<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?> plugticle">

				<header>
					<div class="metacat"><span><?php echo $post->info->metacat; ?></span></div>
					<hgroup>
						<h1><?php echo $post->title_out; ?></h1>
						<h2 class="excerpt"><?php echo $post->info->excerpt; ?></h2>
					</hgroup>
				</header>
				
				<section class="meta">
					
					<?php if ( $show_author ) { ?>
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


					<?php if ( User::identify()->loggedin ) { ?>
							<span class="article-edit"> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					<?php } ?>
					
					<?php /* ?><span><a class="alignright entry-comments" href="<?php echo $post->url ?>#disqus_thread">Comments</a></span> */ ?>


				</section>
				<section class="meta">
					
					<span class="alignright">&nbsp;| <span class="addthis_toolbox addthis_default_style"><a class="addthis_button_email tool-email">E-Mail</a></span></span>
					<span class="alignright"><a href="javascript:window.print()">Print</a></span>
					
					<span class="article-tags"><span class="label"><?php if ($post->tags_out) { ?>archived in:  <?php } ?>&nbsp;</span><?php echo $post->tags_out; ?> </span>
					
					<div class="clearfix"></div>
					
				</section>

				<section class="body">
					
					<?php if ($post->info->photourl) { ?>

						<figure>					
							<span class="license"><?php echo $post->info->photolicense; ?></span>
							<a href="<?php echo $post->info->photourl; ?>"><img alt="<?php echo $post->title; ?>" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" /></a>
							<figcaption>
								<span class="caption"><?php echo $post->info->photoinfo; ?></span>
							</figcaption>
						</figure>			

					<?php } ?>
				
					<?php echo $post->content_out; ?>
					
					<?php /*	
					TODO: 
					search for a solution to display the img/box "beneath the 1st paragraph",
					"above the last paragraph" etc.
					*/ ?>
					
				
				</section>
				
				<footer>
					
					<?php if ( $post->author->info->userfield_Description || $post->info->origauthor ) { ?>
						<section class="meta authorbox">
						
						
							<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
								
								This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 

								<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
								.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
								come from, with profile here if existing.<br /> */ ?>
	
							<?php } elseif ( $post->author->info->userfield_Description ) { ?>
								
								<span>
									<?php echo $post->author->info->userfield_Description; ?>
								</span>
						
							<?php } ?>
						
						</section>
					<?php } ?>
					
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
		
			<aside>
				
				<h3>Further Reading</h3>
			
			 	<ul class="meta similar-posts">
				
					<?php $list = Posts::get( array( 'content_type' => Post::type( 'article' ),
							'status' => Post::status( 'published' ),
							'limit' => 3,
							'vocabulary' => array('any' => $post->tags ),
							'not:id' => $post->id ) );
							foreach ($list as $item ) { ?>
							
							<li>

								<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $item->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>

								<header>

									<h3><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title; ?></a></h3>
									<!-- span class="entry-tags">
										<time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
										<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $item->permalink; ?>">Comments</a>
									</span -->

								</header>

								<article class="body"><?php echo $item->info->excerpt; ?></article>

								<footer>

										<?php /* if ( $show_author ) { ?><span class="entry-autor"><?php _e( 'by <span>%s</span>', array( $post->author->displayname ) ); ?> </span> <?php } */ ?>

								</footer>

							</li>
																			
					<?php } ?>
								
				</ul>
				
				<?php /* <div class="meta affiliated-posts">
				
					<span>{articles of affiliated sites?}</span>
				
					<ul>
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
					</ul>
				
				</div> */ ?>
				
			</aside>
		
			<aside class="disqus">
												
				<?php $theme->comments( $post ); ?>
		
			</aside>
		
		</div>

 	</div>

<!-- /event.single -->

<?php echo $theme->display ( 'sidebar.article.right' ); ?>

<?php echo $theme->display ( 'footer' ); ?>
