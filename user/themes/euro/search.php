<?php echo $theme->display ( 'header'); ?>

<?php /* TODO: echo $theme->display ( 'actioncontrolcenter' ); */ ?>


		
	<?php if(isset($post)) { ?>
		
		<div id="searchresults">		
		
			<?php foreach ($posts as $post ) { ?>
						
				<a href="<?php echo $post->permalink; ?>" title="<?php echo $post->title; ?>" class="tile">
					
					<?php if ( $post->typename == 'article' ) { ?>
						<div class="badge">
							<span>Article</span>
						</div>
					<?php } 
					if ( $post->typename == 'profile' ) {?>
							<div class="badge">
								<span>Profile</span>
							</div>
					<?php }
					if ( $post->typename == 'initiative' ) {?>
							<div class="badge">
								<span>Initiative</span>
							</div>
					<?php } 
					if ( $post->typename == 'debate' ) {?>
							<div class="badge">
								<span>Debate</span>
							</div>
					<?php }
					if ( $post->typename == 'nibble' ) {?>
							<div class="badge">
								<span>Brief</span>
							</div>
					<?php } ?>

					<div class="imgbox">
						<img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" alt="<?php echo $post->info->photoinfo; ?>"/>
					</div>

					<header>

						<h3><?php echo $post->title_out; ?></h3>
						<span class="entry-tags">
							<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						</span>

					</header>

					<article class="body"><?php echo $post->info->excerpt;?></article>

				</a>
									
			<?php } ?>
			
			<section id="page-selector" class="clear">

		<?php echo $theme->prev_page_link('&laquo; ' . _t('Newer Posts') ); ?>
		<?php echo $theme->page_selector ( null, array( 'leftSide' => 2, 'rightSide' => 2 ) ); ?>
		<?php echo $theme->next_page_link( _t('Older Posts') . ' &raquo;'); ?>

			</section>
			
		</div>
	
	<?php } else { ?>

		<div class="centered">
			<h1>Nothing found.</h1>
		</div>
		
	<?php } ?>
	

	
<?php echo $theme->display ( 'footer'); ?>
