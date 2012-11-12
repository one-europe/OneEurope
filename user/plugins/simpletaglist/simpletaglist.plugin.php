<?php
class SimpleTagList extends Plugin
{
	/**
	 * On plugin init, add the template included with this plugin to the available templates in the theme
	 */
	public function action_init()
	{
		$this->add_template( 'simpletaglist', dirname(__FILE__) . '/simpletaglist.php' );
	}

	/**
	 * Add simplified tag array to the available template vars
	 * @param Theme $theme The theme that will display the template
	 **/
	public function theme_tag_links( $theme, $sortorder = 'term_display asc' )
	{
		$theme->tag_links = Tags::vocabulary()->get_tree( $sortorder );
		return $theme->fetch( 'simpletaglist' );
	}
}

?>
