<?php

class PlugVideos extends Plugin
{ 	
	
	const CONTENT_TYPE = 'video';

	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>Plugvideoss adds video content type</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>video.single.php</code> template. If it does not, you can usually copy <code>plugvideo.single.php</code> to <code>video.single.php</code> in your file and use it.</p>';
		return $str;
	}


	/**
	 * On plugin activation
	 */
	public function action_plugin_activation($file)
	{
			// Don't process other plugins
			if ( Plugins::id_from_file($file) == Plugins::id_from_file(__FILE__) ) {

				// Insert new post content types
				Post::add_new_type( self::CONTENT_TYPE, true );
				
				// Give anonymous users access, if the group exists
				$group = UserGroup::get_by_name( 'anonymous ');
				if ( $group ) {
					$group->grant( self::CONTENT_TYPE, 'read' );
				}
			}
	}
	
	/**
	 * On deactivation
	 */
	public function action_plugin_deactivation($file)
	{
		// Unregister content type
		Post::deactivate_post_type( self::CONTENT_TYPE );
	}
	
	/**
	 * Prettify the displaying
	 */
	public function filter_post_type_display($type,$foruse)
	{
		$names = array(
			self::CONTENT_TYPE => array(
				'singular' => _t('Video', self::CONTENT_TYPE ),
				'plural' => _t('Videos', self::CONTENT_TYPE ),
			)
		);
		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type;
	}
	
	
 
	/**
	 * Do changes to the publish form
	 */
	public function action_form_publish( $form, $post, $context )
	{
		// In case the post to publish is a video
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {
			
			// add shorttitle input field
			$form->append('text', 'shorttitle', 'null:null', _t('Short Title (for display on frontpage - can be the actual title itself if it\'s short enough)'), 'admincontrol_text');
			$form->shorttitle->value = $post->info->shorttitle;
			$form->shorttitle->tabindex = 2;
		    $form->shorttitle->move_after($form->title);
			
			// add excerpt field
			$form->append('text', 'excerpt', 'null:null', _t('Subtitle'), 'admincontrol_text');
			$form->excerpt->tabindex = 3;
			$form->excerpt->value = $post->info->excerpt;
			$form->excerpt->move_after($form->shorttitle);

			$form->tags->tabindex = 3; // same for correct tabbing
			$form->tags->move_after($form->excerpt);

			$form->content->tabindex = 4;
			
			// add photo url input field
			$form->append('text', 'photourl', 'null:null', _t('Photo URL (1. upload the image to the media silo, 2. grab its URL, 3. paste it here)'), 'admincontrol_text');
			$form->photourl->tabindex = 5;
			$form->photourl->value = $post->info->photourl;
			$form->photourl->move_after($form->content);
			
			// add photo caption
			$form->append('text', 'photoinfo', 'null:null', _t('Photo Caption'), 'admincontrol_text');
			$form->photoinfo->tabindex = 6;
			$form->photoinfo->value = $post->info->photoinfo;
			$form->photoinfo->move_after($form->photourl);
			
			// add photo license
			$form->append('text', 'photolicense', 'null:null', _t('License Owner'), 'admincontrol_text');
			$form->photolicense->tabindex = 7;
			$form->photolicense->value = $post->info->photolicense;
			$form->photolicense->move_after($form->photoinfo);
			
			// make a dropdown of all debates with set slugs
			$debates = Posts::get( array( 'content_type' => 'debate', 'status' => 'published' ) );
			$slugs = array(); 								// create second, empty array
			$i = 1;
			foreach ($debates as $debate) { 					// for every debate of the first one... 
				if ( $i == 1 ) {
					$slugs[] = 'None';
					$i++;
				}
				if ( $debate->title ) {			// ...if he has a displayname...
					$slugs[] = $debate->title;	// ...fill an object in the new array aka [nr] => [displayname]
				}
			} 												// use this value in the dropdown
			$form->append( 'select', 'debate', 'null:null', _t( 'This post contributes to the following debate:' ), $slugs, 'tabcontrol_select' ); 
			$ids = array();
			$i = 1;
			foreach ($debates as $debate) { 					// ..
				if ( $i == 1 ) {
					$ids[] = '0';
					$i++;
				}
				if ( $debate->title ) {
					$ids[] = $debate->id;						// overwrite the slugs with ids, cause this is what we receive from the db
					$i++;
				}
			}
			$key = array_search( $post->info->debate, $ids ); 
			$form->debate->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			$form->debate->tabindex = 8;
			$form->debate->move_after($form->photolicense);			
			$form->save->tabindex + 20;
			
		}
	}

	/**
	 * Now we need to save our custom entries
	 */
	public function action_publish_post( $post, $form )
	{
		if ( $post->content_type == Post::type( self::CONTENT_TYPE ) ) {
 
			// Save settings
			$post->info->shorttitle = $form->shorttitle->value;
			$post->info->excerpt = $form->excerpt->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->photoinfo = $form->photoinfo->value;
			$post->info->photolicense = $form->photolicense->value;
			
			
			// create the same array for the dropdown as above, but now with id's, and save them as $post->info->debate object to the db
			$debates = Posts::get( array( 'content_type' => 'debate', 'status' => 'published' ) );
			$slugs = array();
			$i = 1;
			foreach ($debates as $debate) { 
				if ( $i == 1 ) {
					$slugs[] = '0';
					$i++;
				}
				if ( $debate->title ) {
					$slugs[] = $debate->id;
					$i++;
				}
			}
			foreach ($debates as $debate) {
				echo $debate->title;
			}
			$post->info->debate = $slugs[$form->debate->value];
		    
			// $initiatives = Posts::get( array( 'content_type' => 'initiative', 'status' => 'published' ) );
			// $slugs = array();
			// $i = 1;
			// foreach ($initiatives as $initiative) { 
			// 	if ( $i == 1 ) {
			// 		$slugs[] = '0';
			// 		$i++;
			// 	}
			// 	if ( $initiative->title ) {
			// 		$slugs[] = $initiative->id;
			// 		$i++;
			// 	}
			// }
			// foreach ($initiatives as $initiative) {
			// 	echo $initiative->title;
			// }
			// $post->info->initiative = $slugs[$form->initiative->value];
			
	    	// $post->info->origsource = $form->origsource->value;
	    	// $post->info->origauthor = $form->origauthor->value;			
           
			// No, it really is that easy to save data
		}
	}
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_videos',
			'parse_regex' => '%^videos(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'videos(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_videos',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display all videos' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_video',
			'parse_regex' => '%video/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'video/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_video',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple video management' )
		);
	  return $rules;
	}
	
	
	/**
	 * Add our content type to the list of templates that we can use. This is what makes Habari display it in the global post output.
	 **/
	public function filter_template_user_filters($filters) {
		if(isset($filters['content_type'])) {
			$filters['content_type']= Utils::single_array( $filters['content_type'] );
			$filters['content_type'][]= Post::type( self::CONTENT_TYPE );
		}
		return $filters;
	}
	
	
	/**
	 * Handle display of single videos
	 */
	public function filter_theme_act_display_video($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'video.{$id}', //match video.234.php , where 234 is the id of the post
			 'video.{$slug}', //match video.my-project.php, where my-video is the slug of the post
			 'video.tag.{$posttag}', //match video.tag1.php, video.tag2.php...where tag1,tag2... are post's tag
			 'video.single', //match video.single.php
			 'video.multiple', //match video.multiple.php
			 'single', //single.php
			 'multiple', //multiple.php
		);
 
		// This is like Post::get().. Get one row, one item
		$paramarray['user_filters'] = array(
		 'nolimit' => TRUE,
		);
 
		return $theme->act_display( $paramarray );
	}
	
	/**
	 * Create list of all videos
	 */
	public function filter_theme_act_display_videos( $handled, $theme )
	{
	  // Try to use the video.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'video.multiple',
	    'multiple',
	  );

	  // Retrieve future videos.

		$page =Controller::get_var( 'page' );
		$pagination = 5;
		if ( $page == '' ) { $page = 1; }
		$theme->current_page = $page;

	  $videos = Posts::get(array(
	    'content_type' => Post::type('video'),
	    'status' => array( Post::status('published'), Post::status('scheduled') ),
		'offset' => ($pagination)*($page)-$pagination,
	    'limit' => $pagination
	  ));
	  // Add the videos to the theme. Access this in your template with $videos.
	  $theme->videos = $videos;
	  $theme->pagination = $pagination;
	 
	  $allvideos = Posts::get(array(
	    'content_type' => Post::type('video'),
	    'status' => array( Post::status('published'), Post::status('scheduled') ),
		'offset' => ($pagination)*($page)-$pagination,
	    'limit' => $pagination
	  ));
	  // Add the videos to the theme. Access this in your template with $videos.
	  $theme->all = $allvideos->count_all();

	



	  $theme->act_display( $paramarray );

	}
	
}
?>