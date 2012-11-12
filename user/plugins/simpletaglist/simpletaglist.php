<!-- This file can be copied and modified in a theme directory -->
<ul id="tag-links">
<?php foreach( $theme->tag_links as $tag) {
?>
	<li><a href="<?php echo URL::get( 'display_entries_by_tag', array( 'tag'=> $tag->term ), false ); ?>"><?php echo $tag->term_display; ?></a></li>
<? 	} ?>
</ul>
