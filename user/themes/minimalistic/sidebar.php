<div id="sidebar" class="toggle">

<?php Plugins::act( 'theme_sidebar_top' ); ?>

		
	<?php if(Options::out('about')) { ?>
		<section class="sb-about">
			<h2><?php _e('About'); ?></h2>
			<p><?php Options::out('about'); ?></p>
		</section>
	<?php } ?>

	<?php /* <section class="blubb">
		
		<p class="expand">What's this about?</p>
	 	<div class="collapse sabout">
			there came a little lorem, that made a little
			ipsum. and since they found each other, they became lorem ipsum.
		</div>
		
	</section> */ ?>
	
	<?php $theme->show_tagcanvas() ?>
	
	<?php $theme->breezyarchives(); ?>
	
	<section class="recentposts">
		<h3>Letzte Artikel</h3>
		<ul>
			<?php
				foreach ($theme->recent_posts as $post) {
					echo '<li><a href="', $post->permalink, '">',
					$post->title, '</a></li>';
				}
			?>
		</ul>
	</section>
	
	<section class="subscribe">
		<h3>Subscribe</h3>
		<div id="subscribe">
			<a href="<?php echo Options::out('habari') ?>/atom/1" rel="nofollow"><img src="<?php Site::out_url( 'theme' ); ?>/img/atom.png" alt="Atom-Feed" height="155" width="155" /></a>
			<a href="http://twitter.com/vOoiJe" rel="nofollow" ><img src="<?php Site::out_url( 'theme' ); ?>/img/twitter.png" alt="Twitter-Feed" height="155" width="155" /></a>
		</div>
	</section>

<?php Plugins::act( 'theme_sidebar_bottom' ); ?>

</div>