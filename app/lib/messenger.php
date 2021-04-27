<?php
/*
** Start Again
** You Can Do It
** You Should Trust In Your Self
*/

namespace MVC\LIB;

class Messenger
{
    const MESSAGE_SUCCESS = 1;
    const MESSAGE_WARNING = 2;
    const MESSAGE_ERROR   = 3;

    // Instance Porperty Will Contain This Object(Messenger)
    private static $instance;
    
    // Session Object
    private $_session;

    // Message 
    private $_message;
    
    // Prevent Instantiate New Objects 
    private function __construct( $session )
    {
        $this->_session = $session;
    }
    private function __clone(){}

    // Get Object Messenge From This Method
    public static function getInstance( SessionManger $session ) // @param Session That Will Provided With Message
    {
        if( self::$instance == null ){
            self::$instance = new self( $session );
        }
        return self::$instance;
    }

    // Method To Get Messenge
    public function getMessage()
    {
        // Check If There Is Message Key In Session File And Not Empty
        if( $this->messageExist() && !empty( $this->_session->message )  ){
             $this->_message = $this->_session->message;
             unset($this->_session->message);
             return $this->_message;
        } else {
            return [];
        }
    } 

    // Method To Set Message 
    public function setMessage( $message, $status = self::MESSAGE_SUCCESS )
    {
        // First We Check If There Is Message Key In Session If Not Found We Assign It With Empty Array
        if( !$this->messageExist() ){
            $this->_session->message = [];
        } 

        $msg = $this->_session->message;
        $msg[] = [$message,$status];
        $this->_session->message = $msg;
    }

    // Metho To Check If Message Key Exist In Array
    private function messageExist( )
    {
        return isset( $this->_session->message ) ? true : false;
    }

    
}