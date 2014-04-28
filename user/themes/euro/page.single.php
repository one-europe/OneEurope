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
	<div class="sm-buttons at-the-bottom">
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
<?php echo $theme->display('sidebar'); ?>
<?php echo $theme->display('footer'); ?>