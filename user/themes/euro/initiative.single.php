<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<?php if ( $post ) { ?>
<!-- profile.single -->

	<div id="main" class="profile-single">

		<div id="profile">
	
			<div class="primary">

				<h1><?php echo $post->title; ?></h1>

				<div class="right-col">

					<img class="pic" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />

				</div>

	 			<div id="post-<?php echo $post->id; ?>" class="card <?php echo $post->statusname; ?>">

					<?php echo $post->content_out; ?>

					<?php if ( User::identify()->loggedin ) { ?>
							<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>

					<?php } ?>

				</div>

				<div class="clear"></div>

			</div>			
			
			<div class="secondary">
										
				<?php 
						
				$news = Posts::get( array('content_type' => Post::type('article'), 'nolimit' => true, 'status' => Post::status('published'), 'all:info' => array ('initiative' => $post->id ) ) ) ;
				$count = $news->count_all();
						
				?>
		
				<?php if ( $count > 0 ) { ?>
					
					<aside>
						
						<div class="h"><span>News about <?php echo $post->title; ?>:</span></div>					
					
						<div class="affiliated-posts tile-thumbs list-1">
		
							<?php foreach ($news as $item ) { ?>
														
								<div class="list">

									<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $item->info->photourl; ?>" alt="<?php echo $item->info->photoinfo; ?>" height="100" width="160"/></a>

									<header>

										<h3><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h3>
										<span class="entry-tags">
											<time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
											<a class="entry-comments" href="<?php echo $item->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $item->permalink; ?>">Comments</a>
										</span>

									</header>

									<article class="body"><?php echo $item->content_out; ?></article>

								</div>
									
							<?php } ?>
						
						</div>
						
					</aside>
						
				<?php } ?>															
			
			</div>
			
			<div class="disqus">

				<?php $theme->comments( $post ); ?>

			</div>
			
		</div>
	
<!-- /profile.single -->

<?php echo $theme->display ( 'sidebar.initiative.right' ); ?>

<?php } else { ?>
	
	<?php echo $theme->display ( '404msg' ); ?>
	
<?php } ?>

<?php echo $theme->display ( 'footer' ); ?>
