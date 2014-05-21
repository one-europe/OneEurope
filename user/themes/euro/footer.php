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
							<div><a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding">Donate ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/imprint">Legal ›</a></div>
							<div><a href="<?php Site::out_url( 'habari' ); ?>/auth/login">Login ›</a></div>
						</nav>
					</div>
		
					<div class="element partners">
						<h3>Partners</h3>
						<a href="http://debatingeurope.eu/" target="_blank" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/debatingeurope.png" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders" alt="Debating Europe – Discuss YOUR ideas with Europe’s leaders" height="136" width="250" /></a>
						<a href="http://www.democraticunion.eu/" target="_blank" title="Project for Democratic Union - One Future. One Europe"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/project-for-democratic-union.png" title="Project for Democratic Union - One Future. One Europe" alt="Project for Democratic Union - One Future. One Europe" height="83" width="250" /></a>
						<a href="http://www.treffpunkteuropa.de/" target="_blank" title="The New Federalist, webzine of the Young European Federalist"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/banner_tpe_oneeurope_1.png" title="The New Federalist, webzine of the Young European Federalist" alt="The New Federalist, webzine of the Young European Federalist" height="47" width="250" /></a>
						<a href="http://www.mladiinfo.eu/" target="_blank" title="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide"><img src="<?php Site::out_url( 'theme' )?>/img/grey.gif" data-original="<?php Site::out_url('theme') ?>/img/supporters/mladiinfo-international.png" title="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide" alt="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide" height="59" width="250" /></a>
					</div>

					<div class="element">
						<form id="contactForm" action="<?php Site::out_url('theme') ?>/mail.php" method="post">
							<div class="container">
								<h3>Say Hello</h3>
								<span>Want to get involved, give some feedback or found an error? No Problem! Drop us a line:</span>
							    <input id="senderName" placeholder="Name" name="senderName" required="required" type="text" />
							    <input id="senderEmail" placeholder="Email" name="senderEmail" required="required" type="email" />
							    <textarea id="senderMessage" placeholder="Message" name="message" required="required"></textarea>
							    <input id="sendMessage" type="submit" name="sendMessage" value="Send message" class="btn" />
								<div class="clear"></div>
							</div>
						</form>
					</div>

					<div class="clear">&nbsp;</div>
					<div style="margin: 0 auto; text-align: center"><p>Contact: info@one-europe.info | OneEurope<br/><br/></p></div>
				</div>
			</div>

			<div id="fb-root"></div>

	<?php /* echo $theme->footer(); */ ?>
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

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-45021944-1', 'one-europe.info');
		ga('send', 'pageview');
	</script>

	<script src="<?php Site::out_url( 'theme' ); ?>/js/plugins.js?2014052101"></script>
	<script src="<?php Site::out_url( 'theme' ); ?>/js/script.js?2014052101"></script>		
	
	</body>
</html>