<?php

/**
 * 
 */
class EuroTheme extends Theme
{
	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme()
	{
// Apply Format::autop() to post content...
//Format::apply( 'autop', 'post_content_out' );
// Apply Format::autop() to comment content...
Format::apply( 'autop', 'comment_content_out' );
// Apply Format::tag_and_list() to post tags...
Format::apply( 'tag_and_list', 'post_tags_out' );
// Apply Format::autop() to post content excerpt...
//Format::apply( 'autop', 'post_content_excerpt' );


Format::apply_with_hook_params( 'more', 'post_content_excerpt', ' <span class="more-exc">more</span>', 17, 1 ); // big excerpt
Format::apply_with_hook_params( 'more', 'post_content_out', '<span class="more-out">› more</span>', 30, 1 ); // short excerpt

Format::apply_with_hook_params( 'more', 'post_content_30', '<span class="more-out">› more</span>', 30, 1 ); // short excerpt
Format::apply_with_hook_params( 'more', 'post_content_50', '<span class="more-out">› more</span>', 50, 1 ); // short excerpt
Format::apply_with_hook_params( 'more', 'post_content_70', '<span class="more-out">› more</span>', 70, 1 ); // short excerpt


	}

/**
	 *  Add additional template variables to the template output.
	 *
	 *  You can assign additional output values in the template here, instead of
	 *  having the PHP execute directly in the template.  The advantage is that
	 *  you would easily be able to switch between template types (RawPHP/Smarty)
	 *  without having to port code from one to the other.
	 *
	 *  You could use this area to provide "recent comments" data to the template,
	 *  for instance.
	 *
	 *  Note that the variables added here should possibly *always* be added,
	 *  especially 'user'.
	 *
	 *  Also, this function gets executed *after* regular data is assigned to the
	 *  template.  So the values here, unless checked, will overwrite any existing
	 *  values.
	 */
	
	public function add_template_vars()
	{
		
		$this->assign('show_author', true ); //Display author in posts

		$this->assign('recent_posts', Posts::get( array( 'content_type' => array( 'article' ), 'limit'=>8, 'status'=>'published', 'orderby'=>'pubdate DESC' ) ) ); //Display the 8 most recent posts	

		if( !$this->template_engine->assigned( 'any' ) ) {
			$this->assign('any', Posts::get( array( 'content_type' => 'any', 'status' => Post::status('published'), 'nolimit' => 1 ) ) );
		}
		if( !$this->template_engine->assigned( 'page' ) ) {
			$page = Controller::get_var( 'page' );
			$this->assign('page', isset( $page ) ? $page : 1 );
		}

		if ( User::identify()->loggedin ) {
			Stack::add( 'template_header_javascript', Site::get_url('scripts') . '/jquery.js', 'jquery' );
		}
		
		// work with systags.plugin
		$this->assign( 'sides', Posts::get( array( 'vocabulary' => array( 'systags:term' => 'mini' ), 'limit' => 2, 'status' => 'published' ) ) );
		$this->assign( 'sliders', Posts::get( array( 'vocabulary' => array( 'systags:term' => 'slideshow' ), 'limit' => 4, 'status' => array('published') ) ) );
		$this->assign( 'menus', Posts::get( array( 'vocabulary' => array( 'systags:term' => 'menu' ), 'limit' => 5, 'status' => 'published' ) ) );
		$this->assign( 'inits', Posts::get( array( 'content_type' => 'initiative', 'limit' => 7, 'status' => 'published' ) ) );
		$this->assign( 'briefsteaser', Posts::get( array( 'content_type' => 'brief', 'status' => array('published'), 'limit' => '6' ) ) );
		
		$nibblescount = 0;
		$articlescount = 0;
		$initscount = 0;
		$i = 0;
    	foreach ( $this->sliders as $post ) { 
			if ($post->content_type == Post::type('brief') && $i < 5) { $nibblescount++; }; 		// increase nibble-counter by 1 if the current slider is a nibble 
			if ($post->content_type == Post::type('article') && $i < 5) { $articlescount++; };		// same for articles
			if ($post->content_type == Post::type('initiative') && $i < 5) { $initscount++; };		// same for articles
			$i++; 
		}
		$this->assign( 'nibblescount', $nibblescount);
		$this->assign( 'articlescount', $articlescount);		
		$this->assign( 'initscount', $initscount);		
		
	}
	
	/* public function filter_theme_call_header ( $return, $theme ) {
		if ( User::identify() != false ) {
			Stack::add( 'template_header_javascript', Site::get_url('scripts') . '/jquery.js', 'jquery' );
		}
		return $return;
	} */

	/**
	 * Return the title for the page
	 * @return String the title.
	 */
	public function the_title( $head = false ){
	    $title = '';
	    //Copy Pasta from Andrew Rickman's ported theme, Dilectio http://www.habari-fun.co.uk/converting-wordpress-themes-to-habari-file-names
	    //check against the matched rule
	    switch( $this->matched_rule->name ){
	        case 'display_404':
	            $title = 'Error 404';
	        break;
	        case 'display_entry':
	            $title .= $this->post->title;
	        break;
	        case 'display_page':
	            $title .= $this->post->title;
	        break;
	        case 'display_article':
	            $title .= $this->post->title;
	        break;
			case 'display_nibble':
				$title .= $this->post->title;
			break;
	        case 'display_action':
	            $title .= $this->post->title;
	        break;
	        case 'display_profile':
	            $title .= $this->post->title;
	        break;
	        case 'display_search':
	            $title .= 'Search for ' . ucfirst( $this->criteria );
	        break;
	        case 'display_entries_by_tag':
	            $title .= ucfirst( $this->tag ) . ' Tag';
	        break;
	        case 'display_entries_by_date':
	            $title .= 'Archive for ';
	            $archive_date = new HabariDateTime();
	            if ( empty($date_array['day']) ){
	                if ( empty($date_array['month']) ){
	                    //Year only
	                    $archive_date->set_date( $this->year , 1 , 1 );
	                    $title .= $archive_date->format( 'Y' );
	                    break;
	                }
	                //year and month only
	                $archive_date->set_date( $this->year , $this->month , 1 );
	                $title .= $archive_date->format( 'F Y' );
	                break;
	            }
	            $archive_date->set_date( $this->year , $this->month , $this->day );
	            $title .= $archive_date->format( 'F jS, Y' );
	        break;
	    }
	
	
		function the_title( $head ) {

			switch( $this->matched_rule->name ){
				case 'display_entry':
					$title .= $this->post->title;
				break;
				case 'display_page':
					$title .= $this->post->title;
				break;
				case 'display_article':
					$title .= $this->post->title;
				break;
				case 'display_nibble':
					$title .= $this->post->title;
				break;
				case 'display_profile':
					$title .= $this->post->title;
				break;
				case 'display_action':
					$title .= $this->post->title;
				break;
			}
	
			if ( $head ){
			  return ( empty($title)) ? Options::get( 'title' ) 
			            : $title . ' - ' . Options::get( 'title' );
			}	

			return $title;

		}

 
	    if ( $head ){
	        return ( empty($title)) ? Options::get( 'title' ) : $title . ' - ' . Options::get( 'title' );
	    }
 
	    return $title;
	}
	
	
	public function act_search( $user_filters = array() ) {
		$paramarray['fallback'] = array(
			'search',
			'multiple',
		);

		$types = Post::list_active_post_types();
		$types = array_keys( $types );
		$types = array_diff( $types, array( 'profile, article, brief, debate, action' ) );
		$default_filters = array(
			'content_type' => $types,
		);

		$paramarray['user_filters'] = array_merge( $default_filters,
		$user_filters );

		$this->assign( 'criteria', htmlentities( Controller::get_var('criteria'), ENT_QUOTES, 'UTF-8' ) );
		return $this->act_display( $paramarray );
	}
	
	public function act_display_home( $user_filters = array() ) {
		$paramarray['fallback'] = array(
			'home',
		);

		// has no effect:
		parent::act_display_home( array( 'content_type' => array( Post::type('article') ) ) );

	}

	/*public function act_display_home($paramarray = array( 'user_filters'=> array() ) ) {
			$user_filters = array('all:info' => array( 'initiative' => '0' ), 'vocabulary' => array( 'systags:not:term' => 'mini' ) );
			$paramarray['user_filters'] = array_merge($user_filters, $paramarray['user_filters']);
			parent::act_display( $paramarray );
		}*/

}

?>
