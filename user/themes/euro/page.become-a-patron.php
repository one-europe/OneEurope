<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/team">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<b>Become a Patron</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
</div>
<article class="full">
	<h1><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
</article>
<?php if ( User::identify()->loggedin ) { ?>
	<p><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
<?php } ?>
<?php echo $theme->display ('footer'); ?>