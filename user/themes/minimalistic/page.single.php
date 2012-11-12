<?php $theme->display( 'header'); ?>


			<div id="content">

				<article>
										
					<section class="body"><?php echo $post->content_out; ?></section>

					<?php if ( $loggedin ) { ?>
					
						<footer>

							<span class="entry-edit"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					
						</footer>
					
					<?php } ?>
				
				</article>
				
			</div>

<?php $theme->display ( 'sidebar' ); ?>


<?php $theme->display ('footer'); ?>

