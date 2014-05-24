<?php echo $theme->display('header'); ?>
	<div class="featured-content">
		<div class="featured-content-slider">
			<div id="featured" >
				<ul class="ui-tabs-nav thumbs-home">
		        	<?php 
					// get all posts sys-tagged with 'featured-slideshow' to built the rotating menu
					$i = 1;
		        	foreach ( $sliders as $post ) { 
						if ($post->info->shorttitle) {$title = $post->info->shorttitle; } else { $title = $post->title; };
			 			?>
					<li class="ui-tabs-nav-item <?php if ( $i == 1 ) { ?>ui-state-active<?php } ?>" id="nav-fragment-<?php echo $i; ?>">
						<a href="#fragment-<?php echo $i; ?>">
							<div class="img-wrap-f-small"><img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" /></div>
							<p><?php echo $title; ?></p>
						</a>
					</li>  
					<?php $i++; } ?>
				</ul>  
				<?php // same as above
				$i = 1;	foreach ( $sliders as $post ) {	?>
			    <div id="fragment-<?php echo $i; ?>" class="ui-tabs-panel <?php if ( $i != 1 ) { ?>ui-tabs-hide<?php } ?> thumbs-home">
					<a href="<?php echo $post->permalink; ?>">
						<?php if ( $i == 1 ) { ?>
							<div class="img-wrap-f-large"><img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" /></div>
						<?php } else { ?>
							<div class="img-wrap-f-large"><img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" /></div>
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
			<div>
				<?php
					$video = $home_page_video[0];
					preg_match('/<iframe(.*?)>(.*?)<\/iframe>/si', strip_tags($video->content_fulltext, '<iframe>'), $matches);
					$iframe = preg_replace(
						['/width=\"\d+\"/', '/height=\"\d+\"/', '/src=\"(.*?)\"/'],
						['width="305"', 'height="172"', 'src="${1}?modestbranding=1&amp;rel=0&amp;showinfo=0&amp;controls=0&amp;wmode=transparent"'],
						$matches[0]
					);
					echo $iframe . '<p><a href="' . $video->permalink . '" title="' . $video->title . '">' . $video->title . '</a></p>';
				?>
				<a href="videos" class="all" title="View more videos">View more videos ›</a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="big-picture-home">
		<div class="initstitle"><a href="<?php echo Site::out_url( 'habari' ); ?>/in-brief" title="">The Big Picture</a></div>
		<div class="list-2 thumbs-list">
			<?php
				$i = 0; $j = 1;
				foreach ($briefsteaser as $brief ) {	
					// show only if not currently in the slideshow and if there aren't already two displayed
					$inslideshow = is_object( Post::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'slug' => $brief->slug ) ));
					if ( $inslideshow == true ) { 
						if ( $i < $nibblescount ) $i++;
					} elseif ( $j <= 4 ) {
						$j++;
			?>
				<div class="list<?php echo $j == 4 ? ' list-last' : ''; ?>">
				<?php if ( $brief->status == Post::status('scheduled') ) { ?>
					<div class="content-badge scheduled">
						<span>scheduled</span>
					</div>
				<?php } ?>
					<a href="<?php echo $brief->permalink; ?>">
					<div class="img-wrap-large"><img src="<?php echo $brief->info->photourl; ?>" width="224" alt="" /></div>
						<h2><?php echo $brief->title; ?></h2>
					</a>
				</div>
			<?php } } ?>
			<div class="clear"></div>
		</div>
	</div>
	<div id="content" class="home">
		<div class="tile-depth-1 list-1 thumbs-list">
			<?php 
			foreach ($posts as $post ) {
				if ($post->content_type != 17) { ?>
					<div class="list">
						<div class="img-wrap">
							<img src="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" width="160" />
						</div>
						<header><h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2></header>
						<article class="body"><?php if ( $post->info->excerpt ) { echo $post->info->excerpt; } else { echo $post->content_out; }?></article>
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
			<?php }} ?>
		</div>
		<div class="pagination">
			<?php echo $theme->prev_page_link( '&laquo;' . _t('Newer Posts') ); ?>
			<?php echo $theme->page_selector( null, array( 'leftSide' => 20, 'rightSide' => 20 ) ); ?>
			<?php echo $theme->next_page_link( _t('&nbsp;Older Posts') . '&raquo;' ); ?>
		</div>
		<div class="sm-buttons at-the-bottom on-home-page">
			<span>Find us on:</span>
			<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
			<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
			<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
			<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
			<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
			<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
			<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
			<a href="/feeds" class="icon-rs" title="Subscribe via RSS"></a>
		</div>
	</div>
<?php echo $theme->display ('sidebar'); ?>
<?php echo $theme->display ('footer'); ?>
