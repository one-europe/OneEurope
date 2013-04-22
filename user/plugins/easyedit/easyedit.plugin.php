<?php

class EasyEdit extends Plugin
{
	/**
	 * Create admin token for posting as somebody else
	 **/
	public function action_plugin_activation( $file )
	{
		// create default access token
		ACL::create_token( 'post_as', _t( 'Post as' ), 'Administration', false );
		$group = UserGroup::get_by_name( 'admin' );
		$group->grant( 'post_as' );
	}

	/**
	 * Remove the admin token
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

		}
	}

	/**
	 * Select the right author when publish form is being loaded
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
