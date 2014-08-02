<?php echo $theme->display ( 'header'); ?>
<article class="full">
	<?php if(isset($post)) { ?>
		<div class="search-results">		
			<?php foreach ($posts as $post ) { ?>
				<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>" class="result">
					<?php if ( $post->typename == 'article' ) { ?><div class="badge">Article</div><?php } 
					if ( $post->typename == 'profile' ) {?><div class="badge">Profile</div><?php }
					if ( $post->typename == 'initiative' ) {?><div class="badge">Initiative</div><?php } 
					if ( $post->typename == 'debate' ) {?><div class="badge">Debate</div><?php }
					if ( $post->typename == 'brief' ) {?><div class="badge">Brief</div><?php } ?>
					<div class="img-wrap-result">
						<img src="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>" width="276" height="276" />
					</div>
					<?php
						$excerpt = strip_tags($post->info->excerpt);
						$excerpt = (strlen($excerpt) > 170) ? substr($excerpt, 0, 169) . '...' : $excerpt;
						$title = (strlen($post->title_out) > 55) ? substr($post->title_out, 0, 54) . '...' : $post->title_out;
					?>
					<h2><?php echo $title; ?></h2>
					<p><time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time> &ndash; <?php echo $excerpt; ?></p>
				</a>
			<?php } ?>
			<div class="pagination">
				<?php echo $theme->prev_page_link(_t('Previous'), array('class' => 'previous')); ?>
				<?php echo $theme->page_selector(null, array('leftSide' => 6, 'rightSide' => 6, 'hideIfSinglePage' => true)); ?>
				<?php echo $theme->next_page_link(_t('Next'), array('class' => 'next')); ?>
			</div>
		</div>
	<?php } else { ?>
		<div class="centered"><h1>Nothing found</h1></div>
	<?php } ?>
</article>
<?php echo $theme->display('footer'); ?>