				<div class="clear"></div>
				
			</div>
				
			<div id="footwrap">
				
				<div id="footer">
	
					<div class="backtotop">
						<?php /* <a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow">feed<img src="<?php Site::out_url( 'theme' ); ?>/img/feed.png" alt="Atom" height="14" widht="14"/></a> */?>
						<a href="#top" id="up">top<img src="<?php Site::out_url( 'theme' ); ?>/img/up.png" alt="" height="20" width="20" /></a>
					
						<nav>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/about">About ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us ›</a></div>
							<!-- <div><a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate ›</a></div> -->
							<div><a href="<?php Site::out_url( 'habari' ); ?>/imprint">Legal ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/auth/login">Login ›</a></div>
						</nav>
					
					</div>
			
					<?php /* <div class="element ">
									
						<div class="license">
							<h3>Get Involved!</h3>
							<p style="display: block; margin: 0 0 -20px">See the different options for how to <a href="/join-us">become a stakeholder ›</a></br></br></p>
							
							<h3>Licensing</h3>
							<p>If not stated differently, all contents are distributed under a <a rel="nofollow" target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons License</a> (click for details)
							<a rel="nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url( 'theme' )?>/img/creative-commons-240x134.png" /></a>
							</p>
						</div>
					
					</div> */ ?>
			
					<div class="element partners">
						<h3>Partners</h3>
						<a href="http://debatingeurope.eu/" target="_blank" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/debatingeurope.png" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders" alt="Debating Europe – Discuss YOUR ideas with Europe’s leaders" height="136" width="250" /></a>
						<a href="http://www.democraticunion.eu/" target="_blank" title="Project for Democratic Union - One Future. One Europe"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/project-for-democratic-union.png" title="Project for Democratic Union - One Future. One Europe" alt="Project for Democratic Union - One Future. One Europe" height="83" width="250" /></a>
						<a href="http://www.treffpunkteuropa.de/" target="_blank" title="The New Federalist, webzine of the Young European Federalist"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/banner_tpe_oneeurope_1.png" title="The New Federalist, webzine of the Young European Federalist" alt="The New Federalist, webzine of the Young European Federalist" height="47" width="250" /></a>
					</div>
					
					<div class="element">

						<form id="contactForm" action="<?php Site::out_url('theme') ?>/mail.php" method="post">

							<div class="container">
								<h3>Say Hello</h3>
								<span>Want to get involved, give some feedback or found an error? No Problem! Drop us a line:</span>
							    <input id="senderName" placeholder="Name" name="senderName" required="required" type="text" />
							    <input id="senderEmail" placeholder="Email" name="senderEmail" required="required" type="email" />
							    <textarea id="message" name="message" required="required"></textarea>
							    <input id="sendMessage" type="submit" name="sendMessage" value="Send message" class="btn" />
								<div class="clear"></div>
							</div>

						</form>
						
					</div>
					<div class="clear">&nbsp;</div>
					
					<div style="margin: 0 auto; text-align: center"><p>Contact: info@one-europe.info | OneEurope<br/><br/></p></div>
					
				</div>
									
			</div>
			
			<div id="sendingMessage" class="statusMessage"><p>Sending your message.</p></div>
			<div id="successMessage" class="statusMessage"><p>Thanks for sending your message! We'll get back to you shortly.</p></div>
			<div id="failureMessage" class="statusMessage"><p>There was a problem sending your message. Please remove all contained "http://"s and try again.</p></div>
			<div id="incompleteMessage" class="statusMessage"><p>Please complete all the fields before sending.</p></div>
			
		<?php echo $theme->footer(); ?>

	<?php
	/*** 
	*
	*  In order to see DB profiling information:
	*  1. Insert this line in your config file: define( 'DEBUG', TRUE );
	*  2. Uncomment the followng line
	*
	***/
	// include 'db_profiling.php';
	?>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	<script src="http://www.scoop.it/button/scit.js" />
	
	<?php if (is_object($post)) { // only show disqus code if there is a post ?>
	<script>
		var disqus_shortname = 'oneeurope';
		var disqus_identifier = '<?php echo $post->id; ?>';
		var disqus_title = '<?php echo $post->title; ?>';
		var disqus_url = '<?php echo $post->permalink; ?>';
		var disqus_developer = 0; // or 1 based on if you're looking to skip URL authentication
		var disqus_thread = document.getElementById('disqus_thread');

		if (disqus_thread) {
			(function() {
				var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
				(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			})()
		}
	</script>
	<?php } ?>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-45021944-1', 'one-europe.info');
		ga('send', 'pageview');
	</script>

	<!-- scripts concatenated and minified via build script -->
	<script src="<?php Site::out_url( 'theme' ); ?>/js/plugins.js?<?php echo date_timestamp_get(date_create()); ?>"></script>
	<script src="<?php Site::out_url( 'theme' ); ?>/js/script.js?<?php echo date_timestamp_get(date_create()); ?>"></script>		
	<!-- end scripts -->
	
	</body>
</html>