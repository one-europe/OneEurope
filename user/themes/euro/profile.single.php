<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<?php if ( $post ) { ?>
	
	<?php // about to be changed ... $source doesn't make sense when I want to first check the former and then the latter.
	if ($post->info->user) {
		$source = User::get_by_id($post->info->user)->info;
		$displayname = User::get_by_id($post->info->user)->displayname;
 	} else {
		$source = $post->info;
		$displayname = $post->title;
	}?>

<!-- profile.single -->

	<div id="main" class="profile-single">

		<?php /* div class="submenu">
			<ul>
				<li><a href="/about"><b>About</b></a></li>
				<li><a href="/join-us">Join us</a></li>
				<li><a href="/contact">Contact</a></li>
				<li class="clear"></li>
			</ul>
		</div */ ?>

		<div id="profile">
			
			<div class="primary vcard">

				<h1 class="fn"><?php echo $displayname; ?></h1>

				<section class="right-col">
					
					<img class="pic photo" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
						
					<div class="social">
					
						<?php if ($source->twitter) { ?>
							<a href="https://twitter.com/<?php echo $source->twitter; ?>" class="twitter-follow-button" data-show-screen-name="false" data-lang="en">Follow</a>
							<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
						<?php } elseif ($post->info->twitter) { ?>
							<a href="https://twitter.com/<?php echo $post->info->twitter; ?>" class="twitter-follow-button" data-show-screen-name="false" data-lang="en">Follow</a>
							<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
						<?php } ?>
						
						<?php if ($source->fbsubscribe) { ?>
							<iframe src="//www.facebook.com/plugins/subscribe.php?href=<?php echo $source->fbprofile; ?>&amp;layout=button_count&amp;show_faces=true&amp;colorscheme=light&amp;font&amp;width=450&amp;appId=119694238052762" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height: 21px;" allowTransparency="true"></iframe>
						<?php } elseif ($source->fbpage) { ?>
							<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $source->fbpage; ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21&amp;appId=121944181248560" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:21px;" allowTransparency="true"></iframe>
						<?php } elseif ($post->info->fbsubscribe) { ?>
							<iframe src="//www.facebook.com/plugins/subscribe.php?href=<?php echo $post->info->fbprofile; ?>&amp;layout=button_count&amp;show_faces=true&amp;colorscheme=light&amp;font&amp;width=450&amp;appId=119694238052762" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height: 21px;" allowTransparency="true"></iframe>
						<?php } elseif ($post->info->fbpage) { ?>
							<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $post->info->fbpage; ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21&amp;appId=121944181248560" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:21px;" allowTransparency="true"></iframe>
						<?php } ?>
					
					</div>
					<?php if ( $source->url || $source->more ) { ?>
						<div class="info">
							<span><?php if ($source->url) { ?><a href="<?php echo $source->url; ?>" target="_blank" title="visit website">› Website</a></span><?php } ?><br/><?php echo $source->more; ?></span>
						</div>
					<?php } elseif ( !($source->url && $source->more) && $post->info->url || $post->info->more ) { ?>
						<div class="info">
							<span><?php if ($post->info->url) { ?><a class="url" href="<?php echo $post->info->url; ?>" target="_blank" title="visit website">› Website</a></span><?php } ?><br/><?php echo $post->info->more; ?></span>
						</div>
					<?php } ?>

				</section>

	 			<section <?php if ( $post->info->user ) { ?> id="user-<?php echo $post->info->user ?>" <?php } else { ?> id="post-<?php echo $post->id; ?>" <?php } ?> class="note card <?php echo $post->statusname; ?>">
										
							<?php if ($post->info->user) { 
								if ($source->content) {
									echo $source->content;
								} else {
									echo $post->content_out;
								}
							} else { 
								echo $post->content_out; 
							}
							if ($post->info->user == 0) { ?>
								<time datetime="<?php echo $post->modified->text_format('{Y}-{m}-{d}'); ?>">last modified on <?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
							<?php } ?>
					
				</section>
			
			
				<?php if ( User::identify()->loggedin ) { 
					if ( $post->info->user == 0 ) { ?>
						<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					<?php } else { ?>
						<p class="profile-edit right">
							<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>">Edit original Entry</a>
							| <a href="http://one-europe.info/admin/user/<?php echo User::get_by_id($post->info->user)->username; ?>">Edit User</a>
						</p>
					<?php } 
				} ?>
				
				
				<div class="clear"></div>
		
			</div>
					
			<div class="secondary">
								
				<aside>
					
					<?php if ( $post->info->user == '0' ) { ?>
						
						<p class="message">This is you or your organisation? <a href="/contact">Get in touch</a> to edit it yourself.</p>
						
					<?php } else { ?>
						
						
						<?php 
						
											
							// exclude all that are by me but where I added an author
							$i = 0;
							foreach ($pieces as $piece) {
								if ( $piece->info->author && $piece->info->author != $post->info->user && $piece->info->author != 0 ) {$i++;}
							}

							$count = $pieces->count_all() - $i;

							if ($count > 0 ) {
						
							?>
						
								<div class="h"><span><?php echo $post->title; ?>'s Posts:</span></div>					
								
								<div class="affiliated-posts tile-thumbs list-1">
					
									<?php foreach ($pieces as $piece ) { ?>
															
										<?php if (!$piece->info->author || $piece->info->author == $post->info->user || $piece->info->author == 0 ) { ?>
			

							<div class="list">

								<a href="<?php echo $piece->permalink; ?>" title="<?php echo $piece->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $piece->info->photourl; ?>" alt="<?php if ( $piece->info->photoinfo ) { echo $piece->info->photoinfo; } else { echo $piece->title; } ?>" height="100" width="160"/></a>

								<header>
							
									<h2><a href="<?php echo $piece->permalink; ?>" title="<?php echo $piece->title; ?>"><?php echo $piece->title_out; ?></a></h2>


								</header>

								<article class="body">
								<?php if ( $piece->info->excerpt ) {
								        echo $piece->info->excerpt; } 
									else {
								        echo $piece->content_out;
								        }?>
								</article>

								<footer>
						
									<span class="entry-tags">
								        <?php if ( $show_author && $piece->typename == 'article' ) { ?>

											<span class="entry-autor">
												<?php if ( $piece->info->origauthor ) { ?>
													<a href="<?php if ( $piece->info->origprofile ) { echo $piece->info->origprofile; } else { echo $piece->info->origsource; } ?>" title="Portrait"><span><?php echo $piece->info->origauthor; ?></span></a>
												<?php } elseif ($piece->info->author) { ?>
													<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $piece->info->author ) ) );?>
													<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo User::get($piece->info->author)->displayname; ?></span></a>
												<?php } else { 
													$publisher = Post::get(array( 'all:info' => array( 'user' => $piece->author->id ) ) );?>
													<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $piece->author->displayname; ?></span></a>
												<?php } ?>
											</span>

										<?php } ?>

								        on <time datetime="<?php echo $piece->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $piece->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
									</span>
								        <a class="alignright entry-comments" href="<?php echo $piece->permalink ?>#disqus_thread">Comments</a>

								</footer>

							</div>
										
										<?php } ?>
													
									<?php } ?>
										
								</div>		
		
								<div class="clear"></div>

								<?php if ( $current_page >= 2 || $there_are_more ) { ?>
									<div class="pagination">
										<?php if ( $current_page >= 2 ) { ?>
											<a href="<?php Site::out_url( 'home' ); ?>/profiles/<?php echo $post->slug; ?>/page/<?php echo $current_page - 1; ?>" title="Previous Page" class="alignleft">&laquo; Newer Posts</a>
										<?php }
										if ( $there_are_more ) { ?>
										<a href="<?php Site::out_url( 'home' ); ?>/profiles/<?php echo $post->slug; ?>/page/<?php echo $current_page + 1; ?>" title="Previous Page" class="alignright">Older Posts &raquo;</a>
										<?php } ?>
									</div>

								<?php } ?>

							<?php } else { ?>
						
								<p class="message"><?php echo $post->title; ?> hasn't published anything yet.</p>
						
							<?php } ?>
																	
					<?php } ?>

				</aside>
		
			</div>
			
		</div>	

<!-- /profile.single -->

<?php echo $theme->display ( 'sidebar.profile.right' ); ?>

<?php } else { ?>

	<?php echo $theme->display ( '404msg' ); ?>

<?php } ?>

<?php echo $theme->display ( 'footer' ); ?>
