<?php

class PlugAuthor extends Plugin
{
 
	/**
	 * On plugin activation
	 */
	public function author_plugin_activation( $file )
	{
		// Don't process other plugins
		if ( Plugins::id_from_file($file) == Plugins::id_from_file(__FILE__) ) {
 
			// Insert new post content types
			Post::add_new_type( 'author', true );
 
			// Create new rewrite rule for showing authors
			$rule = RewriteRule::create_url_rule('"author"/{$slug}', 'UserThemeHandler', 'display_author');
			$rule->parse_regex = '%author/(?P<slug>[^/]+)/?$%i';
			$rule->build_str   = 'author/{$slug}';
			$rule->description = 'Simple author Management';
			$rule->insert();
		}
	}
 
	
	public function author_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( 'author' );
	}
	
	
	/**
	 * Create name string. This is where you make what it displays pretty.
	 **/
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			'author' => array(
				'singular' => _t('Author'),
				'plural' => _t('Authors'),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
 
	/**
	 * Manage authors
	 */
	public function author_form_publish( $form, $post )
	{
		if ( $form->content_type->value == Post::type( 'author' ) ) {
 
			// Add author settings fields
			$settings = $form->publish_controls->append('fieldset', 'authorSettings', _t('Author Settings'));
 
			// Add version entry
			$settings->append('text', 'version', 'null:null', _t('who is there?'), 'tabcontrol_text');
			$settings->version->value = $post->info->version;
 
			// Add license entry
			$settings->append('text', 'license', 'null:null', _t('lalala'), 'tabcontrol_text');
			$settings->license->value = $post->info->license;
		}
	}
 
 
	/**
	 * Now we need to save our custom entries
	 */
	public function author_publish_post( $post, $form )
	{
		if ( $post->content_type == Post::type( 'author' ) ) {
 
			// Save settings
			$post->info->version = $form->version->value;
			$post->info->license = $form->license->value;
			// No, it really is that easy to save data
		}
	}
 
 
	/**
	 * Handle displays
	 */
	public function filter_theme_act_display_author($handled, $theme)
	{
		/**
		 * Tell Habari which files are to be used,
		 * we attempt to get any author theme file first.
		 * if that fails we goto single and then multiple
		 * THESE files are searched in your current theme DIRECTORY
		 */
		$paramarray['fallback'] = array(
		 'author.{$id}', //match author.234.php , where 234 is the id of the post
		 'author.{$slug}', //match author.my-author.php, where my-author is the slug of the post
		 //'author.tag.{$posttag}', //match author.tag1.php, author.tag2.php...where tag1,tag2... are post's tag
		 'author.single', //match author.single.php
		 'author.multiple', //match author.multiple.php
		 'single', //single.php
		 'multiple', //multiple.php
		);
 
		// This is like Post::get().. Get one row, one item
		$paramarray['user_filters'] = array(
		 'fetch_fn' => 'get_row',
		 'limit' => 1,
		);
 
		return $theme->act_display( $paramarray );
	}
}
 
?>
