
	<section class="viral">
		<div class="h"><span>Most Shared</span></div>


		<!-- AddThis Trending Content BEGIN -->
		<div id="addthis_trendingcontent"></div>
		<script>
			addthis.box("#addthis_trendingcontent", {
				feed_title : "",
				feed_type : "shared",
				feed_period : "week",
				num_links : 8,
				height : "auto",
				width : "auto",
				domain : "one-europe.info",
				remove : "- OneEurope"}
			);
		</script>
		<!-- AddThis Trending Content END -->


		<?php /* <ul>
			<?php
			$recent = Posts::get( array( 'content_type' => 'initiative', 'limit'=>8, 'status'=>'published', 'orderby'=>'pubdate DESC' ) );
				foreach ($recent as $rec) {
					echo '<li><a href="', $rec->permalink, '">',
					$rec->title, ' ›</a></li>';
				}
			?>
		
			<li class="all"><a href="<?php Site::out_url( 'home' ); ?>/initiatives">view all ›</a></li>
		
		</ul> */ ?>
	</section>