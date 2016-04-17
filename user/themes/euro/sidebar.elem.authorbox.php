<section class="side-block">
	<span class="top-link">Author</span>
	<?php if ( $post->info->origauthor && $post->info->origsource ) { ?>
		<p class="profile">This article was originally published by <a href="<?php if ( $post->info->origprofile ) { echo $post->info->origprofile; } else { echo $post->info->origsource; } ?>"><?php echo $post->info->origauthor; ?></a>. <?php echo $post->info->originfo; ?> </p>
		<?php /* Introductory sentence about the author, this is sth he can edit himself, but written in 3rd person
		.. this is linking to his/her profiles on twitter, flattr etc. .. and a link to the organisation they
		come from, with profile here if existing.<br /> */ ?>
	<?php } elseif ($post->info->author) { ?>
		<?php
		$publisher = Post::get(array( 'all:info' => array( 'user' => $post->info->author ) ) );
		if ($publisher) {
		?>
		<a class="profile" href="<?php echo $publisher->permalink; ?>">
			<img alt="<?php echo User::get($post->info->author)->displayname; ?>" src="<?php if ( User::get($post->info->author)->info->photourl ) { echo User::get($post->info->author)->info->photourl; } else { echo $publisher->info->photourl; } ?>" width="95" />
			<p class="teaser"><b><?php if (  User::get($post->info->author)->info->displayname ) { echo User::get($post->info->author)->info->displayname; } else { echo $publisher->title; } ?></b>
			<?php if ( User::get($post->info->author)->info->teaser ) { echo User::get($post->info->author)->info->teaser; } else { echo $publisher->info->teaser; } ?>
			<span class="read-more">read more</span></p>
		</a>
		<?php if (User::get($post->info->author)->info->twitter) { ?>
			<div class="follow-me">
				<a href="https://twitter.com/<?php echo explode('-', User::get($post->info->author)->info->twitter)[0]; ?>"
					class="twitter-follow-button"
					data-show-count="false"
					data-dnt="true">Follow @<?php echo explode('-', User::get($post->info->author)->info->twitter)[0]; ?>
				</a>
			</div>
		<?php } elseif ($publisher->info->twitter) { ?>
			<div class="follow-me">
				<a href="https://twitter.com/<?php echo explode('-', $publisher->info->twitter)[0]; ?>"
					class="twitter-follow-button"
					data-show-count="false"
					data-dnt="true">Follow @<?php echo explode('-', $publisher->info->twitter)[0]; ?>
				</a>
			</div>
		<?php } ?>
		<?php } else { echo '<p class="profile">' . User::get($post->info->author)->displayname . '</p>'; }?>
	<?php } else {
		$publisher = Post::get(array( 'all:info' => array( 'user' => $post->author->id ) ) );?>
		<a class="profile" href="<?php echo $publisher->permalink; ?>">
			<img alt="<?php echo $post->author->displayname; ?>" src="<?php if ( $post->author->info->photourl ) { echo $post->author->info->photourl; } else { echo $publisher->info->photurl; } ?>" />
			<p class="teaser"><b><?php if (  $post->author->displayname ) { echo $post->author->displayname; } else { echo $publisher->title; } ?></b>
			<?php if ( $post->author->info->teaser ) { echo $post->author->info->teaser; } else { echo $publisher->info->teaser; } ?>
			<span class="read-more">read more</span></p>
		</a>
		<?php if ($publisher->info->twitter) { ?>
			<div class="follow-me">
				<a href="https://twitter.com/<?php echo explode('-', $publisher->info->twitter)[0]; ?>"
					class="twitter-follow-button"
					data-show-count="false"
					data-dnt="true">Follow @<?php echo explode('-', $publisher->info->twitter)[0]; ?>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
</section>


<?php
	if ($post->info->editor) {
		$username = User::get_by_id($post->info->editor)->username;
		$editor = DB::get_row('
			SELECT {posts}.slug, {postinfo}.value as teaser
			FROM {posts}
			JOIN {postinfo} ON {posts}.id = {postinfo}.post_id
			WHERE title LIKE "%' . $username . '%" AND name = "teaser" LIMIT 1
		');

		if ($editor) {
		?>
			<section class="side-block">
				<span class="top-link">Editor</span>
				<a class="profile" href="/team/<?= $editor->slug ?>">
					<p class="teaser"><b><?= $username ?></b><?= $editor->teaser ?></p>
				</a>

<?php } } ?>

<?php
	if ($post->info->editor2) {
		$username2 = User::get_by_id($post->info->editor2)->username;
		$editor2 = DB::get_row('
			SELECT {posts}.slug, {postinfo}.value as teaser
			FROM {posts}
			JOIN {postinfo} ON {posts}.id = {postinfo}.post_id
			WHERE title LIKE "%' . $username2 . '%" AND name = "teaser" LIMIT 1
		');

		if ($editor2) {
		?>
				<a class="profile" href="/team/<?= $editor->slug ?>">
					<p class="teaser"><b><?= $username2 ?></b><?= $editor2->teaser ?></p>
				</a>
<?php } } ?>

<?php if ($editor || $editor2) { ?></section><?php } ?>
