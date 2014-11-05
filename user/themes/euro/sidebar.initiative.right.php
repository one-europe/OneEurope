<aside>
	<?php echo $theme->display('sidebar.elem.newsletter'); ?>
	<?php echo $theme->display('sidebar.elem.made-in-europe'); ?>
	<?php if ( $post->info->url || $post->info->twitter ) { ?>
	<section class="side-block">
		<span class="top-link">More about this</span>
		<div class="empty">
			<?php if ($post->info->url) { ?><a href="<?php echo $post->info->url; ?>" title="visit website" target="_blank">› Official website of <?php echo $post->title; ?></a><br/><?php } ?>
			<?php if ($post->info->twitter) { ?><a href="http://twitter.com/<?php echo $post->info->twitter; ?>" title="<?php echo $post->title ?> on Twitter" target="_blank">› <?php echo $post->title ?> on Twitter</a><?php } ?>	
		</div>
	</section>
	<?php } ?>
	<?php if ( $post->info->more ) { ?>
	<section class="side-block">
		<span class="top-link">More</span>
		<div class="empty"><?php echo $post->info->more; ?></div>
	</section>
	<?php } ?>
	<?php echo $theme->display('sidebar.elem.social'); ?>
</aside>