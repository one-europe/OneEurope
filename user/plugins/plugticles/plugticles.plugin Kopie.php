<?php

class Plugticles extends Plugin
{ 
	
	/**
	 * Create help file
	 **/
	public function help() {
		$str= '';
		$str.= '<p>Plugticles adds the article content type.</p>';
		$str.= '<h3>Installation Instructions</h3>';
		$str.= '<p>Your theme needs to have a <code>plugticle.single</code> template, or a generic <code>single</code> template. If it does not, you can usually copy <code>plugticle.single</code> to <code>plugticle.single</code> and use it.</p>';
		return $str;
	}

	/**
	 * Register content type
	 **/
	public function action_plugin_activation( $plugin_file )
	{
    // add the content type.
		Post::add_new_type( 'article' );
		
		// Give anonymous users access
		$group = UserGroup::get_by_name('anonymous');
		$group->grant('post_article', 'read');
	}
	
	public function action_plugin_deactivation( $plugin_file )
	{
		Post::deactivate_post_type( 'article' );
	}
	
	/**
	 * Register templates
	 **/
/*	public function action_init()
	{		
		// Create templates
		$this->add_template('article.single', dirname(__FILE__) . '/article.single.php');
		$this->add_template('sidebar.article', dirname(__FILE__) . '/sidebar.article.php');
	}
	
	/**
	 * Create name string. This is where you make what it displays pretty.
	/**/
	public function filter_post_type_display($type, $foruse) 
	{ 
		$names = array( 
			'article' => array(
				'singular' => _t('Article'),
				'plural' => _t('Articles'),
			)
		); 
 		return isset($names[$type][$foruse]) ? $names[$type][$foruse] : $type; 
	}
	
	/**
	 * Modify publish form.
	 **/
	public function action_form_publish($form, $post, $context)
	{
		// only edit the form if it's an article
		if ($post->content_type == Post::type('page'))
		{
			// add text fields
			$form->insert('tags', 'text', 'excerpt', 'null:null', _t('Excerpt (displayed in slideshows, the front site, etc)'), 'admincontrol_textArea');
			$form->excerpt->move_before($form->excerpt, $form->silos);
			$form->insert('tags', 'text', 'photourl', 'null:null', _t('Thumbnail/Photo URL (upload the image to the media silo and grab its URL to paste it here)'), 'admincontrol_textArea');
			$form->insert('tags', 'text', 'photoinfo', 'null:null', _t('Photo subtitle'), 'admincontrol_textArea');
			$form->insert('tags', 'text', 'photolicense', 'null:null', _t('Photo License'), 'admincontrol_textArea');
			//$form->append('file', 'photo', 'path:' . Site::get_dir('files') . '/photos', 'Thumbnail Image');
			// load values and display the fields
			$form->excerpt->value = $post->info->excerpt;
			$form->excerpt->template = 'admincontrol_text';
			$form->photourl->value = $post->info->photourl;
			$form->photourl->template = 'admincontrol_text';
			$form->photoinfo->value = $post->info->photoinfo;
			$form->photoinfo->template = 'admincontrol_text';
			$form->photolicense->value = $post->info->photolicense;
			$form->photolicense->template = 'admincontrol_text';
		}
	}
	
	/**
	 * Save our data to the database
	 **/
	public function action_publish_post( $post, $form )
	{
		if ($post->content_type == Post::type('article'))
		{
			$post->info->excerpt = $form->excerpt->value;
			$post->info->photourl = $form->photourl->value;
			$post->info->photoinfo = $form->photoinfo->value;
			$post->info->photolicense = $form->photolicense->value;
		}
	}

	/**
	 * Add the 'articles' type to the list of templates that we can use. This is what makes Habari display articles in the global post output.
	 **/
	public function filter_template_user_filters($filters) {
		if(isset($filters['content_type'])) {
			$filters['content_type']= Utils::single_array( $filters['content_type'] );
			$filters['content_type'][]= Post::type('article');
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
		if(Post::type("article")==$post->content_type)
			$feed_entry->content[0] = "<strong>".$post->info->excerpt."</strong> ".$feed_entry->content[0];
    }
	
	/**
	 * Add articles to the global posts atom feed
	 **/
	public function filter_atom_get_collection_content_type( $content_type )
    {
        $content_type = Utils::single_array( $content_type );
        $content_type[] = Post::type( 'article' );
        return $content_type;
    }

}
?>