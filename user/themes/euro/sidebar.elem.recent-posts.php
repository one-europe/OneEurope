<section class="side-block">
	<a class="top-link" href="#">Recently Published</a>
	<div class="recent">
	<?php
		$recent_posts = Posts::get(array( 'content_type' => array( 'article' ), 'limit' => 8, 'status'=>'published', 'orderby'=>'pubdate DESC'));
		foreach ($recent_posts as $post) { echo '<a href="', $post->permalink, '">', $post->title, '</a>'; }
	?>
</section>