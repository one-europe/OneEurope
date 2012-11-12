<?php echo $theme->display('header'); ?>

			<div id="imprint">

				<article>
			
					<h1><?php echo $post->title_out; ?></h1>
				
					<section class="body"><?php echo $post->content_out; ?></section>

				</article>
				
				<?php if ( User::identify()->loggedin ) { ?>
						<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
				<?php } ?>
			</div>

<?php echo $theme->display ('footer'); ?>

