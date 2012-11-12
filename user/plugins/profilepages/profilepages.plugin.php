<?php

class Profilepages extends Plugin
{ 
	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>ProfilePages adds the profilepage content type.</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>profilepage.single.php</code> template. If it does not, you can usually copy <code>profilepage.single</code> to <code>profilepage.single.php</code> and use it.</p>';
		return $str;
	}

	/**
	 * Register content type
	 **/
	public function action_plugin_activation( $plugin_file )
	{

		// Don't process other plugins
		if ( Plugins::id_from_file($file) == Plugins::id_from_file(__FILE__) ) {

			// Insert new post content types
			Post::add_new_type( 'profilepage', true );

			// Create new rewrite rule for showing projects
			$rule = RewriteRule::create_url_rule('"profile"/{$slug}', 'UserThemeHandler', 'display_profile');
			$rule->parse_regex = '%profile/(?P<slug>[^/]+)/?$%i';
			$rule->build_str   = 'profile/{$slug}';
			$rule->description = 'Simple Profile Management';
			$rule->insert();
		}
		
		// Give anonymous users access
		$group = UserGroup::get_by_name('anonymous');
		$group->grant('post_article', 'read');
	}
	
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( 'profilepage' );
	}
	
	/**
	 * Create name string. This is where you make what it displays pretty.
	 **/
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			'profilepage' => array(
				'singular' => _t('Profile'),
				'plural' => _t('Profiles'),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	/**
	 * Modify publish form.
	 **/
	public function action_form_publish($form, $post, $context)
	{
		// only edit the form if it's a profilepage
		if ($form->content_type->value == Post::type('profilepage'))
		{
			// remove tags field for profiles, profiles aren't being tagged
			$form->tags->remove();
			
			// add profile settings fields
			$settings = $form->publish_controls->append('fieldset', 'profileSettings', _t('Profile Settings'));

			// add photo url			
			$settings->append('text', 'photourl', 'null:null', _t('Photo URL (media silo)'), 'tabcontrol_text');
			$settings->photourl->value = $post->info->photourl;

			// add URL
			$settings->append('text', 'url', 'null:null', _t('URL of the institution'), 'tabcontrol_text');
			$settings->url->value = $post->info->url;
			
			// add twitter account entry
			$settings->append('text', 'twitter', 'null:null', _t('associated Twitter account'), 'tabcontrol_text');
			$settings->twitter->value = $post->info->twitter;
			
			/* $settings->append('tags', 'associated', 'null:null', _t('Author account this profile belongs to'), 'tabcontrol_text');
			$settings->associated->value = $post->info->associated;*/
	
		}
	}
	
	/**
	 * Save our data to the database
	 **/
	public function action_publish_post( $post, $form )
	{
		if ($post->content_type == Post::type('profilepage'))
		{
			// Save settings
			$post->info->photourl = $form->photourl->value;
			$post->info->url = $form->url->value;
			//$post->info->associated = $form->associated->value;
			$post->info->twitter = $form->twitter->value;
			// No, it really is that easy to save data
		}
	}

	/**
	 * Add the 'profilepage' type to the list of templates that we can use. This is what makes Habari display articles in the global post output.
	 **/
	public function filter_template_user_filters($filters) {
		if(isset($filters['content_type'])) {
			$filters['content_type']= Utils::single_array( $filters['content_type'] );
			$filters['content_type'][]= Post::type('profilepage');
		}
		return $filters;
	}
	
	
	/**
	 * Handle displays
	 */
	public function filter_theme_act_display_project($handled, $theme)
	{
		/**
		 * Tell Habari which files are to be used,
		 * we attempt to get any project theme file first.
		 * if that fails we goto single and then multiple
		 */
		$paramarray['fallback'] = array(
		 'profile.{$id}', //match project.234.php , where 234 is the id of the post
		 'profile.{$slug}', //match project.my-project.php, where my-project is the slug of the post
		 //'profile.tag.{$posttag}', //match project.tag1.php, project.tag2.php...where tag1,tag2... are post's tag
		 'profile.single', //match project.single.php
		 'profile.multiple', //match project.multiple.php
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