<?php if ($matched_rule->name != 'display_briefs') {
	echo $theme->display('home');
} else { ?>
<?php echo $theme->display('header'); ?>
	<div class="list-large">
		<h1>Eurographics</h1>
		<?php foreach ($briefs as $post ) { ?>						
		<div class="item">
			<a class="item-image" href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>">
				<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" />
			</a>
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
			<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
			<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
		</div>
	</div>
<?php echo $theme->display('sidebar.nibble.right'); ?>
<?php echo $theme->display('footer'); ?>
<?php } ?>