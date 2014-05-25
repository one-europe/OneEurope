
	<section class="trending">
		<div class="h"><span>The Debates</span></div>
		
		<ul class="dossier">
			
				<?php 
				$posts = Posts::get( array( 'content_type' => 'debate', 'status' => 'published', 'limit' => 2 /* attention: $i */ ) );
				foreach ($posts as $post ) { ?>
						
					<li>
						<h3><a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a></h3>

						<div class="teaserlist">
				
						<?php 
						$id = $post->id;
						$teasers = Posts::get( array( 'all:info' => array( 'debate' => $id ), 'limit' => 2 ) ); 
						foreach ( $teasers as $teaser ) { ?>
					
							<a href="<?php echo $teaser->permalink; ?>"><?php echo $teaser->title; ?> ›</a><br/>

						<?php } ?>
					
						</div>
					</li>
			
				<?php } ?>
			
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/debates">view all ›</a></li>
			
		</ul>
		
	</section>	