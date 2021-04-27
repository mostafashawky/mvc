<?php 
namespace MVC\LIB;

use MVC\LIB\SessionManger;
class Authorized
{
    private static $_instance;
    private $_session;
    private function __construct( $session )
    {
        $this->_session = $session;
    }
    private function __clone(){}
    
    public static function getInstance( SessionManger $session )
    {
        if( self::$_instance == null ) {
            self::$_instance = new self( $session );
        }
        return self::$_instance;
    }

    public function is_authorized()
    {
         return isset( $this->_session->user ) ;
    }
}