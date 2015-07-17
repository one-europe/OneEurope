<?php echo $theme->display('header'); ?>
<div class="post-list">
	<a class="rss" href="<?php Site::out_url( 'habari' ); ?>/tag/<?php echo $tag ?>/rss" title="Subscribe to the RSS feed of <?php echo $tag; ?> tag">RSS feed</a>
	<h1>Everything tagged with <em><?php echo $tag; ?></em></h1>
	<?php foreach ($posts as $post ) { ?>
		<section>
			<div class="img-wrap">
				<img src="<?php echo $post->info->photourl ? $post->info->photourl : Site::out_url('theme') . '/img/video-icon.png'; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" />
			</div>
			<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
			<p><?php if ( $post->info->excerpt ) { echo strip_tags($post->info->excerpt, '<span><a>'); } else { echo strip_tags($post->content_out, '<span><a>'); } ?></p>
			<p class="meta">
				<?php if ( $show_author && $post->typename == 'article' ) { ?>
					<?php if ( $post->info->origauthor ) { ?>
						<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="<?php echo $post->info->origauthor; ?>"><?php echo $post->info->origauthor; ?></a>
					<?php } elseif ($post->info->author) { ?>
						<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
						<a href="<?php echo $publisher ? $publisher->permalink : ''; ?>" title="<?php echo User::get($post->info->author)->displayname; ?>"><?php echo User::get($post->info->author)->displayname; ?></a>
					<?php } else { 
						$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
						<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $post->author->displayname; ?>"><?php echo $post->author->displayname; ?></a>
					<?php } ?>
				<?php } ?>
		        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
			</p>
		</section>
	<?php } ?>
	<div class="pagination">
		<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
		<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
		<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
	</div>
</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>