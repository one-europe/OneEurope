<?php echo $theme->display ( 'header'); ?>
<article class="in-debate">
	<h1><?php echo $post->title; ?></h1>
	<figure>
		<span class="license" title="<?php echo $post->info->photolicense; ?>"><?php echo $post->info->photolicense; ?></span>
		<img src="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" width="100%" />
		<figcaption><?php echo $post->info->photoinfo; ?></figcaption>
	</figure>
	<div class="post-content"><?php echo $post->content_out; ?></div>
	<?php if ( User::identify()->loggedin ) { ?>
		<p><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></p>
	<?php } ?>
	<div class="spread-the-word">
		Share this debate
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_google_plusone_share"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_pinterest_share"></a>
			<a class="addthis_button_linkedin"></a>
			<a class="addthis_button_stumbleupon"></a>
			<a class="addthis_button_vk"></a>
			<a class="addthis_button_reddit"></a>
			<a class="addthis_button_scoopit"></a>
			<a class="addthis_button_tumblr"></a>
			<a class="addthis_button_digg"></a>
			<a class="addthis_button_wordpress"></a>
			<a class="addthis_button_blogger"></a>
			<a class="addthis_button_delicious"></a>
			<a class="addthis_button_compact"></a>
		</div>
	</div>
</article>
<div class="post-list no-margin in-debate">
	<?php $id = $post->id;
	$posts = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'status' => 'published' ) );
	$count = $posts->count_all(); ?>
	<?php if ($count == 0) { ?>
		<p class="message">There are no posts treating this topic yet.</p>
	<?php } ?>
	<?php foreach ($posts as $post ) { ?>
		<?php if ($post) { ?>
			<section>
				<div class="img-wrap">
					<img src="<?php echo $post->info->photourl ? $post->info->photourl : Site::out_url('theme') . '/img/video-icon.png'; ?>" alt="<?php if ( $post->info->photoinfo ) { echo $post->info->photoinfo; } else { echo $post->title; } ?>" />
				</div>
				<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
				<p><?php if ( $post->info->excerpt ) { echo strip_tags($post->info->excerpt); } else { echo strip_tags($post->content_out); } ?></p>
				<p class="meta">
			        <?php if ( $show_author && $post->typename == 'article' ) { ?>
						<span class="entry-autor">
							<?php if ( $post->info->origauthor ) { ?>
								<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="Portrait"><span><?php echo $post->info->origauthor; ?></span></a>
							<?php } elseif ($post->info->author) { ?>
								<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo User::get($post->info->author)->displayname; ?></span></a>
							<?php } else { 
								$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $post->author->displayname; ?></span></a>
							<?php } ?>
						</span>
					<?php } ?>
			        on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
				</p>
			</section>
		<?php } else { ?>There's been no contribution considering this topic yet.<?php } ?>
	<?php } ?>
</div>
<?php echo $theme->display('footer'); ?>