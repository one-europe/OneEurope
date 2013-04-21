<?php echo $theme->display('header'); ?>


			<div class="submenu">
				<ul>
					<li><a href="/about"><b>About</b></a></li>
					<li><a href="/join-us">Join us</a></li>
					<li><a href="/become-a-patron">Become a Patron</a></li>
					<li><a href="/contact">Contact</a></li>
					<li class="clear"></li>
				</ul>
			</div>

			<div id="about-page">

				<div class="about">
				
					<div class="content">					
					
						<h1><?php echo $post->title_out; ?></h1>
																
						<article class="body"><?php echo $post->content_out; ?></article>
					
					</div>
						
					<div class="sharing">
						
						<div class="fb-like-box" data-href="http://www.facebook.com/oneeurope" data-width="460" data-height="185" data-border-color="#ddd" data-show-faces="true" data-stream="false" data-header="false"></div>
											
						<a href="https://twitter.com/one1europe" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @one1europe</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

						&nbsp;&nbsp;<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://one-europe.info/about"></a>
						<noscript><a href="http://flattr.com/thing/697920/OneEurope" target="_blank">
						<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
					
					</div>
					
					<div class="clear"></div>
					
				</div>
								
				
				<ul class="contribute">
										
					<a href="http://one-europe.info/join-us"><h2>Get involved!<span class="sidenote">There are many ways of taking part ›</span></h2></a>
											
				</ul>
				<ul class="licensing">		
					<li class="clear">
						<h2>Licensing</h2>
						<p>Our commitment to simplifying the process of getting involved makes us believe in the 
							value of information being shared, which is why we encourage our publishers to use the site's
							Creative Commons License. They're free to use other licenses however, and we urge our users
							to respect the authors' choice for every piece of content.
						</p>
					</li>
				</ul>
				<ul class="donate">	
					<li>

						<h2>Donations</h2>

						<p>As we are a non-profit organization, run by volunteers, the financing of this project relies heavily on our fans and donors.
						If you appreciate what we do, please consider donating an amount of your choice:</p>
					
							<form class="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="ZS8QKKQD3C7TG">
								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						<p class="flattr">
						Make a donation through flattr:
							<a href="https://flattr.com/donation/give/to/OneEurope"
							  title="Donate (via Flattr)"><img
							    src="<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png"
							    title="Support my Debian work (Flattr)"
							    onmouseover="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_hover.png'"
							    onmouseout="this.src='<?php Site::out_url( 'theme' )?>/img/flattr_donate_normal.png'"
							    alt="Flattr donation button" />
							</a>
						</p>
			
					<li>
				
					<li class="clear"></li>
				
				</ul>
				
				<div class="clear"></div>
				
			</div>
			
<?php echo $theme->display ('footer'); ?>

