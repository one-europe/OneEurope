<?php echo $theme->display('header'); ?>

			<div class="submenu">
				<ul>
					<li><a href="/about">About</a></li>
					<li><a href="/join-us">Join us</a></li>
					<li><a href="/become-a-patron"><b>Become a Patron</b></a></li>
					<li><a href="/contact">Contact</a></li>
					<li class="clear"></li>
				</ul>
			</div>
			
		
			<div class="content become-a-patron">					
			
				<h1><?php echo $post->title_out; ?></h1>
														
				<article class="body"><?php echo $post->content_out; ?></article>
			
			</div>

			<?php if ( User::identify()->loggedin ) { ?>
					<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>

			<?php } ?>
			
<?php echo $theme->display ('footer'); ?>

