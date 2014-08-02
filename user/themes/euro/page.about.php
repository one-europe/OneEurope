<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<b>About</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/imprint">Terms</a>
</div>
<article>
	<h1 class="on-page"><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<p class="box"><a href="http://one-europe.info/join-us">Get involved! There are many ways of taking part ›</span></a></p>
</article>
<aside>
	<div class="fb-like-box" data-href="http://www.facebook.com/oneeurope" data-width="294" data-height="235" data-border-color="#ddd" data-show-faces="true" data-stream="false" data-header="false"></div>
	<div style="padding: 10px 0 0 7px;"><a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a></div>
	<div style="clear: both; margin-left: -4px; margin-bottom: 15px;">
		<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
		<script type="IN/CompanyProfile" data-id="2916037" data-format="inline" data-width="300"></script>
	</div>
</aside>
<?php echo $theme->display ('footer'); ?>