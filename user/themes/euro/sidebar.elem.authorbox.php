<section class="authorbox">
	<div class="h"><span>Author</span></div>
	<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
		This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> 
		<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
		.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
		come from, with profile here if existing.<br /> */ ?>
	<?php } elseif ($post->info->author) { ?>
		<?php $publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );?>
		<a href="<?php echo $publisher->permalink; ?>">
			<img alt="<?php echo User::get($post->info->author)->displayname; ?>" src="<?php if ( User::get($post->info->author)->info->photourl ) { echo User::get($post->info->author)->info->photourl; } else { echo $publisher->info->photourl; } ?>" />
			<h3><?php if (  User::get($post->info->author)->info->displayname ) { echo User::get($post->info->author)->info->displayname; } else { echo $publisher->title; } ?></h3>
			<p><?php if ( User::get($post->info->author)->info->teaser ) { echo User::get($post->info->author)->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
			<p class="nopbottom">read more › </p>
			<div class="clear"></div>
		</a>
		<?php if (User::get($post->info->author)->info->twitter) { ?>
			<a href="https://twitter.com/<?php echo User::get($post->info->author)->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php } elseif ($publisher->info->twitter) { ?>
			<a href="https://twitter.com/<?php echo $publisher->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php } ?>
	<?php } else { 
		$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
		<a href="<?php echo $publisher->permalink; ?>">
			<img alt="<?php echo $post->author->displayname; ?>" src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
			<h3><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></h3>
			<p><?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?></p>
			<p class="nopbottom">read more › </p>
			<div class="clear"></div>
		</a>
		<?php if ($publisher->info->twitter) { ?>
			<a href="https://twitter.com/<?php echo $publisher->info->twitter; ?>" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @<?php echo $publisher->info->twitter; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php } ?>
	<?php } ?>
	<div class="clear"></div>
</section>