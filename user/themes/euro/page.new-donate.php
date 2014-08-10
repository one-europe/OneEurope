<?php echo $theme->display('header'); ?>
<?php require_once(HABARI_PATH . '/user/themes/euro/config.php'); ?>
<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/about">About</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/donate">Donate</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a>
	<a href="<?php Site::out_url( 'habari' ); ?>/imprint">Terms</a>
</div>
<article class="full">
	<h1><?php echo $post->title_out; ?></h1>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<div class="new-donate-buttons">
		<div class="new-part">
			<form action="./donate" method="post">
				<input type="text" id="amount-stripe" placeholder="Sum" />
				<button id="pay-stripe">Donate with card</button>
				<img style=" margin-left: 10px; top: -4px; position: relative;" src="<?php Site::out_url( 'theme' )?>/img/outline.png" width="100" height="22" />
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
		<div class="new-part">
			<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="ZS8QKKQD3C7TG">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online." style="vertical-align: middle;">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				with PayPal
			</form>
		</div>
		<div class="new-part">
			<a href="https://flattr.com/donation/give/to/OneEurope"
			  title="Donate (via Flattr)"><img
			    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
			    title="Support my Debian work (Flattr)"
			    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
			    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
			    alt="Flattr donation button" />
			</a> &nbsp;with Flattr
		</div>
	</div>
	<?php if (User::identify()->loggedin) { ?>
		<p style="padding: 10px 0 0;"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
	<?php } ?>
</article>
<?php echo $theme->display('footer'); ?>