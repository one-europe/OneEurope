<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact"><b>Contact</b></a></li>
		<li class="clear"></li>
	</ul>
</div>
<div class="page">
	<h1><?php echo $post->title_out; ?></h1>
	<article class="body"><?php echo $post->content_out; ?></article>
	<?php if (User::identify()->loggedin) { ?>
		<span class="article-edit right" style="width: 100%;">
			<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
		</span>
	<?php } ?>
	<section id="contact-email">
		<h3>E-Mail</h3>
		<p>For general information, questions, or ideas please contact 
			<script type="text/javascript">
				emailE='one-europe.info'
				emailE=('info' + '@' + emailE)
				document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
			</script><noscript>
			    <em>[Email address protected by JavaScript. Enable JavaScript to see it]<em>
			</noscript>.<br/>
			To apply for one of our many internships, send an informal application to
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
	 			</noscript>.
			<br/>
			For fundraising and IT matters, please send an email to Cherian at
				<script type="text/javascript">
					emailE='one-europe.info'
					emailE=('cherian' + '@' + emailE)
					document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
				</script><noscript>
				    <em>[Email address protected by JavaScript. Enable JavaScript to see it.]<em>
				</noscript>.
			<br/>
			For anything related to editing, please e-mail Ana at
				<script type="text/javascript">
					emailE='one-europe.info'
					emailE=('ana' + '@' + emailE)
					document.write('<A href="mailto:' + emailE + '">' + emailE + '</a>')
				</script><noscript>
				    <em>[Email address protected by JavaScript. Enable JavaScript to see it.]<em>
				</noscript>.
		</p>
	</section>
</div>
<?php echo $theme->display ('footer'); ?>