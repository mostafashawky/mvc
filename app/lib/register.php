<?php
namespace MVC\LIB;

// Register Object Hanlde The Interface Service Object 
class Register
{
    private static $instance;

    // Prevent Instantiate Objects
    private function __construct(){}
    private function __clone(){}
    
    // Set Object Here
    public function __set( $key, $value )
    {
        $this->$key = $value;
    }
    
    public function __get( $key )
    {
        return isset($this->$key) ? $this->$key : 'Sorry This Object '. $key .' Dosen\'t Exit'; 
    }

    public static function getInstance()
    {
        if( self::$instance == null ){
            self::$instance = new self();
        }
        return self::$instance;
    } 

}
