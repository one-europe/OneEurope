
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
			
			<?php /* li>		
				<?php $i = 1; // TAG 2
				$posts = Posts::get( array( 'vocabulary' => array( 'tags:term' => 'tag2' ), 'content_type' => 'article', 'status' => 'published', 'limit' => 3 ) );
				foreach ($posts as $post ) { ?>
			
					<?php if ($i == 1) { ?>
			
					<div class="first">
			
						<a href="<?php echo $post->permalink; ?>"><img src="<?php Site::out_url( 'theme' ); ?>/img/grey.gif" data-original="<?php echo $post->info->photourl; ?>" /></a>
						<h3><a href="<?php echo $post->permalink; ?>"><?php echo $post->title_out; ?></a></h3>
						<time datetime="<?php echo $post->pubdate->text_format('{Y}-{m}-{d}'); ?>" pubdate><?php echo $post->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
						<p class="author"><?php echo $post->author->displayname; ?></p>
				
					</div>
					<div class="teaserlist">
				
					<?php } else { ?>
						<a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?> ›</a><br/>
					<?php } ?>
					<?php if ( $i == 3 ) { ?>
						</div>
					<?php } ?>
			
				<?php $i++; } ?>
			</li */ ?>
			
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/debates">view all ›</a></li>
			
		</ul>
		
	</section>	