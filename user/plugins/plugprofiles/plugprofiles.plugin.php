<?php

class PlugProfile extends Plugin
{ 	
	
	const CONTENT_TYPE = 'profile';
	
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
				'singular' => _t('Profile', self::CONTENT_TYPE ),
				'plural' => _t('Profiles', self::CONTENT_TYPE ),
			)
		);
		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type;
	}
	
	
 
	/**
	 * Do changes to the publish form
	 */
	public function action_form_publish( $form, $post, $context )
	{
		// In case the post to publish is a profile
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {
			
			
			// add photo url input field
			$form->append('text', 'photourl', 'null:null', _t('Photo URL (upload it to mediasilo and grab its link)'), 'admincontrol_text');
			$form->photourl->value = $post->info->photourl;
			$form->photourl->tabindex = 2;
		    $form->photourl->move_after($form->title);		
		
			// add teaser input field
			$form->append('text', 'teaser', 'null:null', _t('Teaser'), 'admincontrol_text');
			$form->teaser->value = $post->info->teaser;
			$form->teaser->tabindex = 3;
		    $form->teaser->move_after($form->photourl);
		
			$form->content->tabindex = 4;
			
			// add external url input field
			$form->append('text', 'url', 'null:null', _t('URL'), 'admincontrol_text');
			$form->url->value = $post->info->url;
			$form->url->tabindex = 5;
			$form->url->move_after($form->content);
			
			// add twitter channel input field
			$form->append('text', 'twitter', 'null:null', _t('Twitter channel (without @)'), 'admincontrol_text');
			$form->twitter->value = $post->info->twitter;
			$form->twitter->tabindex = 6;
			$form->twitter->move_after($form->url);
			
			
			// add facebook page input field
			$form->append('text', 'fbpage', 'null:null', _t('In case the entity has a facebook page, enter the full link (http://facebook.com/[name]) right here'), 'admincontrol_text');
			$form->fbpage->value = $post->info->fbpage;
			$form->fbpage->tabindex = 7;
			$form->fbpage->move_after($form->twitter);
			
			// add facebook profile channel input field
			$form->append('text', 'fbprofile', 'null:null', _t('In case it is an individual and if it has allowed subscribing to its facebook profile, put the link here'), 'admincontrol_text');
			$form->fbprofile->value = $post->info->fbprofile;
			$form->fbprofile->tabindex = 8;
			$form->fbprofile->move_after($form->fbpage);
			
			// insert "additional links" input field
			$form->insert('tags', 'text', 'more', 'null:null', _t('Additional Links (please enter valid html, so for a list of links, enter: "&lt;a href="URL"&gt;one&lt;/a&gt;,&lt/br&gt;&lt;a href="URL"&gt;two&lt;/a&gt;")'), 'admincontrol_textArea');
			$form->more->value = $post->info->more;
			$form->more->template = 'admincontrol_text';
			$form->more->tabindex = 9;
			$form->more->move_after($form->fbprofile);
			
			
			
			/* 
				This is a little ugly now.
				We create an array which contains all users that have a displayname in the pattern
				[index] => [displayname]. There's no way to let the dropdown save another value than the 
				one that is being displayed, so before we save it we have to redeclare it in order to save
				the id (which we can't get from the displayname later on and cause we can't use the username
				for mysterious reasons, and on top of that don't want to use the latter cause this could
				create confusion one day). As the id is what we receive from the $post->info->user variable,
				we have to re-translate it again to pre-select the right name in the dropdown
			*/
			// make a dropdown of all users with set display names
			$users = Users::get_all(); 						// put all user-objects in one array 
			$names = array(); 								// create second, empty array
			$i = 1;
			foreach ($users as $user) { 					// for every user of the first one... 
				if ( $i == 1 ) {
					$names[] = 'Nobody';
					$i++;
				}
				if ( $user->info->displayname ) {			// ...if he has a displayname...
					$names[] = $user->info->displayname;	// ...fill an object in the new array aka [nr] => [displayname]
				}
			} 												// use this value in the dropdown
			$form->append( 'select', 'user', 'null:null', _t( 'Permit the following user to hijack/overwrite this profile:' ), $names, 'tabcontrol_select' ); 
			$ids = array();
			$i = 1;
			foreach ($users as $user) { 					// ..
				if ( $i == 1 ) {
					$ids[] = '0';
					$i++;
				}
				if ( $user->info->displayname ) {
					$ids[] = $user->id;						// overwrite the displaynames with ids, cause this is what we receive from the db
					$i++;
				}
			}
			$key = array_search( $post->info->user, $ids ); 
			$form->user->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			$form->user->tabindex = 10;
			$form->user->move_after($form->more);
			
			$form->tags->tabindex = 12;

			// buggy, dunno why
			$form->save->tabindex = $form->save->tabindex + 20;
			

			$profoptions = $form->publish_controls->append( 'fieldset', 'profoptions', 'Profile Options' );

			//$ccontributor = $profoptions->append( 'checkbox', 'ccontributor', 'null:null', _t('Content Contributor') );
			//$ccontributor->value = strlen( $post->info->ccontributor ) ? $post->info->ccontributor : '' ;
			//$ccontributor->template = 'tabcontrol_checkbox';
			
			$fbsubscribe = $profoptions->append( 'checkbox', 'fbsubscribe', 'null:null', _t('Allows FB-Subscriptions') );
			$fbsubscribe->value = strlen( $post->info->fbsubscribe ) ? $post->info->fbsubscribe : '' ;
			$fbsubscribe->template = 'tabcontrol_checkbox';
			
			
		}
	}
 
 
	/**
	 * Now we need to save our custom entries
	 */
	public function action_publish_post( $post, $form )
	{
		if ( $post->content_type == Post::type( self::CONTENT_TYPE ) ) {
 
			// Save settings
			$post->info->teaser = $form->teaser->value;			
			$post->info->photourl = $form->photourl->value;
			$post->info->url = $form->url->value;
			$post->info->twitter = $form->twitter->value;
			$post->info->fbprofile = $form->fbprofile->value;
			$post->info->fbpage = $form->fbpage->value;
			$post->info->more = $form->more->value;
			//$post->info->ccontributor = $form->ccontributor->value;
			$post->info->fbsubscribe = $form->fbsubscribe->value;
			
			// create exactly the same array as above, but with id's 
			// and save them as $post->info->user object to the db
			$users = Users::get_all();
			$names = array();
			$i = 1;
			foreach ($users as $user) { 
				if ( $i == 1 ) {
					$names[] = '0';
					$i++;
				}
				if ( $user->info->displayname ) {
					$names[] = $user->id;
					$i++;
				}
			}
			$post->info->user = $names[$form->user->value];
			
			
			// No, it really is that easy to save data
		}
	}
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_profiles',
			'parse_regex' => '%^profiles(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'profiles(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_profiles',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display all profiles' )
		);
		$rules[] = new RewriteRule(array(
			'name' => 'display_contributors',
			'parse_regex' => '%^contributors(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'contributors(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_contributors',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display contributors' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_profile',
			'parse_regex' => '%profiles/(?P<slug>[^/]+)(?:/page/(?P<page>\d+))?/?$%i',
			'build_str' => 'profiles/{$slug}(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_profile',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple profile management' )
		);
	  return $rules;
	}
	
	/**
	 * Handle display of single profiles
	 */
	public function filter_theme_act_display_profile($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'profile.{$id}', //match profile.234.php , where 234 is the id of the post
			 'profile.{$slug}', //match profile.my-project.php, where my-profile is the slug of the post
			 'profile.tag.{$posttag}', //match profile.tag1.php, profile.tag2.php...where tag1,tag2... are post's tag
			 'profile.single', //match profile.single.php
			 'profile.multiple', //match profile.multiple.php
			 'single', //single.php
			 'multiple', //multiple.php
		);

		// This is like Post::get().. Get one row, one item
		$paramarray['user_filters'] = array(
		 'nolimit' => TRUE,
		);


		// Retrieve the paginated list of the autor's pieces
		// therefore, set some pagination variables
		$page =Controller::get_var( 'page' );
		$pagination = 5;
		if ( $page == '' ) { $page = 1; }
		$theme->current_page = $page;

		// Retrieve our post object of the profile in display
		$post_slug = $theme->matched_rule->named_arg_values['slug'];
		$post = Post::get( array( 'slug' => $post_slug ) );

		$pieces = Posts::get(
			array(
				'all:info' => array('author' => $post->info->user ),
			    'content_type' => Post::type('article'),
			    'status' => Post::status('published'),
				'offset' => ($pagination)*($page)-$pagination,
			    'limit' => $pagination
			)
		);

		$theme->pieces = $pieces;
		
		$all = Posts::get(
			array(
				'all:info' => array('author' => $post->info->user ),
			    'content_type' => Post::type('article'),
			    'status' => Post::status('published'),
				'nolimit' => true
			)
		);
	    $theme->there_are_more = false;
	    if ( $all->count_all() > $pagination*$page ) {
	 		$theme->there_are_more = true;
	    }

		return $theme->act_display( $paramarray );
	}
	
	/**
	 * Create list of all profiles
	 */
	public function filter_theme_act_display_profiles( $handled, $theme )
	{
	  // Try to use the profile.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'profile.multiple',
	    'multiple',
	  );

	  // Retrieve all profiles.
	  $allprofiles = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
	    'nolimit' => TRUE,
		'orderby' => 'title ASC'
	
	  ));

	  // Add the profiles to the theme. Access this in your template with $allprofiles.
	  $theme->allprofiles = $allprofiles;

	  $theme->act_display( $paramarray );

	}
	
	public function filter_theme_act_display_contributors( $handled, $theme )
	{
	  // Try to use the profile.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'profile.multiple',
	    'multiple',
	  );
	
	  $authors = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'author'),
	  	'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));
	  $directors = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'director'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));
	  $ambassadors = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'ambassador'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));	
	  $partners = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'partner'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));		  
	  $formerpartners = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'former'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));		  
	  $editors = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'editor'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));	
	  $itdept = Posts::get(array(
	    'content_type' => Post::type('profile'),
	    'status' => Post::status('published'),
		'vocabulary' => array('systags:term' => 'it'),
		'orderby' => 'title ASC',
	    'nolimit' => TRUE
	  ));
	  

	  // Add the profiles to the theme. Access this in your template with $allprofiles.
	  $theme->contributors = $contributors;
	  $theme->directors = $directors;
	  $theme->authors = $authors;
	  $theme->ambassadors = $ambassadors;
	  $theme->formerpartners = $formerpartners;
	  $theme->partners = $partners;
	  $theme->editors = $editors;
	  $theme->itdept = $itdept;

	  $theme->act_display( $paramarray );

	}
	
	/**
	 * Add the configuration to the user page
	 **/
	public function action_form_user( $form, $user )
	{
		$fieldset = $form->append( 'wrapper', 'profile', 'Profile' );
		$fieldset->class = 'container settings';
		$fieldset->append( 'static', 'profile', '<h2>Profile Options</h2>' );

		$teaser = $fieldset->append( 'text', 'teaser', 'null:null', _t('Teaser'), 'optionscontrol_text' );
		$teaser->class[] = 'item clear';
		$teaser->value = $user->info->teaser;
		
		$description = $fieldset->append( 'text', 'description', 'null:null', _t('Describing sentence'), 'optionscontrol_text' );
		$description->class[] = 'item clear';
		$description->value = $user->info->description;

		$url = $fieldset->append( 'text', 'url', 'null:null', _t('Homepage'), 'optionscontrol_text' );
		$url->class[] = 'item clear';
		$url->value = $user->info->url;
		
		$twitter = $fieldset->append( 'text', 'twitter', 'null:null', _t('Twitter Username'), 'optionscontrol_text' );
		$twitter->class[] = 'item clear';
		$twitter->value = $user->info->twitter;
		
		$photourl = $fieldset->append( 'text', 'photourl', 'null:null', _t('Photo URL'), 'optionscontrol_text' );
		$photourl->class[] = 'item clear';
		$photourl->value = $user->info->photourl;

		$content = $fieldset->append( 'text', 'content', 'null:null', _t('About Text'), 'optionscontrol_textarea' );
		$content->class[] = 'item clear';
		$content->value = $user->info->content;
		
		$fbprofile = $fieldset->append( 'text', 'fbprofile', 'null:null', _t('Are you an individual? Please enter your facebook profile if you have one'), 'optionscontrol_text' );
		$fbprofile->class[] = 'item clear';
		$fbprofile->value = $user->info->fbprofile;
		
		$fbsubscribe = $fieldset->append( 'checkbox', 'fbsubscribe', 'null:null', _t('Is subscribing activated?'), 'optionscontrol_checkbox' );
		$fbsubscribe->class[] = 'item clear';
		$fbsubscribe->value = $user->info->fbsubscribe;
		
		$fbpage = $fieldset->append( 'text', 'fbpage', 'null:null', _t('Facebook page instead?'), 'optionscontrol_text' );
		$fbpage->class[] = 'item clear';
		$fbpage->value = $user->info->fbpage;

		$more = $fieldset->append( 'text', 'more', 'null:null', _t('Additional links? (valid html)'), 'optionscontrol_text' );
		$more->class[] = 'item clear';
		$more->value = $user->info->more;

		$form->move_before( $fieldset, $form->page_controls );
	
			//$post = Post::get( array( 'any:info' => array( 'user' => $user->id ) ) );	    
			//echo $post->title;
			
	}

	/**
	 * Save authentication fields
	 **/
	public function filter_adminhandler_post_user_fields( $fields )
	{
	/*	$post = Post::get( array( 'any:info' => array( 'user' => $user->id ) ) );	    
		
		$post->info->twitter = $twitter->value;*/
		$fields[] = 'teaser';
		$fields[] = 'description';
		$fields[] = 'url';
		$fields[] = 'twitter';
		$fields[] = 'photourl';
		$fields[] = 'content';
		$fields[] = 'fbprofile';
		$fields[] = 'fbsubscribe';
		$fields[] = 'fbpage';
		$fields[] = 'more';

		return $fields;
	}
	
	
	
	/**
	* superfluous, no?
	*
	* Add additional controls to the User page
	*
	* @param FormUI $form The form that is used on the User page
	* @param Post $post The user being edited
	**/
	/* public function action_form_user( $form, $edit_user )
	{

		$selfmanagement = $form->append( 'wrapper', 'selfmanagement', 'Profile Options');
		$selfmanagement->class = 'container settings';
		$selfmanagement->append( 'static', 'selfmanagement', _t( '<h2>Profile Options</h2>' ) );

		foreach($fields as $field) {
			$fieldname = "selfmanagement_{$field}";
			$customfield = $selfmanagements->append( 'text', $fieldname, 'null:null', $field );
			$customfield->value = isset( $edit_user->info->{$fieldname} ) ? $edit_user->info->{$fieldname} : '';
			$customfield->class[] = 'important item clear';
			$customfield->template = 'optionscontrol_text';
		}
		$form->move_after( $selfmanagements, $form->user_info );
	}

	/**
	 * Add the Additional User Fields to the list of valid field names.
	 * This causes adminhandler to recognize the fields and
	 * to set the userinfo record appropriately
	**
	public function filter_adminhandler_post_user_fields( $fields )
	{
		
		$selfmanagement = Options::get( 'selfmanagements__fields' );
		if ( !is_array($selfmanagements) || count( $selfmanagements ) == 0 ) {
			return;
		}

		foreach($selfmanagements as $field) {
			$fields[ $field ] = "selfmanagement_{$field}";

		}
		return $fields;
	}

	*/
	

}
?>