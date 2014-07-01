<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about"><b>About</b></a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a></li>
		<li class="clear"></li>
	</ul>
</div>
<div id="about-page">
	<div class="about">
		<div class="content">					
			<h1><?php echo $post->title_out; ?></h1>
			<article class="body"><?php echo $post->content_out; ?></article>
		</div>
		<div class="sharing">
			<div class="fb-like-box" data-href="http://www.facebook.com/oneeurope" data-width="365" data-height="185" data-border-color="#ddd" data-show-faces="true" data-stream="false" data-header="false"></div>
			<div style="padding: 10px 0 0 7px;"><a href="https://twitter.com/one1europe" class="twitter-follow-button">Follow @one1europe</a></div>
			<div style="overflow: hidden; text-align: center;">
				<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
				<script type="IN/CompanyProfile" data-id="2916037" data-format="inline"></script>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<ul class="contribute">
		<a href="http://one-europe.info/join-us"><h2>Get involved!<span class="sidenote">There are many ways of taking part ›</span></h2></a>
	</ul>
	<div class="clear"></div>
</div>
<?php echo $theme->display ('footer'); ?>