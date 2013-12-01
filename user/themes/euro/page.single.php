<?php echo $theme->display('header'); ?>
<div id="content" class="page">
	<article>
		<header><h1><?php echo $post->title_out; ?></h1></header>
		<section><?php echo $post->content_out; ?></section>
		<footer>
		<?php if (User::identify()->loggedin) { ?>
			<span class="entry-edit">
				<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
			</span>
		<?php } ?>
		</footer>
	</article>
	<aside class="disqus"><?php $theme->comments($post); ?></aside>
</div>
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>