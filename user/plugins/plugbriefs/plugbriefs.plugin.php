<?php

class PlugBriefs extends Plugin
{ 	
	
	const CONTENT_TYPE = 'brief';

	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>Plugbriefs adds the brief content type.</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>brief.single.php</code> template. If it does not, you can usually copy <code>plugbrief.single.php</code> to <code>brief.single.php</code> in your file and use it.</p>';
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
				'singular' => _t('Brief', self::CONTENT_TYPE ),
				'plural' => _t('Briefs', self::CONTENT_TYPE ),
			)
		);
		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type;
	}
	
	
 
	/**
	 * Do changes to the publish form
	 */
	public function action_form_publish( $form, $post, $context )
	{
		// In case the post to publish is a brief
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
			// $form->append( 'select', 'initiative', 'null:null', _t( 'This is a report about this initiative:' ), $slugs, 'tabcontrol_select' ); 
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
			// $form->initiative->tabindex = 9;
			// $form->initiative->move_after($form->debate);
			
			
			
			// add original source of the nibble
			// $form->append('text', 'origsource', 'null:null', _t('Is this content re-published? If so, enter the full url of the original source here.'), 'admincontrol_text');
			// $form->origsource->tabindex = 9;
			// $form->origsource->value = $post->info->origsource;
			// $form->origsource->move_after($form->initiative);		
			// add field for the name of the source
			// $form->append('text', 'origauthor', 'null:null', _t('In case this is re-published, enter the name of that source/author here'), 'admincontrol_text');
			// $form->origauthor->tabindex = 10;
			// $form->origauthor->value = $post->info->origauthor;
			// $form->origauthor->move_after($form->origsource);
			
			
			/* * * * * * * * * *
			* This is causing heavy damage.
			* Posts published with this part of the code active crash the front page,
			* by replacing home.php on the front with multiple.brief.php, for 
			* some reason I don't get.
			* * * * * * * * * * 
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
			$form->append( 'select', 'initiative', 'null:null', _t( 'This is a report about this initiative:' ), $slugs, 'tabcontrol_select' ); 
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
			$form->initiative->tabindex = 8;
			$form->initiative->move_after($form->origauthor);*/
			
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
			
	  //   	$post->info->origsource = $form->origsource->value;
	  //   	$post->info->origauthor = $form->origauthor->value;			
           
			// No, it really is that easy to save data
		}
	}
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_briefs',
			'parse_regex' => '%^eurographics(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'eurographics(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_briefs',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display all eurographics' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_brief',
			'parse_regex' => '%eurographics/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'eurographics/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_brief',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple infographic management' )
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
	 * Handle display of single briefs
	 */
	public function filter_theme_act_display_brief($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'brief.{$id}', //match brief.234.php , where 234 is the id of the post
			 'brief.{$slug}', //match brief.my-project.php, where my-brief is the slug of the post
			 'brief.tag.{$posttag}', //match brief.tag1.php, brief.tag2.php...where tag1,tag2... are post's tag
			 'brief.single', //match brief.single.php
			 'brief.multiple', //match brief.multiple.php
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
	 * Create list of all briefs
	 */
	public function filter_theme_act_display_briefs( $handled, $theme )
	{
	  // Try to use the brief.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'brief.multiple',
	    'multiple',
	  );

	  // Retrieve future briefs.

		$page =Controller::get_var( 'page' );
		$pagination = 5;
		if ( $page == '' ) { $page = 1; }
		$theme->current_page = $page;

	  $briefs = Posts::get(array(
	    'content_type' => Post::type('brief'),
	    'status' => array( Post::status('published') ),
		'offset' => ($pagination)*($page)-$pagination,
	    'limit' => $pagination
	  ));

	  // Add the briefs to the theme. Access this in your template with $briefs.
	  $theme->briefs = $briefs;
	  $theme->pagination = $pagination;

	  $theme->act_display( $paramarray, true );
	}

	public static function theme_page_selector_briefs1( $theme, $rr_name = null, $settings = array() )
	{
		// We can't detect proper pagination if $theme->briefs isn't a Posts object, 
		// so if it's not, bail.
		if(!$theme->briefs instanceof Posts) {
			return '';
		}
		$current = $theme->page;
		$items_per_page = isset( $theme->briefs->get_param_cache['limit'] ) ?
			$theme->briefs->get_param_cache['limit'] :
			Options::get( 'pagination' );
		$total = Utils::archive_pages( $theme->briefs->count_all(), $items_per_page );

		// Make sure the current page is valid
		if ( $current > $total ) {
			$current = $total;
		}
		else if ( $current < 1 ) {
			$current = 1;
		}

		// Number of pages to display on each side of the current page.
		$leftSide = isset( $settings['leftSide'] ) ? $settings['leftSide'] : 1;
		$rightSide = isset( $settings['rightSide'] ) ? $settings['rightSide'] : 1;

		// Add the page '1'.
		$pages[] = 1;

		// Add the pages to display on each side of the current page, based on $leftSide and $rightSide.
		for ( $i = max( $current - $leftSide, 2 ); $i < $total && $i <= $current + $rightSide; $i++ ) {
			$pages[] = $i;
		}

		// Add the last page if there is more than one page.
		if ( $total > 1 ) {
			$pages[] = (int) $total;
		}

		// Sort the array by natural order.
		natsort( $pages );

		// This variable is used to know the last page processed by the foreach().
		$prevpage = 0;
		// Create the output variable.
		$out = '';

		if ( 1 === count( $pages ) && isset( $settings['hideIfSinglePage'] ) &&  $settings['hideIfSinglePage'] === true ) {
			return '';
		}

		foreach ( $pages as $page ) {
			$settings['page'] = $page;

			// Add ... if the gap between the previous page is higher than 1.
			if ( ( $page - $prevpage ) > 1 ) {
				$out .= '&nbsp;<span class="sep">&hellip;</span>';
			}
			// Wrap the current page number with square brackets.
			$caption = ( $page == $current ) ?  $current  : $page;
			// Build the URL using the supplied $settings and the found RewriteRules arguments.
			$url = URL::get( $rr_name, $settings, false );
			// Build the HTML link.
			// $out .= '&nbsp;<a href="' . $url . '" ' . ( ( $page == $current ) ? 'class="current-page"' : '' ) . '>' . $caption . '</a>';
			if ($page == $current) $out .= '&nbsp;<strong title="' . $caption . '">' . $caption . '</strong>';
			else $out .= '&nbsp;<a href="' . $url . '" title="Page ' . $caption . '">' . $caption . '</a>';

			$prevpage = $page;
		}

		return $out;
	}

	public function theme_next_page_link_briefs1( $theme, $text = null, $classes = array( 'next-page' ) )
	{
		$settings = array();

		// If there's no next page, skip and return null
		$settings['page'] = (int) ( $theme->page + 1 );
		$items_per_page = isset( $theme->briefs->get_param_cache['limit'] ) ?
			$theme->briefs->get_param_cache['limit'] :
			Options::get( 'pagination' );
		$total = Utils::archive_pages( $theme->briefs->count_all(), $items_per_page );
		if ( $settings['page'] > $total ) {
			return null;
		}

		// If no text was supplied, use default text
		if ( $text == '' ) {
			$text = _t( 'Next' ) . ' &rarr;';
		}

		return '<a class="' . implode( ' ', $classes ) . '" href="' . URL::get( null, $settings, false ) . '" title="' . $text . '">' . $text . '</a>';
	}
	
}
?>