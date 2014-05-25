<?php echo $theme->display( 'header'); ?>
<?php if ($post) { ?>
<div id="main" class="profile-single">
	<div id="profile">
		<div class="primary">
			<h1><?php echo $post->title; ?></h1>
			<div class="right-col">
				<img class="pic" src="<?php if ( $post->info->photourl ) { echo $post->info->photourl; } else { echo Site::out_url( 'theme' ) . '/img/face.jpg'; } ?>" />
			</div>
 			<div id="post-<?php echo $post->id; ?>" class="card <?php echo $post->statusname; ?>">
				<?php echo $post->content_out; ?>
				<?php if ( User::identify()->loggedin ) { ?>
					<span class="article-edit right"><a href="<?php echo $post->editlink; ?>" title="<?php _e('Edit post'); ?>"><?php _e('Edit'); ?></a></span>
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="secondary">
			<?php if (is_object($news)) {
				$count = $news->count_all();
					if ( $count > 0 ) { ?>
						<aside>
					        <div class="h"><span>News about <?php echo $post->title; ?>:</span></div>
					        <div class="affiliated-posts tile-thumbs list-1">
					        	<?php foreach ($news as $item ) { ?>
					        		<div class="list">
					        			<a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><img src="<?php echo $item->info->photourl; ?>" alt="<?php if ( $item->info->photoinfo ) { echo $item->info->photoinfo; } else { echo $item->title; } ?>" height="100" width="160"/></a>
					        			<header>
					        				<h2><a href="<?php echo $item->permalink; ?>" title="<?php echo $item->title; ?>"><?php echo $item->title_out; ?></a></h2>
					        			</header>
					        			<article class="body"><?php if ( $item->info->excerpt ) { echo $item->info->excerpt; }  else { echo $item->content_out; }?></article>
					        			<footer>
					        				<span class="entry-tags">
					        			        <?php if ( $show_author && $item->typename == 'article' ) { ?>
					        						<span class="entry-autor">
					        							<?php if ( $item->info->origauthor ) { ?>
					        								<a href="<?php if ( $item->info->origprofile ) { echo $item->info->origprofile; } else { echo $item->info->origsource; } ?>" title="Portrait"><span><?php echo $item->info->origauthor; ?></span></a>
					        							<?php } elseif ($item->info->author) { ?>
					        								<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $item->info->author ) ) );?>
					        								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo User::get($item->info->author)->displayname; ?></span></a>
					        							<?php } else { 
					        								$publisher = Post::get(array( 'all:info' => array( 'user' => $item->author->id ) ) );?>
					        								<a href="<?php echo $publisher->permalink; ?>" title="Portrait"><span><?php echo $item->author->displayname; ?></span></a>
					        							<?php } ?>
					        						</span>
					        					<?php } ?>
					        			        on <time datetime="<?php echo $item->pubdate->text_format('{Y}-{m}-{d}'); ?>"><?php echo $item->pubdate->text_format('<span>{M}</span> <span>{d}</span>, <span>{Y}</span>'); ?></time>
					        				</span>
					        			        <a class="alignright entry-comments" href="<?php echo $item->permalink ?>#disqus_thread">Comments</a>
					        			</footer>
					        		</div>
					        	<?php } ?>
					        </div>
						</aside>
					<?php } ?>
			<?php } ?>														
		</div>
		<div class="clear"></div>
		<aside class="disqus" style="margin-bottom: 15px;">
			<?php $theme->comments( $post ); ?>
		</aside>
		<div class="sm-buttons at-the-bottom">
			<span>Find us on:</span>
			<a href="https://facebook.com/OneEurope" class="icon-fb" title="Find us on Facebook" target="_blank"></a>
			<a href="https://twitter.com/one1europe" class="icon-tw" title="Follow us on Twitter" target="_blank"></a>
			<a href="http://www.linkedin.com/company/oneeurope" class="icon-in" title="Find us on LinkedIn" target="_blank"></a>
			<a href="https://plus.google.com/118353934830681553476/posts" class="icon-gp" title="Add us to your circles" target="_blank"></a>
			<a href="http://pinterest.com/oneeurope" class="icon-pi" title="Find us on Pinterest" target="_blank"></a>
			<a href="http://www.stumbleupon.com/stumbler/OneEurope" class="icon-st" title="Find us on StumbleUpon" target="_blank"></a>
			<a href="http://vk.com/oneeurope" class="icon-vk" title="Find us on VKontakte" target="_blank"></a>
			<a href="/feeds" class="icon-rs" title="Subscribe via RSS"></a>
		</div>
	</div>
<?php echo $theme->display('sidebar.initiative.right'); ?>
<?php } else { ?>
	<?php echo $theme->display('404msg'); ?>
<?php } ?>
<?php echo $theme->display('footer'); ?>
