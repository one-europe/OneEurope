<?php

if ( !defined( 'HABARI_PATH' ) ) { die( 'No direct access' ); }

Config::set( 'db_connection', array(
	'connection_string'=>'mysql:host=HOST;dbname=DBNAME',
	'username'=>'USERNAME',
	'password'=>'PASSWORD',
	'prefix'=>'PREFIX'
));

error_reporting(E_PARSE);

?>