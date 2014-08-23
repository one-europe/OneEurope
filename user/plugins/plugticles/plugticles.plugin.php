<?php

class Plugticles extends Plugin
{ 
	
	const CONTENT_TYPE = 'article';
	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>Plugticles adds the article content type.</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>article.single.php</code> template. If it does not, you can usually copy <code>plugticle.single</code> to <code>article.single.php</code> and use it.</p>';
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
		// create default access token to re-publish fields
		ACL::create_token( 'republish', _t( 'Allow re-publishing' ), 'Administration', false );
		$group = UserGroup::get_by_name( 'admin' );
		$group->grant( 'republish' );

	}
	/**
	 * Run deactivation routines.
	 */
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( self::CONTENT_TYPE );
		// delete access tokens to re-publish fields
		ACL::destroy_token( 'republish' );

	}
	
	/**
	 * Make the displaying pretty.
	 */
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			self::CONTENT_TYPE => array(
				'singular' => _t( 'Article', self::CONTENT_TYPE ),
				'plural' => _t( 'Articles', self::CONTENT_TYPE ),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	/**
	 * Modify publish form.
	 *
	 * @todo category dropdown, savebutton->tabindex
	 **/
	public function action_form_publish($form, $post)
	{
		// only edit the form if it's an article
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
			
			$form->tags->tabindex = 4;
			$form->tags->move_after($form->excerpt);

			$form->content->tabindex = 5;
			
			// add photo url input field
			$form->append('text', 'photourl', 'null:null', _t('Photo URL (1. upload the image to the media silo, 2. grab its URL, 3. paste it here)'), 'admincontrol_text');
			$form->photourl->tabindex = 6;
			$form->photourl->value = $post->info->photourl;
			$form->photourl->move_after($form->content);
			
			// add photo caption
			$form->append('text', 'photoinfo', 'null:null', _t('Photo Caption'), 'admincontrol_text');
			$form->photoinfo->tabindex = 7;
			$form->photoinfo->value = $post->info->photoinfo;
			$form->photoinfo->move_after($form->photourl);
			
			// add photo licensor field
			$form->append('text', 'photolicense', 'null:null', _t('Photo Licensor'), 'admincontrol_text');
			$form->photolicense->tabindex = 8;
			$form->photolicense->value = $post->info->photolicense;
			$form->photolicense->move_after($form->photoinfo);
			
			// add the articles category
			/*$form->append('text', 'metacat', 'null:null', _t('Category'), 'admincontrol_text');
			$form->metacat->tabindex = 100;
			$form->metacat->value = $post->info->metacat;
			$form->metacat->move_after($form->photolicense);*/


			// only allow re-publish data if user is in that group
			if ( User::identify()->can('republish') ) {

				// add original source of the article
				// $form->append('text', 'origsource', 'null:null', _t('Is this article re-published? If so, enter the full url of the original source here.'), 'admincontrol_text');
				// $form->origsource->tabindex = 9;
				// $form->origsource->value = $post->info->origsource;
				// $form->origsource->move_after($form->photolicense);	
	
				// add field for the name of the source
				// $form->append('text', 'origauthor', 'null:null', _t('In case this is re-published, enter the name of that source/author here'), 'admincontrol_text');
				// $form->origauthor->tabindex = 10;
				// $form->origauthor->value = $post->info->origauthor;
				// $form->origauthor->move_after($form->origsource);

				// add field for additional desc of that source
				// $form->append('text', 'originfo', 'null:null', _t('Please add a describing sentence about that source here'), 'admincontrol_text');
				// $form->originfo->tabindex = 11;
				// $form->originfo->value = $post->info->originfo;
				// $form->originfo->move_after($form->origauthor);

				// add field for the 1e-profile of that source
				/*$form->append('text', 'origprofile', 'null:null', _t('The link of the source\'s 1E-profile, if there is one'), 'admincontrol_text');
				$form->origprofile->tabindex = 12;
				$form->origprofile->value = $post->info->origprofile;
				$form->origprofile->move_after($form->originfo);*/

			}


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
			$form->append( 'select', 'debate', 'null:null', _t( 'Contributes to the following debate:' ), $slugs, 'tabcontrol_select' ); 
			
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
			$form->debate->tabindex = 13;
			$form->debate->move_after($form->photolicense);
			
			// make a dropdown of all initiatives with set slugs
			// $initiatives = Posts::get( array( 'content_type' => 'initiative', 'status' => 'published' ) );
			// $slugs = array(); 								// create second, empty array
			// $i = 1;
			// foreach ($initiatives as $initiative) { 					// for every initiative of the first one... 
			// 	if ( $i == 1 ) {
			// 		$slugs[] = 'None';
			// 		$i++;
			// 	}
			// 	if ( $initiative->title ) {			// ...if it has a displayname...
			// 		$slugs[] = $initiative->title;	// ...fill an object in the new array aka [nr] => [displayname]
			// 	}
			// } 												// use this value in the dropdown
			// $form->append( 'select', 'initiative', 'null:null', _t( 'Reports about the following initiative:' ), $slugs, 'tabcontrol_select' ); 
			// $ids = array();
			// $i = 1;
			// foreach ($initiatives as $initiative) { 					// ..
			// 	if ( $i == 1 ) {
			// 		$ids[] = '0';
			// 		$i++;
			// 	}
			// 	if ( $initiative->title ) {
			// 		$ids[] = $initiative->id;						// overwrite the slugs with ids, cause this is what we receive from the db
			// 		$i++;
			// 	}
			// }
			// $key = array_search( $post->info->initiative, $ids ); 
			// $form->initiative->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			// $form->initiative->tabindex = 14;
			// $form->initiative->move_after($form->debate);
			
							
			
			$form->save->tabindex = $form->save->tabindex + 20;
			// nonworking & causing errors on MAMP
			//$form->publish->tabindex = $form->publish->tabindex + 20;
			//$form->delete->tabindex = $form->delete->tabindex + 20;
			
			
			// append this post to the profile of ... need: list of profiles, similar to the list of authors in plugprofiles
			//$form->append('text', 'append', 'null:null', _t('Append this article to the institution profile of ... (make sure that the name is spelled correctly!)'), 'admincontrol_text');
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
			
			// only change db entry if user can have entered something new
			if ( User::identify()->can('republish') ) {
				//$post->info->origsource = $form->origsource->value;
				//$post->info->origauthor = $form->origauthor->value;			
				//$post->info->originfo = $form->originfo->value;
				//$post->info->origprofile = $form->origprofile->value;
			}

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
			
		}
	}
	
	
	// not working yet
	/*public function filter_template_user_filters( $user_filters = array() ) {
		parent::act_display( array( 'not:any:info' => array( 'debate' => '0' ) ) );
	}*/

	// Habari 0.9 solution for sorting out doubles on the front page
	/*public function filter_posts_get_update_preset($preset_parameters, $presetname, $paramarray) {
		switch($presetname) {
			case 'home':
				$notallinfo = isset($preset_parameters['not:all:info']) ? Utils::single_array($preset_parameters['not:all:info']) : array();
				$notallinfo['debate'] = 0;
				$preset_parameters['not:all:info'] = $notallinfo;
				break;
		}
		return $preset_parameters;
	}*/


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
	 * Modify output in the rss feed (include post info metadata)
	 **/
    public function action_rss_add_post( $feed_entry, $post )
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
    }

	/**
	 * Modify output in the atom feed (include post info metadata)
	 **/
    public function action_atom_add_post( $feed_entry, $post )
    {
        $info = $post->info->get_url_args();
        foreach( $info as $key => $value ) {
            if( is_array( $value ) && isset( $value['enclosure'] ) ) {
                $enclosure = $feed_entry->addChild( 'link' );
                $enclosure->addAttribute( 'rel', 'enclosure' );
                $enclosure->addAttribute( 'title', $post->title );
                $enclosure->addAttribute( 'href', $value['enclosure'] );
                $enclosure->addAttribute( 'length', $value['size'] );
                $enclosure->addAttribute( 'type', 'text' );
            }
        }
		if( Post::type( self::CONTENT_TYPE ) == $post->content_type )
			$feed_entry->content[0] = '<strong>'.$post->info->excerpt.'</strong> '.$feed_entry->content[0];
    }
	
	/**
	 * Add articles to the global posts atom feed
	 **/
	public function filter_atom_get_collection_content_type( $content_type )
    {
        $content_type = Utils::single_array( $content_type );
        $content_type[] = Post::type( self::CONTENT_TYPE );
        return $content_type;
    }

}
?>