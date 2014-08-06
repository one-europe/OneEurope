<?php echo $theme->display('header'); ?>
	
		<div class="featured-content">
			<div class="tabs featured-tabs">

			<?php
				$i = 1;	foreach ( $sliders as $post ) {	?>
			    <div id="fragment-<?php echo $i; ?>" class="ui-tabs-panel <?php if ( $i != 1 ) { ?>ui-tabs-hide<?php } ?> thumbs-home">
					<a href="<?php echo $post->permalink; ?>">
						<div class="img-wrap-f-large">
							<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" width="224" height="160" />
						</div>
	        			<div class="info">  
			    	    	<?php
							if ($post->info->excerpt) {
								$string = $post->info->excerpt;
							} elseif ($post->info->teaser) {
								$string = $post->info->teaser;
							} elseif ($post->info->photoinfo) {
								$string = $post->info->photoinfo;
							} else { $string = $post->info->shorttitle; }
							$string = trim($string);
							$text = (strlen($string) > 139) ? substr($string, 0, 138) . '..' : $string;
							echo $text; ?>
			    	    </div>  
					</a>
			    </div>  
				<?php $i++; } ?>
				<ul class="ui-tabs-nav">
					<?php 
					$i = 1; foreach ( $sliders as $post ) { 
						if ($post->info->shorttitle) {$title = $post->info->shorttitle; } else { $title = $post->title; };
			 			?>
					<li class="ui-tabs-nav-item <?php if ( $i == 1 ) { ?>ui-tabs-active<?php } ?>" id="nav-fragment-<?php echo $i; ?>">
						<a href="#fragment-<?php echo $i; ?>">
							<div class="img-wrap-f-small">
								<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->title; ?>" width="82" height="50" />
							</div>
							<p><?php echo $text = (strlen($title) > 55) ? substr($title, 0, 54) . '..' : $title; ?></p>
						</a>
					</li>  
					<?php $i++; } ?>
				</ul>
			</div>




			<div class="video">
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
				<a href="<?php echo Site::out_url( 'habari' ); ?>/videos" class="all" title="View more videos">View more videos ›</a>
			</div>




			<div class="pictures">
				<h2><a href="<?php echo Site::out_url( 'habari' ); ?>/in-brief" title="">The Big Picture</a></h2>
				<div class="wrap">
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
					<a href="<?php echo $brief->permalink; ?>">
					<div class="img-wrap-large"><img src="<?php echo $brief->info->photourl; ?>" alt="<?php echo $brief->title; ?>" width="224" /></div>
						<h3><?php echo $brief->title; ?></h3>
					</a>
					<?php } } ?>
				</div>
			</div>


		</div>


		<div class="home-content">

			<div class="post-list">
			<?php 
			foreach ($posts as $post ) {
				if ($post->content_type != 17) { ?>
				<section>
					<div class="img-wrap">
						<img src="<?php echo $post->info->photourl; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" width="160" />
					</div>
					<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
					<p><?php if ( $post->info->excerpt ) { echo strip_tags($post->info->excerpt, '<span><a>'); } else { echo strip_tags($post->content_out, '<span><a>'); }?></p>
					<p class="meta">
						<?php if ( $show_author && $post->typename == 'article' ) { ?>
							<?php if ( $post->info->origauthor ) { ?>
								<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title=""><?php echo $post->info->origauthor; ?></a>
							<?php } elseif ($post->info->author) { ?>
								<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title=""><?php echo User::get($post->info->author)->displayname; ?></a>
							<?php } else { 
									if (is_object(Post::get(array( 'all:info' => array( 'user' => $post->author->id ) )))) { 
										$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title=""><?php echo $post->author->displayname; ?></a>
									<?php } else { ?>
								<span><?php echo $post->author->displayname; ?></span>
									<?php } ?>
							<?php } ?>
						<?php } ?>
				        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
					</p>
					<div style="color: #fff;" class="fb-comments-count" data-href="<?php echo $post->permalink; ?>">0</div>
				</section>
			<?php }} ?>

				<div class="pagination">
					<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
					<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
					<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
				</div>

				<div class="social-buttons at-the-bottom">
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

		</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>