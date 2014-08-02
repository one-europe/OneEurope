<?php echo $theme->display('header'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<b>Contact</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/imprint">Terms</a>
</div>
<article>
	<h1 class="on-page"><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<?php if (User::identify()->loggedin) { ?>
		<p><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
	<?php } ?>
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
			</noscript>.<br/>
			For public relations, please contact Ivan at
	 			<script type="text/javascript">
	 				emailE='one-europe.info'
	 				emailE=('ivan' + '@' + emailE)
	 				document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
	 			</script><noscript>
	 			    <em>[Email address protected by JavaScript. Enable JavaScript to see it.]<em>
	 			</noscript>.<br/>
			For fundraising and IT matters, please send an email to Cherian at
				<script type="text/javascript">
					emailE='one-europe.info'
					emailE=('cherian' + '@' + emailE)
					document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
				</script><noscript>
				    <em>[Email address protected by JavaScript. Enable JavaScript to see it.]<em>
				</noscript>.<br/>
			For anything related to editing, please e-mail Ana at
				<script type="text/javascript">
					emailE='one-europe.info'
					emailE=('ana' + '@' + emailE)
					document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
				</script><noscript>
				    <em>[Email address protected by JavaScript. Enable JavaScript to see it.]<em>
				</noscript>.
		</p>
	</div>
	<div style="clear: both; padding-top: 20px;">
		<div style="width: 100%;">
			<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/CompanyProfile" data-id="2916037" data-format="inline"></script>
		</div>
	</div>
</article>
<aside><?php echo $theme->display('sidebar.elem.social'); ?></aside>
<?php echo $theme->display('footer'); ?>