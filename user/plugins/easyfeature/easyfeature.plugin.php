<?php

class EasyFeature extends Plugin
{
	private static $vocabulary = 'systags';

	protected $_vocabulary;


	public function  __get( $name )
	{
		switch ( $name ) {
			case 'vocabulary':
				if ( !isset( $this->_vocabulary ) ) {
					$this->_vocabulary = Vocabulary::get( self::$vocabulary );
				}
				return $this->_vocabulary;
		}
	}
	
	/**
	 * Add the category vocabulary and create the admin token
	 *
	 **/
	public function action_plugin_activation( $file )
	{
		$params = array(
		'name' => self::$vocabulary,
			'description' => 'A vocabulary for featuring entries based on a tag function',
			'features' => array( 'multiple', 'hierarchical' )
		);

		Vocabulary::create( $params );

		// create default access token
		ACL::create_token( 'manage_features', _t( 'Manage features' ), 'Administration', false );
		$group = UserGroup::get_by_name( 'admin' );
		$group->grant( 'manage_features' );
	}

	/**
	 * Remove the admin token
	 *
	 **/
	public function action_plugin_deactivation( $file )
	{
		// delete default access token
		ACL::destroy_token( 'manage_features' );
	}

	/**
	 * Add systags to the publish form
	 **/
	public function action_form_publish ( $form, $post )
	{
		if ( User::identify()->can('manage_features') ) {
			$form->append( 'text', 'systags', 'null:null', _t( 'System Tags, Separated by Commas (available: "slideshow", "mini", "author", "ambassador", "partner", "former", "founder")' ), 'admincontrol_text' );
			$form->systags->class = 'check-change';
			$form->systags->tabindex = 3;
			$form->move_before( $form->systags, $form->content );
			$form->save->tabindex = $form->save->tabindex + 1;

			// If this is an existing post, see if it has systags already
			if ( 0 != $post->id ) {
				$form->systags->value = implode( ', ', array_values( $this->get_systags( $post ) ) );
			}
		}
	}

	/**
	 * Process systags when the publish form is received
	 *
	 **/
	public function action_publish_post( $post, $form )
	{
			$systags = array();
//			$systags = $this->parse_systags( $form->systags->value );
			$systags = Terms::parse( $form->systags->value, 'Term', $this->vocabulary );
			$this->vocabulary->set_object_terms( 'post', $post->id, $systags );
	}

	/**
	 * function get_systags
	 * Gets the systags for the post
	 * @return array The systags array for this post
	 */
	private function get_systags( $post )
	{
		$systags = array();
		$result = $this->vocabulary->get_object_terms( 'post', $post->id );
		if( $result ) {
			foreach( $result as $t ) {
				$systags[ $t->term ] = $t->term_display;
			}
		}
		return $systags;
	}

	/**
	 * function filter_post_get
	 * Allow post->systags
	 * @return array The systags array for this post
	 **/
	public function filter_post_get( $out, $name, $post )
	{
		if( $name != 'systags' ) {
			return $out;
		}
		$systags = array();
		$result = $this->vocabulary->get_object_terms( 'post', $post->id );
		if( $result ) {
			foreach( $result as $t ) {
				$systags[$t->term] = $t->term_display;
			}
		}
		return $systags;
	}

	protected function get_term( $labels, $level )
	{
		$root_term = false;
		$root = $labels[0];
		$roots = $this->vocabulary->get_root_terms();
		foreach( $roots as $term ) {
			if ( $root == $term->term ) {
				$root_term = $term;
				break;
			}
		}


		for( $i = 1; $i <= $level; $i++ ) {
			$term = $labels[$i];
			$roots = $root_term->children( $root_term );
			foreach( $roots as $cur ) {
				if ( $cur->term == $term ) {
					$root_term = $cur;
					break;
				}
			}
		}
		return $root_term;

	}

	public function filter_posts_search_to_get( $arguments, $flag, $value, $match, $search_string )
	{
		if ( 'systags' == $flag ) {
			$arguments['vocabulary'][$this->vocabulary->name . ':term_display'][] = $value;
		}
		return $arguments;
	}

}

?>
