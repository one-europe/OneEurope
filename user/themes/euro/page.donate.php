<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us">Join us</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/donate"><b>Donate</b></a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a></li>
		<li class="clear"></li>
	</ul>
</div>
<div class="content donate">
	<h1><?php echo $post->title_out; ?></h1>
	<article class="body"><?php echo $post->content_out; ?></article>
</div>
<?php if (User::identify()->loggedin) { ?>
	<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
<?php } ?>
<?php require_once(HABARI_PATH . '/user/themes/euro/config.php'); ?>
<div class="box">
	<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
		<a class="addthis_button_linkedin_counter"></a>
		<a class="addthis_counter addthis_pill_style"></a>
	</div>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
</div>
<div class="box donate-buttons">
	<div class="part">
		<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="ZS8QKKQD3C7TG">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
	<div class="part" style="height: 43px; padding: 15px 15px 5px;">
		<form action="./donate" method="post">
			<input type="text" id="amount-stripe" placeholder="Sum" />
			<button id="pay-stripe">Donate with card</button>
			<script src="https://checkout.stripe.com/checkout.js"></script>
			<script>
				var handler = StripeCheckout.configure({
					key: '<?php echo $stripe['publishable_key']; ?>',
					image: '<?php Site::out_url('theme')?>/img/logo128x128.png',
					token: function(token, args) {
						token.amount = document.getElementById('amount-stripe').value * 100;
						$('.box').html('<p class="in-progress-payment">Please wait, donation is in progress...</p>');
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
	<div class="part" style="height: 37px; padding: 21px 15px 5px; border: 0;">
		<p class="flattr">Make a donation through flattr:
			<a href="https://flattr.com/donation/give/to/OneEurope"
			  title="Donate (via Flattr)"><img
			    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
			    title="Support my Debian work (Flattr)"
			    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
			    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
			    alt="Flattr donation button" />
			</a>
		</p>
	</div>
</div>
<?php echo $theme->display('footer'); ?>