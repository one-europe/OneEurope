<?php echo $theme->display ( 'header'); ?>
<?php if ( $post ) { ?>
	
	<?php
	if ($post->info->user) {
		$source = User::get_by_id($post->info->user)->info;
		$displayname = User::get_by_id($post->info->user)->displayname;
 	} else {
		$source = $post->info;
		$displayname = $post->title;
	}?>

<div class="breadcrumbs">
	<a href="<?php Site::out_url( 'habari' ); ?>/contributors">Team</a>
	<b><?php echo $displayname; ?></b>
</div>

<?php

	// this is for deciding if the article is in full mode
	$source = $post->info->user ? $source = User::get_by_id($post->info->user)->info : $post->info;
	$twname = $source->twitter ? $source->twitter : $post->info->twitter;

?>

<article<?php echo $twname ? '' : ' class="full"'; ?>>
	<h1 class="on-page"><?php echo $displayname; ?></h1>
	<section class="profile-sidebar">
		<img src="<?php if ( $source->photourl ) { echo $source->photourl; } elseif ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" width="140" />
		<div class="social">
			<?php if ($source->twitter) { ?>
				<a href="https://twitter.com/<?php echo explode('-', $source->twitter)[0]; ?>" class="twitter-follow-button" data-show-screen-name="false" data-lang="en">Follow</a>
			<?php } elseif ($post->info->twitter) { ?>
				<a href="https://twitter.com/<?php echo explode('-', $post->info->twitter)[0]; ?>" class="twitter-follow-button" data-show-screen-name="false" data-lang="en">Follow</a>
			<?php } ?>
			<?php if ($source->fbsubscribe) { ?>
				<iframe src="//www.facebook.com/plugins/subscribe.php?href=<?php echo $source->fbprofile; ?>&amp;layout=button_count&amp;show_faces=true&amp;colorscheme=light&amp;font&amp;width=450&amp;appId=119694238052762" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height: 21px;" allowTransparency="true"></iframe>
			<?php } elseif ($source->fbpage) { ?>
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $source->fbpage; ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21&amp;appId=121944181248560" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:21px;" allowTransparency="true"></iframe>
			<?php } elseif ($post->info->fbsubscribe) { ?>
				<iframe src="//www.facebook.com/plugins/subscribe.php?href=<?php echo $post->info->fbprofile; ?>&amp;layout=button_count&amp;show_faces=true&amp;colorscheme=light&amp;font&amp;width=450&amp;appId=119694238052762" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height: 21px;" allowTransparency="true"></iframe>
			<?php } elseif ($post->info->fbpage) { ?>
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $post->info->fbpage; ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21&amp;appId=121944181248560" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:140px; height:21px;" allowTransparency="true"></iframe>
			<?php } ?>
		</div>
		<?php if ( $source->url || $source->more ) { ?>
			<div class="info">
				<?php if ($source->url) { ?><a href="<?php echo $source->url; ?>" target="_blank" title="open this website in a new tab">Website</a></span><?php } ?><?php echo strip_tags($source->more, '<a>'); ?>
			</div>
		<?php } elseif ( !($source->url && $source->more) && $post->info->url || $post->info->more ) { ?>
			<div class="info">
				<?php if ($post->info->url) { ?><a class="url" href="<?php echo $post->info->url; ?>" target="_blank" title="visit website">Website</a></span><?php } ?><?php echo strip_tags($post->info->more, '<a>'); ?>
			</div>
		<?php } ?>
	</section>
	<div <?php if ( $post->info->user ) { ?> id="user-<?php echo $post->info->user ?>" <?php } else { ?> id="post-<?php echo $post->id; ?>" <?php } ?> class="post-content on-profile <?php echo $post->statusname; ?>">
		<?php if ($post->info->user) {
			if ($source->content) { echo $source->content; } else { echo $post->content_out; }
		} else { echo $post->content_out; }
		if ($post->info->user == 0) { ?>
			<time datetime="<?php echo $post->modified->text_format('{Y}-{m}-{d}'); ?>">last modified on <?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
		<?php } ?>
	</div>
	<?php if ( User::identify()->loggedin ) { 
		if ( $post->info->user == 0 ) { ?>
			<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
		<?php } else { ?>
			<p class="profile-edit right">
				<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>">Edit original Entry</a>
				| <a href="http://one-europe.info/admin/user/<?php echo User::get_by_id($post->info->user)->username; ?>">Edit User</a>
			</p>
		<?php } 
	} ?>


	<?php if ( $post->info->user == '0' ) { ?>
		<p class="profile-message">This is you or your organisation? <a href="/contact">Get in touch</a> to edit it yourself.</p>
	<?php } else {
		// exclude all that are by me but where I added an author
		$i = 0;
		foreach ($pieces as $piece) {
			if ( $piece->info->author && $piece->info->author != $post->info->user && $piece->info->author != 0 ) {$i++;}
		}
		if(is_object($pieces)) { $count = $pieces->count_all() - $i; }
		if ($count > 0 ) {
		?>
			<!-- <div class="profiles-posts"><?php echo $post->title; ?>'s Posts:</div> -->
			<div class="further-reading post-list">
				<p class="header"><?php echo $post->title; ?>'s Posts:</p>
				<?php foreach ($pieces as $piece ) { ?>
					<?php if (!$piece->info->author || $piece->info->author == $post->info->user || $piece->info->author == 0 ) { ?>
					<section>
						<div class="img-wrap">
							<img src="<?php echo $piece->info->photourl; ?>" alt="<?php if ( $piece->info->photoinfo ) { echo $piece->info->photoinfo; } else { echo $piece->title; } ?>" width="100" height="160" />
						</div>
						<h2><a href="<?php echo $piece->permalink; ?>" title="<?php echo $piece->title; ?>"><?php echo $piece->title_out; ?></a></h2>
						<p><?php if ( $piece->info->excerpt ) { echo $piece->info->excerpt; } else { echo $piece->content_out; } ?></p>
						<p class="meta">
							<?php if ( $show_author && $piece->typename == 'article' ) { ?>
								<span class="entry-autor">
									<?php if ( $piece->info->origauthor ) { ?>
										<a href="<?php if ( $piece->info->origprofile ) { echo $piece->info->origprofile; } else { echo $piece->info->origsource; } ?>" title="<?php echo $piece->info->origauthor; ?>"><?php echo $piece->info->origauthor; ?></a>
									<?php } elseif ($piece->info->author) { ?>
										<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $piece->info->author ) ) );?>
										<a href="<?php echo $publisher->permalink; ?>" title="<?php echo User::get($piece->info->author)->displayname; ?>"><?php echo User::get($piece->info->author)->displayname; ?></a>
									<?php } else { 
										$publisher = Post::get(array( 'all:info' => array( 'user' => $piece->author->id ) ) );?>
										<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $piece->author->displayname; ?>"><?php echo $piece->author->displayname; ?></a>
									<?php } ?>
								</span>
							<?php } ?>
					        on <time datetime="<?php echo $piece->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $piece->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						</p>
					</section>
					<?php } ?>
				<?php } ?>
			</div>

			<?php if ( $current_page >= 2 || $there_are_more ) { ?>
				<div class="pagination">
					<?php if ( $there_are_more ) { ?>
					<a href="<?php Site::out_url( 'habari' ); ?>/profiles/<?php echo $post->slug; ?>/page/<?php echo $current_page + 1; ?>" title="Previous Page" class="previous">Previous</a>
					<?php } ?>
					<?php if ( $current_page >= 2 ) { ?>
					<a href="<?php Site::out_url( 'habari' ); ?>/profiles/<?php echo $post->slug; ?>/page/<?php echo $current_page - 1; ?>" title="Next Page" class="next">Next</a>
					<?php } ?>
				</div>
			<?php } ?>

		<?php } else { ?>
			<p class="profile-message">There's nothing to show from <?php echo $post->title; ?> at the moment.</p>
		<?php } ?>
	<?php } ?>
</article>
<?php echo $theme->display('sidebar.profile.right'); ?>
<?php } else { ?>
	<?php echo $theme->display('404msg'); ?>
<?php } ?>
<?php echo $theme->display('footer'); ?>