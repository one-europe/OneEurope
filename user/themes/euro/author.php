<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<!-- profile.single -->

	<div id="content">
		<div id="primary">

    		<article class="profilepage">

				<header>
					<div class="metacat"><span>Adresses</span></div>
					<hgroup>
						<h1><?php echo $post->author->displayname; ?></h1>
					</hgroup>
				</header>

				<section class="body">
					
					<div class="col-1">
					
						<img class="penis" src="<?php echo $author->info->photourl; ?>" />
						<a href="<?php echo $post->author->info->url; ?>" title="visit website"><?php echo $post->info->url; ?></a>	
							
					</div>									
					
					<div class="list-1">

						<?php
						$pages2 = Posts::get( array( 'content_type' => Post::type('article'), 'limit' => 2 ) );
						foreach ( $pages2 as $post ) { ?>						

						<article>

							<header>

								<h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
								<span class="entry-tags">
									<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
									<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
								</span>

							</header>

							<section class="body"><?php echo $post->content_out; ?></section>

							<footer>

									<?php if ( $show_author ) { ?><span class="entry-autor"><?php _e( 'by <span>%s</span>', array( $post->author->displayname ) ); ?> </span> <?php } ?>

							</footer>

						</article>

						<?php } ?>

					</div>
				
				
				</section>

			</article>
		
			<aside>
				
				<h3>All contents associated with <?php echo $post->title; ?>:</h3>
			
				<div class="meta affiliated-posts">
				
					<span>TODO: create dynamic list of everything either published by or tagged with
						"<?php echo $post->title; ?>".
					</span>
				
					<ul>
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
					</ul>
				
				</div>
				
			</aside>

		</div>

 	</div>

<!-- /event.single -->

<?php echo $theme->display ( 'sidebar.profile.right' ); ?>

<?php echo $theme->display ( 'footer' ); ?>
