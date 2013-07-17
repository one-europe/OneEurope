<?php if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); } ?>

<?php
Config::set( 'db_connection', array(
	'connection_string'=>'mysql:host=HOST;dbname=DBNAME',
	'username'=>'USERNAME',
	'password'=>'PASSWORD',
	'prefix'=>'PREFIX'
));

// $locale = 'en-us';
?>
