<section class="side-block">
	<a class="top-link" href="#">Recently Published</a>
	<div class="recent">
	<?php
		foreach ($theme->recent_posts as $post) {
			echo '<a href="', $post->permalink, '">', $post->title, '</a>';
		}
	?>
</section>