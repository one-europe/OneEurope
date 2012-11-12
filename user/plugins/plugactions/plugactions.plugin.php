<?php

class Plugaction extends Plugin
{
	
	const CONTENT_TYPE = 'initiative';
 
	/**
	 * On plugin activation
	 */
	public function action_plugin_activation( $file )
	{
		// Don't process other plugins
		if ( Plugins::id_from_file($file) == Plugins::id_from_file(__FILE__) ) {
 
			// Insert new post content types
			Post::add_new_type( self::CONTENT_TYPE, true );
 
		}
	}
 
	
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( self::CONTENT_TYPE );
	}
	
	
	/**
	 * Create name string. This is where you make what it displays pretty.
	 **/
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			self::CONTENT_TYPE => array(
				'singular' => _t('Initiative'),
				'plural' => _t('Initiatives'),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
 
	/**
	 * Manage the inputs
	 */
	public function action_form_publish( $form, $post )
	{
		if ( $form->content_type->value == Post::type( self::CONTENT_TYPE ) ) {
 
			// add shorttitle input field
			$form->append('text', 'shorttitle', 'null:null', _t('Short title (for display on frontpage - can be the actual title itself if it\'s short enough)'), 'admincontrol_text');
			$form->shorttitle->value = $post->info->shorttitle;
			$form->shorttitle->tabindex = 2;
		    $form->shorttitle->move_after($form->title);

			// insert photourl input field
			$form->insert('tags', 'text', 'photourl', 'null:null', _t('Photo URL (upload it to mediasilo and grab its link)'), 'admincontrol_textArea');
			$form->photourl->value = $post->info->photourl;
			$form->photourl->template = 'admincontrol_text';
			$form->photourl->tabindex = 3;
		    $form->photourl->move_after($form->shorttitle);
		
			// add teaser input field
			$form->append('text', 'teaser', 'null:null', _t('Teaser'), 'admincontrol_text');
			$form->teaser->value = $post->info->teaser;
			$form->teaser->tabindex = 4;
		    $form->teaser->move_after($form->photourl);

			$form->content->tabindex = 5;

			// insert external url input field
			$form->insert('tags', 'text', 'url', 'null:null', _t('URL'), 'admincontrol_textArea');
			$form->url->value = $post->info->url;
			$form->url->template = 'admincontrol_text';
			$form->url->tabindex = 6;
			$form->url->move_after($form->content);

			// insert twitter account input field
			$form->insert('tags', 'text', 'twitter', 'null:null', _t('Twitter channel (without @)'), 'admincontrol_textArea');
			$form->twitter->value = $post->info->twitter;
			$form->twitter->template = 'admincontrol_text';
			$form->twitter->tabindex = 7;
			$form->twitter->move_after($form->url);
			
			// insert "additional links" input field
			$form->insert('tags', 'text', 'more', 'null:null', _t('Additional Links (input as valid html: "&lt;a href="URL"&gt;one&lt;/a&gt;,&lt/br&gt;&lt;a href="URL"&gt;two&lt;/a&gt;")'), 'admincontrol_textArea');
			$form->more->value = $post->info->more;
			$form->more->template = 'admincontrol_text';
			$form->more->tabindex = 8;
			$form->more->move_after($form->twitter);

			// we don't need no tagging
			$form->tags->remove();
			
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
			$post->info->shorttitle = $form->shorttitle->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->teaser = $form->teaser->value;
			$post->info->url = $form->url->value;
			$post->info->twitter = $form->twitter->value;
			$post->info->more = $form->more->value;
			// No, it really is that easy to save data
		}
	}	
	
	public function filter_rewrite_rules( $rules )
	{
		$rules[] = new RewriteRule(array(
			'name' => 'display_initiatives',
			'parse_regex' => '%^initiatives(?:/page/(?P<page>\d+))?/?$%',
			'build_str' => 'initiatives(/page/{$page})',
			'handler' => 'UserThemeHandler',
			'action' => 'display_initiatives',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Display initiatives' )
		);
		$rules[] = new RewriteRule( array( 
			'name' => 'display_initiative',
			'parse_regex' => '%initiatives/(?P<slug>[^/]+)/?$%i',
			'build_str' => 'initiatives/{$slug}',
			'handler' => 'UserThemeHandler',
			'action' => 'display_initiative',
			'priority' => 2,
			'rule_class' => RewriteRule::RULE_PLUGIN,
			'is_active' => 1,
			'description' => 'Simple initiative management' )
		);
	  return $rules;
	}
	
	/**
	 * Handle display of single initiatives
	 */
	public function filter_theme_act_display_initiative($handled, $theme)
	{
		$paramarray['fallback'] = array(
			 'initiative.{$id}', //match initiative.234.php , where 234 is the id of the post
			 'initiative.{$slug}', //match initiative.my-project.php, where my-initiative is the slug of the post
			 'initiative.tag.{$posttag}', //match initiative.tag1.php, initiative.tag2.php...where tag1,tag2... are post's tag
			 'initiative.single', //match initiative.single.php
			 'initiative.multiple', //match initiative.multiple.php
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
	 * Create list of all initiatives
	 */
	public function filter_theme_act_display_initiatives( $handled, $theme )
	{
	  // Try to use the initiative.multiple.php template, and if that's not available,
	  // use multiple.php
	  $paramarray['fallback']= array(
	    'initiative.multiple',
	    'multiple',
	  );

	  // Retrieve future initiatives.
	  $initiatives = Posts::get(array(
	    'content_type' => Post::type( self::CONTENT_TYPE ),
	    'status' => Post::status('published'),
	    'nolimit' => TRUE
	  ));

	  // Add the initiatives to the theme. Access this in your template with $initiatives.
	  $theme->initiatives = $initiatives;

	  $theme->act_display( $paramarray );

	}
	
}
 
?>
