	</main>

	<footer>
		<div class="parts">
			<div class="part partners">
				<h2>Partners</h2>
				<a href="http://debatingeurope.eu/" target="_blank" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders"><img src="<?php Site::out_url('theme') ?>/img/supporters/debatingeurope.png" title="Debating Europe – Discuss YOUR ideas with Europe’s leaders" alt="Debating Europe – Discuss YOUR ideas with Europe’s leaders" height="136" width="250" /></a>
				<a href="http://www.democraticunion.eu/" target="_blank" title="Project for Democratic Union - One Future. One Europe"><img src="<?php Site::out_url('theme') ?>/img/supporters/project-for-democratic-union.png" title="Project for Democratic Union - One Future. One Europe" alt="Project for Democratic Union - One Future. One Europe" height="83" width="250" /></a>
				<a href="http://www.treffpunkteuropa.de/" target="_blank" title="The New Federalist, webzine of the Young European Federalist"><img src="<?php Site::out_url('theme') ?>/img/supporters/banner_tpe_oneeurope_1.png" title="The New Federalist, webzine of the Young European Federalist" alt="The New Federalist, webzine of the Young European Federalist" height="47" width="250" /></a>
				<a href="http://www.mladiinfo.eu/" target="_blank" title="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide"><img src="<?php Site::out_url('theme') ?>/img/supporters/mladiinfo-international.png" title="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide" alt="Mladiinfo International promotes and mediates the communication between young people, students, professors, researchers, university officials, youth NGOs and all those involved in the educational process in Europe and worldwide" height="59" width="250" /></a>
			</div>
			
			<div class="part-right">
				<div class="part contact-form">
					<h2>Say Hello</h2>
					<p>Want to get involved, give some feedback or found an error? No Problem! Drop us a line:</p>
					<form id="contactForm" action="<?php Site::out_url('theme') ?>/mail.php" method="post">
						<input id="senderName" placeholder="Name" name="senderName" required="required" type="text" />
						<input id="senderEmail" placeholder="Email" name="senderEmail" required="required" type="email" />
						<textarea id="senderMessage" placeholder="Message" name="message" required="required"></textarea>
						<button id="sendMessage" name="sendMessage">Send message</button>
					</form>
				</div>

				<div class="part bottom-nav">
					<a class="jump" href="#top">TOP</a>
					<nav>
						<a href="<?php Site::out_url( 'habari' ); ?>/about" title="About">About</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/join-us" title="Join us">Join us</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/contributors" title="Team">Team</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/donate" title="Donate">Donate</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron" title="Patron">Patron</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/contact" title="Contact">Contact</a>
						<a href="<?php Site::out_url( 'habari' ); ?>/imprint" title="Terms">Terms</a>
					</nav>
				</div>
			</div>

			<div class="copyright">Contact: info@one-europe.info | OneEurope</div>
		</div>
	</footer>

	<div id="fb-root"></div>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-45021944-1', 'one-europe.info');
		ga('send', 'pageview');
	</script>

	<script src="<?php Site::out_url( 'theme' ); ?>/js/plugins.min.js?20140802"></script>
	<script src="<?php Site::out_url( 'theme' ); ?>/js/scripts.min.js?20140810"></script>

</body>
</html>