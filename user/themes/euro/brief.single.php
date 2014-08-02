<?php echo $theme->display ( 'header'); ?>
<?php if ( $post ) { ?>
	<article>
		<div class="breadcrumb">
			<a class="to-root" href="<?php Site::out_url( 'habari' ); ?>/in-brief">Images</a>
			<a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a>
			<div class="pager">
				<?php if ($previous = $post->descend()): ?>
				<a class="prev" href="<?php echo $previous->permalink ?>" title="<?php echo $previous->title; ?>">Previous</a>
				<?php endif; ?>
				<?php if ($post->ascend() && $post->descend()) : echo " | "; endif; ?>
				<?php if ($next = $post->ascend()): ?>
				<a class="next" href="<?php echo $next->permalink ?>" title="<?php echo $next->title; ?>">Next</a>
				<?php endif; ?>
			</div>
		</div>
		<!-- <div class="metacat"><span><?php echo $post->info->metacat; ?></span></div> -->
		<h1><?php echo $post->title_out; ?></h1>
		<?php if ( $post->info->showauthor == 1 ) { ?>
		<p class="author">
			<?php if ( $post->info->origsource ) { ?>
				<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="<?php echo $post->info->origauthor; ?>"><?php echo $post->info->origauthor; ?></a>
			<?php } else { 
				$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
				<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $post->author->displayname; ?>"><?php echo $post->author->displayname; ?></a>
			<?php } ?>
		<?php } ?>
		<p class="meta">
			<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time>
			<?php if ($post->tags_out) { ?> | archived in: <?php } ?><?php echo $post->tags_out; ?>
			<?php if ( User::identify()->loggedin ) { ?>
				<a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a>
			<?php } ?>
		</p>
		<div class="post-content brief">
			<figure>
				<a href="<?php echo $post->info->photourl; ?>" title="View Image in a New Tab" target="_blank">
					<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photocaption; ?>" />
				</a>
				<figcaption>
					<span class="license"><?php echo $post->info->photolicense; ?></span>
					<?php echo $post->info->photoinfo; ?>
				</figcaption>
			</figure>
			<?php echo $post->content_out; ?>
		</div>



		<div class="spread-the-word">
			<?php if ( $post->author->info->userfield_Description || $post->info->origauthor ) { 
				if ( $post->info->showauthor == 1 ) { ?>
				<div style="overflow: hidden; background: linen;">
					<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
						This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
					<?php } elseif ( $post->author->info->userfield_Description ) { ?>
					<span><?php echo $post->author->info->userfield_Description; ?></span>
					<?php } ?>
				</div>
			<?php } } ?>
			Spread the word:
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
				<a class="addthis_button_email"></a>
				<a class="addthis_button_compact"></a>
			</div>
			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
			<form action="http://one-europe.us5.list-manage1.com/subscribe/post?u=fad146f9810377d640e431dfd&amp;id=e147a25731" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<label for="mce-EMAIL">Subscribe to our newsletter:</label>
				<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="your email" required>
				<input type="submit" value="Ok" name="subscribe" id="mc-embedded-subscribe" class="button">
			</form>
			</div>
			<!--End mc_embed_signup-->
		</div>

		<!-- <div class="disqus"><?php $theme->comments( $post ); ?></div> -->

		<div class="fb-comments" style="padding-top: 20px; display: block; overflow: hidden;" data-width="100%" data-href="<?php echo $post->permalink; ?>" data-numposts="5" data-colorscheme="light"></div>

		<div class="social-buttons at-the-bottom">
			<span>Find us on:</span>
			<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
			<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
			<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
			<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
			<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
			<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
			<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
			<a href="/feeds" class="icon-rs" title="Subscribe via RSS"></a>
		</div>
	</article>


<?php echo $theme->display('sidebar.nibble.right'); ?>

<?php } else { echo $theme->display('404msg'); } ?>

<?php echo $theme->display('footer'); ?>