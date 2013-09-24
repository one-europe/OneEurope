<?php if ($matched_rule->name != 'display_videos') {
	echo $theme->display('home');
} else { ?>
<?php echo $theme->display('header'); ?>
	<div class="breadcrumb">
		<span class="first"><a href="/videos">Videos ›</a></span>
	</div>
	<div id="content" class="home">
		<ul class="nibble-list">
			<?php foreach ($videos as $post ) { ?>						
			<li class="nibble">
				<?php if ( $post->status == Post::status('scheduled') ) { ?>
					<div class="content-badge scheduled">
						<span>scheduled</span>
					</div>
				<?php } ?>
				<article style="padding: 16px 0 11px 10px; width: 380px;">
					<!-- <a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><img class="img" src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" height="100" width="160"/></a> -->
					<?php
						preg_match('/<iframe(.*?)>(.*?)<\/iframe>/si', strip_tags($post->content_fulltext, '<iframe>'), $matches);
						$iframe = preg_replace(
							['/width=\"\d+\"/', '/height=\"\d+\"/', '/src=\"(.*?)\"/'],
							['width="380"', 'height="233"', 'src="${1}?modestbranding=1&rel=0&showinfo=0"'],
							$matches[0]
						);
						echo $iframe;
					?>
				</article>
				<aside style="width: 210px">
					<h3><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h3>
					<?php echo strip_tags($post->content_videotext, '<p><span>'); ?>
					<p style="padding: 0;">
						<a class="entry-comments" href="<?php echo $post->url ?>#disqus_thread" data-disqus-identifier="<?php echo $page ?> <?php echo $post->permalink; ?>">Comments</a>
						<span class="timestamp">posted on <time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time></span>
						<?php if ( User::identify()->loggedin ) { ?>
								<span class="alignright article-edit"> <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
						<?php } ?>
					</p>
					<div class="addthis">
						<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						<a class="addthis_button_tweet" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						<a class="addthis_button_facebook_send" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						<a class="addthis_button_pinterest_pinit" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						<a class="addthis_counter addthis_pill_style" addthis:url="<?php echo $post->permalink; ?>" addthis:title="<?php echo $post->title; ?>"></a>
						</div>
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
						<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fe91cf356685c8e"></script>
						<!-- AddThis Button END -->
					</div>
				</aside>
				<div class="clear"></div>
			</li>
			<?php } ?>
		</ul>
		<?php if ( $current_page >= 2 || $all > $pagination ) { ?>
			<div class="pagination">
				<?php if ( $current_page >= 2 ) { ?>
					<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page - 1; ?>" title="Previous Page" class="alignleft">&laquo; Newer Posts</a>
				<?php } if ( $all > $pagination ) { ?>
					<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page + 1; ?>" title="Previous Page" class="alignright">Older Posts &raquo;</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php echo $theme->display ('sidebar.nibble.right'); ?>
<?php echo $theme->display ('footer'); ?>
<?php } ?>


<?php /* echo $theme->display('header'); ?>
<div id="content" class="videos">
	<?php foreach ( $videos as $post ) { ?>
	<div class="video-item">
		<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>">
			<img class="img" src="<?php echo $post->info->photourl ? $post->info->photourl : Site::out_url( 'theme' ) . '/img/video-icon.png'; ?>" height="100" width="160"/>
		</a>
		<h2><a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>"><?php echo $post->title_out; ?></a></h2>
	</div>
	<?php } ?>
	<?php if ( $current_page >= 2 || $there_are_more ) { ?>
		<div class="pagination">
			<?php if ( $current_page >= 2 ) { ?>
				<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page - 1; ?>" 
					title="Previous Page" class="alignleft">&laquo; Newer Videos</a>
			<?php } if ( $there_are_more ) { ?>
				<a href="<?php Site::out_url( 'home' ); ?>/videos/page/<?php echo $current_page + 1; ?>" 
					title="Previous Page" class="alignright">Older Videos &raquo;</a>
			<?php } ?>
		</div>
	<?php } ?>
</div>
<?php echo $theme->display ('sidebar'); ?>
<?php echo $theme->display ('footer'); */ ?>