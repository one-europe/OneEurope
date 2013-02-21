<?php echo $theme->display('header'); ?>

			<div id="content" class="profiles">
								
				<!-- list of actions ordered by date	 -->				
				
				<div class="tile-depth-1 list-1">
						
					<?php
					foreach ( $initiatives as $post ) { ?>						

					<div class="list">

						<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a>

						<header>
							
							<h1><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h1>

						</header>

						<article class="body">
						<?php if ( $post->info->excerpt ) {
								echo $post->info->excerpt; } 
							else {
								echo $post->content_out;
								}?>
						</article>

					</div>

					<?php } ?>


							<?php if ( $current_page >= 2 || $there_are_more ) { ?>
								<div class="pagination">
									<?php if ( $current_page >= 2 ) { ?>
										<a href="<?php Site::out_url( 'home' ); ?>/initiatives/page/<?php echo $current_page - 1; ?>" title="Previous Page" class="alignleft">&laquo; Newer Initiatives</a>
									<?php }
									if ( $there_are_more ) { ?>
									<a href="<?php Site::out_url( 'home' ); ?>/initiatives/page/<?php echo $current_page + 1; ?>" title="Previous Page" class="alignright">Older Initiatives &raquo;</a>
									<?php } ?>
									<div class="clear"></div>
								</div>

							<?php } ?>
					
				</div>
		
			</div>

<?php echo $theme->display ('sidebar'); ?>

<?php echo $theme->display ('footer'); ?>

