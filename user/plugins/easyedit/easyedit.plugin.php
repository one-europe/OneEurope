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


			// Get author list
			$author_list = Users::get_all();
			$authors[0] = 'Select author';
			foreach ( $author_list as $author ) {
				$authors[ $author->id ] = $author->displayname;
			}
			$form->append( 'select', 'user', 'null:null', _t( 'Post as:' ), $authors, 'tabcontrol_select' ); 

			// retrieve current db entry
			if ($post->info->author && $post->info->author != 0 ) {
				$selected_user = $post->info->author;
			} else {
				$selected_user = User::identify()->id;
			}
			
			$author_ids[0] = '';
			foreach ($author_list as $author) { 					// ..
					$author_ids[ $author->id ] = $author->id;		// overwrite the displaynames with ids, cause this is what we receive from the db
			}

			$key = array_search( $selected_user, $author_ids ); 
			$form->user->value = $key;						// ..& retranslate this id to the right correct index in the dropdown.
			$form->user->tabindex = 4;
			$form->user->move_after($form->tags);





			// make a dropdown of all users with set display names
			/*$users = Users::get_all(); 						// create array with all users 
			$names = array(); 								// create another, empty array
			$i = 1;
			foreach ($users as $user) { 					// for every user in the first array.. 
				if ( $i == 1 ) {							// if current index == 0, show my own name
					$myname = User::identify()->displayname;
					$names[] = 'You, resp. the account which created this post (that is: ' . $myname . ')';
					$i++;
				}
				if ( $user->info->displayname ) {			// ...if he has a displayname...
					$names[] = $user->info->displayname;	// ...add [id] => [displayname] to the array
				}
			} 												// use this value in the dropdown*/


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
			
			// Get author list
			$author_list = Users::get_all();
			$authors[0] = '';
			foreach ( $author_list as $author ) {
				$authors[ $author->id ] = $author->id;
			}

			$post->info->author = $authors[$form->user->value];

	}


}

?>
