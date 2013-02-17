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
							<?php } elseif ($post->info->author) { ?>
								<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><?php echo User::get($post->info->author)->displayname; ?></a>
							<?php } else { 
									if (is_object(Post::get(array( 'all:info' => array( 'user' => $post->author->id ) )))) { 
										$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $post->author->displayname; ?></span></a>
									<?php } else { ?>
								<span><?php echo $post->author->displayname; ?></span>
									<?php } ?>
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
					

					<?php /*	Show an info sentence, if there is one (there can be one either as 'originfo', as that of the assigned author or
								as that of the actual author, each of which should first be looked up from their user table and then from their profile
								post table. */

							if ( $post->info->origauthor 
							|| ($post->author->info->description && !$post->info->author) 
							|| (Post::get(array('all:info' => array('user' => $post->author)))->info->description && !$post->info->author) 
							|| User::get($post->info->author)->info->description 
							|| Post::get(array('all:info' => array('user' => $post->info->author)))->info->description ) { ?>
					
						<section class="meta authorbox">
						
							<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
								
								This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 

								<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
								.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
								come from, with profile here if existing.<br /> */ ?>
	
							<?php } elseif ( User::get($post->info->author)->info->description ) { ?>

								<span>
									<?php echo User::get($post->info->author)->info->description; ?>
								</span>

							<?php } elseif ( Post::get(array('all:info' => array('user' => $post->info->author)))->info->description ) { ?>
								
								<span>
									<?php echo Post::get(array('all:info' => array('user' => $post->info->author)))->info->description; ?>
								</span>

							<?php } elseif ( !$post->info->author && $post->author->info->description ) { ?>
								
								<span>
									<?php echo $post->author->info->description; ?>
								</span>
						
							<?php } elseif ( !$post->info->author && Post::get(array('all:info' => array('user' => $post->author)))->info->description ) { ?>
			
								<span>
									<?php echo Post::get(array('all:info' => array('user' => $post->author)))->info->description; ?>
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
							
							<a class="addthis_button_reddit"></a>
							<a class="addthis_button_stumbleupon"></a>
							
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
				
				<h3>Further Reading:</h3>
			
			 	<div class="meta similar-posts list-1">
				
					<?php $list = Posts::get( array( 'content_type' => Post::type( 'article' ),
							'status' => Post::status( 'published' ),
							'order' => 'DESC',
							'limit' => 3,
							'vocabulary' => array('any' => $post->tags ),
							'not:id' => $post->id ) );
							foreach ($list as $item ) { ?>
							

							<div class="list">

								<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $item->info->photourl; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/></a>

								<header>
							
									<h3><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h3>


								</header>

								<article class="body">
								<?php if ( $item->info->excerpt ) {
								        echo $item->info->excerpt; } 
									else {
								        echo $item->content_out;
								        }?>
								</article>

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
							
					<div class="clear"></div>
	
				</div>

				<?php /* <div class="meta affiliated-posts">
				
					<span>{articles of affiliated sites?}</span>
				
					<ul>
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
					</ul>
				
				</div> */ ?>
				
				<div class="clear"></div>

			</aside>
		
			<aside class="disqus">
												
				<?php $theme->comments( $post ); ?>
		
			</aside>
		
		</div>

 	</div>

<!-- /event.single -->

<?php echo $theme->display ( 'sidebar.article.right' ); ?>

<?php echo $theme->display ( 'footer' ); ?>
