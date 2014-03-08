<?php echo $theme->display( 'header'); ?>
<?php if ( $post ) { ?>
	<div id="content">
		<div class="breadcrumb">
			<span class="first"><a href="/videos">Videos ›</a></span> <span class="brief-title"><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></span>
			<div class="pager">
				<?php if ($previous = $post->descend()): ?>
				<a class="prev" href="<?php echo $previous->permalink ?>" title="<?php echo $previous->title; ?>">« Previous</a>
				<?php endif; ?>
				<?php if ($post->ascend() && $post->descend()) : echo " | "; endif; ?>
				<?php if ($next = $post->ascend()): ?>
				<a class="next" href="<?php echo $next->permalink ?>" title="<?php echo $next->title; ?>">Next »</a>
				<?php endif; ?>
			</div>
		</div>
		<div id="main" class="article-single">
    		<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?> plugticle plugnibble">
				<header>
					<div class="metacat"><span><?php echo $post->info->metacat; ?></span></div>
					<hgroup>
						<h1><?php echo $post->title_out; ?></h1>
						<?php /*?><h2 class="excerpt"><?php echo $post->info->excerpt; ?></h2> */?>
					</hgroup>
				</header>
				<section class="meta">
					<?php if ( $post->info->showauthor == 1 ) { ?>
						<span class="article-autor">
							<?php if ( $post->info->origsource ) { ?>
								<a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>" title="Portrait"><?php echo $post->info->origauthor; ?></a>
							<?php } else { 
								$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><?php echo $post->author->displayname; ?></a>
							<?php } ?>
						|</span>
					<?php } ?>
					<span class="article-lastmodified"><time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{d}</span> <span>{M}</span> <span>{Y}</span>'); ?></time></span>
					<?php /* ?><span><a class="alignright entry-comments" href="<?php echo $post->url ?>#disqus_thread">Comments</a></span> */ ?>
					<?php if ( User::identify()->loggedin ) { ?>
							<span class="alignright article-edit">&nbsp;| <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					<?php } ?>
					<span class="alignright">&nbsp;| <span class="addthis_toolbox addthis_default_style"><a class="addthis_button_email tool-email">E-Mail</a></span></span>
					<span class="alignright"><a href="javascript:window.print()">Print</a></span>
					<span class="article-tags"><span class="label"><?php if ($post->tags_out) { ?> | archived in:  <?php } ?>&nbsp;</span><?php echo $post->tags_out; ?> </span>
					<div class="clearfix"></div>
				</section>
				<section class="body"><?php echo $post->content_out; ?></section>
				<a href="<?php Site::out_url( 'habari' ); ?>/crowdfunding" title="Together we build the Future of Europe!">
					<img style="margin: 5px 0 5px;" src="<?php Site::out_url( 'theme' )?>/img/static/bottom-banner-02.png" width="627" height="124" />
				</a>
				<footer>
					<?php if ( $post->author->info->userfield_Description || $post->info->origauthor ) { 
						if ( $post->info->showauthor == 1 ) { ?>
						<section class="meta authorbox">
							<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
								This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
							<?php } elseif ( $post->author->info->userfield_Description ) { ?>
								<span>
									<?php echo $post->author->info->userfield_Description; ?>
								</span>
							<?php } ?>
						</section>
					<?php } } ?>
					<section class="meta">
						<div class="printemail">
							<span><a href="javascript:window.print()">Print</a></span> | <span class="addthis_toolbox addthis_default_style"><a class="addthis_button_email tool-email">E-Mail</a></span>
							<?php if ( User::identify()->loggedin ) { ?>
									<span class="article-edit alignright"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
							<?php } ?>
						</div>
						<span class="spreadtheword">Spread the word:</span>
						<div class="addthis addthis_toolbox addthis_default_style ">
							<a class="addthis_button_pinterest_pinit" pi:pinit:media="<?php echo $post->info->photourl; ?>"></a>
							<div class="scoopit-wrap"><a href="http://www.scoop.it" class="scoopit-button" scit-position="none" >Scoop.it</a></div>
							<a class="addthis_button_linkedin_counter" li:counter="none"></a> 
							<a class="addthis_button_reddit"></a>
							<a class="addthis_button_stumbleupon"></a>
							<a class="addthis_button_vk"></a>
							<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
							<a class="addthis_button_tweet" tw:count="vertical" tw:via="one1europe"></a>
							<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>	
							<a class="addthis_counter"></a>
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
						<div class="clearfix"></div>
					</section>
				</footer>
			</article>
			<aside class="disqus"><?php $theme->comments( $post ); ?></aside>
		</div>
	</div>
<?php
	echo $theme->display ( 'sidebar.nibble.right' );
} else {
	echo $theme->display ( '404msg' );
}
echo $theme->display ( 'footer' );
?>
