<?php

class EuroTheme extends Theme {

	/**
	 * Execute on theme init to apply these filters to output
	 */
	public function action_init_theme() {
		Format::apply('tag_and_list', 'post_tags_out');
		Format::apply('summarize', 'post_content_fulltext', 10000, 100);
		
		Format::apply_with_hook_params('more', 'post_content_excerpt', ' <span class="more-exc">more</span>', 17, 1); // big excerpt
		Format::apply_with_hook_params('more', 'post_content_out', '', 30, 1); // short excerpt
		Format::apply_with_hook_params('more', 'post_content_videotext', '<span class="more-out">› more</span>', 1000, 2); // short excerpt


		/** block from add_template_vars() function  **/
		$this->assign('show_author', true ); // Display author in posts
		$this->assign('recent_debates', Posts::get( array( 'content_type' => array( 'debate' ), 'status'=>'published', 'orderby'=>'pubdate DESC' ) ) ); // Display all debates
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
	public function add_template_vars() {
		// content of this function was moved to action_init_theme() function
	}

	/**
	 * Return the title for the page
	 * @return String the title.
	 */
	public function the_title( $head = false ) {
		echo 'the_title ';
	    $title = '';
	    switch( $this->matched_rule->name ) {
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
		$types = array_keys($types);
		$types = array_diff($types, array( 'profile, article, brief, debate, action'));
		$default_filters = array('content_type' => $types);

		$paramarray['user_filters'] = array_merge($default_filters, $user_filters);

		$this->assign('criteria', htmlentities( Controller::get_var('criteria'), ENT_QUOTES, 'UTF-8' ));
		return $this->act_display($paramarray);
	}
	
	public function act_display_home( $user_filters = array() ) {
		$paramarray['fallback'] = array('home');
		parent::act_display_home( array( 'content_type' => array( Post::type('article') ) ) ); // has no effect:
	}
}

?>