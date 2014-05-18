	<div id="profile-sidebar">
		<?php
		
		$source = $post->info->user ? $source = User::get_by_id($post->info->user)->info : $post->info;
		$twname = $source->twitter ? $source->twitter : $post->info->twitter;

		if ($twname) {
			$tw_data = explode('-', $twname);
			$tw_id = $tw_data[1];
			$tw_name = $tw_data[0];
			if ($tw_id && $tw_name) { ?>
				<section class="twitter">
					<a class="twitter-timeline" href="https://twitter.com/<?php echo $tw_name; ?>"
						data-dnt="true"
						data-widget-id="<?php echo $tw_id; ?>">Tweets by @<?php echo $tw_name; ?></a>
				</section>
		<?php } } ?>
		
		<?php if ( $post->info->user == '0' ) { ?>
			<section>
				<div class="h"><span>This is you?</span></div>
				<p class="message">This is you or your organisation? <a href="/contact">Get in touch</a> to edit it yourself.</p>
			</section>
		<?php }?>
	</div>
</div>