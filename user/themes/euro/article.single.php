<?php echo $theme->display ( 'header'); ?>
<article>
	<h1><?php echo $post->title_out; ?></h1>
	<p class="descr"><?php echo $post->info->excerpt; ?></p>
	<p class="author">
		<?php if ( $show_author ) { ?>
			<?php if ( $post->info->origsource ) { ?>
				<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="<?php echo $post->info->origauthor; ?>"><?php echo $post->info->origauthor; ?></a>
			<?php } elseif ($post->info->author) { ?>
				<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
				<a href="<?php echo $publisher->permalink; ?>" title="<?php echo User::get($post->info->author)->displayname; ?>"><?php echo User::get($post->info->author)->displayname; ?></a>
			<?php } else { 
					if (is_object(Post::get(array( 'all:info' => array( 'user' => $post->author->id ) )))) { 
						$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
				<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $post->author->displayname; ?>"><?php echo $post->author->displayname; ?></a>
					<?php } else { ?>
				<?php echo $post->author->displayname; ?>
					<?php } ?>
			<?php } ?>
		<?php } ?>
		 | <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time></span>
		<?php if ( User::identify()->loggedin ) { ?>
				<span class="article-edit"> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
		<?php } ?>
	</p>
	<p class="meta">
		<?php if ($post->tags_out) { ?>archived in: <?php } ?><?php echo $post->tags_out; ?>
	</p>
	<div class="post-content">
		<?php if ($post->info->photourl) { ?>
			<figure>					
				<span class="license"><?php echo $post->info->photolicense; ?></span>
				<a href="<?php echo $post->info->photourl; ?>"><img alt="<?php echo $post->title; ?>" src="<?php echo $post->info->photourl; ?>" /></a>
				<figcaption><?php echo $post->info->photoinfo; ?></figcaption>
			</figure>			
		<?php } ?>
		<?php echo $post->content_out; ?>
	</div>

	<?php /*	Show an info sentence, if there is one (there can be one either as 'originfo', as that of the assigned author or
				as that of the actual author, each of which should first be looked up from their user table and then from their profile
				post table. */

			if ( $post->info->origauthor 
			|| ($post->author->info->description && !$post->info->author) 
			|| (Post::get(array('all:info' => array('user' => $post->author)))->info->description && !$post->info->author) 
			|| User::get($post->info->author)->info->description 
			|| Post::get(array('all:info' => array('user' => $post->info->author)))->info->description ) { ?>
	
		<div class="author-bottom-box">
			<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
				This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
				<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
				.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
				come from, with profile here if existing.<br /> */ ?>
			<?php } elseif ( User::get($post->info->author)->info->description ) { ?>
				<?php echo User::get($post->info->author)->info->description; ?>
			<?php } elseif ( Post::get(array('all:info' => array('user' => $post->info->author)))->info->description ) { ?>
				<?php echo Post::get(array('all:info' => array('user' => $post->info->author)))->info->description; ?>
			<?php } elseif ( !$post->info->author && $post->author->info->description ) { ?>
				<?php echo $post->author->info->description; ?>
			<?php } elseif ( !$post->info->author && Post::get(array('all:info' => array('user' => $post->author)))->info->description ) { ?>
				<?php echo Post::get(array('all:info' => array('user' => $post->author)))->info->description; ?>
			<?php } ?>
		</div>
	<?php } ?>
		
	<?php if ( User::identify()->loggedin ) { ?><span class="article-edit alignright"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span><?php } ?>

	<div class="spread-the-word">
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

	<div class="fb-comments" style="padding-top: 20px; display: block; overflow: hidden;" data-width="100%" data-href="<?php echo $post->permalink; ?>" data-numposts="5" data-colorscheme="light"></div>

	<div class="further-reading post-list">
		<p class="header">Further Reading:</p>
	 	<div class="similar-posts">
			<?php $list = Posts::get( array( 'content_type' => Post::type( 'article' ),
					'status' => Post::status( 'published' ),
					'order' => 'DESC',
					'limit' => 3,
					'vocabulary' => array('any' => $post->tags ),
					'not:id' => $post->id ) );
					foreach ($list as $item ) { ?>
					<section>
						<div class="img-wrap">
							<img src="<?php echo $item->info->photourl; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/>
						</div>
						<h2><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h2>
						<p><?php if ( $item->info->excerpt ) { echo $item->info->excerpt; } else { echo $item->content_out; } ?></p>
						<p class="meta">
					        <?php if ( $show_author && $item->typename == 'article' ) { ?>
								<?php if ( $item->info->origauthor ) { ?>
									<a href="<?php if ( $item->info->origprofile ) { echo $item->info->origprofile; } else { echo $item->info->origsource; } ?>" title="<?php echo $item->info->origauthor; ?>"><?php echo $item->info->origauthor; ?></a>
								<?php } elseif ($item->info->author) { ?>
									<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $item->info->author ) ) );?>
									<a href="<?php echo $publisher->permalink; ?>" title="<?php echo User::get($item->info->author)->displayname; ?>"><?php echo User::get($item->info->author)->displayname; ?></a>
								<?php } else { 
									$publisher = Post::get(array( 'all:info' => array( 'user' => $item->author->id ) ) );?>
									<a href="<?php echo $publisher->permalink; ?>" title="<?php echo $item->author->displayname; ?>"><?php echo $item->author->displayname; ?></a>
								<?php } ?>
							<?php } ?>
					        on <time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						</p>
					</section>
			<?php } ?>
		</div>
	</div>

	<!-- <div class="disqus"><?php /* $theme->comments( $post ); */ ?></div> -->

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
<?php echo $theme->display('sidebar.article.right'); ?>
<?php echo $theme->display('footer'); ?>
