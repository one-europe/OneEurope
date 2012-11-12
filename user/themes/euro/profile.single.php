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
			
			<div class="primary">

				<h1><?php echo $displayname; ?></h1>

				<section class="right-col">
					
					<img class="pic" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
						
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
							<span><?php if ($post->info->url) { ?><a href="<?php echo $post->info->url; ?>" target="_blank" title="visit website">› Website</a></span><?php } ?><br/><?php echo $post->info->more; ?></span>
						</div>
					<?php } ?>

				</section>

	 			<section <?php if ( $post->info->user ) { ?> id="user-<?php echo $post->info->user ?>" <?php } else { ?> id="post-<?php echo $post->id; ?>" <?php } ?> class="card <?php echo $post->statusname; ?>">
										
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
						
												
							$items = Posts::get( array('content_type' => Post::type('article'), 'nolimit' => true, 'status' => Post::status('published'), 'user_id' => $post->info->user ) ) ;
							$count = $items->count_all();
						
							if ($count > 0 ) {
						
							?>
						
							<div class="h"><span><?php echo $post->title; ?>'s Posts:</span></div>					
								
							<div class="affiliated-posts tile-thumbs list-1">
					
									<?php foreach ($items as $item ) { ?>
																		
										<div class="list">

											<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $item->info->photourl; ?>" alt="<?php echo $item->info->photoinfo; ?>" height="100" width="160"/></a>

											<header>

												<h3><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h3>
												<span class="entry-tags">
													<time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
													<a class="entry-comments" href="<?php echo $item->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $item->permalink; ?>">Comments</a>
												</span>

											</header>

											<article class="body"><?php echo $item->info->excerpt; ?></article>

										</div>
													
									<?php } ?>
										
									<?php /* echo $theme->prev_page_link('&laquo;' . _t('Newer Posts') ); ?>
									<?php echo $theme->page_selector ( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?>
									<?php echo $theme->next_page_link('&raquo;' . _t('Older Posts') ); */ ?>
										
								</div>

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
