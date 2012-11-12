<?php
class MagicTags extends Plugin
{
	/**
	 * function info
	 * Returns information about this plugin
	 * @return array Plugin info array
	 **/
	
	/**
	 * filters display of tags for posts to hide any that begin with "@" from display
	 **/
	 
	
	
	public function filter_post_tags_out( $tags )
	{
		$tags= array_filter($tags, create_function('$a', 'return $a{0} != "@";'));
		$tags= Format::tag_and_list($tags);
		return $tags;
	}

	/**
	 * Displays a list of all tags used on the site except those begining with "@" as a comma seperated linked list.
	 **/
	 
	public function magic_site_tags()
	{
		$tagcount= 0;
		foreach(DB::get_results('SELECT ' . DB::table('tags') . '.tag_text, ' . DB::table('tags') . '.tag_slug, COUNT(' . DB::table('tag2post') . '.post_id) AS post_count FROM ' . DB::table('tag2post') . ' RIGHT JOIN ' . DB::table('posts') . ' ON ' . DB::table('tag2post') . '.post_id = ' . DB::table('posts') . '.id INNER JOIN ' . DB::table('tags') . ' ON ' . DB::table('tags') . '.id = ' . DB::table('tag2post') . '.tag_id WHERE ' . DB::table('posts') . '.status=3 GROUP BY ' . DB::table('tag2post') . '.tag_id ORDER BY post_count DESC') as $tag) {
			
			if (substr($tag->tag_text, 0, 1)== "@") {continue;}
			if ($tag->post_count == 0) {continue;}
			if ($tagcount!= 0) {echo ", ";}
			
			echo "<a href=\"" . URL::get('display_posts_by_tag', 'tag=' . $tag->tag_slug) . "\">{$tag->tag_text}</a>($tag->post_count)";
			$tagcount++;
		}	
	}
}

?>
