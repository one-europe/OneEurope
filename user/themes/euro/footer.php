				<div class="clear"></div>
				
			</div>
				
			<div id="footwrap">
				
				<div id="footer">
	
					<div class="backtotop">
						<?php /* <a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow">feed<img src="<?php Site::out_url( 'theme' ); ?>/img/feed.png" alt="Atom" height="14" widht="14"/></a> */?>
						<a href="#top" id="up">top<img src="<?php Site::out_url( 'theme' ); ?>/img/up.png" alt="" height="20" width="20" /></a>
					
						<nav>
							<div><a href="/about">About ›</a></div>													<div><a href="/contributors">Team ›</a></div>
							<div><a href="/contact">Contact ›</a></div>
							<div><a href="/join-us">Join us ›</a></div>
							<div><a href="/imprint">Legal ›</a></div>
							<div><a href="/forum">Forums ›</a></div>
							<?php if ( User::identify()->loggedin ) { ?>
								<div><a href="/admin">Admin ›</a></div>
								<div><a href="/auth/logout">Logout ›</a></div>
							<?php } else { ?>
								<div><a href="/auth/login">Login ›</a></div>
							<?php } ?>
						</nav>
					
					</div>
			
					<div class="element">
				
						<div class="license">
							<h3>Get Involved!</h3>
							<p style="display: block; margin: 0 0 -20px">See the different options for how to <a href="/join-us">become a stakeholder ›</a></br></br></p>
							
							<h3>Licensing</h3>
							<p>If not stated differently, all contents are distributed under a <a rel="nofollow" target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons License</a> (click for details)
							<a rel="nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url( 'theme' )?>/img/creative-commons-240x134.png" /></a>
							</p>
						</div>
					
					</div>
			
					<div class="element partners">
						<h3>Partners</h3>
						<!-- a href="http://one-europe.info/profiles/european-federalist-party-efp" title="European Federalist Party"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/efp.png" title="European Federalist Party" alt="European Federalist Party" height="" width="" /></a -->
						<a href="http://debatingeurope.eu/" target="_blank" title="debatingeurope.eu"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/debatingeurope.png" title="Debating Europe" alt="Debating Europe" height="137" width="250" /></a>
						<a href="http://thinkyoung.eu/" target="_blank" title="Think Young"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/thinkyoung.png" title="Think Young" alt="Think Young" height="48" width="250" /></a>
						<!-- <a href="http://beta-europe.org/" target="_blank" title="BETA - Simulation of European Politics"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/beta.jpg" title="BETA Europe" alt="BETA Europe" height="137" width="250" /></a> -->
					</div>
					
					<div class="element">

						<form id="contactForm" action="<?php Site::out_url('theme') ?>/mail.php" method="post">

							<div class="container">
								<h3>Say Hello</h3>
								<span>Want to get involved, give some feedback or found an error? No Problem! Drop us a line:</span>
							    <input id="senderName" placeholder="Name" name="senderName" required="required" type="text" />
							    <input id="senderEmail" placeholder="Email" name="senderEmail" required="required" type="email" />
							    <textarea id="message" name="message" required="required"></textarea>
							    <input id="sendMessage" type="submit" name="sendMessage" value="Send message" />
								<div class="clear"></div>
							</div>

						</form>
						
					</div>
					<div class="clear">&nbsp;</div>
					
					<div style="margin: 0 auto; text-align: center"><p>Contact: info@one-europe.info | OneEurope, Place du Luxembourg 6, 1050 Bruxelles, Belgium<br/><br/></p></div>
					
					
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
	
    <script type="text/javascript">
    var disqus_shortname = 'oneeurope';

    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
    </script>	



	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php Site::out_url( 'theme' ); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
	<!-- Grab Google Maps widget js -->
	<script type="text/javascript"
	    src="https://maps.google.com/maps/api/js?sensor=false">
	</script>

	<!-- scripts concatenated and minified via build script -->
	<script src="<?php Site::out_url( 'theme' ); ?>/js/plugins.js"></script>
	<script src="<?php Site::out_url( 'theme' ); ?>/js/script.js"></script>		
	<!-- end scripts -->
	
	</body>
</html>
