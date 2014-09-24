<?php echo $theme->display('header'); ?>
<div class="post-list">
	<h1>Debates</h1>
	<?php foreach ( $debates as $post ) { ?>						
	<section>
		<div class="img-wrap">
			<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" />
		</div>
		<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
		<p><?php if ( $post->info->excerpt ) { echo $post->info->excerpt; } else { echo $post->content_out; } ?></p>
	</section>
	<?php } ?>
</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>