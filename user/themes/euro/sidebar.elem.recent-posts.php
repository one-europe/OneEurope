<section class="recentposts">
	<div class="h"><span>Recently Published</span></div>
	<ul>
		<?php
			foreach ($theme->recent_posts as $post) {
				echo '<li><a href="', $post->permalink, '">', $post->title, '</a></li>';
			}
		?>
	</ul>
</section>