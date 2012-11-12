<?php echo $theme->display('header'); ?>


			<div id="content">

				<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?>">
				
					<header>
						
						<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						<h1><a href="<?php echo $post->permalink; ?>" rel="bookmark" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>
						
					</header>
				
					<section class="body"><?php echo $post->content_out; ?></section>

					<footer>
						
							<div id="socialshareprivacy"></div>
						
							<?php if ( $show_author ) { ?>
								<span class="entry-autor"><?php _e( 'by %s', array( $post->author->displayname ) ); ?></span>
							<?php } ?>
	 					
							<?php if ( count( $post->tags ) > 0 ) { ?>
								<span class="entry-tags"> | tagged with: <?php echo $post->tags_out; ?> </span> 
							<?php } ?>
							
							<?php if ( User::identify()->loggedin ) { ?>
 								<span class="entry-edit"> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
							<?php } ?>

					</footer>
				
				</article>

<?php echo $theme->display ('comments'); ?>
				
			</div>

<?php echo $theme->display ('sidebar'); ?>


<?php echo $theme->display ('footer'); ?>

