<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding">Crowdfunding ›</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron"><b>Become a Patron</b></a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a></li>
		<li class="clear"></li>
	</ul>
</div><img style="margin: 5px 0 15px;" src="<?php Site::out_url( 'theme' )?>/img/static/top-banner.png" width="950" height="124" />
<div class="content become-a-patron">
	<h1><?php echo $post->title_out; ?></h1>
	<article class="body"><?php echo $post->content_out; ?></article>
</div>
<?php if ( User::identify()->loggedin ) { ?>
	<span class="article-edit right">
		<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
	</span>
<?php } ?>
<?php echo $theme->display ('footer'); ?>