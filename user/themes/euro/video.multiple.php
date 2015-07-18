<?php echo $theme->display('header'); ?>
	<div class="list-large">
		<h1>Videos</h1>
		<?php foreach ($videos as $post ) { ?>						
		<div class="item">
			<div class="item-video">
				<?php
					preg_match('/<iframe(.*?)>(.*?)<\/iframe>/si', strip_tags($post->content, '<iframe>'), $matches);
					$iframe = preg_replace(
						['/width=\"\d+\"/', '/height=\"\d+\"/', '/src=\"(.*?)\"/'],
						['width="400"', 'height="245"', 'src="${1}?modestbranding=1&rel=0&showinfo=0"'],
						$matches[0]
					);
					echo $iframe;
				?>
			</div>
			<div class="item-content">
				<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
				<p><?php echo strip_tags($post->content_out, '<span><a>'); ?></p>
				<p>Posted on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
					<?php if ( User::identify()->loggedin ) { ?>
						<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
					<?php } ?>
				</p>
				<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
					<a class="addthis_button_facebook" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_twitter" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_google_plusone_share" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_scoopit" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_pinterest_share" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_reddit" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_stumbleupon" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
					<a class="addthis_button_vk" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="pagination">
			<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
			<?php echo $theme->page_selector_videos(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
			<?php echo $theme->next_page_link_videos(_t('Next'), array('class' => 'next')); ?>
		</div>
	</div>
<?php echo $theme->display ('sidebar.nibble.right'); ?>
<?php echo $theme->display ('footer'); ?>