<?php echo $theme->display('header'); ?>
<?php require_once(HABARI_PATH . '/user/themes/euro/config.php'); ?>
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
	<h1>
		<?php echo $post->title_out; ?>
		<div class="addthis_toolbox addthis_default_style" style="float: right; height: 20px;">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count" style="height: 20px;"></a>
			<a class="addthis_button_tweet"></a>
			<a class="addthis_button_pinterest_pinit"></a>
			<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
			<a class="addthis_button_linkedin_counter"></a>
			<div style="display: inline-block; padding-left: 5px;">
				<a href="http://www.scoop.it" class="scoopit-button" scit-position="none" >Scoop.it</a>
			</div>
			<div style="display: inline-block; padding-left: 5px;">
				<a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false">
					<img src="http://www.reddit.com/static/spreddit7.gif" alt="submit to reddit" border="0" style="vertical-align: baseline;" />
				</a>
			</div>
			<div style="display: inline-block; padding-left: 5px;"><su:badge layout="1"></su:badge></div>
		</div>
	</h1>
	<article class="body" style="float: left; margin-right: 400px;"><?php echo $post->content_out; ?></article>
	<div class="box donate-side">
		<div class="donate-buttons">
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
				<p class="flattr">
					<a href="https://flattr.com/donation/give/to/OneEurope"
					  title="Donate (via Flattr)"><img
					    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
					    title="Support my Debian work (Flattr)"
					    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
					    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
					    alt="Flattr donation button" />
					</a> with Flattr
				</p>
			</div>
		</div>
		<b>Please consider donating an amount of your choice. Even a few euros can make a big difference!</b>
			<br>
			<br>
		For example:<br>
			&gt; 5 Euros will allow us to reach 100 more Europeans on Facebook, or Twitter<br>
			&gt; 10 Euros will allow us to print hundreds of flyers and posters for our events<br>
			&gt; 50 Euros will pay for our website for two months!<br>
			&gt; 100 Euros will allow us to spread our content and the dream of a more united and democratic Europe to thousands more people via enhanced Search Engine Optimization</p>
		
	</div>
</div>
<?php if (User::identify()->loggedin) { ?>
	<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
<?php } ?>
<div class="box">
	<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
		<a class="addthis_button_linkedin_counter"></a>
		<div style="display: inline-block; padding-left: 5px;">
			<a href="http://www.scoop.it" class="scoopit-button" scit-position="none" >Scoop.it</a>
		</div>
		<div style="display: inline-block; padding-left: 5px;">
			<a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false">
				<img src="http://www.reddit.com/static/spreddit7.gif" alt="submit to reddit" border="0" style="vertical-align: baseline;" />
			</a>
		</div>
		<div style="display: inline-block; padding-left: 5px;"><su:badge layout="1"></su:badge></div>
	</div>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>
</div>

<script>
	(function() {
		var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
		li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
	})();
</script>

<?php echo $theme->display('footer'); ?>