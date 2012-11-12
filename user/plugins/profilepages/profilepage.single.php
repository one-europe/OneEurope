<?php echo $theme->display ( 'header'); ?>

<?php /* echo $theme->display ( 'sidebar.article.left' ); **** POSTPONED ****/ ?>

<!-- profile.single -->

	<div id="content">
		<div id="primary">

    		<article id="post-<?php echo $post->id; ?>" class="<?php echo $post->statusname; ?> plugticle">

				<header>
					<div class="metacat"><span>Institution Profile</span></div>
					<hgroup>
						<h1><?php echo $post->title_out; ?></h1>
					</hgroup>
				</header>
				
				<?php if ( User::identify()->loggedin ) { ?>
					<section class="meta">
						<span class="article-edit"> | <a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
					</section>
				<?php } ?>

				<section class="body">
					
					<figure>					
						<img src="<?php echo $post->info->photourl; ?>" />
					</figure>			
				
					<?php echo $post->content_out; ?>
				
				</section>

			</article>
		
			<aside>
				
				<h3>All articles are written by <?php echo $post->author?></h3>
			
				<div class="meta affiliated-posts">
				
					<span>{This is a list of all the posts that <?php echo $post->title; ?> has or that were in their name published}</span>
				
					<ul>
						<li>1</li>
						<li>2</li>
						<li>3</li>
						<li>4</li>
					</ul>
				
				</div>
				
			</aside>

		</div>

 	</div>

<!-- /event.single -->

<?php echo $theme->display ( 'sidebar.article.right' ); ?>

<?php echo $theme->display ( 'footer' ); ?>
