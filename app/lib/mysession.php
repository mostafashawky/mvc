<?php

namespace MVC\LIB;

class mysession extends \sessionhandler	
{
	// Set Session Cookie Params
	const COOKIE_SETTINGS = [
		'lifetime' => 0,
		'path'	   => '/',
		'domain'   => 'mvcapp.nt',
		'httponly' => true,
	];

	// Set Session Name 
	const SESSION_NAME = 'mvcsession';
		
	// Set The File Session Will Be Saved
	const SESSION_FILE_PATH = SESSION_PATH;

	public function __construct( $path = SESSION_PATH )
	{
		\session_name( self::SESSION_NAME );
		\session_set_cookie_params( self::COOKIE_SETTINGS);
		\session_save_path( self::SESSION_FILE_PATH ) ;
	}

	public function startSession()
	{
		session_start();
	}

	public function __set( $key, $value )
	{

		return $_SESSION[ $key ] = $value;
	}
	public function __isset( $key )
	{
		return isset( $_SESSION[ $key] ) ? true : false;
	}
	public function __get( $key )
	{

		return (isset( $_SESSION[ $key ]) ? $_SESSION[ $key ] : 'sorry' );
	}
		
}



