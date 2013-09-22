<?php echo $theme->display('header'); ?>

			<div class="featured-content">

				<div class="featured-content-slider">
			
					<div id="featured" >
												
						<ul class="ui-tabs-nav">
				        	<?php 
							// get all posts sys-tagged with 'featured-slideshow' to built the rotating menu
							$i = 1;
				        	foreach ( $sliders as $post ) { 
								if ($post->info->shorttitle) {$title = $post->info->shorttitle; } else { $title = $post->title; };
					 			?>
                                  
							<li class="ui-tabs-nav-item <?php if ( $i == 1 ) { ?>ui-tabs-selected<?php } ?>" id="nav-fragment-<?php echo $i; ?>">
								<a href="#fragment-<?php echo $i; ?>">
									<img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" />
									<p><?php echo $title; ?></p>
								</a>
							</li>  
								
							<?php $i++; } ?>
							
						</ul>  
						
						<?php // same as above
						$i = 1;	foreach ( $sliders as $post ) {	?>
					    <div id="fragment-<?php echo $i; ?>" class="ui-tabs-panel <?php if ( $i != 1 ) { ?>ui-tabs-hide<?php } ?>" style="">
							<a href="<?php echo $post->permalink; ?>">
								<?php if ( $i == 1 ) { ?>
									<img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" />  
								<?php } else { ?>
									<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" />  
								<?php } ?>
			        			<div class="info">  
					    	    	<?php // show caption or excerpt in 155 characters length or 152 + '...'
									if ($post->info->excerpt) {
										$string = $post->info->excerpt;
									} elseif ($post->info->teaser) {
										$string = $post->info->teaser;
									} elseif ($post->info->photoinfo) {
										$string = $post->info->photoinfo;
									} else { $string = ""; }
									$text = (strlen($string) > 155) ? substr($string,0,153).'...' : $string;
									echo $text; ?>
					    	    </div>  
							</a>
					    </div>  
						<?php $i++; } ?>
	
					</div>
				
				</div>

				<div class="featured-content-boxes video-block">

					<div style="video-item">
						<?php
							$video = $home_page_video[0];
							preg_match('/<iframe(.*?)>(.*?)<\/iframe>/si', strip_tags($video->content_fulltext, '<iframe>'), $matches);
							$iframe = preg_replace(
								['/width=\"\d+\"/', '/height=\"\d+\"/', '/src=\"(.*?)\"/'],
								['width="305"', 'height="187"', 'src="${1}?modestbranding=1&rel=0&showinfo=0&controls=0"'],
								$matches[0]
							);
							echo $iframe . '<p><a href="' . $video->permalink . '" title="' . $video->title . '">' . $video->title . '</a></p>';
						?>
						<a href="videos" class="all" title="View more videos">View more videos ›</a>
					</div>
					
					<?php /* div class="boxtitle"><span class="inits">Welcome to OneEurope!</span></div>
	
						<p>
							We will fill a crucial gap as a hub for information about organized European civil 
							action online and independent journalism from a European perspective.
						</p>
						<p>
							We keep an eye on civil initiatives, cross-border debates and online discussions 
							in order to embed it all into a highly interactive platform.
						</p>
						<p>
							Learn how to <a title="Join us!" href="/join-us">join us on our journey</a>.
						</p>	
	
						<?php /*php
						foreach($sides as $post):
						if ($post->info->shorttitle) {$title = $post->info->shorttitle; } else { $title = $post->title; };
						echo '<div class="box">';
						echo '<h4><a href="' . $post->permalink .'">' . $title . '</a></h4>';
						echo '<a href="' . $post->permalink .'"><section class="excerpt">' . $post->info->excerpt . '</section></a>';
						echo '</div>'; ?>
						<?php endforeach; */?>							

				</div>
				
				<div class="clear"></div>

			</div>

			<div style="width: 100%;">
			
				<div class="initstitle"><a href="<?php echo Site::out_url( 'habari' ); ?>/in-brief" title="">The Big Picture</a></div>

				<div class="list-2">
											
					<?php
			$i = 0; $j = 1;
			foreach ($briefsteaser as $brief ) { 	


/*				echo '<pre>'; print_r($brief->info->shorttitle); echo '</pre>';
				exit;*/
				/* 
				show only if not currently in the slideshow and if there aren't already two displayed
				*/	
				$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $brief->slug ) ));
				if ( $inslideshow == true ) { 
					if ( $i < $nibblescount ) {
						$i++;
						//echo $brief->title . " is featured</br>";
					}
				} elseif ( $j <= 4 ) {
					$j++;
				?>
		
					<div class="list">						
						<?php if ( $brief->status == Post::status('scheduled') ) { ?>
							<div class="content-badge scheduled">
								<span>scheduled</span>
							</div>
						<?php } ?>
			   	    	<a href="<?php echo $brief->permalink; ?>">
							<div class="img-wrap"><img src="<?php echo $brief->info->photourl; ?>" width="224" /></div>
			   	    		<h2><?php echo $brief->title; ?></h2>
						</a>
					</div>   	    

				<?php /* span class="entry-autor">by <span><?php echo $post->author->displayname; ?></span></span> */ ?>
			<?php }
			} ?>
					
					<div class="clear"></div>
					
				</div>
			</div>

			<div id="content" class="home">

				<!-- last actions -->				
				
				<?php /*div class="tile-depth-1 tile-thumbs">

					<?php $feats = Posts::get( array( 'content_type' => 'action', 'status' => Post::status( 'published' ), 'limit' => 4 ) );
					foreach ($feats as $post ) { ?>
						
						<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>" class="tile-depth-2-v1">
					
							<section>

									<?php if ($post->info->photourl) { ?>
										<img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" />
									<?php } ?>
									<h2><?php echo $post->title_out; ?></h2>
									<span class="entry-tags">
										<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
										<!-- a class="entry-comments" href="<?php echo $post->url; ?>#disqus_thread" data-disqus-identifier="<?php echo $page; ?><?php echo $post->permalink; ?>">Comments</a -->
									</span>
	
							</section>
						
						</a>
					<?php } ?>
								

				</div */ ?>	

			
				<div class="tile-depth-1 list-1">
				
					<?php 
					
					
					
					$i = 0;
					$j = 0;
					$h = 0;
					
					/* 
					in case this post is featured, hide it. 
					do this by looking up how many articles are in the slideshow.
					hide as many slideshow-systagged articles in the main loop.
					*/
					foreach ($posts as $post ) {
						if ($post->content_type != 17) {
						
						$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $post->slug ) ));
						$isbrief = is_object( Post::get( array( $post->typename => 'brief', 'slug' => $post->slug ) ) );

						if ( $inslideshow == true && $i < $articlescount ) { 
								$i++; $j++; /*?>
								
								<div class="list"><h1><?php echo $post->title . " is $i. of $articlescount featured.</br>";?></h1></div>
								
						<?php*/ } elseif ( $isbrief == true && $h <= 1 ) { $h++; // avoid duplicate display of the first two briefs in the sidebar
							 /*?>

								<div class="list"><h1><?php echo $post->title . " is $h. of 2 briefs.</br>";?></h1></div>


						<?php*/ } else {
							$j++;

						?>						

							<div class="list">

								<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" height="100" width="160"/></a>

								<header>
							
									<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>


								</header>

								<article class="body">
								<?php if ( $post->info->excerpt ) {
								        echo $post->info->excerpt; } 
									else {
								        echo $post->content_out;
								        }?>
								</article>

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
														if (is_object(Post::get(array( 'all:info' => array( 'user' => $post->author->id ) )))) { 
															$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
													<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $post->author->displayname; ?></span></a>
														<?php } else { ?>
													<span><?php echo $post->author->displayname; ?></span>
														<?php } ?>
												<?php } ?>
											</span>

										<?php } ?>

								        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
									</span>
	        						<a class="alignright entry-comments" href="<?php echo $post->permalink ?>#disqus_thread">Comments</a>

								</footer>

							</div>

					<?php }
						}}
					?>
					
				</div>
		
				<div class="pagination">
					<?php echo $theme->prev_page_link( '&laquo;' . _t('Newer Posts') ); ?>
					<?php echo $theme->page_selector ( null, array( 'leftSide' => 20, 'rightSide' => 20 ) ); ?>
					<?php echo $theme->next_page_link( _t('&nbsp;Older Posts') . '&raquo;' ); ?>
				</div>
		
			</div>

<?php echo $theme->display ('sidebar'); ?>


<?php echo $theme->display ('footer'); ?>

