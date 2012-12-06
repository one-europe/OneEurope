<?php

class PlugBlogPosts extends Plugin
{ 
	
	const CONTENT_TYPE = 'BlogPost';
	
	/******************Help file****************************/
	public function help() {
		$str= '';
		$str.= '<p>With this plugin, you are able to create Posts for the OneEurope Blog</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>plugBlogPost.single.php</code> template. If it does not, you can usually copy <code>PlugBlogPost.single</code> to <code>article.single.php</code> and use it.</p>';
		return $str;
	}

	/********* Activate the content type*********************/
	public function action_plugin_activation( $plugin_file )
	{
   /*******create a content type*********/
		Post::add_new_type( self::CONTENT_TYPE );
		
		// Give anonymous people access, if the group exists
		$group = UserGroup::get_by_name( 'anonymous ');
		if ( $group ) {
			$group->grant( self::CONTENT_TYPE, 'read' );
		}
	}
	/*******Deactiveate the content type**********************/
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( self::CONTENT_TYPE );
	}

/***********naming schemes for singular and plural pronounciation*********/
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			self::CONTENT_TYPE => array(
				'singular' => _t( 'BlogPost', self::CONTENT_TYPE ),
				'plural' => _t( 'BlogPosts', self::CONTENT_TYPE ),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	/***********************manipulate publish form.*********/
	public function action_form_publish($form, $post, $context)
	{
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {				//has to be the right content type to get this publish form
			$form->append('text', 'excerpt', 'null:null', _t('Excerpt'), 'admincontrol_text');		// excerpt
			$form->excerpt->tabindex = 2;
			$form->excerpt->value = $post->info->excerpt;
			$form->excerpt->move_after($form->title);
			
			$form->content->tabindex = 3;
		}
	}
	
	/*************Save our data to the database********************/
	public function action_publish_post( $post, $form )
	{
		if ($post->content_type == Post::type( self::CONTENT_TYPE ) )
		{
			$post->info->excerpt = $form->excerpt->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->photoinfo = $form->photoinfo->value;
			$post->info->photolicense = $form->photolicense->value;
			//$post->info->metacat = $form->metacat->value;
			
			// create exactly the same array as above, but with id's 
			// and save them as $post->info->initiative object to the db
			$initiatives = Posts::get( array( 'content_type' => 'BlogPost', 'status' => 'published' ) );
			$slugs = array();
			$i = 1;
			foreach ($BlogPost as $BlogPost) { 
				if ( $i == 1 ) {
					$slugs[] = '0';
					$i++;
				}
				if ( $BlogPost->title ) {
					$slugs[] = $BlogPost->id;
					$i++;
				}
			}
			foreach ($BlogPost as $BlogPost) {
				echo $BlogPost->title;
			}
			$post->info->BlogPost = $slugs[$form->BlogPost->value];

			
		}
	}
	
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_blogs',
			'parse_regex' => '%^blog(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'blog(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_blogs',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'display project blog' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_blog',
			'parse_regex' => '%blog/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'blog/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_blog',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'single blog entries' )
		);
	  return $rules;
	}
}
?>