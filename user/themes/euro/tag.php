<?php echo $theme->display('header'); ?>


			<div id="content" class="tag">
				
				<h3>Everything tagged with "<?php echo $tag; ?>":</h3>
				
				<div class="tile-depth-1 list-1">					
			 		
			 		<?php // $posts = Posts::get( array( 'limit' => 15 ) );
			 		foreach ( $posts as $post ) { ?>						
             
			 			<div class="list">
                
			 				<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>
                
			 				<header>
			 			
			 			        <h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
			 			        <span class="entry-tags">
			 			            <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
			 			            <a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
			 			        </span>
                
			 				</header>
                
			 				<article class="body"><?php echo $post->content_out; ?></article>
                
			 				<footer>
                
			 			            <?php if ( $show_author ) { ?><span class="entry-autor"><?php _e( 'by <span>%s</span>', array( $post->author->displayname ) ); ?> </span> <?php } ?>
                
			 				</footer>
                
			 			</div>
             
			 		<?php } ?>	

				</div>
				
				<div id="page-selector">

					<?php $theme->prev_page_link(); ?> <?php $theme->page_selector( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?> <?php $theme->next_page_link(); ?>

				</div>
				
			</div>

<?php echo $theme->display ( 'sidebar' ); ?>


<?php echo $theme->display ('footer'); ?>

