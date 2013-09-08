<?php echo $theme->display('header'); ?>
<div id="content" class="videos">
	<?php foreach ( $videos as $post ) { ?>
	<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
	<?php } ?>
	<?php if ( $current_page >= 2 || $there_are_more ) { ?>
		<div class="pagination">
			<?php if ( $current_page >= 2 ) { ?>
				<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page - 1; ?>" 
					title="Previous Page" class="alignleft">&laquo; Newer Videos</a>
			<?php } if ( $there_are_more ) { ?>
				<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page + 1; ?>" 
					title="Previous Page" class="alignright">Older Videos &raquo;</a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<?php echo $theme->display ('sidebar'); ?>
<?php echo $theme->display ('footer'); ?>