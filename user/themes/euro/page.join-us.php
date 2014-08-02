<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<b>Join us</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/imprint">Terms</a>
</div>
<article class="full">
	<h1>Get involved!</h1>
<!-- 	<div class="alignright" style="margin-top: -50px; width: 537px">
		<div class="addthis_toolbox addthis_default_style">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet"></a>
			<a class="addthis_button_pinterest_pinit"></a>
			<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
			<a class="addthis_button_linkedin_counter"></a>
			<a class="addthis_counter addthis_pill_style"></a>
		</div>
	</div> -->
	<div class="post-content"><?php echo $post->content; ?></div>
<!-- 	<div class="alignright" style="margin-top: -50px; width: 537px">
		<div class="addthis_toolbox addthis_default_style">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
			<a class="addthis_button_tweet"></a>
			<a class="addthis_button_pinterest_pinit"></a>
			<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
			<a class="addthis_button_linkedin_counter"></a>
			<a class="addthis_counter addthis_pill_style"></a>
		</div>
	</div> -->
</article>
<?php echo $theme->display ('footer'); ?>