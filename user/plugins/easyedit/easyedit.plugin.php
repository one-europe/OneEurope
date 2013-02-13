<?php

class EasyEdit extends Plugin
{
	private static $vocabulary = 'Post as';

	protected $_vocabulary;


	public function __get( $name )
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
		ACL::create_token( 'post_as', _t( 'Post as' ), 'Administration', false );
		$group = UserGroup::get_by_name( 'admin' );
		$group->grant( 'post_as' );
	}

	/**
	 * Remove the admin token
	 *
	 **/
	public function action_plugin_deactivation( $file )
	{
		// delete default access token
		//ACL::destroy_token( 'post_as' );
	}

	/**
	 * Add 'post as' to the publish form
	 **/
	public function action_form_publish ( $form, $post )
	{
		if ( User::identify()->can('post_as') && $form->content_type->value == Post::type( 'article' ) ) {


			// make a dropdown of all users with set display names
			$users = Users::get_all(); 						// put all user-objects in one array 
			$names = array(); 								// create second, empty array
			$i = 1;
			foreach ($users as $user) { 					// for every user of the first one... 
				if ( $i == 1 ) {
					$names[] = 'Yourself';
					$i++;
				}
				if ( $user->info->displayname ) {			// ...if he has a displayname...
					$names[] = $user->info->displayname;	// ...fill an object in the new array aka [nr] => [displayname]
				}
			} 												// use this value in the dropdown
			$form->append( 'select', 'user', 'null:null', _t( 'Post as:' ), $names, 'tabcontrol_select' ); 
			$ids = array();
			$i = 1;
			foreach ($users as $user) { 					// ..
				if ( $i == 1 ) {
					$ids[] = '0';
					$i++;
				}
				if ( $user->info->displayname ) {
					$ids[] = $user->id;						// overwrite the displaynames with ids, cause this is what we receive from the db
					$i++;
				}
			}
			$key = array_search( $post->info->author, $ids ); 
			$form->user->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			$form->user->tabindex = 4;
			$form->user->move_after($form->tags);

		}
	}

	/**
	 * Process appended author when the publish form is received
	 *
	 **/
	public function action_publish_post( $post, $form )
	{

			// create exactly the same array as above, but with id's 
			// and save them as $post->info->user object to the db
			$users = Users::get_all();
			$names = array();
			$i = 1;
			foreach ($users as $user) { 
				if ( $i == 1 ) {
					$names[] = '0';
					$i++;
				}
				if ( $user->info->displayname ) {
					$names[] = $user->id;
					$i++;
				}
			}
			$post->info->author = $names[$form->user->value];

	}


}

?>
