<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<b>About</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/team">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
</div>
<article>
	<h1 class="on-page"><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<p class="box"><a href="http://one-europe.info/join-us">Get involved! There are many ways of taking part ›</span></a></p>
</article>
<aside>
	<?php echo $theme->display('sidebar.elem.social-about'); ?>
	<?php echo $theme->display('sidebar.elem.linkedin-profile'); ?>
	<?php echo $theme->display('sidebar.elem.pinterest-board'); ?>
	<?php echo $theme->display('sidebar.elem.newsletter'); ?>
</aside>
<?php echo $theme->display ('footer'); ?>