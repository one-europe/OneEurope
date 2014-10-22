<?php
/*
 * Meta SEO an SEO plugin for Habari
 * 
 * @package metaseo
 *
 * This class automatically change your page title
 * to one appropriate for SEO. adds a description
 * and keywords to the page header, and injects
 * indexing tags based on the preferences
 *
 */

class MetaSeo extends Plugin
{
	/**
	* @var string plugin version number
	*/
	const VERSION= '0.5.2';

	/**
	* @var $them Theme object that is currently being use for display
	*/
	private $theme;

	

	/*
	* function set_priorities
	*
	* set priority to a number lower than that used by most plugins 
	* to ensure it is the first one called so it doesn't interfere with 
	* other plugins calling theme_header()
	*
	* @return array the plugin's priority
	*/
	public function set_priorities()
	{
	  return array(
	    'theme_header' => 6,
	  );
	}

	/*
	* function default_options
	*
	* returns defaults for the plugin
	* @return array default options array
	*/
	private static function default_options()
	{
		$home_keys = array();
		
		// this is from the Tags::get() method, altered to return only the top ones
		$tags = DB::get_results( 'SELECT t.id AS id,
			t.tag_text AS tag,
			t.tag_slug AS slug,
			COUNT(tp.tag_id) AS count
			FROM {tags} t
			LEFT JOIN {tag2post} tp ON t.id=tp.tag_id
			GROUP BY id, tag, slug
			ORDER BY count DESC, tag ASC
			LIMIT 0, 50' );
			
		foreach ( $tags as $tag ) {
			$home_keys[] = htmlspecialchars( strip_tags( $tag->tag ), ENT_COMPAT, 'UTF-8' );
		}
		
		return array(
			'home_desc' => htmlspecialchars( strip_tags( Options::get( 'tagline' ) ), ENT_COMPAT, 'UTF-8' ),
			'home_keywords' => $home_keys,
			'home_index' => true,
			'home_follow' => true,
			'posts_index' => true,
			'posts_follow' => true,
			'archives_index' => false,
			'archives_follow' => true,
			);
	}

	public function action_admin_header( $theme ) {
		$vars= Controller::get_handler_vars();
		if ($theme->admin_page == 'plugins' && isset( $vars['configure'] ) && $vars['configure'] === $this->plugin_id ) {
			Stack::add('admin_stylesheet', array($this->get_url() . '/metaseo.css', 'screen'));
		}
	}

	/*
	* function action_plugin_activation
	*
	*if the file being passed in is this file, sets the default options
	*
	* @param $file string name of the file 
	*/
	public function action_plugin_activation( $file )
	{
		if ( realpath( $file ) == __FILE__ ) {
			foreach ( self::default_options() as $name => $value ) {
				if( !( Options::get( 'MetaSEO__' . $name ) ) ) {
					Options::set( 'MetaSEO__' . $name, $value );
				}
			}
		}
	}

	/*
	 * function filter_plugin_config
	 *
	 * Returns  actions to be performed on configuration
	 *
	 * @param array $actions list of actions to perform
	 * @param plugin_id id of the plugin
	 * @return $actions array of actions the plugin will respond to
	 */
	public function filter_plugin_config( $actions, $plugin_id )
	{
		if ( $plugin_id == $this->plugin_id() ) {
			$actions[] = _t( 'Re-Load Top Keywords' );
			$actions[] = _t('Configure' );
		}
		return $actions;
	}

	/*
	* function action_plugin_ui
	*
	* displays the option form 
	* @param $plugin_id string id of the plugin that is being called
	* @param $action mixed the action begin requested
	*/
	public function action_plugin_ui( $plugin_id, $action )
	{
		if ( $plugin_id == $this->plugin_id() ) {
			switch ( $action ) {
				case _t( 'Re-Load Top Keywords' ):
					
					// get the keywords
					$options = self::default_options();
					$keywords = $options['home_keywords'];
					
					Options::set( 'MetaSEO__home_keywords', $keywords );
					
					Session::notice( _t( 'Keywords have been reloaded!' ) );
					
					break;
				case _t( 'Configure' ) :
					$ui = new FormUI( 'MetaSEO' );
					// Add a text control for the home page description and textmultis for the home page keywords
					$ui->append( 'fieldset', 'HomePage', _t( 'HomePage' ) );
					$ui->HomePage->append( 'textarea', 'home_desc', 'option:MetaSEO__home_desc', _t('Description: ' ) );
					$ui->HomePage->append( 'textmulti', 'home_keywords', 'option:MetaSEO__home_keywords', _t( 'Keywords: ' ) );
					
					// Add checkboxes for the indexing and link following options
					$ui->append( 'fieldset', 'Robots', _t( 'Robots' ) );
					$ui->Robots->append( 'checkbox', 'home_index', 'option:MetaSEO__home_index', _t( 'Index Home Page') );
					$ui->Robots->append( 'checkbox', 'home_follow', 'option:MetaSEO__home_follow', _t( 'Follow Home Page Links' )  );
					$ui->Robots->append( 'checkbox', 'posts_index', 'option:MetaSEO__posts_index', _t( 'Index Posts' ) );
					$ui->Robots->append( 'checkbox', 'posts_follow', 'option:MetaSEO__posts_follow', _t( 'Follow Post Links' ) );
					$ui->Robots->append( 'checkbox', 'archives_index', 'option:MetaSEO__archives_index', _t( 'Index Archives' ) );
					$ui->Robots->append( 'checkbox', 'archives_follow', 'option:MetaSEO__archives_follow', _t( 'Follow Archive Links' ) );
					
					$ui->append( 'submit', 'save', _t( 'Save' ) );
					$ui->out();
					break;
			}
		}
	}

	/*
	* Add additional controls to the publish page tab
	*
	* @param FormUI $form The form that is used on the publish page
	* @param Post $post The post being edited
	*/
	public function action_form_publish($form, $post)
	{
		// if( $form->content_type->value == Post::type( 'entry' ) || $form->content_type->value == Post::type( 'page' ) || $form->content_type->value == Post::type( 'initiative' ) || $form->content_type->value == Post::type( 'debate' ) || $form->content_type->value == Post::type( 'article' ) || $form->content_type->value == Post::type( 'nibble' ) ) {

		// 	$metaseo = $form->publish_controls->append( 'fieldset', 'metaseo', 'Search Engines' );

		// 	$html_title = $metaseo->append( 'text', 'html_title', 'null:null', 'Page Title' );
		// 	$html_title->value = strlen( $post->info->html_title ) ? $post->info->html_title : '' ;
		// 	$html_title->template = 'tabcontrol_text';
			
		// 	$keywords = $metaseo->append( 'text', 'keywords', 'null:null', 'Keywords' );
		// 	$keywords->value = strlen( $post->info->metaseo_keywords ) ? $post->info->metaseo_keywords : '' ;
		// 	$keywords->template = 'tabcontrol_text';

		// 	$description = $metaseo->append( 'textarea', 'description', 'null:null', 'Description' );
		// 	$description->value = ( isset( $post->info->metaseo_desc ) ? $post->info->metaseo_desc : '' );
		// 	$description->template = 'tabcontrol_textarea';
		// }
	}


	/*
	* Modify a post before it is updated
	*
	* Called whenever a post is about to be updated or published . If a new html title,
	* meta description, or meta keywords are entered on the publish page, 
	* sove them into the postinfo table. If any of these are empty, remove
	* their entry from the postinfo table if it exists.
	*
	* @param Post $post The post being saved, by reference
	* @param FormUI $form The form that was submitted on the publish page
	*/
	public function action_publish_post($post, $form)
	{
		// if( $post->content_type == Post::type( 'entry' ) || $post->content_type == Post::type( 'page' ) || $post->content_type == Post::type( 'initiative' ) || $post->content_type == Post::type( 'debate' ) || $post->content_type == Post::type( 'article' ) || $post->content_type == Post::type( 'nibble' ) ) {
		// 	if( strlen( $form->metaseo->html_title->value ) ) {
		// 		$post->info->html_title= htmlspecialchars( strip_tags( $form->metaseo->html_title->value ), ENT_COMPAT, 'UTF-8' );
		// 	}
		// 	else {
		// 		$post->info->__unset( 'html_title' );
		// 	}
		// 	if( strlen( $form->metaseo->description->value ) ) {
		// 		$post->info->metaseo_desc= htmlspecialchars( Utils::truncate( strip_tags( $form->metaseo->description->value ), 200, false ), ENT_COMPAT, 'UTF-8' );
		// 	}
		// 	else {
		// 		$post->info->__unset( 'metaseo_desc' );
		// 	}
		// 	if( strlen( $form->metaseo->keywords->value ) ) {
		// 		$post->info->metaseo_keywords = htmlspecialchars( strip_tags( $form->metaseo->keywords->value ), ENT_COMPAT, 'UTF-8' );
		// 	}
		// 	else {
		// 		$post->info->__unset( 'metaseo_keywords' );
		// 	}
		// }

	}

	/*
	* function filter_final_output
	*
	* this filter is called before the display of any page, so it is used 
	* to make any final changes to the output before it is sent to the browser
	*
	* @param $buffer string the page being sent to the browser
	* @return  string the modified page
	*/
	public function filter_final_output( $buffer )
	{
		$seo_title = $this->get_title();
		if( strlen( $seo_title ) ) {
			if( strpos( $buffer, '<title>' ) !== false ) {
				$buffer = preg_replace( "%<title\b[^>]*>(.*?)</title>%is", "<title>{$seo_title}</title>", $buffer );
			}
			else {
				$buffer = preg_replace("%</head>%is", "<title>{$seo_title}</title>\n</head>", $buffer );
			}
		}
		return $buffer;
	}

	/*
	* function theme_header
	*
	* called to added output to the head of a page before it is being displayed.
	* Here it is being used to insert the keywords, description, robot and fb:og meta tags
	* into the page head.
	* 
	* @param $theme Theme object being displayed
	* @return string the keywords, description, and robots meta tags
	*/
	public function theme_header($theme)
	{
		$this->theme = $theme;
		return $this->get_keywords() . $this->get_description() . $this->get_robots() . $this->get_og() . $this->get_twitter();
	}

	/*
	* function action_update_check
	*
	* Add update beacon support
	**/
	public function action_update_check()
	{
		Update::add( 'Meta SEO', 'DE6CFC70-1661-11DD-8BC9-25DB55D89593', $this->info->version );
	}

	/* function get_tag_text
	*
	 * gets the display text from a tag slug
	*
	* @param $tag the tag-slug you want the display text for
	* @return string the tag's display text
	*/
	public function get_tag_text( $tag ) {
		return DB::get_value( "select tag_text from {tags} where tag_slug= ?", array($tag) );
	}

	/* function get_description
	*
	 * This function creates the meta description tag  based on an excerpt of the post being displayed.
	 * Single entry - the excerpt for the individual entry
	 * Page - the excerpt for the page
	*
	* @return string the description meta tag
	*/
	private function get_description()
	{
		$out = '';
		$desc = '';
		
		$matched_rule = URL::get_matched_rule();
		
		if ( is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule) {				
				case 'display_home':	
				case 'display_debates':
				case 'display_videos':
				case 'display_briefs':
				case 'display_profiles':
				case 'display_team':
				case 'display_initiatives':
					$desc = Options::get( 'MetaSEO__home_desc' );
					break;
				case 'display_entry':	
				case 'display_debate':
					$desc = $this->theme->post->info->excerpt;
					break;
				case 'display_profile':
					if ($this->theme->post->info->user) {
						$desc = User::get_by_id($this->theme->post->info->user)->info->teaser;
				 	} else {
					$desc = $this->theme->post->title;
					}
					break;
				case 'display_initiative':
					$desc = $this->theme->post->info->teaser;
					break;
				case 'display_page':
					if( isset( $this->theme->post ) ) {
						if( strlen( $this->theme->post->info->metaseo_desc ) ) {
							$desc = $this->theme->post->info->metaseo_desc;
						}
						else {
							$desc = Utils::truncate( $this->theme->post->content, 200, false );
						}
					}
					break;
				case 'display_search':
					$desc = "Search Results for \"" . $_GET['criteria'] . ".";
					break;
				case 'display_404':
					$desc = "Nothing found under this URL.";
					break;
				default:
					$desc = $this->theme->post->info->excerpt;
					break;
			}
		}
		if( strlen( $desc ) ) {
			$desc = str_replace( "\r\n", " ", $desc );
			$desc = str_replace( "\n", " ", $desc );
			$desc = htmlspecialchars( strip_tags( $desc ), ENT_COMPAT, 'UTF-8' );
			$desc = strip_tags( $desc );
			$out = "<meta name=\"description\" content=\"{$desc}\" >\n\n";
		}

		return $out;
	}

	/*
	 * function get_keywords
	 *
	 * This function creates the meta keywords tag based on the type of page being loaded.
	 * Single entry and single page - the tags for the individual entry
	 * Home - the keywords entered in the options
	 * Tag page - the tag for which the page was generated
	 *
	 * @return string the keywords meta tag
	*/
	private function get_keywords()
	{
		$out = '';
		$keywords = '';
		
		$matched_rule = URL::get_matched_rule();
		
		if ( is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule) {
				case 'display_entry':
				case 'display_debate':
				case 'display_profile':
				case 'display_initiative':
				case 'display_page':
					if( isset( $this->theme->post ) ) {
						if( strlen( $this->theme->post->info->metaseo_keywords ) ) {
							$keywords = $this->theme->post->info->metaseo_keywords;
						}
						else if( count( $this->theme->post->tags ) > 0 ) {
							$keywords = implode( ', ', $this->theme->post->tags );
						}
					}
					break;
				case 'display_entries_by_tag':
					$keywords = Controller::get_var( 'tag' );
					break;
				case 'display_home':	
				case 'display_debates':
				case 'display_videos':
				case 'display_briefs':
				case 'display_profiles':
				case 'display_team':
				case 'display_initiatives':
					if( count( Options::get( 'MetaSEO__home_keywords' ) ) ) {
						$keywords= implode( ', ', Options::get( 'MetaSEO__home_keywords' ) );
					}
					break;
				default:
					if( isset( $this->theme->post ) ) {
						if( strlen( $this->theme->post->info->metaseo_keywords ) ) {
							$keywords = $this->theme->post->info->metaseo_keywords;
						}
						else if( count( $this->theme->post->tags ) > 0 ) {
							// something's strange here!!
							$keywords = implode( ', ', $this->theme->post->tags );
						}
					}
					break;
			}
		}
		$keywords = htmlspecialchars( strip_tags( $keywords ), ENT_COMPAT, 'UTF-8' );
		if( strlen( $keywords ) ) {
			$out = "<meta name=\"keywords\" content=\"{$keywords}\">\n\n";
		}
		return $out;
	}

	/*
	 * function get_robots
	 *
	 * creates the robots tag based on the type of page being loaded.
	 *
	 * @return string the robots meta tag
	*/
	private function get_robots()
	{
		$out = '';
		$robots = '';
		
		$matched_rule = URL::get_matched_rule();

		if ( is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule) {
  				case 'display_article':	
  				case 'display_video':
  				case 'display_brief':
  				case 'display_initiative':
  				case 'display_profile':
  				case 'display_debate':
  				case 'display_entry':
  				case 'display_page':
  				case 'display_post':
					if( Options::get( 'MetaSEO__posts_index' ) ) {
						$robots = 'index';
					}
					else {
						$robots = 'noindex';
					}
					if( Options::get( 'MetaSEO__posts_follow' ) ) {
						$robots .= ', follow';
					}
					else {
						$robots .= ', nofollow';
					}
					break;
				case 'display_home':
					if( Options::get( 'MetaSEO__home_index' ) ) {
						$robots= 'index';
					}
					else {
						$robots = 'noindex';
					}
					if( Options::get( 'MetaSEO__home_follow' ) ) {
						$robots .= ', follow';
					}
					else {
						$robots .= ', nofollow';
					}
					break;
				case 'display_debates':
				case 'display_videos':
				case 'display_briefs':
				case 'display_profiles':
				case 'display_team':
				case 'display_initiatives':
					$robots = 'index, follow';
					break;
				case 'display_entries_by_tag':
				case 'display_entries_by_date':
				case 'display_entries':
					if( Options::get( 'MetaSEO__archives_index' ) ) {
						$robots = 'index';
					}
					else {
						$robots = 'noindex';
					}
					if( Options::get( 'MetaSEO__archives_follow' ) ) {
						$robots .= ', follow';
					}
					else {
						$robots .= ', nofollow';
					}
					break;
				default:
					$robots = 'noindex, follow';
					break;
			}
		}
		if( strlen( $robots ) ) {
			$out = "<meta name=\"robots\" content=\"{$robots}\" >\n\n";
		}
		return $out;
	}

	/*
	* function get_title
	* 
	* creates the html title for the page being displayed
	*
	* @return string the html title for the page
	*/
	private function get_title()
	{
		$months= array(
			1 =>'January', 
			'February', 
			'March', 
			'April', 
			'May', 
			'June', 
			'July', 
			'August', 
			'September', 
			'October', 
			'November', 
			'December', 
		);
		$out = '';

		$matched_rule = URL::get_matched_rule();
		if (is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule ) {
				case 'display_home':
				case 'display_entries':
					$out = Options::get( 'title' );
					if( Options::get( 'tagline' ) ) {
						$out .= ' - ' . Options::get( 'tagline' );
					}
					break;
				case 'display_entries_by_date':
					$out = 'Archive for ';
					if( isset( $this->theme->day ) ) {
						$out .= $this->theme->day . ' ';
					}
					if( isset( $this->theme->month ) ) {
						$out .= $months[$this->theme->month] . ' ';
					}
					if (isset( $this->theme->year) ) {
						$out .= $this->theme->year . ' ';
					}
					$out .= ' - ' . Options::get( 'title' );
					break;
				case 'display_entries_by_tag':
					$out = $this->get_tag_text(Controller::get_var( 'tag' ) ) . ' Archive';
					$out .= ' - ' . Options::get( 'title' );
					break;
				case 'display_search':
					if ( isset( $_GET['criteria'] ) ) {
						$out = 'Search Results for "' . $_GET['criteria'] . '" - ' ;
					}
					$out .= Options::get( 'title' );
					break;
				case 'display_404':
					$out = 'Page Not Found!';
					$out .= ' - ' . Options::get( 'title' );
					break;
				case 'display_debates':
					$out = 'All Debates';
					$out .= ' - ' . Options::get('title');
					break;
				case 'display_videos':
					$out = 'All Videos';
					$out .= ' - ' . Options::get('title');
					break;
				case 'display_briefs':
					$out = 'All Briefs';
					$out .= ' - ' . Options::get('title');
					break;
				case 'display_profiles':
					$out = 'Profiles › All Profiles';
					$out .= ' - ' . Options::get('title');
					break;
				case 'display_team':
					$out = 'Team';
					$out .= ' - ' . Options::get( 'title' );
					break;
				case 'display_initiatives':
					$out = 'Initiatives';
					$out .= ' - ' . Options::get( 'title' );
					break;
				case 'display_article':	
				case 'display_video':
				case 'display_brief':
				case 'display_initiative':
				case 'display_profile':
				case 'display_debate':
				case 'display_entry':
				case 'display_page':
				default:
					if (isset($this->theme->post)) {
						if( strlen( $this->theme->post->info->html_title ) ) {
							$out = $this->theme->post->info->html_title;
						}
						else {
							$out = $this->theme->post->title . ' - ';
						}
					}
					$out .= Options::get( 'title' );
					break;
			}

			if( strlen( $out ) ) {
				$out = htmlspecialchars( strip_tags( $out ), ENT_COMPAT, 'UTF-8' );
				$out = stripslashes( $out );
			}
		}

		return $out;
	}
	
	function action_add_template_vars( $theme )
	{
	  $theme->titleliblubb = 47;
	  $theme->yourvariable = 'Sweet Plugin Output';
	}
	
	
	private function get_og()
	{
		$matched_rule = URL::get_matched_rule();
		if ( is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule) {
				case 'display_home':
					echo "\n<meta property=\"og:title\" content=\"OneEurope\" >\n";
					echo "<meta property=\"og:type\" content=\"website\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"OneEurope creates a hub to exchange insights and breathe the spirit and the diversity of Europe. It's brought to you by a community of volunteers from all around Europe.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_page':
					echo "\n<meta property=\"og:title\" content=\"{$this->theme->post->title}\" >\n";
					echo "<meta property=\"og:type\" content=\"article\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					if( isset( $this->theme->post ) ) {
						if( strlen( $this->theme->post->info->metaseo_desc ) ) {
							$desc = $this->theme->post->info->metaseo_desc;
						}
						else {
							$desc = Utils::truncate( $this->theme->post->content, 200, false );
						}
					}
					echo "<meta property=\"og:description\" content=\"\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_brief':
					echo "\n<meta property=\"og:title\" content=\"{$this->theme->post->title}\" >\n";
					echo "<meta property=\"og:type\" content=\"article\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta property=\"og:description\" content=\"{$this->theme->post->info->excerpt}\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_briefs':
					echo "\n<meta property=\"og:title\" content=\"All image posts\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/nibbles\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Our complete image post database.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_initiative':
					echo "\n<meta property=\"og:title\" content=\"{$this->theme->post->title}\" >\n";
					echo "<meta property=\"og:type\" content=\"article\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta property=\"og:description\" content=\"{$this->theme->post->info->teaser}\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_initiatives':
					echo "\n<meta property=\"og:title\" content=\"All Initiatives\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/initiatives\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Our complete initiative database.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_debate':
					echo "\n<meta property=\"og:title\" content=\"{$this->theme->post->title}\" >\n";
					echo "<meta property=\"og:type\" content=\"article\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta property=\"og:description\" content=\"{$this->theme->post->info->excerpt}\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_debates':
					echo "\n<meta property=\"og:title\" content=\"All Debates\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/debates\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Our complete debate database.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_videos':
					echo "\n<meta property=\"og:title\" content=\"All Videos\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/videos\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Our complete video database.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;	
				case 'display_profile':
					if ($this->theme->post->info->user) {
						$source = User::get_by_id($this->theme->post->info->user)->info;
						$displayname = User::get_by_id($this->theme->post->info->user)->displayname;
				 	} else {
						$source = $post->info;
						$displayname = $post->title;
					}
					echo "\n<meta property=\"og:title\" content=\"{$displayname}\" >\n";
					echo "<meta property=\"og:type\" content=\"profile\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:image\" content=\"". str_replace(' ', '%20', $source->photourl) . "\" >\n";
					echo "<meta property=\"og:description\" content=\"{$source->teaser}\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_profiles':
					echo "\n<meta property=\"og:title\" content=\"All Profiles\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/profiles\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Our cromplete profile database.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_team':
					echo "\n<meta property=\"og:title\" content=\"Team\" >\n";
					echo "<meta property=\"og:url\" content=\"http://one-europe.info/team\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Who's contributing to this project?\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_search':
					echo "\n<meta property=\"og:title\" content=\"Search Results for \"" . $_GET['criteria'] . "\" >\n";
					echo "<meta property=\"og:url\" content=\"" .$this->get_url() . "\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"Search Results for \"" . $_GET['criteria'] . "\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				case 'display_404':
					echo "\n<meta property=\"og:title\" content=\"Nothing Found!\" >\n";
					echo "<meta property=\"og:url\" content=\"" .$this->get_url() . "\" >\n";
					echo "<meta property=\"og:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta property=\"og:description\" content=\"The page you are trying to link to is not on our servers.\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				default: // e.g. normal articles
					echo "\n<meta property=\"og:title\" content=\"{$this->theme->post->title}\" >\n";
					echo "<meta property=\"og:type\" content=\"article\" >\n";
					echo "<meta property=\"og:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta property=\"og:description\" content=\"{$this->theme->post->info->excerpt}\" >\n";
					echo "<meta property=\"og:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta property=\"og:site_name\" content=\"OneEurope\" >\n\n";
					echo "<meta property=\"article:publisher\" content=\"249709208387329\" >\n";
					echo "<meta property=\"fb:app_id\" content=\"121944181248560\" >\n\n";					
					break;
				break;
			}
		}
	}

	private function get_twitter()
	{
		$matched_rule = URL::get_matched_rule();
		if ( is_object( $matched_rule ) ) {
			$rule = $matched_rule->name;
			switch( $rule) {
				case 'display_home':
					echo "\n<meta name=\"twitter:title\" content=\"OneEurope\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . htmlspecialchars( strip_tags( Options::get( 'about' ) ), ENT_COMPAT, 'UTF-8' ) . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n";
					break;
				case 'display_page':
					echo "\n<meta name=\"twitter:title\" content=\"OneEurope\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"{$this->theme->post->permalink}\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					if( isset( $this->theme->post ) ) {
						if( strlen( $this->theme->post->info->metaseo_desc ) ) {
							$desc = $this->theme->post->info->metaseo_desc;
						}
						else {
							$desc = Utils::truncate( $this->theme->post->content, 200, false );
						}
					}
					echo "<meta name=\"twitter:description\" content=\"\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n";
					break;
				case 'display_brief':
					echo "\n<meta name=\"twitter:title\" content=\"" . $this->theme->post->title . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"photo\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->theme->post->permalink . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . $this->theme->post->info->excerpt . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_briefs':
					echo "\n<meta property=\"twitter:title\" content=\"All image posts\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/nibbles\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"The best image and info graphic content about European politics on the web.\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_initiative':
					echo "\n<meta name=\"twitter:title\" content=\"" . $this->theme->post->title . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->theme->post->permalink . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . $this->theme->post->info->teaser . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_initiatives':
					echo "\n<meta name=\"twitter:title\" content=\"All Initiatives\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/initiatives\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Our complete initiative database.\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_debate':
					echo "\n<meta name=\"twitter:title\" content=\"" . $this->theme->post->title . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->theme->post->permalink . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . $this->theme->post->info->excerpt . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_debates':
					echo "\n<meta name=\"twitter:title\" content=\"All Debates\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/debates\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Our complete debate database.\" >\n";
					echo "<meta name=\"twitter:site_name\" content=\"OneEurope\" >\n\n";
					break;	
				case 'display_videos':
					echo "\n<meta name=\"twitter:title\" content=\"All Videos\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/videos\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Our complete video database.\" >\n";
					echo "<meta name=\"twitter:site_name\" content=\"OneEurope\" >\n\n";
					break;	
				case 'display_profile':
					if ($this->theme->post->info->user) {
						$source = User::get_by_id($this->theme->post->info->user)->info;
						$displayname = User::get_by_id($this->theme->post->info->user)->displayname;
				 	} else {
						$source = $post->info;
						$displayname = $post->title;
					}
					echo "\n<meta name=\"twitter:title\" content=\"" . $displayname . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->theme->post->permalink . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"" . $source->photourl . "\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . $source->teaser . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_profiles':
					echo "\n<meta name=\"twitter:title\" content=\"All Profiles\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/profiles\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Our cromplete profile database.\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_team':
					echo "\n<meta name=\"twitter:title\" content=\"Team\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"http://one-europe.info/team\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Who's contributing to this project?\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_search':
					echo "\n<meta name=\"twitter:title\" content=\"Search Results for \"" . $_GET['criteria'] . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->get_url() . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"Search Results for \"" . $_GET['criteria'] . "\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				case 'display_404':
					echo "\n<meta name=\"twitter:title\" content=\"Nothing Found!\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->get_url() . "\" >\n";
					echo "<meta name=\"twitter:image\" content=\"http://one-europe.info/user/themes/euro/img/static/logo_square.png\" >\n";
					echo "<meta name=\"twitter:description\" content=\"The page you are trying to link to is not on our servers.\" >\n";
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				default:
					echo "\n<meta name=\"twitter:title\" content=\"" . $this->theme->post->title . "\" >\n";
					echo "<meta name=\"twitter:card\" content=\"summary\" >\n";
					echo "<meta name=\"twitter:image\" content=\"". str_replace(' ', '%20', $this->theme->post->info->photourl) . "\" >\n";
					echo "<meta name=\"twitter:description\" content=\"" . $this->theme->post->info->excerpt . "\" >\n";
					echo "<meta name=\"twitter:url\" content=\"" . $this->theme->post->permalink . "\" >\n";
					// don't display post->info->author->info->twitter if the author is actually somebody else
					if ( !$this->theme->post->info->origsource ) { 
						$author = User::get_by_id($this->theme->post->info->author)->info->twitter;
						echo "<meta name=\"twitter:creator\" content=\"" . $author . "\" >\n";
					}
					echo "<meta name=\"twitter:site:id\" content=\"344621545\" >\n\n";
					break;
				break;
			}
		}
	}

}
?>
