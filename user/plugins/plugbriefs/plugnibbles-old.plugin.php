<?php

class Plugnibbles extends Plugin
{ 
	
	const CONTENT_TYPE = 'nibble';
	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>PlugNibbles adds the \"nibble\" content type.</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>nibble.single.php</code> template. If it does not, you can usually copy <code>plugnibbles.single.php</code> to <code>nibble.single.php</code> and use it.</p>';
		return $str;
	}

	/**
	 * Run activation routines
	 **/
	public function action_plugin_activation( $plugin_file )
	{
    // add the content type.
		Post::add_new_type( self::CONTENT_TYPE );
		
		// Give anonymous users access, if the group exists
		$group = UserGroup::get_by_name( 'anonymous ');
		if ( $group ) {
			$group->grant( self::CONTENT_TYPE, 'read' );
		}
	}
	/**
	 * Run deactivation routines.
	 */
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( self::CONTENT_TYPE );
	}
	
	/**
	 * Make the displaying pretty.
	 */
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			self::CONTENT_TYPE => array(
				'singular' => _t( 'Nibble', self::CONTENT_TYPE ),
				'plural' => _t( 'Nibbles', self::CONTENT_TYPE ),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	/**
	 * Modify publish form.
	 *
	 * @todo category dropdown, savebutton->tabindex
	 **/
	public function action_form_publish($form, $post, $context)
	{
		// only edit the form if it's an nibble
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {
			
			
			// add photo url input field
			$form->append('text', 'photourl', 'null:null', _t('Photo URL (1. upload the image to the media silo, 2. grab its URL, 3. paste it here)'), 'admincontrol_text');
			$form->photourl->tabindex = 2;
			$form->photourl->value = $post->info->photourl;
			$form->photourl->move_after($form->content);
			
			// add photo caption
			$form->append('text', 'photoinfo', 'null:null', _t('Photo Caption'), 'admincontrol_text');
			$form->photoinfo->tabindex = 3;
			$form->photoinfo->value = $post->info->photoinfo;
			$form->photoinfo->move_after($form->photourl);
			
			// add photo license
			$form->append('text', 'photolicense', 'null:null', _t('Photo License'), 'admincontrol_text');
			$form->photolicense->tabindex = 4;
			$form->photolicense->value = $post->info->photolicense;
			$form->photolicense->move_after($form->photoinfo);
			
			$form->content->tabindex = 5;
			
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
			$form->append( 'select', 'debate', 'null:null', _t( 'Contribution to the following debate:' ), $slugs, 'tabcontrol_select' ); 
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
			$form->debate->tabindex = 6;
			$form->debate->move_after($form->tags);
			
			
			
			// make a dropdown of all initiatives with set slugs
			$initiatives = Posts::get( array( 'content_type' => 'initiative', 'status' => 'published' ) );
			$slugs = array(); 								// create second, empty array
			$i = 1;
			foreach ($initiatives as $initiative) { 					// for every initiative of the first one... 
				if ( $i == 1 ) {
					$slugs[] = 'None';
					$i++;
				}
				if ( $initiative->title ) {			// ...if it has a displayname...
					$slugs[] = $initiative->title;	// ...fill an object in the new array aka [nr] => [displayname]
				}
			} 												// use this value in the dropdown
			$form->append( 'select', 'initiative', 'null:null', _t( 'Related to the following initiative:' ), $slugs, 'tabcontrol_select' ); 
			$ids = array();
			$i = 1;
			foreach ($initiatives as $initiative) { 					// ..
				if ( $i == 1 ) {
					$ids[] = '0';
					$i++;
				}
				if ( $initiative->title ) {
					$ids[] = $initiative->id;						// overwrite the slugs with ids, cause this is what we receive from the db
					$i++;
				}
			}
			$key = array_search( $post->info->initiative, $ids ); 
			$form->initiative->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			$form->initiative->tabindex = 7;
			$form->initiative->move_after($form->tags);
			
			
			
			
			// add original source of the nibble
			$form->append('text', 'origsource', 'null:null', _t('Is this nibble re-published? If so, enter the full url of the original source here.'), 'admincontrol_text');
			$form->origsource->tabindex = 8;
			$form->origsource->value = $post->info->origsource;
			$form->origsource->move_after($form->photolicense);		
			// add field for the name of the source
			$form->append('text', 'origauthor', 'null:null', _t('In case this is re-published, enter the name of that source/author here'), 'admincontrol_text');
			$form->origauthor->tabindex = 9;
			$form->origauthor->value = $post->info->origauthor;
			$form->origauthor->move_after($form->origsource);
				
			$form->tags->move_after($form->origauthor);
			$form->tags->tabindex = 10;
			
			$unrequired = $form->publish_controls->append( 'fieldset', 'unrequired', 'Additional Options' );
			
			$showauthor = $unrequired->append( 'checkbox', 'showauthor', 'null:null', _t('Show the author?') );
			$showauthor->value = strlen( $post->info->showauthor ) ? $post->info->showauthor : '' ;
			$showauthor->template = 'tabcontrol_checkbox';
			
			$form->save->tabindex + 20;
			
			// append this post to the nibble of ... need: list of nibbles, similar to the list of authors in plugnibbles
			//$form->append('text', 'append', 'null:null', _t('Append this nibble to the institution nibble of ... (make sure that the name is spelled correctly!)'), 'admincontrol_text');
			//$form->append->value = $post->info->append;
			//$form->append->template = 'admincontrol_text';
			
			//$form->append('file', 'photo', 'path:' . Site::get_dir('files') . '/photos', 'Thumbnail Image');
			// load values and display the fields
		}
	}
	
	/**
	 * Save our data to the database
	 **/
	public function action_publish_post( $post, $form )
	{
		if ($post->content_type == Post::type( self::CONTENT_TYPE ) )
		{
			$post->info->shorttitle = $form->shorttitle->value;
			$post->info->excerpt = $form->excerpt->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->photoinfo = $form->photoinfo->value;
			$post->info->photolicense = $form->photolicense->value;
			//$post->info->metacat = $form->metacat->value;
			
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
			
			
			$initiatives = Posts::get( array( 'content_type' => 'initiative', 'status' => 'published' ) );
			$slugs = array();
			$i = 1;
			foreach ($initiatives as $initiative) { 
				if ( $i == 1 ) {
					$slugs[] = '0';
					$i++;
				}
				if ( $initiative->title ) {
					$slugs[] = $initiative->id;
					$i++;
				}
			}
			foreach ($initiatives as $initiative) {
				echo $initiative->title;
			}
			$post->info->initiative = $slugs[$form->initiative->value];
			
			$post->info->origsource = $form->origsource->value;
			$post->info->origauthor = $form->origauthor->value;			
			$post->info->originfo = $form->originfo->value;
			$post->info->orignibble = $form->orignibble->value;
			
		}
	}

	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_nibbles',
			'parse_regex' => '%^in-brief(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'in-brief(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_nibbles',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display all nibbles' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_nibble',
			'parse_regex' => '%in-brief/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'in-brief/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_nibble',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple nibble management' )
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
	 * Handle display of single nibbles
	 */
	public function filter_theme_act_display_nibble($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'nibble.{$id}', //match nibble.234.php , where 234 is the id of the post
			 'nibble.{$slug}', //match nibble.my-project.php, where my-nibble is the slug of the post
			 'nibble.tag.{$posttag}', //match nibble.tag1.php, nibble.tag2.php...where tag1,tag2... are post's tag
			 'nibble.single', //match nibble.single.php
			 'nibble.multiple', //match nibble.multiple.php
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
	 * Create list of all nibbles
	 */
	public function filter_theme_act_display_nibbles( $handled, $theme )
	{
	  // Try to use the nibble.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'nibble.multiple',
	    'multiple',
	  );

	  // Retrieve all nibbles.
	  $allnibbles = Posts::get(array(
	    'content_type' => Post::type('nibble'),
	  //  'status' => Post::status('published'),
	    'nolimit' => TRUE,
	
	  ));

	  // Add the nibbles to the theme. Access this in your template with $allnibbles.
	  $theme->allnibbles = $allnibbles;

	  $theme->act_display( $paramarray );

	}
	
	
	
	
	/**
	 * Modify output in the rss feed (include post info metadata)
	 **/
    /* public function action_rss_add_post( $feed_entry, $post )
    {
        $info = $post->info->get_url_args();
        foreach( $info as $key => $value ) {
            if( is_array( $value ) && isset( $value['enclosure'] ) ) {
                $enclosure = $feed_entry->addChild( 'enclosure' );
                $enclosure->addAttribute( 'url', $value['enclosure'] );
                $enclosure->addAttribute( 'length', $value['size'] );
                $enclosure->addAttribute( 'type', 'text' );
            }
        }
    }*/

	/**
	 * Modify output in the atom feed (include post info metadata)
	 **/
    public function action_atom_add_post( $feed_entry, $post )
    {
//        $info = $post->info->get_url_args();
//        foreach( $info as $key => $value ) {
//            if( is_array( $value ) && isset( $value['enclosure'] ) ) {
//                $enclosure = $feed_entry->addChild( 'link' );
//                $enclosure->addAttribute( 'rel', 'enclosure' );
//                $enclosure->addAttribute( 'href', $value['enclosure'] );
//                $enclosure->addAttribute( 'length', $value['size'] );
//                $enclosure->addAttribute( 'type', 'text' );
//            }
//        }
		if( Post::type( self::CONTENT_TYPE ) == $post->content_type )
			$feed_entry->content[0] = '<strong>'.$post->info->excerpt.'</strong> '.$feed_entry->content[0];
    }
	
	/**
	 * Add nibbles to the global posts atom feed
	 **/
	public function filter_atom_get_collection_content_type( $content_type )
    {
        $content_type = Utils::single_array( $content_type );
        $content_type[] = Post::type( self::CONTENT_TYPE );
        return $content_type;
    }

}
?>