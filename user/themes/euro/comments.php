<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } ?>

<?php if ( $post->comments->moderated->count > 0 ) { ?>
		
	<div class="responses">

		<h3><?php echo $post->comments->moderated->count ?> Response<?php if ( $post->comments->moderated->count > 1) { ?>s<?php } ?> to "<?php echo $post->title; ?>"</h3>

		<?php if ( $post->comments->moderated->count > 0 ) { ?>

			<section id="comments">
			<?php
			foreach ( $post->comments->moderated as $comment ) {
				if ( $comment->url_out == '' ) {
					$comment_url = $comment->name_out;
				}
				else {
					$comment_url = '<a href="' . $comment->url_out . '" rel="external">' . $comment->name_out . '</a>';
				}
			?>
	
				<article class="comment" id="comment-<?php echo $comment->id; ?>">
		
					<header>
			
						<?php if ( $comment->status == Comment::STATUS_UNAPPROVED ) { ?><span class="comment-meta"><?php _e('In moderaton'); ?></span><?php } ?>
						<span class="comment-autor"><?php echo $comment_url; ?> meint:</span>
						<time datetime="<?php $comment->date->out('Y-m-d'); ?>" class="comment-time"><a href="#comment-<?php echo $comment->id; ?>" title="Permanent Link to this Comment"><?php $comment->date->out('d. M Y - g:i'); ?></a></time>
						
					</header>
		
					<?php echo $comment->content_out; ?>
		
				</article>
					
			<?php } ?>
			
			</section>

		<?php } ?>
		
	</div>
		
<?php } ?>

	<div class="reply">
		<h2 id="comment"><?php _e('Leave a Reply'); ?></h2>
		<?php if ( Session::has_messages() ) {
			Session::messages_out();
		}
		if ( ! $post->info->comments_disabled ) {
			$post->comment_form()->out();
		} ?>
	</div>