<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/team">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<b>Contact</b>
</div>
<article>
	<h1 class="on-page"><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<div class="box" id="contact-email">
		<h2>E-Mail</h2>
		<p>For general information, questions, or ideas please contact 
			<script type="text/javascript">
				emailE='one-europe.info'
				emailE=('info' + '@' + emailE)
				document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
			</script><noscript>
			    <em>[Email address protected by JavaScript. Enable JavaScript to see it]<em>
			</noscript>.<br/>
			To apply for <a href="<?php Site::out_url( 'habari' ); ?>/join-us" title="One Europe internships list">one of our many internships</a>, send an informal application to
			<script type="text/javascript">
				emailE='one-europe.info'
				emailE=('applications' + '@' + emailE)
				document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
			</script><noscript>
			    <em>[Email address protected by JavaScript. Enable JavaScript to see it]<em>
			</noscript>.
		</p>
	</div>
	<?php if (User::identify()->loggedin) { ?>
		<p style="padding-top: 10px;"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
	<?php } ?>
	<div style="clear: both; padding-top: 20px;">
		<div style="float: left; width: 380px;">
			<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/CompanyProfile" data-id="2916037" data-format="inline"></script>
		</div>
		<div class="pinterest-board" style="float: left; padding-top: 5px;">
			<a data-pin-do="embedUser" href="http://www.pinterest.com/oneeurope/" data-pin-scale-width="77" data-pin-scale-height="260" data-pin-board-width="265">Visit One Europe's profile on Pinterest</a>
		</div>
	</div>
</article>
<aside><?php echo $theme->display('sidebar.elem.social'); ?></aside>
<?php echo $theme->display('footer'); ?>