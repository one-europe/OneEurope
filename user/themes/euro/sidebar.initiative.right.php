	<div id="profile-sidebar" class="toggle">
		<?php echo $theme->display('sidebar.elem.newsletter'); ?>
		<section class="sharing">
			<div class="h"><span>Share</span></div>
			<div class="addthis addthis_toolbox addthis_default_style add_this_multiple">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
				<a class="addthis_button_tweet" tw:count="vertical"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>	
				<a class="addthis_counter"></a>
				<a style="clear: left; height: 20px; margin-top: 1px;" class="addthis_button_linkedin_counter" li:counter="none"></a> 
				<div style="clear: none;" class="scoopit-wrap"><a href="http://www.scoop.it" class="scoopit-button" scit-position="none" scit-url="<?php echo $post->permalink; ?>" >Scoop.it</a></div>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_button_print"></a>
				<a class="addthis_button_reddit"></a>
				<a class="addthis_button_stumbleupon"></a>
			</div>
		</section>
		<?php /*if ( $post->info->twitter ) {
			$tw_data = explode('-', $post->info->twitter);
			$tw_id = $tw_data[1];
			$tw_name = $tw_data[0];
			if ($tw_id && $tw_name) { ?>
			<section class="twitter">
				<a class="twitter-timeline" href="https://twitter.com/<?php echo $tw_name; ?>"
					data-dnt="true"
					data-widget-id="<?php echo $tw_id; ?>">Tweets by @<?php echo $tw_name; ?></a>
			</section>
		<?php } }*/ ?>
		<?php if ( $post->info->url || $post->info->twitter ) { ?>
		<section>
			<div class="h"><span>More about this</span></div>
			<span>
				<?php if ($post->info->url) { ?><a href="<?php echo $post->info->url; ?>" title="visit website" target="_blank">› Official website of <?php echo $post->title; ?></a><br/><?php } ?>
				<?php if ($post->info->twitter) { ?><a href="http://twitter.com/<?php echo $post->info->twitter; ?>" title="<?php echo $post->title ?> on Twitter" target="_blank">› <?php echo $post->title ?> on Twitter</a><?php } ?>	
			</span>
		</section>
		<?php } ?>
		<?php if ( $post->info->more ) { ?>
		<section class="">
			<div class="h"><span>More</span></div>
			<span><?php echo $post->info->more; ?></span>
		</section>
		<?php } ?>
		<section class="fb">
			<div class="h"><span>Connect with us</span></div>
			<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://one-europe.info/about"></a>
			<noscript><a href="http://flattr.com/thing/697920/OneEurope" target="_blank">
			<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
			<div class="g-plus-box" style="overflow: hidden; border-right: 1px solid #c8c9ca; height: 106px;">
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
				<g:plus href="https://plus.google.com/118353934830681553476" width="297"></g:plus>
			</div>
			<div class="fb-like-box" style="margin-top: 20px;" data-href="http://www.facebook.com/OneEurope" data-width="252" data-show-faces="true" data-stream="true" data-show-border="false" data-header="false"></div>
			<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/One1Europe" data-widget-id="372098233318662144">Tweets by @One1Europe</a>
		</section>
	</div>
</div>