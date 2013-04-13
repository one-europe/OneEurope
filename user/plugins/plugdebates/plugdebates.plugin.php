<?php

class PlugDebate extends Plugin
{ 	
	
	const CONTENT_TYPE = 'debate';
	
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
				'singular' => _t('Debate', self::CONTENT_TYPE ),
				'plural' => _t('Debates', self::CONTENT_TYPE ),
			)
		);
		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type;
	}
	
	
 
	/**
	 * Do changes to the publish form
	 */
	public function action_form_publish( $form, $post, $context )
	{
		// In case the post to publish is a debate
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {
			
			
			// add excerpt field
			$form->append('text', 'excerpt', 'null:null', _t('Excerpt'), 'admincontrol_text');
			$form->excerpt->tabindex = 2;
			$form->excerpt->value = $post->info->excerpt;
			$form->excerpt->move_after($form->title);
			
			// add photo url input field
			$form->append('text', 'photourl', 'null:null', _t('Photo URL (upload it to mediasilo and grab its link)'), 'admincontrol_text');
			$form->photourl->value = $post->info->photourl;
			$form->photourl->tabindex = 3;
		    $form->photourl->move_after($form->excerpt);		
		
			$form->content->tabindex = 4;
			
			// add photo url input field
			$form->append('text', 'photolicense', 'null:null', _t('Photo License'), 'admincontrol_text');
			$form->photolicense->value = $post->info->photolicense;
			$form->photolicense->tabindex = 5;
		    $form->photolicense->move_after($form->content);
		
			$form->tags->tabindex = 6;
			
			// buggy, dunno why
			$form->save->tabindex = $form->save->tabindex + 10;
				
		}
	}
 
 
	/**
	 * Now we need to save our custom entries
	 */
	public function action_publish_post( $post, $form )
	{
		if ( $post->content_type == Post::type( self::CONTENT_TYPE ) ) {
 
			// Save settings
			$post->info->excerpt = $form->excerpt->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->photolicense = $form->photolicense->value;
			
						
			// No, it really is that easy to save data
		}
	}
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_debates',
			'parse_regex' => '%^debates(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'debates(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_debates',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display debates' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_debate',
			'parse_regex' => '%debates/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'debates/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_debate',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple debate management' )
		);
	  return $rules;
	}
	
	/**
	 * Handle display of single debates
	 */
	public function filter_theme_act_display_debate($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'debate.{$id}', //match debate.234.php , where 234 is the id of the post
			 'debate.{$slug}', //match debate.my-project.php, where my-debate is the slug of the post
			 'debate.tag.{$posttag}', //match debate.tag1.php, debate.tag2.php...where tag1,tag2... are post's tag
			 'debate.single', //match debate.single.php
			 'debate.multiple', //match debate.multiple.php
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
	 * Create list of all debates
	 */
	public function filter_theme_act_display_debates( $handled, $theme )
	{
	  // Try to use the debate.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'debate.multiple',
	    'multiple',
	  );

		// Retrieve the paginated list of debates
		// therefore, set some pagination variables
		$page =Controller::get_var( 'page' );
		if (is_object(htmlspecialchars( strip_tags( Options::get( 'debatepagination' ) ), ENT_COMPAT, 'UTF-8' ) ) ) {
			$pagination = htmlspecialchars( strip_tags( Options::get( 'debatepagination' ) ), ENT_COMPAT, 'UTF-8' );
		} else {
			$pagination = 10;
		}
		if ( $page == '' ) { $page = 1; }
		$theme->current_page = $page;

		$debates = Posts::get(
			array(
	    		'content_type' => Post::type('debate'),
	    		'status' => Post::status('published'),
				'offset' => ($pagination)*($page)-$pagination,
			    'limit' => $pagination
			)
		);

	  // Add the debates to the theme. Access this in your template with $debates.
	  $theme->debates = $debates;

	
		$all = Posts::get(
			array(
	    		'content_type' => Post::type('debate'),
	    		'status' => Post::status('published'),
			)
		);
	  $theme->there_are_more = false;
	  if ( $all->count_all() > $pagination*$page ) {
		$theme->there_are_more = true;
	  }

	  $theme->act_display( $paramarray );

	}
	
}
?>