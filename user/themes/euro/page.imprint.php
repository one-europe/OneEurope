<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/team">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
	<b>Terms</b>
</div>
<article class="full">
	<h1><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<?php if ( User::identify()->loggedin ) { ?>
		<p><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
	<?php } ?>
</article>
<?php echo $theme->display('footer'); ?>