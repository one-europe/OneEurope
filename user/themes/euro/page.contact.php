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
	<h1>Contact</h1><br/>
	<p>OneEurope has been created and is still managed entirely by volunteers from all over Europe, for citizens all over Europe.<br/>
	OneEurope is for YOU, and so we would love to hear from you.<br/>
	YOUR ideas, questions, suggestions and queries guide our direction!</p>
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
	<p>...or to join the debate on the future of Europe follow us on our social media platforms (which you can see on the top right of this page), and join in the discussions.</p>
	<p>The future of Europe is in YOUR hands!</p>
</div>
<?php echo $theme->display ('footer'); ?>