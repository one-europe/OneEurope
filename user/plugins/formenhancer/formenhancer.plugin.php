<?php

class Formenhancer extends Plugin
{
	
	public function action_admin_header() {	
		// Make sure that jQuery is loaded first.
		Stack::add('admin_header_javascript', URL::get_from_filesystem(__FILE__) . '/jquery.counter.js', 'charcountdown', 'jquery');
		Stack::add('admin_stylesheet', array(URL::get_from_filesystem(__FILE__) . '/jquery.counter.css', 'screen'), 'suggestr' );
		
		//Stack::add('admin_header_javascript', URL::get_from_filesystem(__FILE__) . '/counter.js', 'charcountdownconfig', 'jquery');	
	
	}

}

?>
