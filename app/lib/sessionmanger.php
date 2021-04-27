<?php

namespace MVC\LIB;

class SessionManger extends \SessionHandler
{
	private $sessionName = 'mvcsession';
	private $cookiePath  = '/';
	private $domain		 = 'mvcapp.nt';
	private $secure	     = false;
	private $http  	     = true;
	private $cookieTime  = 0;
	
	// Cryptographt Data In Session File	
	private $cipherAlgo  = 'AES-256-ECB';
	private $cipherKey  = "wehashthis2021";

	// The Name Of The Directory That Session Will save
	private $sessionPath =  SESSION_PATH;

	public function __construct( )
	{
		// Check If The Server Contain SSL
		if( isset( $_SERVER['HTTPS'] ) ) {
			$this->secure = true;
		}
		\session_name( $this->sessionName );
		\session_save_path( $this->sessionPath );
		ini_set( 'session.use_cookies', 1 );
		ini_set(' session.use_only_cookies',1);
		ini_set( 'session.save_handler','files' );
		ini_set( 'session.use_trans_sid', 0 );
		\session_set_cookie_params( $this->cookieTime, $this->cookiePath, $this->domain, $this->secure, $this->http );
		
		// This Method Specific The Manner Of Session Storage Save
		//\session_set_save_handler( $this, true ) ;
	}

	public function __get( $key )
	{

		return 	(isset( $_SESSION[ $key ]) ? $_SESSION[ $key ] : false) ;
	}
	
	public function __set( $key, $value )
	{
	
		 $_SESSION[ $key ] = $value;
	}

	public function __isset( $key )
	{
		return isset( $_SESSION[ $key] ) ? true : false;
	}

	public function __unset( $key )
	{
		unset( $_SESSION[$key] );
	}

	public function write( $id, $data )
	{
	 	return parent::write( $id, openssl_encrypt( $data, $this->cipherAlgo, $this->cipherKey ) );
	}

	public function read( $id )
	{
		
		if( parent::read($id) == '' ) {
			return parent::read($id);
		}
		 return openssl_decrypt(parent::read($id), $this->cipherAlgo, $this->cipherKey)	;
	}		

	
	public function startSession()
	{
		if(  session_id() == '' ){
			session_start();
		}
	}
	public function sessionKill()
	{
		\session_unset();
		// Delete Cookie 
		\setcookie( $this->sessionName, '', time()- 5000, $this->cookiePath, $this->domain );
		session_destroy();

	}

		
}



