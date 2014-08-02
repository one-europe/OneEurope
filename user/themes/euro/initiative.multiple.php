<?php echo $theme->display('header'); ?>
<div class="post-list">
	<h1>Initiatives</h1>
	<?php foreach ( $initiatives as $post ) { ?>
	<section>
		<div class="img-wrap">
			<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" />
		</div>
		<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
		<p><?php if ( $post->info->excerpt ) { echo $post->info->excerpt; } else { echo strip_tags($post->content_out, '<span><a>'); } ?></p>
	</section>
	<?php } ?>
	<div class="pagination">
		<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
		<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
		<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
	</div>
</div>
<?php echo $theme->display('sidebar.initiatives'); ?>
<?php echo $theme->display('footer'); ?>