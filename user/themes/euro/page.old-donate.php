<?php echo $theme->display('header'); ?>
<?php require_once(HABARI_PATH . '/user/themes/euro/config.php'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/team">Team</a>
	<b>Donate</b>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
</div>
<a name="top"></a>
<article class="full crowd">
	<div class="box with-addthis">
		<span class="please-share">Please help us share this campaign:</span>
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_pinterest_share"></a>
			<a class="addthis_button_linkedin"></a>
			<a class="addthis_button_scoopit"></a>
			<a class="addthis_button_reddit"></a>
			<a class="addthis_button_stumbleupon"></a>
			<a class="addthis_button_vk"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
		</div>
	</div>
	<div style="float: left; margin-right: 400px;"><?php echo $post->content_out; ?></div>
	<div class="box donate-side">
		<p style="margin-top: 0;"><b>Support OneEurope!<br>Donate securely with a Debit Card, Credit Card, Paypal, or Flattr</b></p>
		<div class="donate-buttons">
			<div class="part">
				<form action="./donate" method="post">
					<input type="text" id="amount-stripe" placeholder="Sum" />
					<button id="pay-stripe">Donate with card</button>
					<img style="float: right; margin-top: 5px;" src="<?php Site::out_url( 'theme' )?>/img/outline.png" width="100" height="22" />
					<script src="https://checkout.stripe.com/checkout.js"></script>
					<script>
						var handler = StripeCheckout.configure({
							key: '<?php echo $stripe['publishable_key']; ?>',
							image: '<?php Site::out_url('theme')?>/img/logo128x128.png',
							token: function(token, args) {
								token.amount = document.getElementById('amount-stripe').value * 100;
								$('.donate-buttons').html('<p class="in-progress-payment">Please wait, donation is in progress...<br>Do not refresh the page until donation is successful.</p>');
								$.ajax({
									url: '<?php Site::out_url('theme')?>/charge.php',
									type: 'post',
									data: token
								}).done(function (data) { $('.donate-buttons').html(data); });
							}
						});
						document.getElementById('pay-stripe').addEventListener('click', function(e) {
							handler.open({
								name: 'OneEurope',
								description: 'One Society, One Democracy',
								currency: 'eur',
								amount: document.getElementById('amount-stripe').value * 100 || 10000,
								panelLabel: 'Donate {{amount}}'
							});
							e.preventDefault();
						});
					</script>
				</form>
			</div>
			<div class="part">
				<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="ZS8QKKQD3C7TG">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online." style="vertical-align: middle;">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					with PayPal
				</form>
			</div>
			<div class="part">
				<a href="https://flattr.com/donation/give/to/OneEurope"
				  title="Donate (via Flattr)"><img
				    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
				    title="Support my Debian work (Flattr)"
				    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
				    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
				    alt="Flattr donation button" />
				</a> with Flattr
			</div>
		</div>

		<p class="donate-faq"><a href="#faq" title="FAQ">Frequently Asked Questions</a></p>

		<p><b>Please consider donating an amount of your choice. Even a few euros can make a big difference!</b></p>

		<p class="pledge"><b>Donate &euro;5 or more</b>
		Thank You! We will list your name on our website and you'll
		receive a Thank You message via email which will come with a download of an
		exclusive OneEurope Screensaver for your PC.</p>

		<p class="pledge"><b>Donate &euro;10 or more</b>
		Postcard from OneEurope! You will receive an exclusive OneEurope
		postcard with a personal message from a team member. We will also list your name on our website
		and you'll receive a Thank You message via email which will come with a
		download of an exclusive OneEurope Screensaver for your PC.</p>

		<p class="pledge"><b>Donate &euro; 20 or more</b>
		Flying with stickers! We will send you OneEurope stickers to
		decorate your stuff with and some promotional flyers so you can represent us
		in your community. In addition you will receive an exclusive OneEurope
		postcard with a personal message from a team member. We will also list your name on our website
		and you'll receive a Thank You message via email which will come with a
		download of an exclusive OneEurope Screensaver for your PC.</p>

		<p class="pledge"><b>Donate &euro;50 or more</b>
		Digital Yearbook, Best of OneEurope. 2013 was a great year for us
		and to celebrate that we have put together a Yearbook of our best articles,
		eurographics and more. Donate 50 Euros or more and receive a digital version
		of the Yearbook before anyone else. In
		addition you will receive an exclusive OneEurope postcard with a personal
		message from a team member, your name listed on our website, a Thank You message via 
		email and an exclusive OneEurope Screensaver for your PC. Not only that, you'll also get a great
		package of OneEurope stickers, flyers, a reusable car window sticker AND a
		OneEurope pin badge to prove you are now a OneEuropean!</p>

		<p class="pledge"><b>Donate &euro;100 or more</b>
		OneEurope Yearbook 2013 - Collector's Print Edition. Get your
		hands on the most exclusive item in our collection of rewards, the first
		print edition magazine from OneEurope featuring 2013's best articles,
		eurographics and other content. Support us with €100 and be one of the first
		to own it from the original print run, Hot off the Press! Plus
		all the goodies mentioned above: Thank You's, stickers, postcards, window
		sticker, flyers and OneEuropeans pin badge.</p>

		<p class="pledge"><b>Donate &euro;250 or more</b>
		All that and more! Donate more than 250 Euros and receive the
		Collectors print editon of the Yearbook 2013 and all of the other Rewards
		previously mentioned. Furthermore, in recognition of your wonderful support
		we would like to invite you to an invitation only Google Air Hangout with our
		Directors to hear and ask about our story to date, our plans for 2014 and
		beyond, and of course our Thanks!</p>

		<p class="pledge"><b>Donate &euro;500 or more</b>
		Hello Patron!! A donation of more than 500 Euros deserves special
		recognition. We appreciate that your donation represents just how much you
		want to see OneEurope succeed. We value all the support we receive and are
		always glad of feedback which is why we would invite you to join our Board of
		Patrons with a special advisory role, with direct contact to our Directors.
		We'll keep you regularly updated on our latest developments as we transform
		into a professional non-profit organisation. Naturally please enjoy your own
		bumper pack of rewards goodies too!</p>

		<div style="overflow: hidden; padding: 15px 0 0;">
			<iframe style="float: left; margin-right: 2px;" width="176" height="315" src="//www.youtube.com/embed/QNCh7kZCUaA?modestbranding=1&amp;rel=0&amp;showinfo=0&amp;controls=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
			<iframe style="float: left;" width="176" height="315" src="//www.youtube.com/embed/Yq7hN9lBTSs?modestbranding=1&amp;rel=0&amp;showinfo=0&amp;controls=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
		</div>

		<div class="pinterest-board" style="overflow: hidden; padding: 15px 0 0;">
			<a data-pin-do="embedUser" href="http://www.pinterest.com/oneeurope/" data-pin-scale-width="111" data-pin-scale-height="1600" data-pin-board-width="355">Visit One Europe's profile on Pinterest</a>
		</div>

	</div>
	<?php if (User::identify()->loggedin) { ?>
		<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
	<?php } ?>
	<div class="box with-addthis">
		<span class="please-share">Please help us share this campaign:</span>
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_pinterest_share"></a>
			<a class="addthis_button_linkedin"></a>
			<a class="addthis_button_scoopit"></a>
			<a class="addthis_button_reddit"></a>
			<a class="addthis_button_stumbleupon"></a>
			<a class="addthis_button_vk"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
		</div>
		<!-- AddThis Button END -->
	</div>
</article>


<script>
	(function() {
		var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
		li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
	})();
</script>

<?php echo $theme->display('footer'); ?>