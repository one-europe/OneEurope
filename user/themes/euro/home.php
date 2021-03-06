<?php echo $theme->display('header'); ?>
	
		<div class="featured-content">
			<div class="tabs featured-tabs">

			<?php
				$sliders = Posts::get(array( 'content_type' => 'article', 'limit' => 4, 'status'=> 'published', 'orderby' => 'pubdate DESC'));
				$i = 1;	foreach ( $sliders as $post ) {
					$ignored_posts['articles'][] = $post->id;
			?>
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
					$latest_video = Posts::get(array( 'content_type' => array( 'video' ), 'limit' => 1, 'status'=>'published', 'orderby'=>'pubdate DESC'));
					$latest_video = $latest_video[0];
					preg_match('/<iframe(.*?)>(.*?)<\/iframe>/si', strip_tags($latest_video->content, '<iframe>'), $matches);
					$iframe = preg_replace(
						['/width=\"\d+\"/', '/height=\"\d+\"/', '/src=\"(.*?)\"/'],
						['width="305"', 'height="172"', 'src="${1}?modestbranding=1&amp;rel=0&amp;showinfo=0&amp;controls=0&amp;wmode=transparent"'],
						$matches[0]
					);
					echo $iframe . '<p><a href="' . $latest_video->permalink . '" title="' . $latest_video->title . '">' . $latest_video->title . '</a></p>';
				?>
				<a href="<?php echo Site::out_url( 'habari' ); ?>/videos" class="all" title="View more videos">View more videos ›</a>
			</div>

			<div class="pictures">
				<h2><a href="<?php echo Site::out_url( 'habari' ); ?>/eurographics" title="Eurographics">Eurographics</a></h2>
				<div class="wrap">
					<?php
						$briefsteaser = Posts::get(array( 'content_type' => 'brief', 'limit' => 4, 'status'=> 'published', 'orderby' => 'pubdate DESC'));
						foreach ($briefsteaser as $brief ) {
							$ignored_posts['briefs'][] = $brief->id;
					?>
					<a href="<?php echo $brief->permalink; ?>">
					<div class="img-wrap-large"><img src="<?php echo $brief->info->photourl; ?>" alt="<?php echo $brief->title; ?>" width="224" /></div>
						<h3><?php echo $brief->title; ?></h3>
					</a>
					<?php } ?>
				</div>
			</div>

		</div>

		<div class="home-content">

			<div class="post-list">
			<?php 

			$usersIds = array();
			foreach ($posts as $post ) {
				if ($post->info->author) $usersIds[$post->info->author] = User::get($post->info->author)->displayname;
			}

			foreach ($posts as $post ) { ?>
				<section class="<?php echo in_array($post->id, $ignored_posts['articles']) ? 'article-removed' : '' ?><?php echo in_array($post->id, $ignored_posts['briefs']) ? ' brief-removed' : '' ?>">
					<div class="img-wrap">
						<img src="<?php echo $post->info->photourl ? $post->info->photourl : Site::out_url('theme') . '/img/video-icon.png'; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" width="160" />
					</div>
					<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
					<p><?php echo $post->info->excerpt ? strip_tags($post->info->excerpt) : (isset($post->content_out) ? strip_tags($post->content_out) : ''); ?></p>
					<p class="meta">
						<?php if ( $show_author && $post->typename == 'article' ) { ?>
							by 
							<?php if ( $post->info->origauthor ) { ?>
								<span><?php echo $post->info->origauthor; ?></span>
							<?php } elseif ($post->info->author) { ?>
								<span><?php echo $usersIds[$post->info->author]; ?></span>
							<?php } else {
								$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );
								if (is_object($publisher)) { ?>
								<span><?php echo $post->author->displayname; ?></span>
									<?php } else { ?>
								<span><?php echo $post->author->displayname; ?></span>
									<?php } ?>
							<?php } ?>
						<?php } ?>
				        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						<?php /* <em>(<span title="Comments" class="fb-comments-count" data-href="<?php echo $post->permalink; ?>">0</span>)</em> */ ?>
					</p>
				</section>
			<?php } ?>

				<div class="pagination">
					<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
					<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
					<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
				</div>

				<?php echo $theme->display('social.buttons-bottom'); ?>

			</div>

		</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>