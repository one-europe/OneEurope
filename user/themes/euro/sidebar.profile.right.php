<aside>
	<?php
	
	$source = $post->info->user ? $source = User::get_by_id($post->info->user)->info : $post->info;
	$twname = $source->twitter ? $source->twitter : $post->info->twitter;

	if ($twname) {
		$tw_data = explode('-', $twname);
		$tw_id = isset($tw_data[1]) ? $tw_data[1] : null;
		$tw_name = $tw_data[0];
		if ($tw_id && $tw_name) { ?>
			<section class="side-block">
				<div class="empty">
					<a class="twitter-timeline" href="https://twitter.com/<?php echo $tw_name; ?>" data-dnt="true" data-widget-id="<?php echo $tw_id; ?>">Tweets by @<?php echo $tw_name; ?></a>
				</div>
			</section>
	<?php } } ?>
	<?php /*if ( $post->info->user == '0' ) { ?>
	<section class="side-block">
		<span class="top-link">This is you?</span>
		<div class="empty">This is you or your organisation?<br /><a href="/contact">Get in touch</a> to edit it yourself.</div>
	</section>
	<?php }*/ ?>
</aside>