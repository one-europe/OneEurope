<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<!-- <li><a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a></li> -->
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact"><b>Contact</b></a></li>
		<li class="clear"></li>
	</ul>
</div>
<div class="page" style="width: 655px; float: left; margin-right: 30px;">
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
	<div style="overflow: hidden;">
		<div style="width: 335px; float: left; padding-right: 20px;">
			<a class="twitter-timeline" height="303" data-dnt="true" href="https://twitter.com/One1Europe" data-widget-id="372098233318662144">Tweets by @One1Europe</a>
		</div>
		<div style="width: 300px; float: left;">
			<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
			<script type="IN/CompanyProfile" data-id="2916037" data-format="inline" data-width="300"></script>
		</div>
	</div>
</div>
<div style="width: 256px; float: left; margin: 20px 0 0 -1px; padding-bottom: 10px;">
	<section class="fb">
		<div class="h"><span>Connect with us</span></div>
		<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://one-europe.info/about"></a>
		<noscript><a href="http://flattr.com/thing/697920/OneEurope" target="_blank">
		<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
		<div class="g-plus-box">
			<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
			<g:plus href="https://plus.google.com/118353934830681553476" width="277"></g:plus>
		</div>
		<br/>
		<div class="fb-like-box" data-href="http://www.facebook.com/OneEurope" data-width="277" data-show-faces="true" data-stream="true" data-show-border="false" data-header="false"></div>
	</section>
</div>
<?php echo $theme->display('footer'); ?>