<?php echo $theme->display('header'); ?>
<div class="submenu">
	<ul>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/about">About</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/join-us"><b>Join us</b></a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding">Crowdfunding ›</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/become-a-patron">Become a Patron</a></li>
		<li><a href="<?php Site::out_url( 'habari' ); ?>/contact">Contact</a></li>
		<li class="clear"></li>
	</ul>
</div>
<img style="margin: 5px 0 15px;" src="<?php Site::out_url( 'theme' )?>/img/static/top-banner.png" width="950" height="124" />
<div class="page">
	<h1>Get involved!</h1>
	<h3>There are many ways of taking part:</h3>
	<br/>				
	<div class="alignright" style="margin-top: -50px; width: 500px">
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
		<a class="addthis_button_linkedin_counter"></a>
		<a class="addthis_counter addthis_pill_style"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
		<!-- AddThis Button END -->	
	</div>
	<div class="clear"></div>
	<?php echo $post->content; ?>
	<div class="clear"></div>
	<div class="alignright" style="margin-top: -50px; width: 500px">
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
		<a class="addthis_button_linkedin_counter"></a>
		<a class="addthis_counter addthis_pill_style"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
		<!-- AddThis Button END -->
	</div>
</div>
<?php echo $theme->display ('footer'); ?>